<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/26
 * Time: 21:07
 */

namespace app\controllers\account;

use Yii;
use app\controllers\BaseController;
use yii\web\Controller;
use yii\captcha\CaptchaAction;
use yii\helpers\Html;
use app\common\Constant;
use app\models\account\Login;
use app\models\User;
use app\models\LoginForm;

class RegisterController extends BaseController {
    function init()
    {
        parent::init();
    }

    function actionRegistered () {

        echo '注册成功';

        return $this->render('registered.html');
    }

    //用户注册
    function actionIndex () {
        $req = Yii::$app->request;
        $res = Yii::$app->response;
        if ($req->isPost) {
            $status = false;
            $username = trim($req->post('username'));
            $password = trim($req->post('password'));
            mb_convert_encoding($username,"UTF-8","ASCII");
            mb_convert_encoding($password,"UTF-8","ASCII");
            $pass = md5(Constant::USER_PASS_PREFIX . $password);
            $insert = Login::insertOne($username, $pass);
            if ($insert) {
                return $this->redirect('/web/account/register/registered');
            }
        }
        return $this->render('register.html', $this->view->params);
    }
}