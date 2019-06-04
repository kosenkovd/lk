<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();
$user_id = $_SESSION["id"];
session_write_close();

$query = new Query();

$objectg[0] = "id";
$objectg[1] = "name";
$objectpar["user_id"] = $user_id;
$objectpar["is_archived"] = 0;

$objects = $query->_Select("objects", $objectg, $objectpar);

$return["data"] = '';
foreach($objects as $object){
    $arr1[0] = 'name';
    $arr1[1] = 'month';
    $arr1[2] = 'year';
    $arr1[3] = 'id';
    
    $arr2["object_id"] = $object["id"];
    $arr2["type"] = 2;
    $return["data"] .= '<h3>Объект '.$object["name"].'</h3>';
    $scans = $query->_Select("scans", $arr1, $arr2, true);
    
    $last_month = 'asd';
    $last_year = 1;
    
    $counter = 1;
    $return["data"] .= '<ul class="nav nav-tabs text-center" id="photo-reports-nav">';
    foreach($scans as $scan) {
        $return["data"] .= '
        <li';
        if($counter == 1){
            $return["data"] .= ' class="active"';
        }
        $return["data"] .= '>
			<a data-toggle="tab" href="#photocoll-'.$counter.'" role="tab">
			<span class="">'.$scan["name"].'</span></a>
		</li>';
		$counter++;
    }
    $return["data"] .= '
            </ul>';
    $return["data"] .= '
            <div class="tab-content">';
    $counter = 1;
    foreach($scans as $scan){
        $phot[0] = "id";
        $phot[1] = "time_sent";
        $phot[2] = "scans";
        $photp["scans_id"] = $scan["id"];
        
        $photos = $query->_Select("scan_docs", $phot, $photp);
        
        $firstdate = explode('.', $photos[0]["time_sent"]);
        $first_year = $firstdate[2];
        $first_month = $firstdate[1];
        $return["data"] .= '
        <div class="tab-pane';
        if($counter == 1){
            $return["data"] .= ' active';
        }
        $return["data"] .= '" id="photocoll-'.$counter.'">
			<h3 class="title sr-only">'.$scan["name"].'</h3>
			<div class="desc text-left">
                <div class="">
					<div class="row">
						<div class="content-area col-md-12 col-sm-12 col-xs-12">
        ';
        $open_to_get = true;
        $close_to_get = true;
        $photoarr = [];
        foreach($photos as $photo){
            $photodate = explode('.', $photo["time_sent"]);
            $photomonth = $photodate[1];
            $photoyear = $photodate[2];
            $photoarr[$photoyear][$photomonth][]["name"] = $photo["scans"];
        }
        $first_month = true;
        
/*        foreach($photoarr as $year => $ya){
            $return["data"] .='y - '.$year;
            foreach($ya as $m => $ma){
                $return["data"] .= ', m - '.$m;
                foreach($ma as $ph){
                    $return["data"] .= ', ph - '.$ph["name"];   
                }
            }
        }*/
        
        foreach($photoarr as $year => $yeararr){
            $return["data"] .= '<h3 class="text-center">'.$year.'</h3>
            <table class="table table-striped">';
            foreach($yeararr as $month => $montharr){
                $return["data"] .= '
                    <thead>
                        <tr>
                          <th scope="col">
                              <h4 class="text-center"><a onclick="getPhotoSetOf('.$scan["id"].', '.$month.', '.$year.')">'.$month.'.'.$year.' <i class="fas fa-sort-down"></i></a></h4>
                          </th>
                        </tr>
                    </thead>';
                if($first_month){
                    $first_month = false;
                    $return["data"] .= '
                    <tbody>
                        <tr>
                            <td id="photoset'.$scan["id"].'-'.$month.'-'.$year.'">
                                <div id="jssor_'.$scan["id"].$month.$year.'" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
                                    <!-- Loading Screen -->
                                    <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="assets/images/common/spin.svg" />
                                    </div>
                                    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">';
                    foreach($montharr as $photo){
                        $return["data"] .= '
                                        <div><img data-u="image" src="/public_html/ticket_files/'.$user_id.'/'.$photo["name"].'" /></div>';
                    }
                    $return["data"] .= '
                                    </div>
                                    <!-- Bullet Navigator -->
                                    <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                                        <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- Arrow Navigator -->
                                    <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                            <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                                        </svg>
                                    </div>
                                    <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                            <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                                        </svg>
                                    </div>
                                </div>';
                    
                    $return["data"] .= '
                                <script type="text/javascript">
                                setTimeout(function () {
                        
                                    var jssor_1_SlideshowTransitions = [
                                      {$Duration:800,$Opacity:2}
                                    ];
                        
                                    var jssor_1_options = {
                                      $AutoPlay: 1,
                                      $SlideshowOptions: {
                                        $Class: $JssorSlideshowRunner$,
                                        $Transitions: jssor_1_SlideshowTransitions,
                                        $TransitionsOrder: 1
                                      },
                                      $ArrowNavigatorOptions: {
                                        $Class: $JssorArrowNavigator$
                                      },
                                      $BulletNavigatorOptions: {
                                        $Class: $JssorBulletNavigator$
                                      }
                                    };
                        
                                    var jssor_'.$scan["id"].$month.$year.'_slider = new $JssorSlider$("jssor_'.$scan["id"].$month.$year.'", jssor_1_options);
                        
                                    /*#region responsive code begin*/
                        
                                    var MAX_WIDTH = 980;
                        
                                    function ScaleSlider'.$scan["id"].$month.$year.'() {
                                        var containerElement = jssor_'.$scan["id"].$month.$year.'_slider.$Elmt.parentNode;
                                        var containerWidth = containerElement.clientWidth;
                        
                                        if (containerWidth) {
                        
                                            var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
                        
                                            jssor_'.$scan["id"].$month.$year.'_slider.$ScaleWidth(expectedWidth);
                                        }
                                        else {
                                            window.setTimeout(ScaleSlider'.$scan["id"].$month.$year.', 30);
                                        }
                                    }
                        
                                    ScaleSlider'.$scan["id"].$month.$year.'();
                        
                                    $(window).bind("load", ScaleSlider'.$scan["id"].$month.$year.');
                                    $(window).bind("resize", ScaleSlider'.$scan["id"].$month.$year.');
                                    $(window).bind("orientationchange", ScaleSlider'.$scan["id"].$month.$year.');
                                    /*#endregion responsive code end*/
                                }, 500);
                            </script>
                        </td>
                    </tr>
                </tbody>';
                } else {
                    $return["data"] .= '<tbody><tr><td empty="1" id="photoset'.$scan["id"].'-'.$month.'-'.$year.'"></td></tr></tbody>';
                }
            }
            $return["data"] .= '
            </table>';
        }
        $return["data"] .= '
        	
						</div><!--//content-area-->
					</div><!--//row-->
				</div><!--//container-->
			</div><!--//desc-->
		</div><!--//tab-pane-->';
		$counter++;
    }
    $return["data"] .= '</div>';
}

function safe_json_encode($value){
    if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
        $encoded = json_encode($value, JSON_PRETTY_PRINT);
    } else {
        $encoded = json_encode($value);
    }
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return $encoded;
        case JSON_ERROR_DEPTH:
            return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_STATE_MISMATCH:
            return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_CTRL_CHAR:
            return 'Unexpected control character found';
        case JSON_ERROR_SYNTAX:
            return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_UTF8:
            $clean = utf8ize($value);
            return safe_json_encode($clean);
        default:
            return 'Unknown error'; // or trigger_error() or throw new Exception()

    }
}

function utf8ize($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } else if (is_string ($mixed)) {
        return utf8_encode($mixed);
    }
    return $mixed;
}

$retu = safe_json_encode($return);


echo $retu;
#echo json_last_error();
?>