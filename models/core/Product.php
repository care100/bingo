<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/26
 * Time: 20:50
 */

namespace app\models\core;

use Yii;
use yii\base\Model;
use yii\base\Object;

class Product extends Model
{
    /*
     * 返回展示产品数据
     * */
    function getProduct ($productId) {
        $db = Yii::$app->db;
        $product = (Object)$db->createCommand("SELECT id, user_id, price, handle FROM product WHERE id = " . $productId)->queryOne();
        return $product;
    }
}