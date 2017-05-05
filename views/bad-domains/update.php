<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BadDomains */

$this->title = 'Update Bad Domains: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bad Domains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bad-domains-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
