<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image_decision".
 *
 * @property int $id
 * @property int $image_id
 * @property bool $is_approved
 */
class ImageDecision extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image_decision';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'is_approved'], 'required'],
            [['image_id'], 'integer'],
            [['is_approved'], 'boolean'],
            [['image_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'Image ID',
            'is_approved' => 'Is Approved',
        ];
    }
}
