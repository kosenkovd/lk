$(document).ready(function() {

    
    /* ======= Отправка сообщений парой кликов ======= */   
    
    
    /* ======= Twitter Bootstrap hover dropdown ======= */   
    /* Ref: https://github.com/CWSpear/bootstrap-hover-dropdown */ 
    /* apply dropdownHover to all elements with the data-hover="dropdown" attribute */
    
  /*  $('[data-hover="dropdown"]').dropdownHover();
    */
    /* ======= Fixed header when scrolled ======= */    
  /*  $(window).on('scroll load', function() {
         
         if ($(window).scrollTop() > 0) {
             $('#header').addClass('scrolled');
         }
         else {
             $('#header').removeClass('scrolled');
             
         }
    });
*/
    // Возвращаемся по нажатию

 /*   $(".comeback > i").mouseenter(function(){
        $(this).removeClass('fa-times');
        $(this).addClass('fa-angle-left fa-lg');
    })
    .mouseleave(function(){
        $(this).removeClass('fa-angle-left fa-lg');
        $(this).addClass('fa-times ');
    });
*/
    $(".comeback").click(function(){
	if(history.length>1)
{
        history.back();
}
else
{
	window.location.replace("http://perfect-crm.ru/");
}
    });

    // Прячем номер, чтобы не накладывался

    function vasily()
    {
        if(($(window).outerWidth() < "1200") && ($(window).outerWidth() > "950"))
        {
            $(".wtf").css("display","none");
        }
    }
    vasily();
    $( window ).resize(function() {
        if($("#header").hasClass("header")){
            if(($(window).outerWidth() < "1200") && ($(window).outerWidth() > "950"))
            {
                $(".wtf").css("display","none");
            }
            else
            {
                $(".wtf").css("display","block");
            }
        }
        else{
            if(($(window).outerWidth() < "1000") && ($(window).outerWidth() > "950"))
            {
                $(".wtf").css("display","none");
            }
            else
            {
                $(".wtf").css("display","block");
            }
        }  
    });
    
    function isPhone(){
        var isMobile = ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) ? true : false;
        if( isMobile ) {
            $(".levitation .fa-question").css("display", "none");
// some code...
}
else{
    $(".levitation .fa-microphone").css("display", "none");
    $(".signup-form div.mid").css("display", "none");
}
    }
    isPhone();
    
    flag = false;
    // Изменяем маргин хедера

    function changeMargin(){
        if(!$("#user").attr("href")){
            if($("#header").hasClass("header")){
            if($(window).outerWidth() < "982"){
            $(".header").css("margin-top", "-25px");
        }
        else
        {
            $(".header").css("margin-top", "0");
        }
        }
        else{
            if($(window).outerWidth() < "300"){
            $(".header").css("margin-top", "-25px");
        }
        else
        {
            $(".header").css("margin-top", "0");
        }
        }        
    }        
    }

   // changeMargin();

    
    $(window).resize(changeMargin);
    
    /*
    // Ищем локацию

    var region = geoplugin_region();
    if(region == 'St.-Petersburg')
    {
         $(".wtf").css("display", "block");
         $(".wtf").html('Тел.: (499) 753-22-66');
        $(".wtf").attr('href', 'skype:+74997532266?call');
//        $(".wtf").html('Тел.: (812) 337-56-77');
  //      $(".wtf").attr('href', 'skype:+78123375677?call');
    }
    else
    {
        if(region == ''){
            $(".wtf").css("display", "none");
        }
         $(".wtf").css("display", "block");
        $(".wtf").html('Тел.: (499) 753-22-66');
        $(".wtf").attr('href', 'skype:+74997532266?call');
    }


*/
    /* ======= jQuery Placeholder ======= */
    /* Ref: https://github.com/mathiasbynens/jquery-placeholder */
    
    $('input, textarea').placeholder();    
   
    /* ======= jQuery FitVids - Responsive Video ======= */
    /* Ref: https://github.com/davatron5000/FitVids.js/blob/master/README.md */
    
    $(".video-container").fitVids();
    
    /* ======= FAQ accordion ======= */
    function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find('.panel-title a')
        .toggleClass('active')
        .find("i.fa")
        .toggleClass('fa-plus-square fa-minus-square');
    }
    $('.panel').on('hidden.bs.collapse', toggleIcon);
    $('.panel').on('shown.bs.collapse', toggleIcon);    
    
    
    /* ======= Header Background Slideshow - Flexslider ======= */    
    /* Ref: https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties */
    
 /*   $('.bg-slider').flexslider({
        animation: "fade",
        directionNav: false, //remove the default direction-nav - https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties
        controlNav: false, //remove the default control-nav
        slideshowSpeed: 8000
    });
   */ 
    /* ======= Stop Video Playing When Close the Modal Window ====== */
    $("#modal-video .close").on("click", function() {
        $("#modal-video iframe").attr("src", $("#modal-video iframe").attr("src"));        
    });
     
    
     /* ======= Testimonial Bootstrap Carousel ======= */
     /* Ref: http://getbootstrap.com/javascript/#carousel */
    $('#testimonials-carousel').carousel({
      interval: 8000 
    });
    
    
    
    /* ======= Style Switcher ======= */    
    $('#config-trigger').on('click', function(e) {
        var $panel = $('#config-panel');
        var panelVisible = $('#config-panel').is(':visible');
        if (panelVisible) {
            $panel.hide();          
        } else {
            $panel.show();
        }
        e.preventDefault();
    });
    
    $('#config-close').on('click', function(e) {
        e.preventDefault();
        $('#config-panel').hide();
    });
    
    
    $('#color-options a').on('click', function(e) { 
        var $styleSheet = $(this).attr('data-style');
        $('#theme-style').attr('href', $styleSheet);	
                
        var $listItem = $(this).closest('li');
        $listItem.addClass('active');
        $listItem.siblings().removeClass('active');
        
        e.preventDefault();
        
    });

