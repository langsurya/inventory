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
class BootstrapFileInputAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/backend/bootstrap-fileinput/css/fileinput.css',
    ];

    public $js = [
        'themes/backend/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js',
        'themes/backend/bootstrap-fileinput/js/plugins/sortable.min.js',
        'themes/backend/bootstrap-fileinput/js/plugins/purify.min.js',
        'themes/backend/bootstrap-fileinput/js/fileinput.min.js',
        'themes/backend/bootstrap-fileinput/themes/fa/theme.js',
        'themes/backend/bootstrap-fileinput/js/locales/id.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
