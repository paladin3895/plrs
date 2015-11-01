<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reports');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'patient.name',
            'operator.username',
            'date',

            [
								'class' => 'yii\grid\ActionColumn',
								'buttons' => [
										'view' => function ($url, $model, $key) {
                                /** @var ActionColumn $column */
                                return Html::a('View Medical Record', $url, [
                                        'title' => Yii::t('yii', 'View'),
                                ]);
                  	}
								],
								'template' => '{view}'
						],
        ],
    ]); ?>

</div>
