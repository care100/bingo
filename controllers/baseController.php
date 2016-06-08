<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/24
 * Time: 21:50
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\common\BaseUtil;
use yii\base\InlineAction;
use yii\helpers\Url;
use app\common\Constant;
use yii\base\Exception;
use yii\base\UserException;
use yii\web\HttpException;

class baseController extends Controller
{
    public function init () {
        Yii::$app->layout = false;
        Yii::$app->cache->flush();
        $this->view->params['_csrf']  = Yii::$app->getRequest()->getCsrfToken();
        $this->view->params['loginOn'] = Yii::$app->session['loginOn'];
        $this->view->params['username'] = Yii::$app->session['username'];
        $this->view->params['type'] = Yii::$app->session['type'];
    }
}