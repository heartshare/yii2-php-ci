<?php

namespace app\components\web;

use yii\base\Event;
use yii\base\View;

class Controller extends \yii\web\Controller
{
    public $leftMenu = [];

    public $chanel = 'dashboard';

    public $layout = 'dashboard';

    public function init()
    {
        $this->view->on(View::EVENT_BEFORE_RENDER,array($this,'initViewParams'));
    }

    protected function initViewParams(Event $event)
    {
        $chanelArray = explode('.', $this->chanel);
        //init left menu
        $event->sender->params['leftMenu'] = isset(\Yii::$app->params['systemMenu']['leftMenu'][$chanelArray[0]])?\Yii::$app->params['systemMenu']['leftMenu'][$chanelArray[0]]:array();

        //set the pos for the application
        $event->sender->params['topMenuChanel']  = $chanelArray[0];
        $event->sender->params['leftMenuChanel'] = $this->chanel;

    }
}