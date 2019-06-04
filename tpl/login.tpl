
        
        <!-- ******Login Section****** --> 
        <section class="login-section access-section section">
            <div class="container" >
                <div class="row" id="login-box">
                    <div class="form-box" style="position: relative;">
                        <div class="">
                        <div class="logo">
			<h2 class="title text-center" style="margin-top: 25px;">Вход</h2>
		</div><!-- /.logo -->
                            <form  method="post" action="/public_html/php/login.php">              
                                        <div class="form-group email">
                                            <label class="sr-only" for="login-email">Логин</label>
                                            <input id="login-email" name="login" maxlength="32" type="text" class="form-control login-email" placeholder="Логин" required>
                                        </div><!--//form-group-->
                                        <div class="form-group password">
                                            <label class="sr-only" for="login-password">Пароль</label>
                                            <input id="login-password" maxlength="32" name="password" type="password" class="form-control login-password" placeholder="Пароль" required>
                                            <div class="checkbox remember">
                                                <label>
                                                    <input name="remember_me" type="checkbox" style="top: 0;"> Не запоминать меня
                                                </label>
                                            </div><!--//checkbox-->
                                        </div><!--//form-group-->
                                        <button type="submit" class="btn btn-block btn-cta-primary">Войти</button>
                                        <p class="forgot-password"><a href="resetpassword">Забыли пароль?</a></p>
                                         </form>
                        </div><!--//form-box-inner-->
                    </div><!--//form-box-->
                </div><!--//row-->
            </div><!--//container-->
            <div id="particles-js"></div>
        </section><!--//contact-section-->
    </div><!--//upper-wrapper-->

