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
class FancyboxAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/backend/fancybox/jquery.fancybox.css',
    ];

    public $js = [
        'themes/backend/fancybox/jquery.mousewheel.pack.js',
        'themes/backend/fancybox/jquery.fancybox.pack.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

/*
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="../lib/jquery.mousewheel.pack.js?v=3.1.3"></script>

    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="../source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="../source/jquery.fancybox.css?v=2.1.5" media="screen" />
*/