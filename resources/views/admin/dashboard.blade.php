<div class="row">
    <h1 class="page-header">Dashboard</h1>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-check-square-o fa-fw fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $orderCount }}</div>
                        <div>Orders</div>
                    </div>
                </div>
            </div>
            <a href="{{ Admin::instance()->router->routeToModel('orders') }}">
                <div class="panel-footer">
                    <span class="pull-left">Show More</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-map-marker fa-fw fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $salonCount }}</div>
                        <div>Salons</div>
                    </div>
                </div>
            </div>
            <a href="{{ Admin::instance()->router->routeToModel('salons') }}">
                <div class="panel-footer">
                    <span class="pull-left">Show More</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-car fa-fw fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $autoCount }}</div>
                        <div>Autos</div>
                    </div>
                </div>
            </div>
            <a href="{{ Admin::instance()->router->routeToModel('autos') }}">
                <div class="panel-footer">
                    <span class="pull-left">Show More</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-building fa-fw fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ $dealerCount }}</div>
                        <div>Dealers</div>
                    </div>
                </div>
            </div>
            <a href="{{ Admin::instance()->router->routeToModel('dealers') }}">
                <div class="panel-footer">
                    <span class="pull-left">Show More</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>