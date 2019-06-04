<?php
	
class admincontroller extends AbstractController {

	protected $keywords;
	protected $help;
	protected $enter;
	protected $margin="-25px !important";
	protected $class="";
	protected $msgs;
	protected $scripts = '<script src="public_html/assets/js/admin.js"></script>';
	protected $quest = "mail";

	protected function message(){
		session_start();

		@$id = $_SESSION["id"] ? $_SESSION["id"] : $_COOKIE["id"];
		@$status = $_SESSION["status"];
		$type = gettype($status);
			if($type!="NULL"){
				switch ($status)
				{
					case 0:						
						//global $msgs, $script;
						$this->msgs = "<div id='hellomsg'><p>Отчет успешно отправлен!</p></div>";
						$this->scripts  = "<script type='text/javascript'>
						\$('#hellomsg').css('transform','translateY(-60px)');
						function hide(){ \$('#hellomsg').css('transform','translateY(0)');} 
						var timeout = setTimeout(hide, 5000); 
						\$('#hellomsg').click(function(){ 
						clearTimeout(timeout);
						\$('#hellomsg').css('display','none').empty();})
						</script>";
						unset($_SESSION["status"]);
						break;
					case 1:
						$this->msgs = "<div id='hellomsg'><p>Возникла непредвиденная ошибка, повторите запрос позже.</p></div>";
						$this->scripts = "<script type='text/javascript'>
						\$('#hellomsg').css('transform','translateY(-60px)');
						function hide(){ \$('#hellomsg').css('transform','translateY(0)');} 
						var timeout = setTimeout(hide, 5000); 
						\$('#hellomsg').click(function(){ 
						clearTimeout(timeout);
						\$('#hellomsg').css('display','none').empty();})
						</script>";
						unset($_SESSION["status"]);
						break;
					case 2:
						$fio = $_SESSION["fio"];
						$this->msgs = "<div id='hellomsg'><p>Произошла ошибка при открытии тикета, попробуйте повторить запрос позже.</p></div>";
						$this->scripts = "<script type='text/javascript'>
						function hide(){ \$('#hellomsg').slideUp()} 
						var timeout = setTimeout(hide, 5000); 
						\$('#hellomsg').click(function(){ 
						clearTimeout(timeout);
						\$('#hellomsg').css('display','none').empty();})
						</script>";
						unset($_SESSION["status"]);
						break;
					case 3:
						$this->msgs = "<div id='hellomsg'><p>Неверный логин или пароль!</p></div>";
						$this->scripts = "<script type='text/javascript'>
						\$('#hellomsg').css('transform','translateY(-60px)');
						function hide(){ \$('#hellomsg').css('transform','translateY(0)');} 
						var timeout = setTimeout(hide, 5000); 
						\$('#hellomsg').click(function(){ 
						clearTimeout(timeout);
						\$('#hellomsg').css('display','none').empty();})
						</script>";
						unset($_SESSION["status"]);
						break;
					case 4:
						$this->msgs = "<div id='hellomsg'><p>Произошла ошибка при создании тикета, просьба повторить операцию</p></div>";
						$this->scripts = "<script type='text/javascript'>
						\$('#hellomsg').css('transform','translateY(-60px)');
						function hide(){ \$('#hellomsg').css('transform','translateY(0)');} 
						var timeout = setTimeout(hide, 5000); 
						\$('#hellomsg').click(function(){ 
						clearTimeout(timeout);
						\$('#hellomsg').css('display','none').empty();})
						</script>";
						unset($_SESSION["status"]);
						break;
					default:
						$this->msgs = '';
						$this->scripts = '';
				}
				session_write_close();
			}

	}

	public function __construct() {
		parent::__construct(new View(DIR_TMPL));
	}

	public function action404() {
		parent::action404();
		$this->keywords = "Запрошенная страница не найдена, 404.";
		$this->class = "about-page";
		$this->message();
		
		$body = $this->view->render("404", array(), true);

		$this->render($body, FORM_LAYOUT);
}

	public function actionIndex() {
		$this->keywords = '';
		$this->help = '<li id="admin" class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Администрирование <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="register" target="_blank">Новый пользователь</a></li>
                            </ul>
                        <!--//dropdown-->';
		$this->message();
		$this->enter = "<a href='/public_html/php/logout.php'>Выйти</a>";

		$query = new Query();
		$list = '';		
		$array1[0] = "id";
		$array1[1] = "fio";
		$array2["is_admin"] = 0;
		$array2["is_archived"] = 0;
		$options = $query->_Select("users", $array1, $array2);
		for($o = 0; $o < count($options); $o++){
			$list.='<li class="nav-item dropdown" style="position: relative;"><a id="user'.$options[$o]["id"].'" onclick="getUserObjects('.$options[$o]["id"].')">'.$options[$o]["fio"].'</a></li>
			<li class="nav-item dropdown"><ul class="nav project-list" id="full-menu-'.$options[$o]["id"].'"></ul></li>';
		}
		$list .='<li class="nav-item dropdown" style="position: relative;"><a href="/register" target="_blank"><i class="fas fa-plus"></i> Новый пользователь</a></li>';
        
		$params["options"] = $list;
		$params["script"] = '';
		$body = $this->view->render("mail", $params, true);

		$this->render($body, SERVICE_LAYOUT);
	}

