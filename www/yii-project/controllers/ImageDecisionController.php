<?php

namespace app\controllers;

use app\models\ImageDecision;
use Yii;

class ImageDecisionController extends \yii\web\Controller
{
    public $defaultAction = 'show-random';

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $isApproved = filter_var($request->post('is_approved'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $imageDecision = new ImageDecision();
        $imageDecision->is_approved = $isApproved;
        $imageDecision->image_id = $request->post('image_id');

        if ($imageDecision->save()) {
            return $this->asJson(['status' => 'success']);
        } else {
            return $this->asJson(['status' => 'error']);
        }
    }

    public function actionShowRandom()
    {
        $shownImagesIds = ImageDecision::find()->select('image_id')->column();
        
        $bottomLimit = 1010;
        $topLimit = 1020;
        $randomId = null;
        $image = null;
        $imageIsValid = false;

        while(
            !$imageIsValid 
            && (count($shownImagesIds) < $topLimit - $bottomLimit + 1)
        ) {
            $randomId = rand($bottomLimit, $topLimit);
            if (array_search($randomId, $shownImagesIds) === false) {
                try {
                    $image = file_get_contents("https://picsum.photos/id/$randomId/600/500");
                    $imageIsValid = true;
                } catch (\Throwable $e) {
                    $shownImagesIds[] = $randomId;
                }
            }
        }

        return $this->render('show-random', [
            'image' => $image,
            'imageId' => $randomId,
        ]);
    }
}
