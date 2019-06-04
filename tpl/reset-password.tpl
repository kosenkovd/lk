
        <!-- ******resetpass Section****** --> 
        <section class="resetpass-section access-section section">
            <div class="container">
                <div class="row">
                    <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0" style="position: relative;">
                        <div class="comeback"><i class="fa fa-times"></i></div>
                        <div class="form-box-inner">
                            <h2 class="title text-center">Восстановление пароля</h2>
                            <p class="intro"></p>
                            <div class="row">
                                <div class="form-container">
                                    <form class="resetpass-form" action="/public_html/php/reset_password.php" method="post">
                                        <div class="form-group email">
                                            <label class="sr-only" for="reset-email">login</label>
                                            <input id="reset-email" type="text" maxlength="32" class="form-control resetpass-email" name="login" placeholder="Ваш логин" required>
                                        </div><!--//form-group-->  
                                        <button type="submit" class="btn btn-block btn-cta-primary">Восстановить пароль</button>
                                    </form>
                                    <p class="lead text-center">Вернуться на страницу <a href="login">входа</a>.</p>
                                </div><!--//form-container-->
                            </div><!--//row-->
                        </div><!--//form-box-inner-->
                    </div><!--//form-box-->
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//contact-section-->
    </div><!--//upper-wrapper-->


