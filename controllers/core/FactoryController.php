<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/25
 * Time: 8:39
 */

namespace app\controllers\core;

use Yii;
use app\controllers\BaseController;

class FactoryController extends BaseController
{
    function init()
    {
        parent::init();
    }

    public function  actionIndex () {
        return $this->render('factory.html',$this->view->params);
    }
}