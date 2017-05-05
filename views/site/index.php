<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClickSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clicks';
?>
<div class="click-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'click_id',
                    'contentOptions'=>['style'=>'max-width: 200px;word-wrap: break-word;']
                ],
                'ua:ntext',
                [
                    'attribute'=>'ip',
                    'label' => 'IP',
                    'content'=>function($model){
                        return long2ip($model->ip);
                    }
                ],
                'ref:ntext',
                'param1',
                'param2',
                [
                    'attribute'=>'error',
                    'label' => 'Status',
                    'content'=>function($model){
                        if($model->error == 0) {
                            return '<span class="label label-success">Success</span>';
                        } else {
                            return '<span class="label label-danger">Duplicated ('.$model->error.')</span>';
                        }
                    }
                ],
                [
                    'attribute'=>'bad_domain',
                    'label' => 'Domain',
                    'filter'=>array("0"=>"Good","1"=>"Bad"),
                    'content'=>function($model){
                        if($model->bad_domain == 0) {
                            return '<span class="label label-success">good</span>';
                        } else {
                            return '<span class="label label-danger">bad</span>';
                        }
                    }
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>