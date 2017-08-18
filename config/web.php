<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$rules = require(__DIR__ . '/rules.php');


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '2Q9RQWCWbZSFxza3uzaSp6S1XwZ6bwBj',
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
        'db' => $db,

        'urlManager' => [
            //用于表明urlManager是否启用URL美化功能，在Yii1.1中称为path格式URL，
            // Yii2.0中改称美化。
            // 默认不启用。但实际使用中，特别是产品环境，一般都会启用。
            'enablePrettyUrl' => true,
            // 是否启用严格解析，如启用严格解析，要求当前请求应至少匹配1个路由规则，
            // 否则认为是无效路由。
            // 这个选项仅在 enablePrettyUrl 启用后才有效。
            'enableStrictParsing' => false,
            // 是否在URL中显示入口脚本。是对美化功能的进一步补充。
            'showScriptName' => false,
            // 指定续接在URL后面的一个后缀，如 .html 之类的。仅在 enablePrettyUrl 启用时有效。
            'suffix' => '',
            'rules' => $rules,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['admin'],
        ],

    ],

    'modules' => [
//        'manager' => [
//            'class' => 'app\modules\manager\ManagerModule',
//        ],
        'author' => [
            'class' => 'app\modules\author\AuthorModule',
        ],
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
