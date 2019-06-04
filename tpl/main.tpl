<!DOCTYPE html>
<!--[if IE 8]> <html lang="ru" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="ru" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="ru"> <!--<![endif]-->
<head>
    <title>AdmiRealLK</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Perfect CRM - лучшее решение для типографий и рекламнопроизводственных предприятий"/>
    <meta name="author" content="kosenkovdd110297">
    <meta name="keywords" content="<?=$keywords?>"/>
  <!--  <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>  -->
    <link rel="shortcut icon" href="public_html/favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,900,900italic,300italic,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="public_html/assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="public_html/assets/plugins/font-awesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="public_html/assets/css/full-style.css">
    <link rel="stylesheet" href="public_html/assets/plugins/flexslider/flexslider.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="public_html/assets/css/styles.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="public_html/assets/css/new-style.css">
    <link rel="stylesheet" href="public_html/assets/css/catalog-style.css">
    <link rel="stylesheet" href="public_html/assets/plugins/Countdown/countdown/jquery.countdown.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="<?=$class?>">
<?=$msg?>

    <!-- ******HEADER****** -->
    <header id="header" class="header header-main navbar-fixed-top scrolled">
        
        <div class="container main-header">
            <h1 class="logo">
                <img src="public_html/assets/images/Logo/logo-blue.png" alt="logo"/>
            </h1><!--//logo-->
            
            <nav class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->
                <div id="navbar-collapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?=$index?>
                        <li class="nav-item"><?=$help?></li>      
                        <li class="nav-item"><?=$enter?></li>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div><!--//container-->
        
    </header><!--//header-->
    
   <?=$body?>

    <!-- ******FOOTER****** -->
    <footer class="footer" style="margin-bottom: -25px;">
                    <div id="footer-second" class="container text-center col-md-12 col-xs-12 col-sm-12" style="padding-bottom: 80px; background: white;">                
                    <div class="footer-col-inner middle-flex" style="margin-top: 15px;"><?=$enter?></div>
                    <small>Admireal 2019</small>
            </div><!--//container-->
        </div>

    </footer><!--//footer-->

       <!-- *****CONFIGURE STYLE****** -->
    <div class="config-wrapper">
        <div class="config-wrapper-inner">
            <a id="config-trigger" class="config-trigger" href="#"><i class="fa fa-cog"></i></a>
            <div id="config-panel" class="config-panel">
                <h5>Выберите цвет</h5>
                <ul id="color-options" class="list-unstyled list-inline">
                    <li class="theme-1 active" ><a data-style="public_html/assets/css/styles.css" href="#"></a></li>
                    <li class="theme-2"><a data-style="public_html/assets/css/styles-2.css" href="#"></a></li>
                    <li class="theme-3"><a data-style="public_html/assets/css/styles-3.css" href="#"></a></li>
                    <li class="theme-4"><a data-style="public_html/assets/css/styles-4.css" href="#"></a></li>
                    <li class="theme-5"><a data-style="public_html/assets/css/styles-5.css" href="#"></a></li>
                    <li class="theme-6"><a data-style="public_html/assets/css/styles-6.css" href="#"></a></li>
                    <li class="theme-7"><a data-style="public_html/assets/css/styles-7.css" href="#"></a></li>
                    <li class="theme-8"><a data-style="public_html/assets/css/styles-8.css" href="#"></a></li>
                    <li class="theme-9"><a data-style="public_html/assets/css/styles-9.css" href="#"></a></li>
                    <li class="theme-10"><a data-style="public_html/assets/css/styles-10.css" href="#"></a></li>
                </ul><!--//color-options-->
                <a id="config-close" class="close" href="#"><i class="fa fa-times-circle"></i></a>
            </div><!--//configure-panel-->
        </div><!--//config-wrapper-inner-->
    </div><!--//config-wrapper-->

    <!-- Javascript -->
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/bootstrap/js/bootstrap-dropdownhover.min.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/FitVids/jquery.fitvids.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/flexslider/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="public_html/assets/js/main.js"></script>
    <script type="text/javascript" src="public_html/assets/js/banner.js"></script>
    <script type="text/javascript" src="public_html/assets/js/api_calc.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/Countdown/countdown/jquery.countdown.js"></script>
    
        <?=$script?>
</body>
</html>

