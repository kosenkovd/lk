<?php
	
class maincontroller extends AbstractController {

	protected $keywords;
	protected $help;
	protected $enter;
	protected $class="";
	protected $margin="0";
	protected $msgs;
	protected $scripts;
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
						$this->msgs = "<div id='hellomsg'><p>Запрос успешно отправлен!</p></div>";
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

		$body = $this->view->render("404", array(), true);

		$this->render($body, FORM_LAYOUT);
}

	public function actionIndex() {
		$this->keywords = "Полиграфия, типография, предприятие, программное обеспечение, Perfect, Perfect-CRM, Perfect ERP, Perfect Momentum";
		$this->help = "";
		$this->enter = "<a href='/public_html/php/logout.php'>Выйти</a>";
		$this->class = "home-page";
		$this->message();

		$body = $this->view->render("user_main", array(), true);

		$this->render($body, SERVICE_LAYOUT);
	}

	public function actionLogin() {
		$this->class = "login-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("login", array(), true);

		$this->render($body, FORM_LAYOUT);
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