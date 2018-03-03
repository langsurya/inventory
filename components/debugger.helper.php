<?php

use app\components\Debugger;

if (! function_exists('dump')) {
	function dump()
	{
		call_user_func_array([(new Debugger()), 'dump'], func_get_args());
	}
}

if (! function_exists('dd')) {
	function dd()
	{
		call_user_func_array([(new Debugger()), 'dd'], func_get_args());
	}
}