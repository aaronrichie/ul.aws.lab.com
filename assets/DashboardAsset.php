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
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/css/site.css',
        'web/gentelella-1.2.0/vendors/bootstrap/dist/css/bootstrap.min.css',
        'web/gentelella-1.2.0/vendors/font-awesome/css/font-awesome.min.css',
        'web/gentelella-1.2.0/vendors/iCheck/skins/flat/green.css',
        'web/gentelella-1.2.0/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
        'web/gentelella-1.2.0/production/css/maps/jquery-jvectormap-2.0.3.css',
        'web/gentelella-1.2.0/production/css/custom.css', 
        'web/customcss/main.css',
        'web/customcss/flags.css',
        'web/js/bootstrap-multiselect/dist/css/bootstrap-multiselect.css',
        'web/js/jQuery-Plugin-For-Country-Selecter-with-Flags-flagstrap/dist/css/flags.css',
    
       
    ];
    public $js = [
       
       // Custom Theme Scripts -->
   
        'web/gentelella-1.2.0/production/js/bootstrap-progressbar.min.js',
        'web/gentelella-1.2.0/production/js/custom.js',
        'web/customjs/main.js',
//        'web/js/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js',
        'web/js/jQuery-Plugin-For-Country-Selecter-with-Flags-flagstrap/src/jquery.flagstrap.js',
        'web/js/bootstrap-multiselect/dist/js/bootstrap-multiselect.js',
        'https://www.google.com/recaptcha/api.js',
      
       
       
        
     
      //  'web/js/bootstrap-multiselect/dist/js/jquery.multi-select.js',
     //   'js/jquery.multi-select.js'
  
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\bootstrap\BootstrapThemeAsset', // 
     
       
    ];
}
