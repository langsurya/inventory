<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ChartsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'themes/backend/css/bootstrap.min.css',
        // 'themes/backend/css/main.css',
        // 'themes/backend/css/font-awesome.min.css',
    ];
    public $js = [
        'themes/backend/bower_components/highcharts/highcharts.js',
        'themes/backend/bower_components/highcharts/modules/exporting.js',
        'themes/backend/assets/js/init-highcharts.js',

        // <!--sparkline-->
        'themes/backend/bower_components/bower-jquery-sparkline/dist/jquery.sparkline.retina.js',
        'themes/backend/assets/js/init-sparkline.js',
        'themes/backend/bower_components/rickshaw/vendor/d3.min.js',
        'themes/backend/bower_components/rickshaw/vendor/d3.layout.min.js',
        'themes/backend/bower_components/rickshaw/rickshaw.min.js',
        'themes/backend/assets/js/init-rickshaw.js'





    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
