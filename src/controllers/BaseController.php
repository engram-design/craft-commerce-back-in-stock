<?php
/**
 * Back In Stock plugin for Craft CMS 3.x
 *
 * Back in stock Craft Commerce 2 plugin
 *
 * @link      https://www.mylesderham.dev/
 * @copyright Copyright (c) 2019 Myles Derham
 */

namespace mediabeastnz\backinstock\controllers;

use mediabeastnz\backinstock\BackInStock;
use mediabeastnz\backinstock\records\BackInStockRecord;
use mediabeastnz\backinstock\models\BackInStockModel;

use Craft;
use craft\web\Controller;
use craft\commerce\elements\Variant;

/**
 * @author    Myles Derham
 * @package   BackInStock
 */
class BaseController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['register-interest'];

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionRegisterInterest()
    {
        
        $this->requirePostRequest();

        $session = Craft::$app->getSession();
        $request = Craft::$app->getRequest();
        
        $email = $request->getParam('email');
        $variantId = $request->getParam('variantId');

        if ($variantId == '' || !is_numeric($variantId)) {
            $error = Craft::t('craft-commerce-back-in-stock', 'Sorry you couldn\'t be added to the notifications list');

            if ($request->getAcceptsJson()) {
                return $this->asJson([
                    'success' => false,
                    'error' => $error,
                ]);
            }

            Craft::$app->getUrlManager()->setRouteParams([
                'error' => $error,
            ]);

            return null;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = Craft::t('craft-commerce-back-in-stock', 'Please Enter a Valid Email Address');

            if ($request->getAcceptsJson()) {
                return $this->asJson([
                    'success' => false,
                    'error' => $error,
                ]);
            }

            Craft::$app->getUrlManager()->setRouteParams([
                'error' => $error,
            ]);

            return null;
        }

        //check is product exists and is actually out of stock
        $variant = Variant::findOne($variantId);
        if (!$variant || $variant->hasStock()) {
            return false;
        }

        $model = new BackInStockModel();
        $model->variantId = $variantId;
        $model->email = $email;

        if (!BackInStock::$plugin->backInStockService->createBackInStockRecord($model)) {
            $error = Craft::t('craft-commerce-back-in-stock', 'We couldn\'t save your request');

            if ($request->getAcceptsJson()) {
                return $this->asJson([
                    'success' => false,
                    'error' => $error,
                ]);
            }

            Craft::$app->getUrlManager()->setRouteParams([
                'error' => $error,
            ]);

            return null;
        }

        if ($request->getAcceptsJson()) {
            return $this->asJson([
                'success' => true,
                'message' => Craft::t('craft-commerce-back-in-stock', $email . ' will be notified when ' . $variant->title . ' is available'),
            ]);
        }

        return $this->redirectToPostedUrl();
    }
}