/* try{
    tinymce.init({
        selector: '.e',
        inline: true,
        plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'save table contextmenu directionality emoticons template paste textcolor'
        ],
        theme: 'modern'
    });
}
catch(e){
    
} */

});

/* ===== Красивое меню хелпдеска ===== */

    $("#closed-menu").slideUp(1);
    $(".projects").slideUp(1);

    function toggleFullMenu(){
        $("#full-menu").slideToggle();
    }

    function toggleClosedMenu(id){
        if(id){
            $("#closed-menu-"+id).slideToggle();
        }
        else{
            $("#closed-menu").slideToggle();
        }
        
    }

    function togglePros(id){
        $("#"+id).slideToggle();
    }
    
 /* ======= Слайдер видео ======= */
    var videos = new Array();
videos[0] = 'https://www.youtube.com/embed/7MrmrB8v_-I?color=ffffff&wmode=transparent';
videos[1] = 'https://www.youtube.com/embed/fCsq28iS5uo?color=ffffff&wmode=transparent';
var pos = 0;
function changeVid(a){
    if(a == 1){
        if(pos < videos.length - 1){
            pos++;
            $("#vimeo-video").attr("src", videos[pos]);
        }
        else{
            pos = 0;
            $("#vimeo-video").attr("src", videos[pos]);
        }
    }
    else{
        if(pos > 0){
            pos--;
            $("#vimeo-video").attr("src", videos[pos]);
        }
        else{
            pos = videos.length - 1;
            $("#vimeo-video").attr("src", videos[pos]);
        }
    }
}

function appendFileArea(){
    if($("div").is("#preview")){
        return false;
    }
    else{
        $("#callhere div").prepend("");
    }
}
function goBackToMenu(){
    $("#ticket-box").css("transform","none");
    var width = $("#ticket-box").outerWidth()/2;
    $("#menu-box").css("width",width+" !important");
}
function goBackToKagentMenu(){
    $("#kagent-box").css("transform","none");
    var width = $("#kagent-box").outerWidth()/2;
    $("#menu-box").css("width",width+" !important");
}
function testAccess(){
    var data = '<div id="testAccessForm" style="margin-top: 10px;" class="form-container "><div class="login-form"><div class="form-group email"><label class="sr-only" for="login-email">ФИО</label><input id="login-email" name="login" maxlength="255" type="text" class="form-control login-email" placeholder="ФИО" required></div><!--//form-group--><div class="form-group"><label class="sr-only" for="login-password">Электронная почта</label><input id="login-password" maxlength="255" name="password" type="email" class="form-control login-password" placeholder="Электронная почта" required></div><!--//form-group--><label><input id="agreed" name="remember_me" type="checkbox" style="top: 0;" required> Я согласен на обработку моих персональных данных <br/> <a href="/terms.html" target="_blank">Пользовательское соглашение</a></label><button id="testAccessButton" onclick="sendTestAccessInfo()" class="btn btn-block btn-cta-primary">Запросить</button></div></div><!--//form-container-->';
    if(!$("div").is("#testAccessForm")) $("#feature-1 > .desc > .desc").append(data);
}
var flag = 0;
function toggleFeatures(num){
    if (num == 1){
        flag++;
    }
    $(".nav-tabs li").removeClass("active");
    $(".nav-tabs li:nth-child("+num+")").addClass("active");
    var translate = ($("#slideTabOverlay .text-center").innerWidth() - 30) * (num-1);
    var tabHeight = $(".nav-tabs").innerHeight();
    var currentHeight = $("#feature-"+num).innerHeight()+tabHeight;
    if(flag){
        $("#slideTab").css("transform","translate(-"+translate+"px, "+tabHeight*flag+"px)");
        $(".text-center > .nav-tabs").css("transform","translateY("+tabHeight*flag+"px)");
    }
    else{
        $("#slideTab").css("transform","translateX(-"+translate+"px)");
    }
    $("#slideTabOverlay > .text-center").css("height", currentHeight)
}
    
function changeUserParam(param, value){
    let output;
    if(value !== undefined){
        output = '<input type="text" class="form-control" value="'+value+'"> <a onclick="updateUserParam(\''+param+'\')"><i class="fas fa-check"></i></a> <a onclick="declineUpdatingUserParam(\''+param+'\', \''+value+'\')"><i class="fas fa-times"></i></a>';
    } else {
        output = '<input type="text" class="form-control" placeholder="Введите пароль"> <a onclick="updateUserParam(\''+param+'\')"><i class="fas fa-check"></i></a> <a onclick="declineUpdatingUserParam(\''+param+'\')"><i class="fas fa-times"></i></a>';
    }
    
    $("#user-" + param).html(output);
}

function declineUpdatingUserParam(param, value){
    let output;
    if(value !== undefined){
        output = value + ' <a onclick="changeUserParam(\'' + param + '\', \'' + value + '\')"><i class="fas fa-edit"></i></a>';
    } else {
        output = '******** <a onclick="changeUserParam(\'password\')"><i class="fas fa-edit"></i></a>';
    }
    $("#user-" + param).html(output);
}