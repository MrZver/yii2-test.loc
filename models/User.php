<?php

namespace app\models;

use Yii;
use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInformPrefs()
    {
        return $this->hasMany(UserInformPref::className(), ['user_id' => 'id']);
    }

    public static function InformAdmin($event)
    {
        Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('This new user was registered: ' . $event->sender->username)
            ->setTextBody('This new user was registered: ' . $event->sender->username . ', email: ' . $event->sender->email)
            ->send();
    }

    public function create()
    {
        parent::create();
        $this->createUserPrefs();
        return true;
    }

    public function register()
    {
        parent::register();
        $this->createUserPrefs();
        return true;
    }

    public function createUserPrefs() {
        $types = Informtype::find()->all();
        foreach ($types as $type) {
            $current_pref = new UserInformPref();
            $current_pref->enabled = true;
            $current_pref->user_id = $this->id;
            $current_pref->informtype_id = $type->id;
            $current_pref->save();
        }
        return true;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (($this->password_hash != $this->OldAttributes['password_hash']) && $this->OldAttributes['password_hash']) {
                $this->informAboutChangePassword();
            }
            return true;
        } else {
            return false;
        }
    }

    protected function informAboutChangePassword()
    {
        Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo($this->email)
            ->setSubject('Password changed!')
            ->setTextBody('Your password was changed!')
            ->send();
    }

    /**
     * Finds all users by assignment role
     *
     * @param  \yii\rbac\Role $role
     * @return static|null
     */
    public static function findByRole($role)
    {
        return static::find()
            ->join('LEFT JOIN','auth_assignment','auth_assignment.user_id = id')
            ->where(['auth_assignment.item_name' => $role->name])
            ->all();
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
}
