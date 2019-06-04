
        <script src="https://webasr.yandex.net/jsapi/v1/webspeechkit.js" type="text/javascript"></script>
        <script src="https://webasr.yandex.net/jsapi/v1/webspeechkit-settings.js" type="text/javascript"></script>
        <!-- ******Signup Section****** --> 
        <section class="signup-section access-section section">
            <div class="container">
                <div class="row">
                    <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0" style="position: relative;">
                        <div class="comeback"><i class="fa fa-times"></i></div>
                        <div class="form-box-inner">
                            
                            <h2 class="title text-center" style="margin-bottom: 30px;">Зарегистирируйтесь</h2>
                            <div class="row">
                                <div class="form-container">
                                    <div class="col-md-12 col-sm-12">
                                    <form class="login-form" method="post" action="/php/register.php">              
                                        <div class="form-group password">
                                            <label class="sr-only" for="login-password">Пароль</label>
                                            <input id="login-password" maxlength="32" name="password" type="text" class="form-control login-password" placeholder="Пароль" required>
                                        </div><!--//form-group-->
                                        <div class="form-group email">
                                            <label class="sr-only" for="fios">ФИО</label>
                                            <input id="fios" name="FIO" maxlength="100" type="text" class="form-control login-email" placeholder="ФИО" required>
                                        </div><!--//form-group-->
                                        <div class="form-group email">
                                            <label class="sr-only" for="email">Email</label>
                                            <input id="email" name="email" maxlength="32" type="email" class="form-control login-email" placeholder="email" required onchange="checkExistence()">
                                            <p id="warning" style="display:none; padding-left: 20px;">Этот емейл уже занят</p>
                                        </div><!--//form-group-->    
                                        <div class="form-group email">
                                            <label class="sr-only" for="tel">Телефон</label>
                                            <input id="tel" name="tel" maxlength="32" type="text" class="form-control login-email" placeholder="Телефон">
                                        </div><!--//form-group-->  
                                         <div class="checkbox remember" style="display:none;">
                                            <p><input name="isAdmin" type="radio" value="0" checked> Пользователь</p>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-cta-primary">Зарегистрироваться</button>
                                    </form>

                                    </div>
                                </div><!--//form-container-->
                            </div><!--//row-->
                        </div><!--//form-box-inner-->
                    </div><!--//form-box-->
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//signup-section-->
    </div><!--//upper-wrapper-->
