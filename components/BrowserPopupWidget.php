<?php

namespace app\components;

use app\models\User;
use app\models\News;
use app\models\Informtype;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\Pjax;

class BrowserPopupWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();

        $isNeededInform = false;
        $type = null;

        if (!Yii::$app->user->isGuest) {
            /* @var $user \app\models\User */
            $user = Yii::$app->user->identity;
            $type = Informtype::findOne(['name' => 'browser']);
            if ($type) {
                $pref = $user->getUserInformPrefs()->where(['informtype_id' => $type->id])->one();
                if ($pref) {
                    $isNeededInform = $pref->enabled;
                }
            }

        }

        if (($this->message === null) && $isNeededInform) {
            $for_display = '';
            $session = Yii::$app->session;
            $old_last_news_id = (int)$session->get('last_news_id');
            $instant_news_id = (int)$session->get('instant_news_id');
            $new_last_news_id = 0;
            $new_last_news = News::find()->orderBy(['id' => SORT_DESC])->one();
            if ($new_last_news) {
                $new_last_news_id = $new_last_news->id;
            }

            if (($old_last_news_id > 0) && ($old_last_news_id < $new_last_news_id)) { // new news exists
                // get all new news
                $new_news = News::find()->where(['>', 'id', $old_last_news_id])->orderBy(['id' => SORT_DESC])->all();
                foreach ($new_news as $item) {
                    $for_display .= "This news was created: {$item->title}<br>{$type->message}: {$item->preview}<br><br>";
                }
                $session->set('last_news_id', $new_last_news_id);
            } elseif (!$old_last_news_id) { // first load
                // init last id
                $session->set('last_news_id', $new_last_news_id);
            } else if ($instant_news_id) { // instant inform from admin
                $new_news = News::findOne($instant_news_id);
                $for_display .= "This news was created: {$new_news->title}<br>{$type->message}: {$new_news->preview}<br><br>";
                $session->set('instant_news_id', '');
            }

            ob_start(); ?>
            <script type="text/javascript">
            $(document).ready(function() {
                setInterval(function(){ $("#refreshButton").click(); }, 5000);
            });
            </script>
            <? Pjax::begin(['enablePushState' => false]);
            ?>
            <div class="alert alert-info" style="display: <?= $for_display ? 'block' : 'none' ?>" id="browser_message_block">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <span id="browser_message_content"><?= $for_display ?></span>
                <?= Html::a("Обновить", ['/site/get-popup-widget'], ['class' => 'btn btn-lg btn-primary', 'id' => 'refreshButton', 'style' => 'display: none;']) ?>
            </div>
            <?
            Pjax::end();
            $this->message = ob_get_clean();
        }
    }

    public function run()
    {
        return $this->message;
    }
}