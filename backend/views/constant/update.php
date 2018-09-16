<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Constant */

$this->title = 'Update Constant: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Constants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="constant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
