<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_inform_pref".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $informtype_id
 * @property integer $enabled
 *
 * @property Informtype $informtype
 * @property User $user
 */
class UserInformPref extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_inform_pref';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'informtype_id'], 'required'],
            [['user_id', 'informtype_id', 'enabled'], 'integer'],
            [['informtype_id'], 'exist', 'skipOnError' => true, 'targetClass' => Informtype::className(), 'targetAttribute' => ['informtype_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'informtype_id' => 'Type',
            'enabled' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInformtype()
    {
        return $this->hasOne(Informtype::className(), ['id' => 'informtype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
