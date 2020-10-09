<?php

namespace app\traits;

use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\traits
 */
trait IsOneCountryModeTrait
{
    /**
     * @var bool
     */
    private $_isOneCountryOnly;
    /**
     * @var string
     */
    private $_countryDefault;

    /**
     * @return bool
     * @throws \Exception
     */
    public function isOneCountryOnly()
    {
        if (!isset($this->_isOneCountryOnly)) {
            $this->_isOneCountryOnly = Yii::$app->settings->get('frontend', 'siteOneCountryOnly', false);
        }

        return $this->_isOneCountryOnly;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getDefaultCountry()
    {
        if (!isset($this->_countryDefault)) {
            $this->_countryDefault = Yii::$app->settings->get('frontend', 'siteCountry');
        }

        return $this->_countryDefault;
    }
}
