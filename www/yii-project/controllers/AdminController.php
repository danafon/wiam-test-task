<?php

namespace app\controllers;

use app\models\ImageDecision;
use Yii;
use yii\web\NotFoundHttpException;

class AdminController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        $request = Yii::$app->request;
        $token = $request->get('token');
        if ($token !== 'xyz123') {
            throw new NotFoundHttpException('Доступ запрещен.');
        }

        return true;
    }

    public function actionDelete($id)
    {
        $decision = ImageDecision::findOne($id);
        if ($decision) {
            $decision->delete();
            Yii::$app->session->setFlash('success', 'Решение отменено.');

            return $this->asJson(['status' => 'success']);
        } else {
            return $this->asJson(['status' => 'error', 'message' => 'Image Decision not found.']);
        }
    }

    public function actionIndex()
    {
        $decisions = ImageDecision::find()->all();

        return $this->render('index', [
            'decisions' => $decisions,
        ]);
    }
}
