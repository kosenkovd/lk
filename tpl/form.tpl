<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>AdmiReal</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="<?=$keywords?>">
    <meta name="author" content="">
    <script src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <link rel="shortcut icon" href="public_html/favicon.ico">  
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
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head> 
<style>
    .signup-form
    {
        margin: auto;
        width: 100%;
    }
    .file_upload, .photo_file_upload{
    display: block;
    position: relative;
    overflow: hidden;
    font-size: 1em;              
    height: 2em;                 
    line-height: 2em;             
    vertical-align: middle;
}
.file_upload .button, .file_upload > mark,
.photo_file_upload .button, .photo_file_upload > mark{
    display: block;
    cursor: pointer;              
}
.file_upload .button,
.photo_file_upload .button{
    float: right;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    width: 8em;                 
    height: 100%;
    text-align: center;           
}
.file_upload > mark,
.photo_file_upload > mark{
    background: transparent;     
    padding-left: 1em;
    width: 80%;
    margin-bottom: 5px;
    height: 32px;
}
@media only screen and ( max-width: 500px ){  
    .file_upload > mark,
    .photo_file_upload > mark{
        display: none
    }
    .file_upload .button,
    .photo_file_upload .button{
        width: 100%
    }
}
.file_upload input[type=file],
.photo_file_upload input[type=file]{
    position: absolute;
    top: 0;
    opacity: 0
}

.file_upload  > mark,
.photo_file_upload  > mark{
    border: 1px solid #ccc;
    border-radius: 3px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
    transition: box-shadow 0.1s linear;
}
.file_upload.focus  > mark,
.photo_file_upload.focus  > mark{
    box-shadow: 0 0 5px rgba(0,30,255,0.4);
}
.file_upload .button,
.photo_file_upload .button{
    text-align: center;
    line-height: 1.65em;
    margin-bottom: 5px;
    border-radius: 2px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;

}
#insert
{
    position: absolute;
    top: 10px;
    left: 10px;
}
.file_upload:hover .button,
.photo_file_upload:hover .button{
}
.file_upload:active .button,
.photo_file_upload:active .button{
}
.upper-wrapper{
    margin-top: <?=$margin?>;
}
</style>
<body class="<?=$class?>">


<?=$msg?>
    <div class="upper-wrapper">
        <!-- ******HEADER****** -->
        <header class="header">
            <div class="container">
                <h1 class="logo">
                     <a href="index"><img src="./public_html/assets/images/Logo/logo-blue.png" width="130px"></a>
                </h1><!--//logo-->
                                     
            </div><!--//container-->
        </header><!--//header-->

        <?=$body?>
        
    </div>
    

    
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
    <script type="text/javascript" src="public_html/assets/plugins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="public_html/assets/plugins/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
    <script type="text/javascript" src="public_html/assets/plugins/FitVids/jquery.fitvids.js"></script> 
    <script type="text/javascript" src="public_html/assets/plugins/flexslider/jquery.flexslider-min.js"></script>  
    <script type="text/javascript" src="public_html/assets/js/main.js"></script>
    <script type="text/javascript" src="public_html/assets/js/ajax.js"></script>
    <script type="text/javascript" src="public_html/assets/js/login.js"></script>
    <script type="text/javascript" src="public_html/assets/js/jquery.maskedinput.min.js"></script>
    <!--<script type="text/javascript" src="public_html/assets/js/ya.js"></script>-->
    <script type="text/javascript">
    
    </script>
        <?=$script?>    
</body>
</html> 

