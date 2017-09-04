<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
          'markdown' => [
            'class' => 'kartik\markdown\Module',
            
            // the controller action route used for markdown editor preview
            'previewAction' => '/markdown/parse/preview',
        
            // the controller action route used for downloading the markdown exported file
            'downloadAction' => '/markdown/parse/download',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'DGLUaD1vihcs6nAorG-D_6MpXQQrTzfC',
        ],
        [
        'class' => 'yii\i18n\PhpMessageSource',
        'basePath' => '@kvdialog/messages',
        'forceTranslation' => true
    ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
           'identityClass' => 'app\models\UlUser',
           'class' => 'yii\web\user',
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
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
                '<controller>' => '<controller>/index',
//                'risk-assessment/index/1' =>'risk-assessment/index?mID=1'
            ],
        ],
    ],
    'params' => $params,
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
