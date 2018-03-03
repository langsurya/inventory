<?php

namespace app\components;

use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

class Debugger extends \yii\base\Component
{
    public function __construct()
    {
        $this->registerMethodAliases();
    }

    public function dd()
    {
        array_map(function ($value) {
            $this->dump($value);
        }, func_get_args());

        die(0);
    }

    public function dump($value)
    {
        if (class_exists(CliDumper::class)) {
            $dumper = (PHP_SAPI === 'cli') ? new CliDumper : new HtmlDumper;
            $dumper->dump((new VarCloner)->cloneVar($value));
        } else {
            var_dump($value);
        }
    }

    protected function registerMethodAliases()
    {
        require_once __DIR__.'/debugger.helper.php';
    }
}