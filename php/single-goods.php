<?php
/**
 * Template: Single product page
 *
 * You can edit this template by coping into your theme's folder
 */

if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <article <?php post_class(); ?>>
            <header class="single-good">
                <div id="inner_hope">
                
                <?php
                echo '<div class="goods-single-thumb-container row col-md-6 col-lg-6 col-sm-12 col-xs-12">';
                ?>
                
                <h2 class="entry-title "><strong>Товар: </strong><?php the_title(); ?></h2>
                
                <?php
			$size = getimagesize("https://aw-api.andrewn.name/GetImage/".get_post_meta(get_the_ID(), 'gc_sku', true)."/0");
		# $size = getimagesize(plugins_url('/img/gi.png', dirname(__FILE__)));
                if (strcmp($size[3], 'width="1" height="1"') != 0) {
                    $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                    echo '<div class="single-goods-img"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
                    echo '<img class="goods-item-thumb" src="https://aw-api.andrewn.name/GetImage/'.get_post_meta(get_the_ID(), 'gc_sku', true).'/0" alt="">';
                    echo '</a></div>';
                } else {
                    // show default image if the thumbnail is not found
                    echo '<div class="single-goods-img"><img class="goods-item-thumb" src="' . plugins_url('/img/gi.png', dirname(__FILE__)) . '" alt=""></div>';
                }?>
                
                
                    
                </div>
                <?
                echo '</div>';
                ?>
                <div class="goods-infos col-md-6 col-lg-6  col-sm-12 col-xs-12">
                    
                    <div class="calc row">
                    	    <div class="col-xs-3" id="labels">
                    	        <div>
                    	            <p>Тираж:</p>
                    	        </div>
                    	        <div>
                    	            <p>Цветность:</p>
                    	        </div>
				<div>
                    	            <p>Размеры:</p>
                    	        </div>
                    	        <div>
                    	            <p>Тип материала: </p>
                    	        </div>
                    	        <div>
                    	            <p>Материал:</p>
                    	        </div>
				<div>
                    	            <p>Доп операции:</p>
                    	        </div>
                    	        <div>
                    	            <p>Срочность:</p>
                    	        </div>
                    	    </div>
                    	    <div class="col-xs-9 price-show">
                    		<form class="login-form price-maker">
                    			<div class="form-group email">
                                    <label class="sr-only" for="login-email">Количество</label>
                                    <input onchange="checkPrice()" id="login-email" name="login" maxlength="32" type="text" class="form-control login-email" placeholder="Количество">
                                </div><!--//form-group-->
                                <div class="form-group email">
                                    <label class="sr-only" for="colors">Цветность</label>
                                    <select id="colors" name="colors" class="form-control login-email" onchange="getSizes()">
                                    	<option value="0">Цветность</option>
                                    </select>
                                </div><!--//form-group-->
				<div class="form-group email">
                                    <label class="sr-only" for="sizes">Тип материала</label>
                                    <select id="sizes" name="mat-type" class="form-control login-email">
                                    	<option value="0">Размеры</option>
                                    </select>
                                </div><!--//form-group-->
                                <div class="form-group email" onchange="getMat()">
                                    <label class="sr-only" for="mat-type">Тип материала</label>
                                    <select id="mat-type" name="mat-type" class="form-control login-email">
                                    	<option value="0">Тип материала</option>
                                    </select>
                                </div><!--//form-group-->				
                                <div class="form-group email">
                                    <label class="sr-only" for="material">Материал</label>
                                    <select id="material" name="material" class="form-control login-email">
                                    	<option value="0">Материал</option>
                                    </select>
                                </div><!--//form-group-->	
				<div id="operations">
                                    
                                </div>			
                                <div class="form-group email">
                                    <label class="sr-only" for="urgency">Срочность</label>
                                    <select id="urgency" name="urgency" class="form-control login-email">
                                    	<option value="0">Срочность</option>
                                    </select>
                                </div><!--//form-group-->
                    		</form>
                    			<div id="fin-price">
                    			    <span>
                    			        Итого: 
                    			    </span>
                    			    <span id="full-number"><span id="number">0000</span><span> Руб.</span></span>
                    			</div><p class="price"><span id="number"></span> </p>
                    		    
                    	</div>
                    	<button id="order_good">ЗАКАЗАТЬ</button>
                    	<img id="callccalc" src="<? echo plugins_url('/img/calc.png', dirname(__FILE__)); ?>" />
                    </div>
			
			
                </div>



                <div class="clear"></div>
		
