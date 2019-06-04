<?php
	set_include_path(get_include_path().PATH_SEPARATOR."controllers/");
spl_autoload_extensions("_class.php");
spl_autoload_register();
		$result = Mail::getMail();
		$params = array();
		$val = '';
		$id=0;
		echo count($result);
		for($i=0; $i < count($result); $i++)
		{
		foreach ($result[$i] as $key => $value) {
			$bold = substr($key, 0, 1);
			if($bold = "0")
			{
				$style = 'style="font-weight:bold;"';
			}
			else
			{
				$style="";
			}
			$sub = substr($key, 1);
			$val .=' <article class="post col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0" style="margin-bottom: 0;">
                        <div class="post-inner">
                            <div class="content">                                
                                <p $style id="'.$id.'">'.$sub.'</p>
                                <p id="h'.$id.'">'.$value.'</p>    
                            </div><!--//content-->
                        </div><!--//post-inner-->
                    </article><!--//post--> <script type="text/javascript"> $("#h'.$id.'").slideUp(0); $("#'.$id.'").click(function(){ $("#h'.$id.'").slideToggle(50); })</script>';
            $id++;
		}
		}

		echo "$val";
?>