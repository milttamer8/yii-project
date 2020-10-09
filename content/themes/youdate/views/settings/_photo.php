<?php

use app\models\Photo;
use app\helpers\Html;

/** @var $model Photo */
/** @var $profile \app\models\Profile */
/** @var $photoModerationEnabled bool */

$profile = Yii::$app->user->identity->profile;
$previewUrl = $model->getThumbnail(200, 200, 'crop-center', ['sharp' => 1]);
?>
<div class="photo-item col-sm-4">
    <div class="card">
        <img class="card-img-top" src="<?= $previewUrl ?>">
        <div class="card-body d-flex flex-column pt-2 pl-2 pr-2 pb-2">
            <div class="d-flex align-items-center mt-auto">
                <?php if ($model->is_verified): ?>
                    <div>
                        <span class="text-muted"><?= Yii::t('youdate', 'Verified') ?></span>
                    </div>
                <?php elseif ($photoModerationEnabled == true && !$model->is_verified): ?>
                    <div>
                        <span class="text-warning bg-orange-darker rounded px-2 py-1" rel="tooltip" title="<?= Yii::t('youdate', 'This photo must be approved by administration') ?>">
                            <?= Yii::t('youdate', 'Not verified') ?>
                        </span>
                    </div>
                <?php endif; ?>
                <div class="ml-auto">
                    <?= Html::a('<i class="fe fe-check"></i>', ['/photo/set-main', 'id' => $model->id], [
                        'class' => 'btn btn-ajax btn-sm btn-' . ($profile->photo_id == $model->id ? 'primary' : 'secondary'),
                        'data-pjax-container' => '#pjax-settings-photos',
                        'data-type' => 'post',
                    ]) ?>
                    <?php if ($model->is_private == false): ?>
                        <?= Html::a('<i class="fe fe-eye"></i>', ['/photo/toggle-private', 'id' => $model->id], [
                            'class' => 'btn btn-ajax btn-sm btn-success',
                            'data-pjax-container' => '#pjax-settings-photos',
                            'data-type' => 'post',
                            'rel' => 'tooltip',
                        ]) ?>
                    <?php else: ?>
                        <?= Html::a('<i class="fe fe-eye-off"></i>', ['/photo/toggle-private', 'id' => $model->id], [
                            'class' => 'btn btn-ajax btn-sm btn-warning',
                            'data-pjax-container' => '#pjax-settings-photos',
                            'data-type' => 'post',
                            'rel' => 'tooltip',
                        ]) ?>
                    <?php endif; ?>
                    <?= Html::a('<i class="fe fe-trash"></i>', ['/photo/delete', 'id' => $model->id], [
                        'class' => 'btn btn-ajax btn-sm btn-danger',
                        'data-pjax-container' => '#pjax-settings-photos',
                        'data-confirm-title' => Yii::t('youdate', 'Delete this photo?'),
                        'data-title' => Yii::t('youdate', 'Delete photo'),
                        'data-type' => 'post',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
