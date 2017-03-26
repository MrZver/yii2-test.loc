<?php
namespace app\components;

use Yii;
use yii\base\Object;
use app\models\Informtype;

class Inform extends Object
{
    public $model;

    public function run($name, $model) {
        $this->model = $model;
        $type = Informtype::findOne(['name' => $name]);
        foreach ($type->getUserInformPrefs()->where(['enabled' => true])->all() as $userInformPref) {
            $this->$name($userInformPref);
        }
    }

    public function email($userInformPref) {
        $user = $userInformPref->user;
        Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo($user->email)
            ->setSubject('This news was created: ' . $this->model->title)
            ->setTextBody($userInformPref->informtype->message . ": " . $this->model->preview)
            ->send();
    }

    public function browser($userInformPref) {
        // very custom logic, see app\components\BrowserPopupWidget
    }
}
?>