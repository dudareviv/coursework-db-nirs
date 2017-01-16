<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'work_id')->dropDownList(\common\models\Work::fetchList()) ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'description')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => [
            'lang' => 'ru',
        ],
    ]) ?>

    <?= $form->field($model, 'money')->input('number') ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::className(), [
        'options' => ['class' => 'form-control']
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
