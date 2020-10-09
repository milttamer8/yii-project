<?php

namespace app\modules\admin\widgets;

use app\helpers\Html;
use app\helpers\Url;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\modules\admin\widgets
 */
class CitySelector extends SelectizeDropDownList
{
    /**
     * @var array 'value' and 'title'
     */
    public $preloadedValue;

    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['class' => 'city-selector']);
        $this->clientOptions = [
            'render' => [
                'option' => new \yii\web\JsExpression("function(item, escape) {
                    return '<div class=\"px-2 my-2\">' +
                        '<div class=\"title\"><span class=\"name\">' + escape(item.city) + '</span></div>' +
                        (item.region ? '<div class=\"region text-muted\"><small>' + escape(item.region) + '</small></div>' : '') +
                    '</div>';
                }"),
            ],
            'score' => new \yii\web\JsExpression("function() { 
                return function() { 
                    return 1; 
                }; 
            }"),
            'load' => new \yii\web\JsExpression('function(query, callback) {
                var self = this;
                if (!query.length) return callback();
                $.ajax({
                    url: \'' . Url::to(['default/find-cities']) . '\',
                    type: \'GET\',
                    dataType: \'json\',
                    data: {
                        country: $(\'.country-selector\').val(),
                        query: query,
                    },
                    error: function() {
                        callback();
                    },
                    success: function(response) {
                        self.clearOptions();
                        callback(response.cities);
                    }
                });
            }'),
            'onInitialize' => new \yii\web\JsExpression('function() {
                var selectize = this;
                var preloadedValue = ' . (int) $this->preloadedValue['value'] . ';
                if (preloadedValue) {
                    selectize.addOption({
                        \'value\': preloadedValue, 
                        \'text\': \''. addslashes($this->preloadedValue['city']) . '\',
                        \'city\': \''. addslashes($this->preloadedValue['city']) . '\',
                        \'region\': \'' . addslashes($this->preloadedValue['region']) . '\',
                        \'population\': \'' . addslashes($this->preloadedValue['population']) . '\'
                    });
                }
                $(".selectize-input input").attr("autocomplete", "new-password");
            }')
        ];
    }
}
