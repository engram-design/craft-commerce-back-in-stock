<?php
namespace verbb\backinstock\models;

use verbb\backinstock\records\Log as LogRecord;

use Craft;
use craft\base\Model;
use craft\helpers\App;
use craft\helpers\Json;

use DateTime;

use yii\validators\InlineValidator;

use craft\commerce\elements\Variant;

class Log extends Model
{
    // Properties
    // =========================================================================

    public ?string $id = null;
    public ?int $variantId = null;
    public ?string $locale = null;
    public array $options = [];
    public bool $isNotified = false;
    public ?DateTime $dateCreated = null;
    public ?DateTime $dateUpdated = null;
    public ?string $uid = null;

    private ?string $_email = null;


    // Public Methods
    // =========================================================================

    public function defineRules(): array
    {
        $rules = parent::defineRules();
        $rules[] = [['email', 'variantId'], 'required'];
        $rules[] = [['email'], 'email', 'enableIDN' => App::supportsIdn(), 'enableLocalIDN' => false];
        $rules[] = [['variantId'], 'number', 'integerOnly' => true];
        $rules[] = [['variantId'], 'validateVariant'];
        $rules[] = [['variantId'], 'validateLog'];

        return $rules;
    }

    public function getEmail(): ?string
    {
        return $this->_email;
    }

    public function setEmail(?string $email): void
    {
        $this->_email = trim(strtolower($email));
    }

    public function getVariant(): ?Variant
    {
        if ($this->variantId) {
            return Variant::findOne($this->variantId);
        }

        return null;
    }

    public function validateVariant(string $attribute, ?array $params, InlineValidator $validator): void
    {
        $variant = $this->getVariant();

        if (!$variant) {
            $validator->addError($this, $attribute, Craft::t('craft-commerce-back-in-stock', 'Unable to find variant.'), $params);
        }

        if ($variant && $variant->hasStock()) {
            $validator->addError($this, $attribute, Craft::t('craft-commerce-back-in-stock', 'Variant is in stock.'), $params);
        }
    }

    public function validateLog(string $attribute, ?array $params, InlineValidator $validator): void
    {
        $duplicateRecord = LogRecord::findOne([
            'variantId' => $this->variantId,
            'locale' => $this->locale,
            'email' => $this->getEmail(),
            'options' => Json::encode($this->options),
            'isNotified' => false,
        ]);

        if ($duplicateRecord) {
            $validator->addError($this, $attribute, Craft::t('craft-commerce-back-in-stock', 'Your email is already subscribed to receive updates for this product.'), $params);
        }
    }

}
