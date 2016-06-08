<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/26
 * Time: 20:43
 */

namespace app\controllers\core;
use Yii;
use app\controllers\BaseController;
use yii\web\Controller;
use yii\captcha\CaptchaAction;
use yii\helpers\Html;
use app\common\Constant;
use app\models\core\Product;

class ProductController extends BaseController
{

    function init()
    {
        parent::init();
    }

    public function  actionIndex () {
        $req = Yii::$app->request;
        $productId = 0;
        $productId = $req->get('product_id');
        $Product = new Product();
        $productMsg = $Product->getProduct($productId);
        if (isset($productMsg->scalar) && $productMsg->scalar == false) {
            echo '产品不存在或已删除';
            exit();
        }
        $this->view->params['product'] = $productMsg;
        $this->view->params['productId'] = $productId;
        return $this->render('index.html',$this->view->params);
    }
}