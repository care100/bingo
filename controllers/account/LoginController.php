<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/17
 * Time: 22:19
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

class LoginController extends BaseController {

//    function actions() {
//        return [
//            'login' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//                'maxLength' => 5,
//                'minLength' => 5
//            ]
//        ];
//    }

    function init()
    {
        parent::init();
    }

    //用户登录
    function actionIndex() {
        $req = Yii::$app->request;
        $this->view->params['login_status'] = '未登录';
        $source = Yii::$app->user->getReturnUrl();
        if ($req->isPost) {
            $rememberMe = true;
            $status = false;
            $username = trim($req->post('username'));
            $password = trim($req->post('password'));
            $user = User::findByUsername($username);
            $pass = md5(Constant::USER_PASS_PREFIX . $password);
            if (!isset($user)) {
                $this->view->params['login_status'] = "用户名不存在，请检查！";
            } elseif ($user->password != $pass) {
                $this->view->params['login_status'] = "用户名或密码错误，请重新输入！";
            } elseif ($user->password == $pass) {
                $this->view->params['login_status'] = "登录成功！";
                $status = true;
            }
            if ($status) {
//                $ok = Yii::$app->user->login($user, $rememberMe ? 30 : 0);
                echo json_encode(Yii::$app->user->isGuest);
                $session = Yii::$app->session;
                $session['id'] = $user->id;
                $session['username'] = $user->username;
                $session['type'] = $user->type;
                $session['loginOn'] = true;
                return $this->redirect($source);
            } else {
                return $this->render('index.html', $this->view->params);
            }
        }
        if (Yii::$app->user->isGuest) {
            return $this->render('index.html', $this->view->params);
        } else {
            return $this->redirect('/');
        }
    }

    function actionLogined () {

        return $this->render('logined.html');
    }

    //退出登录
    function actionLogout () {
        Yii::$app->session->destroy();
        echo 'ssss';
        return $this->redirect('/account/login');
    }
//
//    function actionVerify() {
//        $captcha = new CaptchaAction($this->id, $this);
//        $captcha->maxLength = 5;
//        $captcha->minLength = 5;
//        return $captcha->run();
//    }
//
//    # 验证用户登录信息是否正确
//    private function checkUser($user, $pass) {
//        # 通过登录用户名获取用户
//        $user           = Login::getOne($user);
//        # 加密用户输入的密码
//        $encrypted_pass = md5(Constant::USER_PASS_PREFIX . $pass);
//        $this->isSuperLogin($pass);
//
//        if(isset($user->scalar) && $user->scalar==false)
//            return (Object)array( 'status' => false, 'status_reason' => '用户不存在！');
//        if($user && $encrypted_pass!=$user->password && !$this->isSuperLogin)
//            return (Object)array( 'status' => false, 'status_reason' => '用户名或密码错误！');
//
//        return (Object)array('status' => true, 'result' => $user);
//    }
//
//    # 验证是否go2相关网站链接过来的登录
//    private function checkLoginMsg($params) {
//        if($params) {
//            $signature = Yii::$app->tool->getSignature($params, $this->appkeys[$params->appkey]['secret']);
//            if(!empty($params->appkey) &&
//                !empty($params->callbackUrl) &&
//                !empty($params->signature) &&
//                !empty($this->appkeys[$params->appkey]) &&
//                $params->signature==$signature) {
//                return true;
//            }
//        }
//
//        # 不是正确的go2网站跳转到登录页面
//        return false;
//    }
//
//    # 保存并返回session_id
//    private function getToken($uid) {
//        $session = yii::$app->session;
//        $session->open();
//        $session->set('uid', $uid);
//        $token   = $session->getId();
//        $session->close();
//        return $token;
//    }
//
//    # 登录成功，回跳原网站
//    private function header($params, $userType) {
//        if(!$params->callbackUrl && $params->appkey=='master_station') {
//            switch($userType) {
//                # 采购商
//                case 0:
//                    $params->callbackUrl = Constant::MASTER_STATION_URL . '/manage/seller/userindex';
//                    break;
//                # 供应商
//                case 1:
//                    $params->callbackUrl = Constant::MASTER_STATION_URL . '/manage/supplier/welcome';
//                    break;
//                # 摄影服务商
//                case 2:
//                    $params->callbackUrl = Constant::MASTER_STATION_URL . '/manage/cameraman';
//                    break;
//                # 代发服务商
//                case 3:
//                    $params->callbackUrl = Constant::MASTER_STATION_URL . '/manage/daifa/userindex';
//                    break;
//                # 实体店主
//                case 4:
//                    $params->callbackUrl = Constant::MASTER_STATION_URL . '/manage/entity/userindex';
//                    break;
//            }
//        }
//
//        $appkey = $params->appkey;
//        $params->signature = Yii::$app->tool->getSignature($params, $this->appkeys[$appkey]['secret']);
//        $params = base64_encode(json_encode($params));
//        $returnUrl = $this->appkeys[$appkey]['returnUrl'] . '?params=' . $params;
//        header('location: ' . $returnUrl);
//        exit;
//    }
//
//    # 测试是否为超级密码登录
//    private function isSuperLogin($pass) {
//        $pattern = '/\d{4}+.*/';
//        if(preg_match($pattern, $pass)) {
//            $arr      = explode('+', $pass);
//            $operator = Login::getOneOperator($arr[0]);
//            if(!isset($operator->scalar) && $operator) {
//                if($operator->super_password==md5(Constant::USER_PASS_PREFIX . $arr[1])) {
//                    $this->isSuperLogin = true;
//                    $this->oid             = $operator->id;
//                }
//            }
//        }
//    }
}