<div class="goods-infos col-md-12 col-lg-12 col-sm-12" style="">
                    
                    <?php
                    // show product's details
#                    echo get_the_product_price();

                    
 #                       show_the_product_sku();
                    
  #                  if (isset($catalog_option['show_product_descr_page'])) {
   #                     show_the_product_desrc();
    #                }
     #               echo get_the_product_size();
      #              echo get_the_product_mass();
                   ?> <div class="entry-content">
                <?php
                the_content();
                ?>
            </div>
            </header>
                 <br clear="all"/>
            <div class="clear"></div>

        </article>
        <script>
	    var aw = '';
            window.onload = function(){

$("#buy").avgrund( {
        height: 1000,
        showClose: true, 
        showCloseText: 'Закрыть',
        holderClass: 'buy-popup',
        onBlurContainer: 'body',
        closeByEscape: true,
        closeByDocument: true,
        setEvent: 'click',
        template: '<form id="buy-form" class="signup-form" action="" method="post"><div class="form-group"><label class="sr-only" for="buy-fio">Ваше имя</label><input type="text" id="buy-fio" class="form-control" name="namez" maxlength="255" placeholder="Ваше имя" required></input></div><div class="form-group"><label class="sr-only" for="buy-phone">Ваш телефон или емейл</label><input type="text" id="buy-phone" class="form-control" name="buy-phone" maxlength="255" placeholder="Ваш телефон или емейл" required></input></div><button type="submit" class="btn btn-block btn-border" name="submit" value="KK">Отправить</button></form>'
    });

var listener = new window.keypress.Listener();

listener.register_combo({
    "keys"              : "enter",
    "on_keydown"        : function(){ },
    "on_keyup"          : function(){ },
    "on_release"        : function(){ },
    "this"              : $("#login-email"),
    "prevent_default"   : true,
    "prevent_repeat"    : true,
    "is_unordered"      : false,
    "is_counting"       : false,
    "is_exclusive"      : false,
    "is_solitary"       : true,
    "is_sequence"       : false
});


	    $("#login-email").val(1);
            $.ajax({
                type: "GET",
                url: "https://aw-api.andrewn.name/GetSrochnost/<?php echo get_post_meta(get_the_ID(), 'gc_sku', true); ?>",
                dataType: 'json',
                success: function(data){
                    data.forEach(function(item) {
                      $("#urgency").append('<option value="'+item["ID"]+'" nacenka="'+item["nacenka"]+'">'+item["name"]+'</option>');
                    });
                },
                error: function(e){
                }
            });
            $.ajax({
                type: "GET",
                url: "https://aw-api.andrewn.name/GetMatTypes/<?php echo get_post_meta(get_the_ID(), 'gc_sku', true); ?>",
                dataType: 'json',
                success: function(data){
                    data["Values"].forEach(function(item) {
                      $("#mat-type").append('<option value="'+item["Id"]+'">'+item["Value"]+'</option>');
                    });
                },
                error: function(e){
                }
            });
	    $.ajax({
                type: "GET",
                url: "https://aw-api.andrewn.name/GetOperations/<?php echo get_post_meta(get_the_ID(), 'gc_sku', true); ?>",
                dataType: 'json',
                success: function(data){
                    data.forEach(function(item) {
                      $("#operations").append('<p> <input onclick="checkPrice()" type="checkbox" value="'+item["ID"]+'"> '+item["name"]+'</p>');
                    });
                },
                error: function(e){
                }
            });
	    $.ajax({
                type: "GET",
                url: "https://aw-api.andrewn.name/GetPriceParam/<?php echo get_post_meta(get_the_ID(), 'gc_sku', true); ?>",
                dataType: 'json',
                success: function(data){
                    data["Values"].forEach(function(item) {
                      $("#colors").append('<option value="'+item["Id"]+'">'+item["Value"]+'</option>');
                    });
                },
                error: function(e){
                }
            });
            }
            
            
            
            function getSizes(){
                url = "https://aw-api.andrewn.name/GetPriceParam2/<?php echo get_post_meta(get_the_ID(), 'gc_sku', true); ?>/"+$("#colors").val();
                $.ajax({
                type: "GET",
                url: url,
                dataType: 'json',
                success: function(data){
		    $("#sizes").html('<option value="0" selected>Размеры</option>');
                    data["Values"].forEach(function(item) {		      
                      $("#sizes").append('<option value="'+item["Id"]+'">'+item["Value"]+'</option>');
                    });
                },
                error: function(e){
                }
            });
	    checkPrice();
            }

	    function getMat(){
                url = "https://aw-api.andrewn.name/GetMat/"+$("#mat-type").val();
                $.ajax({
                type: "GET",
                url: url,
                dataType: 'json',
                success: function(data){
		    $("#material").html('<option value="0" selected>Материал</option>');
                    data["Values"].forEach(function(item) {
                      $("#material").append('<option value="'+item["Id"]+'">'+item["Value"]+'</option>');
                    });
                },
                error: function(e){
                }
            });
	    checkPrice();
            }

	    function checkPrice(){   
		console.log( $("#material").val() +' ;' +      $("#mat-type").val() +' ;' +       $("#colors").val() +' ;' + $("#urgency").val() +' ;' + $("#login-email").val() );
            if(($("#material").val() != 0) && ($("#mat-type").val() != 0) && ($("#colors").val() != 0) && ($("#sizes").val() != 0) && ($("#urgency").val() != 0) && ($("#login-email").val() != '')){
		var oper = '';
		$("#operations p input").each(function(){
			if($(this).is(":checked")){				
				oper = oper + $(this).attr("value") + ',';
			}
		});
		srokk = $("#urgency").val();
		srokkn = $("#urgency option[value='"+srokk+"']").attr("nacenka");
		oper = oper.slice(0, -1);	
		if(oper != ''){
			var param = {
	                matId : +$("#material").val(),
        	        priceNameId : +$("#colors").val(),
                	param2Id : +$("#sizes").val(),
	                quantity : +$("#login-email").val(),
	                nacenka : oper,
        	        srok : +srokkn 
            		}; 
		}
		else{
			var param = {
	                matId : +$("#material").val(),
        	        priceNameId : +$("#colors").val(),
                	param2Id : +$("#sizes").val(),
	                quantity : +$("#login-email").val(),
			nacenka : ' ',
        	        srok : +srokkn 
            		}; 
		}
               $.each(param, function(index, value){
		console.log(index + ' = ' + value);
});
            $.ajax({ 
                type: "POST",
                url: "https://aw-api.andrewn.name/Calculate",
                data: param,
                dataType: 'json',
                success: function(data){
	$.each(data, function(index, value){
		console.log('result ' + index + ' = ' + value);
});		
                    $("#number").html(parseInt(data["Sum"]));
		    $("#buy").removeAttr("disabled");
                },
                error: function(){

                }
            });
        }

	else{
		$("#number").html('0000');
                $("#buy").attr("disabled", "disabled");
	}
    }

            function checkTimeoutPrice(a){
if(a){
	var timerId =    setInterval(function(){
if(($("#login-email").val() != aw) && ($("#login-email").val() != '')){
aw = $("#login-email").val();
                    checkPrice();
}
                }, 1000);
            }           
else{
	clearInterval(timerId);
}
}


function toggleOperations(){
	$("#operations").slideToggle();
	if($("#operationToggler").attr("state") == 0){
		$("#operationToggler i").css("transform","rotate(90deg)");
		$("#operationToggler").attr("state", 1);
	}
	else{
		$("#operationToggler i").css("transform","rotate(0)");
		$("#operationToggler").attr("state", 0);
	}
}
var aaa=0;
function toggleSubMenu(){
	$("#operations").slideToggle();
if(aaa){
	$("#openSub").css("transform","none");
	aaa=0;
}
else{
	$("#openSub").css("transform","rotate(180deg)");
	aaa=1;
}
}


        </script>
<script src="http://aw-gifts.ru/wp-includes/js/keypress-2.1.4.min.js"></script>
        <?php
    }
    ?>
    <div class="navigation">
        <?php previous_post_link('%link', __('Предыдущий товар', 'goods-catalog'), TRUE, ' ', 'goods_category'); ?>
        <?php next_post_link('%link', __('Следующий товар', 'goods-catalog'), TRUE, ' ', 'goods_category'); ?>
    </div>

    <?php
} else {
    get_404_template();
}