	public function actionRegister() {
		$this->keywords = "";
		$this->class = "login-page access-page has-full-screen-bg";
		$this->message();		

		$body = $this->view->render("register", $options, true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionRegister_kagent() {
		$this->keywords = "";
		$this->class = "login-page access-page has-full-screen-bg";
		$this->message();	

		$body = $this->view->render("register_kagent", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionLogin() {
		$this->keywords = "";
		$this->class = "login-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("login", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionHelp() {
		$this->keywords = "";
		$this->class = "login-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("helpAllowed", $param, true);
		$this->render($body, FORM_LAYOUT);
	}
	
	public function actionPhotohelp() {
		$this->keywords = "";
		$this->class = "login-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("photohelpAllowed", $param, true);
		$this->render($body, FORM_LAYOUT);
	}

	public function actionSignup() {
		$this->keywords = "";
		$this->class = "login-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("signup", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionResetpassword() {
		$this->keywords = "";
		$this->class = "resetpass-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("reset-password", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionMail() {
		$this->keywords = "";
		$this->help = '<li id="admin" class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Администрирование <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="register" target="_blank">Новый пользователь</a></li>
                            </ul>
                        <!--//dropdown-->';
		$this->enter = "<a href='/php/logout.php'>Выйти</a>";
		$this->mobileenter="<a class='btn btn-cta btn-cta-primary' href='/php/logout.php'>Выйти</a>";
		$this->message();
        $this->margin = 'style="position: relative;"';
		$query = new Query();
		$select = '<ul class="nav" style="border-bottom: 1px solid #999999;">
		<li style="display:none;"><span id="kAgentSelect"></span></li>';		
		$array1[0] = "id";
		$array1[1] = "name";
		$options = $query->_Select("k_agents", $array1, array());
		for($o = 0; $o < count($options); $o++){
			$arr1[0] = "id";
			$arr2["kagent_id"] = $options[$o]["id"];
			$arr2["is_closed"] = 0;
			$res = $query->_Select("project", $arr1, $arr2, true);
			$count = 0;
			for($i=0;$i<count($res);$i++){
			    $arr3[0] = "COUNT(*)";
			    $arr4['project_id']=$res[$i]["id"];
			    $arr4['is_read']=0;
			    $arr4['from_admin']=0;
			    $messages = $query->_Select("user_messages", $arr3, $arr4, true);
			    if($messages[0]["COUNT(*)"] > 0){
			        $count++;
			    }
			}
			$arr3[0] = "COUNT(*)";
			if($count == 0){
				$select.='<li class="nav-item"><a onclick="getKAgentProjects('.$options[$o]["id"].')">'.$options[$o]["name"].'</a></li>
					<li class="nav-item"><ul class="nav project-list" id="full-menu-'.$options[$o]["id"].'">
                                </ul></li>
                    <li id="closed-head-'.$options[$o]["id"].'" class="nav-item closed-head" onclick="toggleClosedMenu('.$options[$o]["id"].')"></li>
                    <li class="nav-item"><ul class="nav project-list closed-list" id="closed-menu-'.$options[$o]["id"].'">
                                </ul></li>';
			}
			else{
				$select.='<li class="nav-item blinked" style="position: relative;"><a onclick="getKAgentProjects('.$options[$o]["id"].')"><strong>'.$options[$o]["name"].'</strong> <span class="numbered">'.$count.'</span></a></li>
					<li class="nav-item"><ul class="nav project-list" id="full-menu-'.$options[$o]["id"].'">
                                </ul></li>
                    <li id="closed-head-'.$options[$o]["id"].'" class="nav-item closed-head" onclick="toggleClosedMenu('.$options[$o]["id"].')"></li>
                    <li class="nav-item"><ul class="nav project-list closed-list" id="closed-menu-'.$options[$o]["id"].'">
                                </ul></li>';
			}			
		}
		$select .= "</ul>";

		$params["options"] = $select;
		$params["help"] = ' style="border-bottom: 1px solid #999999;"><a href="help">Создать новый тикет</a';
	
		$body = $this->view->render("mail", $params, true);

		$this->render($body, SERVICE_LAYOUT);
	}
	
	protected function render($str, $layout = MAIN_LAYOUT) {
		session_start();
		$params = array();
		$params["keywords"] = $this->keywords;
		$params["help"] = $this->help;
		$params["enter"] = $this->enter;
		$params["mobileenter"] = $this->mobileenter;
		$params["body"] = $str;
		$params["class"] = $this->class;
		$params["margin"] = $this->margin;
		$params["msg"] = $this->msgs;
		$params["script"] = $this->scripts;
		$params["realname"] = '<a id="realname">'.$_SESSION["fio"].'</a>';
		$params["quest"] = $this->quest;
		$this->view->render($layout, $params);
	}

}

?>