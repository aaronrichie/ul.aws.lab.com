<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/css/site.css',
        'web/AdminLTE-2.3.0/bootstrap/css/bootstrap.min.css',
        "https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css",
        "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",
        "web/AdminLTE-2.3.0/dist/css/AdminLTE.min.css",
        "web/AdminLTE-2.3.0/plugins/iCheck/square/blue.css",
        'web/gentelella-1.2.0/production/css/custom.css', 
        'web/customcss/main.css'
    ];
    public $js = [
        'web/customjs/main.js',
        "web/AdminLTE-2.3.0/plugins/jQuery/jQuery-2.1.4.min.js",
        "web/AdminLTE-2.3.0/bootstrap/js/bootstrap.min.js",
        "web/AdminLTE-2.3.0/plugins/iCheck/icheck.min.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        
    ];
}
