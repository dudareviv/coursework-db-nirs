<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;
use common\models\Leader;
use common\models\Speciality;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/signup.js', ['depends' => \yii\web\JqueryAsset::className()]);
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->errorSummary($model) ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'last_name')->textInput() ?>

            <?= $form->field($model, 'first_name')->textInput() ?>

            <?= $form->field($model, 'parent_name')->textInput() ?>

            <?= $form->field($model, 'type')->dropDownList(User::typeLabels(), [
                'id' => 'signup_type',
                'prompt' => 'Выберите тип регистрации'
            ]) ?>

            <div class="signup-categorization-fields" data-type="<?= User::TYPE_STUDENT ?>" style="display: none;">
                <?= $form->field($model, 'student_leader_id')->dropDownList(Leader::fetchList(), [
                    'prompt' => 'Нет'
                ]) ?>

                <?= $form->field($model, 'student_speciality_id')->dropDownList(Speciality::fetchList(), [
                    'id' => 'signup_student_speciality',
                    'prompt' => 'Другое'
                ]) ?>

                <div class="signup-student-speciality-fields" style="display: none;">
                    <?= $form->field($model, 'student_speciality_name')->textInput() ?>

                    <?= $form->field($model, 'student_speciality_number')->textInput() ?>
                </div>
            </div>

            <div class="signup-categorization-fields" data-type="<?= User::TYPE_LEADER ?>" style="display: none;">
                <?= $form->field($model, 'leader_grade')->textInput() ?>
            </div>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
