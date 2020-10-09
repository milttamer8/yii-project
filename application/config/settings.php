<?php

use app\helpers\Html;
use yii\helpers\ArrayHelper;
use app\helpers\Timezone;
use app\models\Currency;
use app\models\Language;

/**
 * Do not edit this file
 */

return function() {
    return [
        'main' => [
            [
                'alias' => 'siteName',
                'type' => 'text',
                'label' => Yii::t('app', 'Site name'),
                'rules' => [
                    ['string', 'min' => 2, 'max' => 255],
                    ['default', 'value' => 'YouDate'],
                ]
            ],
            [
                'alias' => 'siteOneCountryOnly',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'One country mode only'),
                'rules' => [
                    ['boolean'],
                    ['default', 'value' => false],
                ]
            ],
            [
                'alias' => 'siteCountry',
                'type' => 'dropdown',
                'label' => Yii::t('app', 'Site country'),
                'help' => Yii::t('app', 'Works when "One country mode" is enabled'),
                'options' => function() {
                    return Yii::$app->geographer->getCountriesList();
                },
                'rules' => [
                    ['string', 'min' => 2, 'max' => 5],
                ]
            ],
            [
                'alias' => 'siteLanguage',
                'type' => 'dropdown',
                'label' => Yii::t('app', 'Site language'),
                'options' => function() {
                    return ArrayHelper::map(
                        Language::findAll(['status' => Language::STATUS_ACTIVE]), 'language_id', 'name'
                    );
                },
                'rules' => [
                    ['string', 'min' => 2, 'max' => 5],
                ]
            ],
            [
                'alias' => 'siteLanguageAutodetect',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'Autodetect language based on user\'s browser language'),
                'rules' => [
                    ['boolean'],
                    ['default', 'value' => true],
                ]
            ],
            [
                'alias' => 'siteTimezone',
                'type' => 'dropdown',
                'label' => Yii::t('app', 'Site timezone'),
                'options' => function() {
                    return ArrayHelper::map(Timezone::getAll(), 'timezone', 'name');
                },
                'rules' => [
                    ['string', 'max' => 40],
                ]
            ],
            [
                'alias' => 'siteMetaDescription',
                'type' => 'textarea',
                'label' => Yii::t('app', 'Meta description'),
                'rules' => [
                    ['string', 'min' => 10, 'max' => 255],
                ]
            ],
            [
                'alias' => 'siteMetaKeywords',
                'type' => 'textarea',
                'label' => Yii::t('app', 'Meta keywords'),
                'rules' => [
                    ['string', 'min' => 10, 'max' => 255],
                ]
            ],
            [
                'alias' => 'siteRequireCaptcha',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'Require captcha on login/signup/restore'),
                'rules' => [
                    ['boolean'],
                    ['default', 'value' => false],
                ]
            ],
            [
                'alias' => 'siteRequireEmailVerification',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'Require e-mail verification on signup'),
                'rules' => [
                    ['boolean'],
                    ['default', 'value' => true],
                ],
            ],
            [
                'alias' => 'sitePremiumFeaturesEnabled',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'Enable premium features and balance'),
                'rules' => [
                    ['boolean'],
                    ['default', 'value' => true],
                ],
            ],
            [
                'alias' => 'sitePreferUsersWithPhoto',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'Search users with photo by default'),
                'rules' => [
                    ['boolean'],
                    ['default', 'value' => true],
                ],
            ],
            [
                'alias' => 'siteHideUsersFromGuests',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'Hide user profiles from guests'),
                'rules' => [
                    ['boolean'],
                    ['default', 'value' => false],
                ],
            ],
            [
                'alias' => 'siteHideDirectoryFromGuests',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'Hide directory/browse page from guests'),
                'rules' => [
                    ['boolean'],
                    ['default', 'value' => false],
                ],
            ],
            [
                'alias' => 'siteHeaderCode',
                'type' => 'code',
                'label' => Yii::t('app', 'Additional HTML code (header)'),
                'help' => Yii::t('app', 'Styles, Scripts, Meta tags'),
                'rules' => [
                    ['string', 'max' => 8000],
                ],
            ],
            [
                'alias' => 'siteFooterCode',
                'type' => 'code',
                'label' => Yii::t('app', 'Additional HTML code (footer)'),
                'help' => Yii::t('app', 'Scripts, Analytics'),
                'rules' => [
                    ['string', 'max' => 8000],
                ],
            ]
        ],
        'photos' => [
            [
                'alias' => 'photoModerationEnabled',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'Photo moderation enabled'),
                'rules' => [
                    ['boolean'],
                    ['default', 'value' => true],
                ]
            ],
            [
                'alias' => 'photoMinWidth',
                'type' => 'text',
                'label' => Yii::t('app', 'Photo min width'),
                'rules' => [
                    ['number', 'min' => 0, 'max' => 10000, 'integerOnly' => true],
                ]
            ],
            [
                'alias' => 'photoMinHeight',
                'type' => 'text',
                'label' => Yii::t('app', 'Photo min height'),
                'rules' => [
                    ['number', 'min' => 0, 'max' => 10000, 'integerOnly' => true],
                ]
            ],
            [
                'alias' => 'photoMaxFileSize',
                'type' => 'text',
                'label' => Yii::t('app', 'Photo max file size (MB)'),
                'rules' => [
                    ['number', 'min' => 1, 'max' => 200, 'integerOnly' => true],
                ]
            ],
            [
                'alias' => 'photoMaxFiles',
                'type' => 'text',
                'label' => Yii::t('app', 'Photo max files per upload'),
                'rules' => [
                    ['number', 'min' => 1, 'max' => 100, 'integerOnly' => true],
                ]
            ],
        ],
        'payment' => [
            [
                'alias' => 'paymentCurrency',
                'type' => 'dropdown',
                'options' => function() {
                    return ArrayHelper::map(Currency::find()->all(), 'code', 'title');
                },
                'label' => Yii::t('app', 'Site currency'),
                'rules' => [
                    ['in', 'range' => function() {
                        return ArrayHelper::getColumn(Currency::find()->all(), 'code');
                    }],
                ]
            ],
            [
                'alias' => 'paymentRate',
                'type' => 'text',
                'label' => Yii::t('app', 'Credits per 1.00 of currency'),
                'help' => Yii::t('app', 'Default value: {value}', ['value' => 10]),
                'rules' => [
                    ['required'],
                    ['integer', 'min' => 1, 'max' => 10000],
                    ['default', 'value' => 10],
                ]
            ],
            [
                'alias' => 'paymentStripeEnabled',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'Stripe enabled'),
                'rules' => [
                    ['boolean'],
                    ['default', 'value' => true],
                ]
            ],
            [
                'alias' => 'paymentStripeSecretKey',
                'type' => 'text',
                'label' => Yii::t('app', 'Stripe Secret Key'),
                'help' => Yii::t('app', 'Begins with sk_'),
                'rules' => [
                    ['string', 'max' => 100],
                ]
            ],
            [
                'alias' => 'paymentStripePublishableKey',
                'type' => 'text',
                'label' => Yii::t('app', 'Stripe Publishable Key'),
                'help' => Yii::t('app', 'Begins with pk_'),
                'rules' => [
                    ['string', 'max' => 100],
                ]
            ],
            [
                'alias' => 'paymentPaypalEnabled',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'PayPal enabled'),
                'rules' => [
                    ['boolean'],
                    ['default', 'value' => true],
                ]
            ],
            [
                'alias' => 'paymentPaypalClientId',
                'type' => 'text',
                'label' => Yii::t('app', 'PayPal Client ID'),
                'rules' => [
                    ['string', 'max' => 100],
                ]
            ],
            [
                'alias' => 'paymentPaypalClientSecret',
                'type' => 'text',
                'label' => Yii::t('app', 'PayPal Client Secret'),
                'rules' => [
                    ['string', 'max' => 100],
                ]
            ],
            [
                'alias' => 'paymentPaypalSandbox',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'PayPal Sandbox mode'),
                'rules' => [
                    ['boolean'],
                ]
            ],
        ],
        'prices' => [
            [
                'alias' => 'pricePremium',
                'type' => 'text',
                'label' => Yii::t('app', 'Premium price'),
                'rules' => [
                    ['default', 'value' => 100],
                    ['integer', 'min' => 1, 'max' => 10000],
                ]
            ],
            [
                'alias' => 'premiumDuration',
                'type' => 'text',
                'label' => Yii::t('app', 'Premium duration (days)'),
                'help' => Yii::t('app', 'Default value: {value}', ['value' => 30]),
                'rules' => [
                    ['integer', 'min' => 1, 'max' => 1000],
                    ['default', 'value' => 30],
                ]
            ],
            [
                'alias' => 'priceBoost',
                'type' => 'text',
                'label' => Yii::t('app', 'Boost price'),
                'rules' => [
                    ['default', 'value' => 20],
                    ['integer', 'min' => 1, 'max' => 10000],
                ]
            ],
            [
                'alias' => 'boostDuration',
                'type' => 'text',
                'label' => Yii::t('app', 'Boost duration (days)'),
                'help' => Yii::t('app', 'Default value: {value}', ['value' => 30]),
                'rules' => [
                    ['integer', 'min' => 1, 'max' => 1000],
                    ['default', 'value' => 30],
                ]
            ],
            [
                'alias' => 'priceSpotlight',
                'type' => 'text',
                'label' => Yii::t('app', 'Spotlight price'),
                'rules' => [
                    ['default', 'value' => 50],
                    ['integer', 'min' => 0, 'max' => 10000],
                ]
            ],
            [
                'alias' => 'priceGift',
                'type' => 'text',
                'label' => Yii::t('app', 'Default gift price'),
                'rules' => [
                    ['default', 'value' => 100],
                    ['integer', 'min' => 0, 'max' => 10000],
                ]
            ],
        ],
        'social' => [
            [
                'alias' => 'facebookEnabled',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'Facebook enabled'),
                'rules' => [
                    ['boolean'],
                ]
            ],
            [
                'alias' => 'facebookAppId',
                'type' => 'text',
                'label' => Yii::t('app', 'Facebook App ID'),
                'rules' => [
                    ['string', 'max' => 255],
                ]
            ],
            [
                'alias' => 'facebookAppSecret',
                'type' => 'text',
                'label' => Yii::t('app', 'Facebook App Secret'),
                'rules' => [
                    ['string', 'max' => 255],
                ]
            ],
            [
                'alias' => 'twitterEnabled',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'Twitter enabled'),
                'rules' => [
                    ['boolean'],
                ]
            ],
            [
                'alias' => 'twitterConsumerKey',
                'type' => 'text',
                'label' => Yii::t('app', 'Twitter Consumer Key'),
                'rules' => [
                    ['string', 'max' => 255],
                ]
            ],
            [
                'alias' => 'twitterConsumerSecret',
                'type' => 'text',
                'label' => Yii::t('app', 'Twitter Consumer Secret'),
                'rules' => [
                    ['string', 'max' => 255],
                ]
            ],
            [
                'alias' => 'vkEnabled',
                'type' => 'checkbox',
                'label' => Yii::t('app', 'VK enabled'),
                'rules' => [
                    ['boolean'],
                ]
            ],
            [
                'alias' => 'vkAppId',
                'type' => 'text',
                'label' => Yii::t('app', 'VK App ID'),
                'rules' => [
                    ['string', 'max' => 255],
                ]
            ],
            [
                'alias' => 'vkAppSecret',
                'type' => 'text',
                'label' => Yii::t('app', 'VK App Secret'),
                'rules' => [
                    ['string', 'max' => 255],
                ]
            ],
        ],
        'license' => [
            [
                'alias' => 'appLicenseKey',
                'type' => 'text',
                'label' => Yii::t('app', 'Item Purchase Code'),
                'help' => Yii::t('app', 'Codecanyon Purchase Code. See {link} for more details', [
                    'link' => Html::a(Yii::t('app', 'this page'), 'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-'),
                ]),
                'rules' => [
                    ['string', 'max' => 255],
                ]
            ],
        ],
    ];
};
