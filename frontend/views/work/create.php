<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Work */

$this->title = 'Добавить работу';
$this->params['breadcrumbs'][] = ['label' => 'Научные работы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
