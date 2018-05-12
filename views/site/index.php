<?php

/* @var $this yii\web\View */

use app\assets\ChartsAsset;
ChartsAsset::register($this);  // $this represents the view object

$this->title = 'Dasboard Application';
?>
<div class="row">
    <!--task states start-->
    <div class="col-md-6 col-lg-4 col-sm-6">
        <div class="panel">
            <header class="panel-heading">
                Statistics Master
                <span class="tools pull-right">
                    <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                    <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                    <a class="close-box fa fa-times" href="javascript:;"></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="row w-states">
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-primary btn-block">
                            <span class="value">24</span>
                            <span class="info">Barang</span>
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-info btn-block">
                            <span class="value">18</span>
                            <span class="info">Categories</span>
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-success btn-block">
                            <span class="value">13</span>
                            <span class="info">Inbound</span>
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-danger btn-block">
                            <span class="value">02</span>
                            <span class="info">Outbound</span>
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-default btn-block margin0">
                            <span class="value">14</span>
                            <span class="info">Barang pending</span>
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-default btn-block margin0">
                            <span class="value">08</span>
                            <span class="info">Barang Expired</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--task states end-->

    <!--charts start-->
    <div class="col-md-6 col-lg-4 col-sm-6">
        <div class="panel">
            <div class="panel-body">
                <div id="stacked-bar-chart"></div>
            </div>
        </div>
    </div>
    <!--charts end-->

    <!--daily visit start-->
    <div class="col-md-12 col-lg-4 col-sm-12">
        <div class="panel">
            <header class="panel-heading">
                Daily Visit
                <span class="tools pull-right">
                    <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                    <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                    <a class="close-box fa fa-times" href="javascript:;"></a>
                </span>
            </header>
            <div class="panel-body text-center">
                <div class="chart-wrap">
                    <div id="bar-chart-1"></div>
                    <small>Laptop</small>
                </div>
                <div class="chart-wrap">
                    <div id="bar-chart-2"></div>
                    <small>iPhone</small>
                </div>
                <div class="chart-wrap">
                    <div id="bar-chart-3"></div>
                    <small>iPad</small>
                </div>
            </div>
        </div>
        <div class="panel">
            <header class="panel-heading">
                Visitor Graph
                <span class="tools pull-right">
                    <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                    <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                    <a class="close-box fa fa-times" href="javascript:;"></a>
                </span>
            </header>
            <div class="panel-body text-center">
                <div class="chart-wrap">
                    <small>visit </small>
                    <span class="h4">10,090</span>
                    <div id="line-chart-1"></div>
                    <small>Page visit</small>
                </div>
                <div class="chart-wrap">
                    <small>Unique visitor </small>
                    <span class="h4">8,129</span>
                    <div id="line-chart-2"></div>
                    <small>Avg. visit Duration</small>
                </div>
            </div>
        </div>
    </div>
    <!--daily visit end-->

</div>

<!--states start-->
<div class="row">
    <div class="col-md-3">
        <div class="panel short-states">
            <div class="panel-title">
                <h4> <span class="label label-danger pull-right">Daily Income</span></h4>
            </div>
            <div class="panel-body">
                <h1>$1,3012</h1>
                <div class="text-danger pull-right">53% <i class="fa fa-bolt"></i></div>
                <small>Daily income</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel short-states">
            <div class="panel-title">
                <h4> <span class="label label-info pull-right">Weekly Income</span></h4>
            </div>
            <div class="panel-body">
                <h1>$5,534</h1>
                <div class="text-primary pull-right">65% <i class="fa fa-level-up"></i></div>
                <small>Weekly Income</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel short-states">
            <div class="panel-title">
                <h4> <span class="label label-warning pull-right">Monthly Income</span></h4>
            </div>
            <div class="panel-body">
                <h1>$22,329</h1>
                <div class="text-warning pull-right">77% <i class="fa fa-level-down"></i></div>
                <small>Monthly Income</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel short-states">
            <div class="panel-title">
                <h4> <span class="label label-success pull-right">Annual Income</span></h4>
            </div>
            <div class="panel-body">
                <h1>$268,188</h1>
                <div class="text-success pull-right">88% <i class="fa fa-level-up"></i></div>
                <small>Annual Income</small>
            </div>
        </div>
    </div>
</div>
<!--states end-->
