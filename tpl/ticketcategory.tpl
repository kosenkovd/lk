<!-- ******BLOG LIST****** --> 
         <div class="row" style="min-height: 500px; margin-top: 100px;">
            <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1" id="">
                <div id="cat">
                <form>
                    <ul class="nav">
                        <?=$category_list?>
                    </ul>
                </form>
                </div>
                <input type="text" class="form-control" style="display: inline-block; max-width: 700px; margin-right: 20px;" id="newCat" placeholder="Введите название" />
                <button class="btn-cta-primary btn btn-block" style="margin-top: 20px; max-width: 700px;" onclick="appendCategory()">Добавить категорию</button>
            </div>
        </div>
            <link id="theme-style" rel="stylesheet" href="assets/css/avgrund.css">
            
            <!-- ******FOOTER****** -->
