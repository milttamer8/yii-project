<?php

namespace app\forms;

use app\base\Model;
use app\components\data\DataExportManager;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\forms
 */
class DataRequestForm extends Model
{
    /**
     * @var string
     */
    public $format;

    public function init()
    {
        parent::init();
        if (!isset($this->format)) {
            $this->format = DataExportManager::FORMAT_HTML;
        }
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['format', 'in', 'range' => array_keys($this->getFormatList())],
        ];
    }

    /**
     * @return array
     */
    public function getFormatList()
    {
        return DataExportManager::getFormatsList();
    }
}
