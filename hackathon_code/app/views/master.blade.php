<!DOCTYPE html>

<html>
    <head>
        <!-- Google Font: Open Sans -->
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,800,800italic">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oswald:400,300,700">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/assets/bootstrap-3.2.0-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/admin-mvp/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/admin-mvp/css/mvpready-admin.css">
        <link rel="stylesheet" href="/assets/admin-mvp/css/mvpready-admin.css">
        <link rel="stylesheet" href="/assets/custom.css">


        <!-- jQuery -->
        <script src="/assets/jquery/jquery-1.11.1.min.js"></script>
        <script src="/assets/jquery/jquery.table-head-fixed.js"></script>

        <!-- Bootstrap Datepicker -->
        <script src="/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" href="/assets/bootstrap-datepicker/css/datepicker.css">
        <link rel="stylesheet" href="/assets/bootstrap-datepicker/css/datepicker3.css">

    
        <?php $currentRoute = Route::getCurrentRoute(); if (isset($currentRoute) && Route::getCurrentRoute()->getPath() == "policy/{id}"){ ?>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <?php } ?>
        <style type="text/css">
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            -webkit-border-radius: 0 6px 6px 6px;
            -moz-border-radius: 0 6px 6px;
            border-radius: 0 6px 6px 6px;
        }

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }

        .dropdown-submenu>a:after {
            display: block;
            content: " ";
            float: right;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
            border-width: 5px 0 5px 5px;
            border-left-color: #ccc;
            margin-top: 5px;
            margin-right: -10px;
        }

        .dropdown-submenu:hover>a:after {
            border-left-color: #fff;
        }

        .dropdown-submenu.pull-left {
            float: none;
        }

        .dropdown-submenu.pull-left>.dropdown-menu {
            left: -100%;
            margin-left: 10px;
            -webkit-border-radius: 6px 0 6px 6px;
            -moz-border-radius: 6px 0 6px 6px;
            border-radius: 6px 0 6px 6px;
        }
	</style>

        <!-- Latest compiled and minified JavaScript -->
        <script src="/assets/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>

	<link href="/assets/jquery/select2.min.css" rel="stylesheet" />
        <script src="/assets/jquery/select2.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                </div>
                    <ul class="nav navbar-nav navbar-right">			
                    </ul>
            </div>
        </nav>

        <div class="container container-body">
            @yield('content')
        </div>
        <br><br>
    </body>
</html>