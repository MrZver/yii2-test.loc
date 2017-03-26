<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\models\Informtype;
use app\models\UserInformPref;
use Yii;
use app\models\News;
use app\models\User;
use app\components\Inform;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInstantInform()
    {
        $this->view->title = "Instant inform";

        $session = Yii::$app->session;
        $post = Yii::$app->request->post();
        $types = Informtype::find()->all();
        /* @var $user \app\models\User */
        $user = Yii::$app->user->identity;
        $news = News::find()->all();
        $users = User::find()->all();
        $roles = Yii::$app->authManager->getRoles();

        if ($post) {
            $recipients = [];
            if ($post['recipients'] == 'user') {
                $recipients[] = User::findOne($post['user_id']);
            } elseif ($post['recipients'] == 'role') {
                $ids = Yii::$app->authManager->getUserIdsByRole($post['role']);
                $recipients = User::find()->where(['id' => $ids])->all();
            } elseif ($post['recipients'] == 'all') {
                $recipients = $users;
            }
            foreach ($post['types'] as $typename) {
                $type = Informtype::findOne(['name' => $typename]);
                foreach ($recipients as $recipient) {
                    $current_pref = $recipient->getUserInformPrefs()->where(['informtype_id' => $type->id])->one();
                    $informer = new Inform();
                    $informer->model = News::findOne($post['news_id']);
                    $informer->$typename($current_pref);
                    if ($typename == 'browser') {
                        $session->set('instant_news_id', $post['news_id']);
                    }
                }

            }
            \Yii::$app->session->addFlash('success', 'Users informed successfully');
        }

        return $this->render('instant-inform', compact('types', 'user', 'news', 'users', 'roles'));
    }
}
