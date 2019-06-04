
        
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
                                    <h2>Загрузите фотографии для фотоотчета</h2>
                                    <form class="signup-form" action="./public_html/php/photo_help.php" enctype="multipart/form-data" method="post">
                                        <div id="scans">
                                            <div class="form-group">
                                                <label class="photo_file_upload">
                                                    <span class="button btn-cta-primary">выбрать</span>
                                                    <mark>файл не выбран</mark>
                                                    <input type="file" name="file[]" id="file1" multiple required>
                                                </label>
                                            </div><!--//form-group-->
                                        </div>
                                        <input type="text" name="user_id" style="display: none;" value="<?=htmlspecialchars($_GET["user_id"])
                                        ?>">
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
