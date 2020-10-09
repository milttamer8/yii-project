<?php

use app\helpers\Html;
use yii\helpers\ArrayHelper;

/** @var $content string */
/** @var $pages array */

?>
<?php $this->beginContent('@theme/views/data-export/layout.php'); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->params['userDisplayName']) ?></h4>
    </div>
    <table class="table card-table">
        <tbody>
        <?php foreach ($pages as $page => $params): ?>
            <?php if (ArrayHelper::getValue($params, 'excludeFromMenu', false) === false): ?>
                <tr>
                    <td width="1"><i class="fe fe-<?= ArrayHelper::getValue($params, 'icon') ?> text-gray"></i></td>
                    <td>
                        <?= Html::encode(ArrayHelper::getValue($params, 'title')) ?>
                        <a href="<?= $page ?>.html" class="btn btn-sm btn-outline-primary float-right"><?= Yii::t('youdate', 'View') ?></a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php $this->endContent(); ?>
