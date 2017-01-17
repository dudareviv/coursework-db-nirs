<?php
/**
 * Created with love by Kodelnaya.
 * Author: Dudarev Ilia
 * Email: ilya@kodelnya.ru
 * Phone: +7 906 780 3210
 * Date: 16.01.2017
 * Time: 18:38
 */

namespace frontend\controllers;


use frontend\models\MainForm;
use yii\web\Controller;

/**
 * Class QueryController
 * @package frontend\controllers
 */
class QueryController extends Controller
{
    /**
     * @return string
     */
    public function actionJoin()
    {
        $model = new MainForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            \Yii::$app->session->addFlash('success', 'Данные обновлены');
        }

        return $this->render('join', [
            'model' => $model
        ]);
    }
}