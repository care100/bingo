<?php

$params = require(__DIR__ . '/params.php');

//smarty
$smarty = [
    'renderers' => [
        'class' => 'yii\web\View',
        'smarty' => [
            'class' => 'yii\smarty\ViewRenderer',
            //'cachePath' => '@runtime/Smarty/cache',
        ],
        'tpl' => [
            'class' => 'yii\smarty\ViewRenderer',
            'options' => [
                'left_delimiter' =>'{#',
                'right_delimiter' => '#}',
            ],
            //'cachePath' => '@runtime/Smarty/cache',
        ],
        'html' => [
            'class' => 'yii\smarty\ViewRenderer',
            'options' => [
                'left_delimiter' =>'{#',
                'right_delimiter' => '#}',
            ],
            //'cachePath' => '@runtime/Smarty/cache',
        ],
    ],
];

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'bingo',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'view' => $smarty,
        'db' => require(__DIR__ . '/db.php'),
        'urlManager'=>array(
//            'urlFormat'=>'path',
            'enablePrettyUrl' => true,
            'showScriptName'=>false,
            'rules'=>array(
                'product/<product_id:\d+>'=>'core/product/index',
//                '<controller:\w+>/<product_id:\d+>'=>'core/<controller:\w+>/index',
                '<alias:index|factory>' => 'core/<alias>'
////                '<login:\w+>/<id:\d+>'=>'<controller>/view',
//                '/' => '/web',
               // 'login' => 'account/login',
//                '<controller:\w+>/<action:\w+>/<sId:\d+>'=>'account/<controller>/<action>',
//               // '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            )
        )
    ],
    'params' => $params,
//    'defaultRoute' => 'web/core/index/index',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
