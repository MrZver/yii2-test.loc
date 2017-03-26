<?php
namespace app\commands;

use app\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\console\Controller;

class MyrbacController extends Controller
{
    public function actionInit()
    {
        if (!$this->confirm("Are you sure? It will re-create permissions tree.")) {
            return self::EXIT_CODE_NORMAL;
        }

        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $moderator = $auth->createRole('moderator');
        $moderator->description = 'Moderator';
        $auth->add($moderator);

        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator';
        $auth->add($admin);
        $auth->addChild($admin, $moderator);
    }
}