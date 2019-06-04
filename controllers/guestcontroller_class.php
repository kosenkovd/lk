<?php
	

class guestcontroller extends AbstractController {
	protected $possible_keywords = "Полиграфия, типография, предприятие, программное обеспечение, Perfect, Perfect-CRM, Perfect ERP, Perfect Momentum, Автоматизация типографии расчета и учета";
	protected $keywords;
	protected $enter;
	protected $help="";
	protected $class="pyotr";
	#protected $margin="25px !important";
	protected $msgs;
	protected $scripts;
	protected $quest = "signup";

	protected function message(){
		session_start();

		@$id = $_SESSION["id"];
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
				#	case 2:
				#		$fio = $_SESSION["fio"];
				#		$this->msgs = "<div id='hellomsg'><p>Здравствуйте, $fio!</p></div>";
				#		$this->scripts = "<script type='text/javascript'>function hide(){ \$('#hellomsg').slideUp()} setTimeout(hide, 5000); \$('#hellomsg').click(function(){ \$('#hellomsg').empty();})</script>";
				#		unset($_SESSION["status"]);
				#		break;
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
						$this->msgs = "<div id='hellomsg'><p>Новый пароль отправлен на электронную почту</p></div>";
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
					case 5:
						$this->msgs = "<div id='hellomsg'><p>Ваш аккаунт перемещен в архив!</p></div>";
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
			}

	}

	public function __construct() {
		parent::__construct(new View(DIR_TMPL));
	}

	public function action404() {
		parent::action404();
		$this->keywords = $this->possible_keywords;
		$this->class = "about-page";
		$this->message();
		
		$body = $this->view->render("404", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionIndex() {
		$this->keywords = "";
		$this->class = "login-page access-page";
		$this->message();
		$this->margin = "0px";

		$body = $this->view->render("login", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionLogin() {
		$this->keywords = "";
		$this->class = "login-page access-page";
		$this->message();
		$this->margin = "0px";

		$body = $this->view->render("login", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionHelp() {
		$this->keywords = "";
		$this->class = "signup-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("helpDenied", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionResetpassword() {
		$this->keywords = "";
		$this->class = "resetpass-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("reset-password", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionRegister() {
		$this->keywords = "";
		$this->class = "signup-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("helpDenied", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionRegister_kagent() {
		$this->keywords = "";
		$this->class = "signup-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("helpDenied", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionMail() {
		$this->keywords = "";
		$this->class = "signup-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("helpDenied", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	public function actionKagents() {
		$this->keywords = "";
		$this->class = "signup-page access-page has-full-screen-bg";
		$this->message();

		$body = $this->view->render("helpDenied", array(), true);

		$this->render($body, FORM_LAYOUT);
	}

	protected function render($str, $layout = MAIN_LAYOUT) {
		$params = array();
		$params["keywords"] = $this->keywords;
		$params["help"] = $this->help;
		$params["enter"] = $this->enter;
		$params["mobileenter"] = $this->mobileenter;
		$params["class"] = $this->class;
		$params["margin"] = $this->margin;
		$params["msg"] = $this->msgs;
		$params["script"] = $this->scripts;
		$params["realname"] = '<a href="index"><img src="./assets/images/Logo/perfect.jpg" width="130px"></a>';
		$params["body"] = $str;
		$params["quest"] = $this->quest;
		$this->view->render($layout, $params);
	}

}

?>