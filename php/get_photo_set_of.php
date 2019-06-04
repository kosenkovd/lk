<?php

set_include_path(get_include_path().PATH_SEPARATOR."php/".PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
session_start();
$user_id = $_SESSION["id"];
session_write_close();

$scans_id = (int) $_POST["scans_id"];

$query = new Query();

$arr1[0] = "time_sent";
$arr1[1] = "scans";
$arr2["scans_id"] = $scans_id;

$photos = $query->_Select("scan_docs", $arr1, $arr2, true);

$photoarr = [];
foreach($photos as $photo){
    $photodate = explode('.', $photo["time_sent"]);
    $photomonth = $photodate[1];
    $photoyear = $photodate[2];
    $photoarr[$photoyear][$photomonth][]["name"] = $photo["scans"];
}

$return["data"] = '';

foreach($photoarr as $year => $yeararr){
    if($year == htmlspecialchars($_POST["year"])){
        foreach($yeararr as $month => $montharr){
            if($month == htmlspecialchars($_POST["month"])){
                $return["data"] .= '
                            <div id="jssor_'.$scans_id.$month.$year.'" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
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
                    
                                var jssor_'.$scans_id.$month.$year.'_slider = new $JssorSlider$("jssor_'.$scans_id.$month.$year.'", jssor_1_options);
                    
                                /*#region responsive code begin*/
                    
                                var MAX_WIDTH = 980;
                    
                                function ScaleSlider'.$scans_id.$month.$year.'() {
                                    var containerElement = jssor_'.$scans_id.$month.$year.'_slider.$Elmt.parentNode;
                                    var containerWidth = containerElement.clientWidth;
                    
                                    if (containerWidth) {
                    
                                        var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
                    
                                        jssor_'.$scans_id.$month.$year.'_slider.$ScaleWidth(expectedWidth);
                                    }
                                    else {
                                        window.setTimeout(ScaleSlider'.$scans_id.$month.$year.', 30);
                                    }
                                }
                    
                                ScaleSlider'.$scans_id.$month.$year.'();
                    
                                $(window).bind("load", ScaleSlider'.$scans_id.$month.$year.');
                                $(window).bind("resize", ScaleSlider'.$scans_id.$month.$year.');
                                $(window).bind("orientationchange", ScaleSlider'.$scans_id.$month.$year.');
                                /*#endregion responsive code end*/
                            }, 500);
                        </script>';
            }
        }
    }

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