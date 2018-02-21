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
class BackendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/backend/css/bootstrap.min.css',
        'themes/backend/css/mains.css',
        'themes/backend/css/font-awesome.min.css',
    ];
    public $js = [
        'themes/backend/js/modernizr-custom.js',
        'themes/backend/js/bootstrap.min.js',
        'themes/backend/js/jquery.nicescroll.min.js',
        'themes/backend/js/autosize.min.js',
        'themes/backend/js/main.js',
        'themes/backend/js/app.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
