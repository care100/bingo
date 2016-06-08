<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/26
 * Time: 23:03
 */

namespace app\controllers\usercenter;


use Yii;
use app\controllers\BaseController;

class SellerController extends BaseController{
    /*初始化*/
    function init()
    {
        parent::init();

        if (!$this->view->params['loginOn']) {
            return $this->redirect('/account/login');
        }
    }

    /*厂家用户中心-首页*/
    public function  actionIndex () {
        return $this->render('index.html',$this->view->params);
    }
}