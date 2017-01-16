<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Work */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->dropDownList(\common\models\Student::fetchList()) ?>

    <?= $form->field($model, 'leader_id')->dropDownList(\common\models\Leader::fetchList()) ?>

    <?= $form->field($model, 'theme')->textInput() ?>

    <?= $form->field($model, 'justification')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => [
            'lang' => 'ru',
        ],
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\Work::statusLabels()) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
