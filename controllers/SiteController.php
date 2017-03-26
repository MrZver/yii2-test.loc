<?php

namespace app\controllers;

use app\models\Informtype;
use app\models\UserInformPref;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\BaseVarDumper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\News;
use yii\data\Pagination;
use app\components\BrowserPopupWidget;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'profile'],
                'rules' => [
                    [
                        'actions' => ['logout', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = News::find();
        $pagination = new Pagination([
            'defaultPageSize' => Yii::$app->params['newsPerPage'],
            'totalCount' => $query->count(),
        ]);
        $news = $query->orderBy(['id' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $this->view->title = "Home | News list";
        return $this->render('index', ['news' => $news, 'pagination' => $pagination]);
    }

    public function actionProfile()
    {
        $this->view->title = "Profile";

        $post = Yii::$app->request->post();
        $types = Informtype::find()->all();
        /* @var $user \app\models\User */
        $user = Yii::$app->user->identity;

        if ($post) {
            /* @var $type \app\models\Informtype */
            foreach ($types as $type) {
                $current_pref = $user->getUserInformPrefs()->where(['informtype_id' => $type->id])->one();
                if (!$current_pref) {
                    $current_pref = new UserInformPref();
                    $current_pref->enabled = false;
                    $current_pref->user_id = $user->id;
                    $current_pref->informtype_id = $type->id;
                    $current_pref->save();
                }
                $current_pref->enabled = (int)$post[$type->name];
                $current_pref->save();
            }
            \Yii::$app->session->addFlash('success', 'Settings saved');
        }

        $preferences = $user->getUserInformPrefs()->all();
        $defaults = [];
        foreach ($preferences as $pref) {
            $defaults[$pref->informtype->name] = $pref->enabled;
        }
        return $this->render('profile', compact('types', 'defaults', 'user'));
    }

    public function actionGetPopupWidget()
    {
        return BrowserPopupWidget::widget();
    }

    public function actionNews($id)
    {
        $news = News::findOne($id);
        $this->view->title = "News page";
        return $this->render('news', ['news' => $news]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
