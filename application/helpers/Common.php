<?php

namespace app\helpers;

use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\helpers
 */
class Common
{
    /**
     * @param null $language
     * @return null|string
     */
    public static function getShortLanguage($language = null)
    {
        $language = $language == null ? Yii::$app->language : $language;
        $languageParts = explode('-', $language);
        if (count($languageParts)) {
            return $languageParts[0];
        }

        return $language;
    }
}
