<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\plrs\Report */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Report').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            <?=
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'),
                ['pdf', 'id' => $model['id']],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        [
            'attribute' => 'patient.name',
            'label' => Yii::t('app', 'Patient'),
        ],
        [
            'attribute' => 'operator.username',
            'label' => Yii::t('app', 'Operator'),
        ],
        'date',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>

    <div class="row">
<?php
    $gridColumnReportTest = [
        ['class' => 'yii\grid\SerialColumn'],
        // ['attribute' => 'id', 'hidden' => true],
        // [
        //     'attribute' => 'report.id',
        //     'label' => Yii::t('app', 'Report'),
        // ],
        [
            'attribute' => 'test.name',
            'label' => Yii::t('app', 'Test'),
        ],
        [
            'attribute' => 'test.description',
            'label' => Yii::t('app', 'Description'),
        ],
        'result',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerReportTest,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  ' . Html::encode(Yii::t('app', 'Report Test').' '. $this->title) . ' </h3>',
        ],
        'columns' => $gridColumnReportTest
    ]);
?>
    </div>
</div>
