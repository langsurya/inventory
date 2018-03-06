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
class DatePickerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/backend/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css',
        'themes/backend/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
    ];

    public $js = [
        'themes/backend/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        'themes/backend/bootstrap-timepicker/js/bootstrap-timepicker.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
