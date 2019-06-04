
        
        <!-- ******Signup Section****** --> 
        <section class="signup-section access-section section">
            <div class="container">
                <div class="row">
                    <div class="form-box col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0" style="position: relative;">
                        <div class="comeback"><i class="fa fa-times"></i></div>
                        <div class="form-box-inner">
                            <h2 class="title text-center" style="margin-bottom:30px;"></h2>
                            <div class="row">
                                <div class="form-container">
                                    <form class="signup-form" action="./public_html/php/help.php" enctype="multipart/form-data" method="post">
                                        <div class="form-group">
                                            <label class="sr-only" for="theme">Введите тему отчета</label>
                                            <input type="text" id="theme" class="form-control" name="theme" maxlength="255" placeholder="Введите тему отчета" required></input>
                                        </div><!--//form-group-->
                                        <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="is_jkh" value="1" id="is_jkh">
                                              <label class="form-check-label" for="is_jkh">
                                                Квитанция ЖКХ
                                              </label>
                                            </div>
                                        <h3>Сканы</h3>
                                        <div id="scans">
                                            <div class="form-group">
                                                <label class="file_upload">
                                                    <span class="button btn-cta-primary">выбрать</span>
                                                    <mark>файл не выбран</mark>
                                                    <input type="file" name="file1" id="file1" required>
                                                </label>
                                            </div><!--//form-group-->
                                            <div class="form-group">
                                                <label class="sr-only" for="problem1">Комментарий</label>
                                                <textarea id="problem1" class="form-control" name="problem1" rows="5" placeholder="Комментарий"></textarea>
                                            </div><!--//form-group-->
                                            <div class="form-group">
                                                <label class="sr-only" for="theme">Сумма</label>
                                                <input type="number" id="sum1" class="form-control" name="sum1" placeholder="Сумма" required></input>
                                            </div><!--//form-group-->
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="is_income1" value="1" id="is_income1">
                                              <label class="form-check-label" for="is_income1">
                                                Доход
                                              </label>
                                            </div>
                                        </div>
                                        <input type="text" name="user_id" style="display: none;" value="<?=htmlspecialchars($_GET["user_id"])
                                        ?>">
                                        <a class="btn btn-cta-secondary middle" style="margin: 10px 0;" onclick="appendScanArea()">Добавить скан</a>
                                        <button type="submit" class="btn btn-block btn-cta-primary" name="submit" value="KK">Отправить</button>
                                    </form>
                                </div><!--//form-container-->
                            </div><!--//row-->
                        </div><!--//form-box-inner-->
                    </div><!--//form-box-->
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//signup-section-->
    </div><!--//upper-wrapper-->
<script type="text/javascript" src="assets/js/help.js"></script>
