
        
        <!-- ******Login Section****** --> 
        <section class="login-section access-section section">
            <div class="container" >
                <div class="row">
                    <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0" style="position: relative;">                    
                        <div class="comeback"><i class="fa fa-times"></i></div>
                        <div class="form-box-inner">
                            <h2 class="title text-center"></h2>
                            <div class="row">
                                <div class="form-container ">
                                    <form class="login-form" method="post" action="/public_html/php/register.php">              
                                        <div class="form-group email">
                                            <label class="sr-only" for="name">Имя</label>
                                            <input id="name" name="name" maxlength="32" type="text" class="form-control login-email" placeholder="Имя" required>
                                        </div><!--//form-group-->
                                        <div class="form-group email">
                                            <label class="sr-only" for="surname">Фамилия</label>
                                            <input id="surname" name="surname" maxlength="32" type="text" class="form-control login-email" placeholder="Фамилия" required>
                                        </div><!--//form-group-->   
                                        <div class="form-group email">
                                            <label class="sr-only" for="passport">Серия и номер паспорта</label>
                                            <input id="passport" name="passport" maxlength="40" type="text" class="form-control login-email" placeholder="Серия и номер паспорта">
                                        </div><!--//form-group-->
                                        <div class="form-group email">
                                            <label class="sr-only" for="birthday">Дата рождения</label>
                                            <input id="birthday" name="birthday" maxlength="12" type="text" class="form-control login-email" placeholder="Дата рождения">
                                        </div><!--//form-group-->   
                                        <div class="form-group email">
                                            <label class="sr-only" for="account">№ счета</label>
                                            <input id="account" name="account" maxlength="64" type="text" class="form-control login-email" placeholder="№ счета">
                                        </div><!--//form-group-->
                                        <div class="form-group email">
                                            <label class="sr-only" for="email">Email</label>
                                            <input id="email" name="email" maxlength="60" type="email" class="form-control login-email" placeholder="email" required onchange="checkExistence()">
                                            <p id="warning" style="display:none; padding-left: 20px;">Этот емейл уже занят</p>
                                        </div><!--//form-group--> 
                                         <div class="checkbox remember">
                                            <p><input name="isAdmin" type="radio" value="0" checked> Пользователь</p>
                                            <p><input name="isAdmin" type="radio" value="1"> Админ</p>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-cta-primary">Зарегистрировать</button>
                                         </form>
                                </div><!--//form-container-->
                            </div><!--//row-->
                        </div><!--//form-box-inner-->
                    </div><!--//form-box-->
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//contact-section-->
    </div><!--//upper-wrapper-->

<sctipt src="./assets/js/ajax.js"></script>
<script> 
var lastNum = '';
window.onload = function() {
	$("#tel").mask("+7 (999) 999-99-99");
	$("#tel").change(function() {
		lastNum = $("#tel").val();
		console.log(lastNum);
	})
	$("#tel").focus(function() {
	
		if (lastNum != '') $("#tel").val(lastNum)
	})
}
</script>
