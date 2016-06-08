<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/18
 * Time: 9:24
 */

namespace app\models\account;

use Yii;
use yii\base\Model;
use yii\base\Object;

class Login extends Model
{
    static function getUsername () {
        $sql = "select username from user";
        $db = Yii::$app->db;
        $cmd = $db->createCommand($sql);
        $username = $cmd->queryAll();
        return $username;
    }

    //获取一个用户的信息
    static function getOne($user) {
        $db = Yii::$app->db;
        return (Object)$db->createCommand('select id, password, type from user where username="' . $user . '"')->queryOne();
    }

    //注册通过验证时增加一个用户
    static function insertOne ($username, $pass) {
        $type = 1;
        $db = Yii::$app->db;
        return (Object)$db->createCommand("insert into user(username,password,type,create_time) values ('" . $username . "','" . $pass . "','" . $type . "',NOW())")->execute();
    }
}
