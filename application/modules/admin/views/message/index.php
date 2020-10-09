<?php

use yii\grid\GridView;
use app\models\Message;

/** @var $this \yii\web\View */
/** @var $dataProvider \yii\data\ActiveDataProvider */
/** @var $searchModel \app\modules\admin\models\Photo */

$this->title = Yii::t('app', 'Manage messages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-tabs-custom">
    <div class="tab-content no-padding table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{summary}\n{items}\n{pager}",
            'tableOptions' => ['class' => 'table table-vcenter'],
            'columns' => [
                [
                    'attribute' => 'fromUser',
                    'format' => 'raw',
                    'contentOptions' => ['width' => 250, 'style' => 'vertical-align: top !important'],
                    'value' => function(Message $model) {
                        return $this->render('/partials/_user_column', [
                            'user' => $model->sender,
                        ]);
                    }
                ],
                [
                    'attribute' => 'toUser',
                    'format' => 'raw',
                    'contentOptions' => ['width' => 250, 'style' => 'vertical-align: top !important'],
                    'value' => function(Message $model) {
                        return $this->render('/partials/_user_column', [
                            'user' => $model->receiver,
                        ]);
                    }
                ],
                [
                    'attribute' => 'text',
                    'format' => 'raw',
                    'value' => function (Message $model) {
                        return $this->render('_message', [
                            'model' => $model,
                        ]);
                    }
                ],
                [
                    'attribute' => 'created_at',
                    'contentOptions' => ['style' => 'vertical-align: top !important'],
                    'value' => function ($model) {
                        if (extension_loaded('intl')) {
                            return Yii::t('app', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
                        } else {
                            return date('Y-m-d G:i:s', $model->created_at);
                        }
                    },
                ],
            ],
        ]); ?>
    </div>
</div>
