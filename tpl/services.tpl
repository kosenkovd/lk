<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>AdmiRealLK</title>
    <!-- Meta -->
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="<?=$keywords?>">
    <link rel="shortcut icon" href="public_html/favicon.ico">  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,900,900italic,300italic,300' rel='stylesheet' type='text/css'> 
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="public_html/assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="public_html/assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="public_html/assets/plugins/flexslider/flexslider.css">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="public_html/assets/css/full-style.css">
    <link id="theme-style" rel="stylesheet" href="public_html/assets/css/styles.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="public_html/assets/css/new-style.css">
    <link rel="stylesheet" href="public_html/assets/plugins/fine-uploader/fine-uploader-gallery.min.css">
    <link rel="stylesheet" href="public_html/assets/plugins/fine-uploader/fine-uploader.min.css">
    <link rel="stylesheet" href="public_html/assets/plugins/fine-uploader/fine-uploader-new.min.css">
    <link rel="stylesheet" href="public_html/assets/plugins/jquery-ui/css/base/jquery-ui-1.9.2.custom.min.css">
    <!--[if lte IE 9]>
        <style>
            #ticket-box{
                margin-top: 10px;
                display: block;
            }
            #menu-box{
                display: inline-block;
                width: 24%;
                margin: 0;
            }
            #message-box{
                display: inline-block;
                width: 74%;
                margin: 0;
            }
        </style>
    <![endif]-->
</head> 

<body class="blog-page blog-archive-page" <?=$margin?>>

<?=$msg?>

    <div class="wrapper" id="ourMail">
        <!-- ******HEADER****** -->
        <header class="header header-main navbar-fixed-top scrolled">
            <div class="container">
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
                            <li class="nav-item"><a href="index">Домой</a></li>
                            <?=$index?>
                            <li class="nav-item"><?=$help?></li>
                            <li class="nav-item" id="cardwrap">
                                
                            </li>
                 <li class="nav-item"><?=$enter?></li>
           <li class="nav-item last">
                                <a class="wtf" href="#"></a>
                            </li><!--//dropdown-->
                        </ul><!--//nav-->
                    </div><!--//navabr-collapse-->

                </nav><!--//main-nav-->
            </div><!--//container-->

        </header><!--//header-->
        
        <?=$body?>

    
    
    
    <!-- *****CONFIGURE STYLE****** -->  
    <div class="config-wrapper">
        <div class="config-wrapper-inner">
            <a id="config-trigger" class="config-trigger" href="#"><i class="fa fa-cog"></i></a>
            <div id="config-panel" class="config-panel">
                <h5>Выберите цвет</h5>
                <ul id="color-options" class="list-unstyled list-inline">
                    <li class="theme-3 active" ><a data-style="public_html/assets/css/styles.css" href="#"></a></li>
                    <li class="theme-2"><a data-style="public_html/assets/css/styles-2.css" href="#"></a></li>
                    <li class="theme-1"><a data-style="public_html/assets/css/styles-3.css" href="#"></a></li>
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
    <script type="text/javascript" src="public_html/assets/plugins/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/jquery-migrate-3.0.0.min.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="public_html/assets/plugins/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/FitVids/jquery.fitvids.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/flexslider/jquery.flexslider-min.js"></script> 
    <script src="public_html/assets/plugins/mustache.js"></script>
    
    <!-- blog specific js starts -->
    <script type="text/javascript" src="public_html/assets/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>     
    <script type="text/javascript" src="public_html/assets/plugins/masonry.pkgd.min.js"></script> 
    <script type="text/javascript" src="public_html/assets/js/blog.js"></script>
    <script type="text/javascript" src="public_html/assets/js/min/jquery.avgrund.min.js"></script>
    <script type="text/javascript" src="public_html/assets/js/jquery.avgrund.js"></script>
    <script type="text/javascript" src="public_html/assets/js/jquery.ajaxupload.js"></script>
    <script type="text/javascript" src="public_html/assets/js/ajax.js"></script>
    <script type="text/javascript" src="public_html/assets/js/kagents.js"></script>
    <script type="text/javascript" src="public_html/assets/js/jquery.maskedinput.min.js"></script>
    
    <!-- fine-uploader -->    
    <script type="text/javascript" src="public_html/assets/plugins/fine-uploader/all.fine-uploader.core.min.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/fine-uploader/dnd.min.js"></script>
    
    <!-- blog specific js ends -->    
    <script src="public_html/assets/js/keypress-2.1.4.min.js"></script>
    <script type="text/javascript" src="public_html/assets/js/main.js"></script>
    
    <script src="public_html/assets/plugins/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
    <script src="public_html/assets/plugins/jquery-ui/development-bundle/ui/jquery.ui.progressbar.js"></script>
    <?=$script?>
</body>
</html> 

