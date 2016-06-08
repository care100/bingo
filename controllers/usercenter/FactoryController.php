<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/25
 * Time: 12:28
 */

namespace app\controllers\usercenter;

use Yii;
use app\controllers\BaseController;

class FactoryController extends BaseController
{
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
        $this->view->params['page'] = 'factoryIndex';
        return $this->render('index.html',$this->view->params);
    }

    /*厂家用户中心-我的产品*/
    public function  actionProduct () {
        $this->view->params['page'] = 'factoryProduct';
        return $this->render('product.html',$this->view->params);
    }

    /*厂家用户中心-发布新品*/
    public function  actionPublish () {
        $this->view->params['page'] = 'factoryPublish';
        return $this->render('publish.html',$this->view->params);
    }

    /*厂家用户中心-我的资料*/
    public function  actionInformation () {
        $this->view->params['page'] = 'factoryInformation';
        return $this->render('information.html',$this->view->params);
    }

    /*厂家用户中心-修改密码*/
    public function  actionPassword () {
        $this->view->params['page'] = 'factoryPassword';
        return $this->render('password.html',$this->view->params);
    }
}