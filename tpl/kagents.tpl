<!-- ******BLOG LIST****** --> 
         <div class="row rowyourboat" id="kagent-box" style="min-height: 500px; margin-top: 20px;">
            <div class="col-md-2 col-sm-3 col-xs-4 col-md-offset-1 col-sm-offset-1 col-xs-offset-0" id="menu-box" style=" padding-right: 0;">
                <section class="features-tabbed section" style="overflow-y: scroll; padding-bottom: 0;">
                    <div id="menu">                    
                        <ul id="kagents" class="nav" >                              
							
							<?=$kAgents?>
                        
                        </ul>
                        </div><!--//tab-pane-->
                </section>
            </div>

            <div class="tab-pane col-md-8 col-xs-8 col-sm-6 col-sm-8" id="kagent-user-box">
                <div class="row"><a id="turn-back" onclick="goBackToKagentMenu()" style="cursor: pointer;"><i class="fa fa-chevron-left" aria-hidden="true"></i></a><ul class="nav col-md-4 col-sm-6 col-xs-12"><li class="nav-item"><a class="gobackbutton" id="goBackButtonKagent" onclick="goBackToKagents()" style="display: none !important;"><i class="fa fa-angle-left" aria-hidden="true"></i> Назад</a></li></ul></div>
                <div id="userList"></div><!--//desc-->
            </div>
        </div>
            <link id="theme-style" rel="stylesheet" href="assets/css/avgrund.css">
            
            <!-- ******FOOTER****** -->
   