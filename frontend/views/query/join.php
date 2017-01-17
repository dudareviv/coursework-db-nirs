<?php

use yii\helpers\Html;
use common\models\Work;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form ActiveForm */
/* @var $model \frontend\models\MainForm */

$this->title = Yii::$app->name;

$works = $model->getWorksList();
?>
<div class="site-index">
    <h1><?= $this->title ?></h1>

    <?php $form = ActiveForm::begin() ?>
    <?php \yii\widgets\Pjax::begin() ?>

    <h2>Научные работы</h2>

    <?= $form->field($model, 'work_status')->dropDownList(Work::statusLabels()) ?>

    <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>

    <?php if (count($works) == 0): ?>
        <h3>Научные работы не найдены</h3>
    <?php endif ?>

    <?php foreach ($works as $work): ?>
        <h3>Тема: <?= $work['work_theme'] ?></h3>
        <p>
            Автор: <?= $work['student_fullname'] ?> <br/>
            Специальность: <?= $work['student_speciality'] ?> <br/>
            Руководитель: <?= $work['leader_fullname'] ?>
        </p>
    <?php endforeach ?>

    <?php \yii\widgets\Pjax::end() ?>
    <?php $form->end() ?>

</div>
