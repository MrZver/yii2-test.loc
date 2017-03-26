<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "informtype".
 *
 * @property integer $id
 * @property string $name
 * @property string $message
 *
 * @property UserInformPref[] $userInformPrefs
 */
class Informtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'informtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'message' => 'Message',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInformPrefs()
    {
        return $this->hasMany(UserInformPref::className(), ['informtype_id' => 'id']);
    }
}
