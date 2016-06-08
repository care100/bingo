<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/19
 * Time: 16:58
 */

namespace app\controllers\core;
use Yii;
use app\controllers\BaseController;
use yii\web\Controller;
use yii\captcha\CaptchaAction;
use yii\helpers\Html;
use app\common\Constant;
use app\models\core\Index;

class IndexController extends BaseController
{

    function init()
    {
        parent::init();
    }

    public function  actionIndex () {
        $Index = new Index();
        $productShow = $Index->getProducts();
        $this->view->params['products'] = $productShow;
        return $this->render('index.html',$this->view->params);
    }
}