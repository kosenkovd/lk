/* ===== АЯКС запросы ===== */
        function sendTestAccessInfo(){
            if(($("#login-email").val() != '') && ($("#login-password").val() != '') && ($("#agreed").is(":checked"))){
                var param = {
                    fio: $("#login-email").val(),
                    email: $("#login-password").val()
                }
                $.ajax({
                type: "POST",
                url: "/public_html/php/send_test_access_info.php",
                data: param,
                success: function(data){
                    console.log(data);
                    if(!!data === true){
                        $("#testAccessForm").html('<p>Запрос успешно отправлен!</p>');
                    }
                    else{
                        $("#testAccessForm").html('<p>Возникла ошибка данных, введите данные еще раз.</p>');    
                    }
                },
                error: function(){
                    $("#testAccessForm").html('<p>Произошла ошибка, попробуйте запрос позже</p>');
                }
            });
            }
            else{
                $("#testAccessButton").html("Вы должны заполнить все поля!").attr("disabled","disabled");
                setTimeout(function(){$("#testAccessButton").html("Запросить").removeAttr("disabled");}, 3000);
            }
        }
        
        function postContact(){
            if(($("#call-company").val() != '') && ($("#call-email").val() != '') && ($("#call-name").val() != '') && ($("#call-phone").val() != '') && ($("#call-agreed").is(":checked"))){
                var param = {
                    fio: $("#call-name").val(),
                    email: $("#call-email").val(),
                    company: $("#call-company").val(),
                    phone: $("#call-phone").val()
                }
                $.ajax({
                type: "POST",
                url: "/public_html/php/postContact.php",
                data: param,
                success: function(data){
                    if(!!data === true){
                        $("#ssend").html('<p>Запрос успешно отправлен!</p>');
                    }
                    else{
                        $("#ssend").html('<p>Возникла ошибка данных, введите данные еще раз.</p>');    
                    }
                },
                error: function(){
                    $("#ssend").html('<p>Произошла ошибка, попробуйте запрос позже</p>');
                }
            });
            }
            else{
                $("#ssend").html("Вы должны заполнить все поля!").attr("disabled","disabled");
                setTimeout(function(){$("#ssend").html("Запрос").removeAttr("disabled");}, 3000);
            }
        }
        
        function postRequestContact(){
            console.log('postRequestContact');
            if(($("#request-company").val() != '') && ($("#request-email").val() != '') && ($("#request-name").val() != '') && ($("#request-phone").val() != '') && ($("#request-problem").val() != '') && ($("#request-agreed").is(":checked"))){
                var param = {
                    fio: $("#request-name").val(),
                    email: $("#request-email").val(),
                    company: $("#request-company").val(),
                    phone: $("#request-phone").val(),
                    problem: $("#request-problem").val()
                }
                $.ajax({
                type: "POST",
                url: "/public_html/php/postContact.php",
                data: param,
                success: function(data){
                    if(!!data === true){
                        $("#request-send").html('<p>Запрос успешно отправлен!</p>');
                    }
                    else{
                        $("#request-send").html('<p>Возникла ошибка данных, введите данные еще раз.</p>');    
                    }
                },
                error: function(){
                    $("#request-send").html('<p>Произошла ошибка, попробуйте запрос позже</p>');
                }
            });
            }
            else{
                $("#request-send").html("Вы должны заполнить все поля!").attr("disabled","disabled");
                setTimeout(function(){$("#request-send").html("Запрос").removeAttr("disabled");}, 3000);
            }
        }

        function showSend(a){
            var param = {
               response: a
           }
           $.ajax({
               type: "POST",
                url: "php/captcha.php",
                data: param,
                success: function(data){
                    if(data == true){
                        $("#ssend").removeAttr("disabled");  
                        $("#captch").fadeOut(500);
                }
                else
                {
                    grecaptcha.reset();
                }
                }
           });
        }

         function checkExistence(table){
            var param = {
                email: $("#email").val(),
                table: table
            };
            $.ajax({
                type: "POST",
                url: "/public_html/php/verify_login.php",
                data: param,
                dataType: 'json',
                success: function(data){
                    if(data['result'] == 0){
                    $("#warning").css("display","none");
                     $('button[type=submit]').prop('disabled', false);
                }
                else
                {
                    $("#warning").css("display","inline"); 
                     $('button[type=submit]').prop('disabled', true);  
                }
                },
                error: function(){
                 //   alert("Не удалось подключиться к серверу, повторите попытку позже");
                }
            });
        }
        
        function getProjectMail(project_id, is_admin, is_closed){
            var param = {
                id: project_id
            };
            $.ajax({
                type: "POST",
                url: "/public_html/php/get_project_mail.php",
                data: param,
                async: false,
                dataType: 'json',
                success: function(data){
                    $(".desc").html('').attr("pr", '');
                    $(".textarea").html('').css("border-top", "1px solid #999");
                    $("#ticket-header").html('');
                    $("#ticket-header").html(data.theme);
                    $(".desc::after").html('');
                    $(".desc").append(data.messages).attr("pr", project_id);
                    $(".textarea").append("<script type='text/javascript'> setInterval(checkMail, 5000); </script>");
                    if(is_closed == 0) {
                            if(is_admin == 0){
                                $(".textarea").append("<div id='callhere'><input type='text' id='screen' style='display: none;'><textarea class='form-control' name='new_msg' rows='3' onfocus='setRead()' required placeholder='Введите ваше сообщение...'></textarea><div><button id='sendd' pro='"+project_id+"' adm='"+is_admin+"' class='btn btn-cta-primary' style='margin: 10px 0;' onclick='sendNewMessage("+project_id+","+is_admin+")'>Отправить сообщение</button><button class='btn btn-cta-default' style='margin: 10px 0;' onclick='switchProject("+project_id+", 0, 120)'>Закрыть тикет</button></div></div>");

                            }
                            else{
                                $(".textarea").append("<div id='callhere'><textarea class='form-control' name='new_msg' rows='3' onfocus='setRead()' required placeholder='Введите ваше сообщение...'></textarea><div><button id='sendd' pro='"+project_id+"' adm='"+is_admin+"' class='btn btn-cta-primary' style='margin: 10px 0;' onclick='sendNewMessage("+project_id+","+is_admin+")'>Отправить сообщение</button><button style='margin: 10px; width: 300px;' id='uploadbtn' class='btn btn-cta-primary' onclick='appendFileArea()'>Приложить файлы</button><button class='btn btn-cta-default' style='margin: 10px 0;' onclick='switchProject("+project_id+", 0)'>Закрыть тикет</button></div></div>");
                            }
                            $("#callhere div").append(data.call);
                        }
                    else {
                        if(is_admin == 0){
                            $(".textarea").append("<button class='btn btn-cta-primary' style='margin: 10px;' onclick='switchProject("+project_id+", 1, 120)'>Открыть тикет</button></div>");
                        }
                        else{
                            $(".textarea").append("<button class='btn btn-cta-primary' style='margin: 10px;' onclick='switchProject("+project_id+", 1)'>Открыть тикет</button></div>");
                        }
                        $(".textarea").append(data.call);
                    }
                    
                    pasteSheet();
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
     /*               $("#scrollMessage").animate({
                        scrollTop: 100000
                    }, 100);
       */             var width = $("#ticket-box").outerWidth()/2;
       console.log(width);
                    if(width < 365.5){
                        $("#ticket-box").css("transform","translateX(-"+width+"px)");
                    }
                },
                error: function(aa, bb ,cc){
              //      alert("Не удалось подключиться к серверу, повторите попытку позже");
                }
            })
        }

        function sendNewMessage(project_id, is_admin){
            if($("textarea").val() == ''){
                $("#sendd").html('Сообщение не должно быть пустым!');
                setTimeout(function(){
                   $("#sendd").html('Отправить сообщение'); 
                }, 3000);
            }
            else
            {
            var param = {
                project_id: project_id,
                from_admin: is_admin,
                problem: $("textarea").val(),
                file: $("#files").val(),
                screen: $("#screen").val()
            };
            $.ajax({
                type: "POST",
                url: "/public_html/php/send_new_message.php",
                data: param,
                async: false,
                success: function(data){
                    $("#sendd").attr("disabled", "disabled");
                    setTimeout(function(){
                        $("#sendd").removeAttr("disabled");
                    }, 50);
                    $("#scrollMessage").prepend(data);
                    $("textarea").val('');
                    $("#files").val('');
                    $("#sendd").html('Отправить сообщение'); 
                    $("#preview").detach();
  /*                  $("#scrollMessage").animate({
                        scrollTop: 100000
                    }, 100);
    */            },
                error: function(){
           //         alert("Не удалось подключиться к серверу, повторите попытку позже");
                }
            });
            }
        }
        
        
        
        function setRead(){
            project_id = $(".desc").attr("pr");
            var param = {
                project_id: project_id
            };
            $.ajax({
                type: "POST",
                url: "/public_html/php/set_read.php",
                data: param,
                success: function(data){
                    if(data == 1){
                        $('.message:not(.admin-message)[is-read="0"] .read').html("Прочитано ");
                    }
                    else{
                        $('.admin-message[is-read="0"] .read').html("Прочитано ");
                    }
                },
                error: function(){
                }
            });
        }
         
        
        function toggleDone(id, state){
            var param = {
                id: Number(id),
                state: Number(state)
            };
            $.ajax({
                type: "POST",
                url: "/public_html/php/toggle_done.php",
                data: param,
                success: function(data){
                    if(Number(state)){
                        $("#"+id + ".message .doned").html('Выполнено! <i class="fa fa-check-square-o" aria-hidden="true"></i>');
                        $("#" + id + ".message .done_menu").html("<p>Выполнить! <i class='fa fa-check-square-o' aria-hidden='true'></i></p><a onclick='toggleDone(" + id + ", 0)'>Вернуть в рассмотрение</a>");
                    }
                    else{
                        $("#"+id + ".message .doned").html('В процессе ...');
                        $("#" + id + ".message .done_menu").html("<p>Вернуть в рассмотрение</p><a onclick='toggleDone(" + id + ", 1)'>Выполнить! <i class='fa fa-check-square-o' aria-hidden='true'></i></a>");
                    }
                    
                },
                error: function(){
                    console.log("err");
                }
            });
        }
        

        function checkMail(){
            var firstID = $("#scrollMessage .message:first-child").attr("id");
            var lastID = $("#scrollMessage .message:last-child").attr("id");
            var paramID = 0;
            if(firstID >= lastID){
                paramID = firstID;
            }
            else{
                paramID = lastID;
            }
            var param = {
                id: paramID,
                project_id: $(".desc").attr("pr")
            };
            console.log("id: " + param.id);
            console.log("project: " + param.project_id);
            if(param.project_id){
            $.ajax({
                type: "POST",
                url: "/public_html/php/check_mail.php",
                data: param,
                success: function(data){
                    if(data.length>1){
                        if($("#menu .nav .nav-item a").html() == "Создать новую тему PerfectCRM"){
                            $('.admin-message[is-read="0"] .read').html("Прочитано ");
                        } 
                        else{
                            $('.message:not(.admin-message)[is-read="0"] .read').html("Прочитано ");
                        }
                    }
                    if(data[0] == 1){
                        $(".desc .message:last-child .read").html("Прочитано ");
                    }
                    $("#scrollMessage").prepend(data.substring(1));
                    setTimeout(function(){}, 100);    
                },
                error: function(){
                }
            });
        	}
        }
        
        function deleteMessage(id){
            msgID = id-0;
            var param = {
                id: msgID
            };
            var update = confirm("Вы уверены, что хотите удалить это сообщение?");
            if(update){
                $.ajax({
                    type: "POST",
                    url: "/public_html/php/delete_message.php",
                    data: param,
                    success: function(data){
                        $("#" + msgID).detach();
                    },
                    error: function(){
                        alert("Произошла ошибка, попробуйте позже");
                    }
                });
            }
        }

        function getUserObjects(id, force){
            user_id = id-0 || $("#ticket-box").attr("user-id")-0;
            if((id == $("#ticket-box").attr("user-id")) && !force){
                $("#full-menu-"+user_id+", #closed-head-"+user_id).slideToggle();
                $("#closed-menu-"+user_id).slideUp(1);
                return;
            }
            var param = {
                user_id
            }
            $.ajax({
                type: "POST",
                url: "/public_html/php/get_user_objects.php",
                data: param,
                dataType: 'json',
                success: function(data){
                    $("#ticket-box").attr("user-id", user_id);
                    $(".project-list, .closed-list, .closed-head").slideUp(1).html('').css("border-top", "none");
                    $("#full-menu-"+user_id).slideUp(1).append(data.opened).slideDown();
                },
                error: function(e){
                    console.log(e); 
      /*              alert("Не удалось подключиться к серверу, повторите запрос позже.");
        */        }
            })
        }

        function getUserProjects(){
            user_id = $(".look_here").attr("id");
            user_id = user_id.substr(7) - 0;
            var param = {
                user_id: user_id
            };
            $.ajax({
                type: "POST",
                url: "/public_html/php/get_user_projects.php",
                data: param,
                dataType: 'json',
                success: function(data){
                    $("#full-menu").html('');
                    $("#full-menu").append(data.opened);
                    $("#closed-menu").html('');
                    $("#closed-menu").append(data.closed);
                },
                error: function(){
         //           alert("Не удалось подключиться к серверу, повторите запрос позже.");
                }
            })
        }

        function switchProject(project_id, is_closed, is_admin){
            is_admin = is_admin || 1;
            project_id = project_id - 0;
            var param = {
                id: project_id,
                is_admin: is_admin
            };
            if(is_closed == 1){
                var del = confirm("Вы уверены, что хотите открыть эту тему?");
            }
            else{
                var del = confirm("Вы уверены, что хотите закрыть эту тему?");
            }            
            if(del){
                if(is_closed == 1){
                    $.ajax({
                        type: "POST",
                        url: "/public_html/php/open_project.php",
                        data: param,
                        success: function(data){
                            if(data){
                                $("#clsdprjct"+project_id).empty();
                                $(".desc").html('').attr("pr", '');
                                $(".textarea").html('').css("border-top","none");
                                $("#ticket-header").empty();
                                $(".desc::after").html('');
                                var width = $("#ourMail").outerWidth()*1;
                                if(width < 731){
                                    $("#ticket-box").css("transform","translateX(0)");
                                }
                                if(is_admin == 1){
                                    getKAgentProjects();    
                                }
                                else{
                                    getUserProjects();
                                }
                                var width = $("#ticket-box").outerWidth()/2;
                                if(width < 731){
                                    goBackToMenu();
                                }
                            }
                            else{
                                $(".desc").prepend('<div class="message">Пожалуйста, повторите запрос</div>');
                            }
                        },
                        error: function(){
              //              alert("Не удалось подключиться к серверу, повторите запрос позже.");
                        }
                    });
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "/public_html/php/close_project.php",
                        data: param,
                        success: function(data){
                            if(data){
                                $("#prjct"+project_id).empty();
                                $(".desc").html('').attr("pr", '');
                                $(".textarea").html('').css("border-top","none");
                                $("#ticket-header").empty();
                                $(".desc::after").html('');
                                if(is_admin == 1){
                                    getKAgentProjects();    
                                }
                                else{
                                    getUserProjects();
                                }
                                var width = $("#ticket-box").outerWidth()/2;
                                if(width < 731){
                                    goBackToMenu();
                                }
                            }
                            else{
                                $(".desc").prepend('<div class="message">Пожалуйста, повторите запрос</div>');
                            }
                            
                        },
                        error: function(){
             //               alert("Не удалось подключиться к серверу, повторите запрос позже.");
                        }
                    });
                }
            }
        }

        function getKAgentUsers(kAgentID){
            kAgentID = kAgentID - 0;
            var param = {
                id: kAgentID
            };
            $.ajax({
                type: "POST",
                url: "/public_html/php/get_all_kagent_users.php",
                data: param,
                success: function(data){
                    $("#userList").html('');
                    $("#userList").append(data);
                    $("#userList").attr("kagentid",kAgentID);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                    var width = $("#kagent-box").outerWidth()/2;
                    if(width < 731){
                        $("#kagent-box").css("transform","translateX(-"+width+"px)");
                    }
                },
                error: function(){
       //             alert("Не удалось подключиться к серверу, повторите запрос позже.");
                }
            });
        }

        function getUserInfo(id, is_inactive){
            var userInfo = 'значение';
            userID = id-0;
            var param = {
                id: userID,
                is_inactive
            }
            $.ajax({
                async: false,
                type: "POST",
                url: "/public_html/php/get_user_info.php",
                dataType: 'json',
                data: param,
                success: function(data){
                    userInfo = data;
                    return;
                },
                error: function(){
     //               alert("Не удалось подключиться к серверу, повторите запрос позже.");
                    return;
                }
            });
            var res = userInfo;
            return res;
        }

        function updateUser(id){
            
            userID = id - 0;
            is_admin = +$("#isadminselect").val();
            var param = {
                id: userID,
                is_admin: is_admin,
                password: '',
                login: '',
                email: ''
            };
            if($("#kagentselect").val() != ''){
                param.kontragent = $("#kagentselect").val();
            }
            if($("#login-password").val() != 'Пароль: *****'){
                param.password = $("#login-password").val();
            }
            if($("#fios").val() != ''){
                param.login = $("#fios").val();
            }
            if($("#email").val() != ''){
                param.email = $("#email").val();
            }
            if($("#fioo").val() != ''){
                param.fio = $("#fioo").val();
            }
            if(($("#phone_number").val() != '') && ($("#phone_number").val() != '+7 (___) ___-__-__')){
                var p = $("#phone_number").val();
                param.phone_number = p.substr(0, 2) + p.substr(4, 3) + p.substr(9, 3) + p.substr(13, 2) + p.substr(16, 2);
            }
            console.log($("#is_notificated").is(":checked"));
            if($("#is_notificated").is(":checked")){
                param.is_notificated = 1;
            }
            else{
                param.is_notificated = 0;
            }
            if(is_admin == 2){
                var cats = '';
                var kags = '';
                for(var a = 0; a < $("#category_count").val(); a++){
                    if($("#category"+a).is(':checked')){
                        cats += $("#category"+a).val() + ",";
                    }
                }
                for(var a = 0; a < $("#kagent_count").val(); a++){
                    if($("#kagent"+a).is(':checked')){
                        kags += $("#kagent"+a).val() + ",";
                    }
                }
                cats = cats.substring(0, cats.length - 1);
                param.cat_moder = cats;
                kags = kags.substring(0, kags.length - 1);
                param.kagent_moder = kags;
            }
            var str = $('#user'+userID+' a').html();
            if(str.indexOf('Неактивен:') + 1) {
                urlurl="/public_html/php/update_inactive_user.php";
            }
            else{
                urlurl="/public_html/php/update_user.php";
            }
            var update = confirm("Вы уверены, что хотите обновить данные этого пользователя?");
            if(update){
                $.ajax({
                    type: "POST",
                    url: urlurl,
                    data: param,
                    success: function(data){
                        $("#usermenu"+id).html(data);
                    },
                    error: function(){
                    }
                });
            }
        }
        
        function reInviteUser(id){
            
            userID = id - 0;
            var param = {
                id: userID,
                password: $("#pass").val()
            };
            var update = confirm("Вы уверены, что хотите вновь пригласить этого пользователя?");
            if(update){
                $.ajax({
                    type: "POST",
                    url: "/public_html/php/reinvite_user.php",
                    data: param,
                    success: function(data){
                        $("#usermenu"+id).html(data);
                    },
                    error: function(){
                    }
                });
            }
        }

        function putUserIntoArchieve(id){
            userID = id-0;
            var param = {
                id: userID
            };
            var update = confirm("Вы уверены, что хотите поместить этого пользователя в архив?");
            if(update){
                $.ajax({
                    type: "POST",
                    url: "/public_html/php/put_user_into_archive.php",
                    data: param,
                    success: function(data){
                        ("#usermenu"+id).html(data);
                        $("#goBackButton").attr("onclick","getKAgentUsers("+$("#userList").attr("kagentid")+")");
                    },
                    error: function(){
                        ("#usermenu"+id).html('<p style="margin-top: 100px;">Не удалось подключиться к серверу, повторите запрос позже.</p>');
                        $("#goBackButton").attr("onclick","getKAgentUsers("+$("#userList").attr("kagentid")+")");
                    }
                });
            }
        }

        function getKAgentInfo(id){
            var kAgentInfo;
            kAgentID = id-0;
            var param = {
                id: kAgentID
            }
            $.ajax({
                async: false,
                type: "POST",
                url: "/public_html/php/get_kagent_info.php",
                dataType: 'json',
                data: param,
                success: function(data){
                    kAgentInfo = data;
                    return;
                },
                error: function(){
        //            alert("Не удалось подключиться к серверу, повторите запрос позже.");
                    return;
                }
            });
            var res = kAgentInfo;
            return res;
        }

        function updateKAgent(id){
            
            userID = id - 0;
            var param = {
                id: userID,
                tel: '',
                www: '',
                name: ''
            };
            if($("#login-password").val() != ''){
                param.tel = $("#login-password").val();
            }
            if($("#fios").val() != ''){
                param.name = $("#fios").val();
            }
            if($("#email").val() != ''){
                param.www = $("#email").val();
            }
            var update = confirm("Вы уверены, что хотите обновить данные этого контрагента?");
            if(update){
                $.ajax({
                    type: "POST",
                    url: "/public_html/php/update_kagent.php",
                    data: param,
                    success: function(data){
                        $(".kagentpopup").html('<a href="#" class="avgrund-close">Закрыть</a>');
                        $(".kagentpopup").append(data);
                    },
                    error: function(){
                        $(".kagentpopup").html('<a href="#" class="avgrund-close">Закрыть</a> <p style="margin-top: 100px;">Не удалось подключиться к серверу, повторите запрос позже.</p>');
                    }
                });
            }
        }
        
        function deleteKagent(kagent_id){
            var param = {
                id: kagent_id
            };
            var update = confirm("Вы уверены, что хотите поместить этого контрагента и всех его пользователей в архив?");
            if(update){
                $.ajax({
                    type: "POST",
                    url: "/public_html/php/put_kagent_into_archive.php",
                    data: param,
                    success: function(data){
                        console.log(data);
                        if(data !== undefined) {
                            $("#userList").html('<p style="margin-top: 30px;">Контрагент успешно помещен в архив!</p>');
                            $("#goBackButton").attr("onclick","");
                            if(!$("ul").is("#inactive_kagents")){
                                $("#menu").append('<ul class="nav" id="inactive_kagents"><p>Неактивные контрагенты: </p></ul>');
                            }
                            $("#inactive_kagents").append($("#kAgent" + kagent_id).parent());
                            $("#inactive_kagents #kAgent" + kagent_id).attr("id", "inactiveKagent" + kagent_id).attr("onclick", "openInactiveKagentSubMenu("+kagent_id+")");
                            $("#kAgent" + kagent_id).parent().remove();
                        }
                    },
                    error: function(){
                        $("#goBackButton").attr("onclick","");
                        $("#userList").html('<p style="margin-top: 100px;">Не удалось подключиться к серверу, повторите запрос позже.</p>');
                    }
                });
            }
        }
    
        function recreateKagent(kagent_id){
            var param = {
                id: kagent_id
            };
            var update = confirm("Вы уверены, что хотите вернуть этого контрагента из архива?");
            if(update){
                $.ajax({
                    type: "POST",
                    url: "/public_html/php/recreate_kagent.php",
                    data: param,
                    success: function(data){
                        $("#userList").html(data);
                        $("#goBackButton").attr("onclick","");
                        $("#kagents").append($("#inactiveKagent" + kagent_id).parent());
                        $("#kagents #inactiveKagent" + kagent_id).attr("id", "kAgent" + kagent_id).attr("onclick", "openKagentSubMenu("+kagent_id+")");
                        $("#inactiveKagent" + kagent_id).parent().remove();
                        if(!$("#inactive_kagents li").is()){
                            $("#inactive_kagents").remove();
                        }
                        
                    },
                    error: function(){
                        $("#goBackButton").attr("onclick","");
                        $("#userList").html('<p style="margin-top: 100px;">Не удалось подключиться к серверу, повторите запрос позже.</p>');
                    }
                });
            }
        }
    
        function getStreamAccess(id){
            
            userID = id - 0;
            var param = {
                id: userID
            };
            $.ajax({
                    type: "POST",
                    url: "/public_html/php/get_stream_access.php",
                    data: param,
                    dataType: 'json',
                    success: function(data){
                        $("#usermenu"+id).html(data.resp);
                        $("#goBackButton").attr("onclick","goBackOnPopup("+$("#userList").attr("userid")+")");
                    },
                    error: function(){
                        $("#goBackButton").attr("onclick","goBackOnPopup("+$("#userList").attr("userid")+")");
                        $("#usermenu"+id).html(' <p style="margin-top: 100px;">Не удалось подключиться к серверу, повторите запрос позже.</p>');
                    }
                });
        }
        
        function giveStreamAccess(id){
            
            userID = id - 0;
            var param = {
                id: userID
            };
            var update = confirm("Вы уверены, что хотите разрешить доступ к трансляции этому пользователю?");
            if(update){
                $.ajax({
                    type: "POST",
                    url: "/public_html/php/give_stream_access.php",
                    data: param,
                    success: function(data){
                        $("#userList").html('<p style="margin-top: 100px;">Успешно!</p>');
                        $("#goBackButton").attr("onclick","goBackOnPopup("+$("#userList").attr("userid")+")");
                    },
                    error: function(){
                        $("#userList").html('<p style="margin-top: 100px;">Не удалось подключиться к серверу, повторите запрос позже.</p>');
                        $("#goBackButton").attr("onclick","goBackOnPopup("+$("#userList").attr("userid")+")");
                    }
                });
            }
        }
        
        function denyStreamAccess(id){
            
            userID = id - 0;
            var param = {
                id: userID
            };
            var update = confirm("Вы уверены, что хотите запретить доступ к трансляции этому пользователю?");
            if(update){
                $.ajax({
                    type: "POST",
                    url: "/public_html/php/deny_stream_access.php",
                    data: param,
                    success: function(data){
                        $("#userList").html('<p style="margin-top: 100px;">Успешно!</p>');
                        $("#goBackButton").attr("onclick","goBackOnPopup("+$("#userList").attr("userid")+")");
                    },
                    error: function(){
                        $("#userList").html('<p style="margin-top: 100px;">Не удалось подключиться к серверу, повторите запрос позже.</p>');
                        $("#goBackButton").attr("onclick","goBackOnPopup("+$("#userList").attr("userid")+")");
                    }
                });
            }
        }
        
        function findUser(){
            var ticket = $("#ticket-hash").val();
            var param = {
                fio: ticket
            };
            $.ajax({
                type: "POST",
                url: "/public_html/php/find_user.php",
                data: param,
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if(data.found == 1){
                        console.log('yes');
                        getUserObjects(data.user_id);
                        $("#ticket-box").attr('user-id', data.user_id);
                        newRenderer.setUserId = data.user_id;
                        newRenderer.setUserName = data.name;
                        
                        newRenderer.getObjectData(data.content.objects[0].objectId)
                        newRenderer.openFolder(data.content);
                    }
                    else{
                        alert("Такого пользователя не обнаружено");
                    }
                },
                error: function(aa, bb ,cc){
     //               alert("Не удалось подключиться к серверу, повторите попытку позже");
                }
            });
        }
        
        function changeTicketCategory(id){
            var cat = $("#category_select").val();
            var param = {
                id: id,
                category_id: cat
            }
            $.ajax({
                type: "POST",
                url: "/public_html/php/change_ticket_category.php",
                data: param,
                success: function(data){
                    console.log('Успешно!');
                },
                error: function(){
                }
            });
        }
        
        function appendCategory(){
            var cat_name = $("#newCat").val();
            cat_name = $.trim(cat_name);
            if(cat_name.length > 0){
               var pr = confirm("Вы точно хотите создать категорию " + cat_name + "?");
                if(pr){
                    var param = {
                        category_name: cat_name
                    }
                    $.ajax({
                        type: "POST",
                        url: "/public_html/php/append_category.php",
                        data: param,
                        success: function(data){
                            $("#cat ul").append(data);
                        },
                        error: function(){
                        }
                    });
                } 
            }
            else{
                alert("Имя не должно быть пустым!");
            }
        }
        
        function toggleCategory(a){
            var b;
            if($("input[onchange='toggleCategory("+a+")']").is(":checked")){
                b = 1;
            }
            else{
                b = 0;
            }
            var param = {
                id: +a,
                is_active: b
            }
            $.ajax({
                type: "POST",
                url: "/public_html/php/toggle_category.php",
                data: param,
                success: function(data){
                },
                error: function(){
                }
            });
        }
        
        function addResponsibilities(){
            var is_mod = $("input[name=isAdmin]:checked").val();
            if(is_mod == 2){
                $.ajax({
                    type: "POST",
                    url: "/public_html/php/add_responsibilities.php",
                    success: function(data){
                        $("#categories").html(data);
                    },
                    error: function(){
                    }
                });
            }
            else{
                $("#categories").empty();
            }
        }
        
        function checkIfModer(id){
            var param = {
                id: id
            };
            var is_mod = $("#isadminselect").val();
            if(is_mod == 2){
                $.ajax({
                    type: "POST",
                    data: param,
                    dataType: 'json',
                    url: "/public_html/php/add_update_responsibilities.php",
                    success: function(data){
                        var daten = '<div>' + data.cat_moder + '</div><div>' + data.kagent_moder + '</div>';
                        $("#twocolinfo").html(daten);
                        $(".popup").css({"height": "auto", "top": "25%", "max-height": "800px", "overflow-y": 'scroll', "min-height" : "350px"});
                    },
                    error: function(){
                    }
                });
            }
            else{
                $("#twocolinfo").empty();
            }
        }
        
/* ===== AdmiReal ===== */
        
    function getSummary(){
        const now = new Date().getTime();
        const isEmpty = !$("#summary").children().length;
        
        let toCheck = isEmpty;
        if(!isEmpty){
            const lastChecked = $("#summary").attr("last-checked");
            if(now - lastChecked > 5*60*1000){
                toCheck = true;
            }
        }
        if(toCheck){
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/public_html/php/get_summary.php",
                dataType: 'json',
                success: function(data){
                    const summary = $("#summary");
                    summary.attr("last-checked", now);
                    summary.html(data.data);
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
    }
    
    function openUserFolder(id, objectId) {
        const param = {
            id,
            object_id: objectId
        }
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/public_html/php/open_user_folder.php",
            data: param,
            dataType: 'json',
            success: function(data){
                $("#user-file-system-" + objectId).html(data.data);
            },
            error: function(e){
                console.log(e);
            }
        });
    }
    
    function getUserFolders(objectId) {
        const param = {
            object_id: objectId
        }
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/public_html/php/get_user_folders.php",
            dataType: 'json',
            data: param,
            success: function(data){
                $("#user-file-system-" + objectId).html(data.data);
            },
            error: function(e){
                console.log(e);
            }
        });
    }
    
    function getPaymentScans(){
        const now = new Date().getTime();
        const isEmpty = !$("#payment-scans").children().length;
        
        let toCheck = isEmpty;
        if(!isEmpty){
            const lastChecked = $("#payment-scans").attr("last-checked");
            if(now - lastChecked > 5*60*1000){
                toCheck = true;
            }
        }
        if(toCheck){
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/public_html/php/get_payment_scans.php",
                success: function(data){
                    const summary = $("#payment-scans");
                    summary.attr("last-checked", now);
                    summary.html(data.data);
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
    }
    
    function getPhotoReports(){
        const now = new Date().getTime();
        const isEmpty = !$("#photo-reports").children().length;
        
        let toCheck = isEmpty;
        if(!isEmpty){
            const lastChecked = $("#photo-reports").attr("last-checked");
            if(now - lastChecked > 5*60*1000){
                toCheck = true;
            }
        }
        if(toCheck){
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/public_html/php/get_photo_reports.php",
                dataType: 'json',
                success: function(data){
                    const summary = $("#photo-reports");
                    summary.attr("last-checked", now);
                    summary.html(data.data);
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
    }
    
    function getPhotoSetOf(scans_id, month, year){
        const param = {
            scans_id,
            month,
            year
        }
        let photosetId;
        if(month < 10){
            photosetId = "#photoset"+scans_id+"-0"+month+"-"+year;
        } else {
            photosetId = "#photoset"+scans_id+"-"+month+"-"+year;
        }
        if($(photosetId).attr("empty")) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/public_html/php/get_photo_set_of.php",
                dataType: 'json',
                data: param,
                success: function(data){
                    $(photosetId).html(data.data);
                    $(photosetId).removeAttr('empty');
                },
                error: function(e){
                    console.log(e);
                }
            });
        } else {
            $(photosetId).slideToggle(50);
        }
    }
    
    function getYourData(){
        const now = new Date().getTime();
        const isEmpty = !$("#your-data").children().length;
        let toCheck = isEmpty;
        if(!isEmpty){
            const lastChecked = $("#your-data").attr("last-checked");
            if(now - lastChecked > 5*60*1000){
                toCheck = true;
            }
        }
        if(toCheck){
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/public_html/php/get_user_info.php",
                success: function(data){
                    const udata = $("#your-data");
                    udata.attr("last-checked", now);
                    const userInfoTemplate = $('#userInfoTemplate').html();
                    const renderedUserInfoTemplate = Mustache.render(userInfoTemplate, data);
                    udata.html(renderedUserInfoTemplate);
                    prepareBiometryUpload();
                    udata.html(data.data);
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
    }
    
    function getScansOf(object_id, month, year) {
        const param = {
            object_id,
            month,
            year
        };
        
        let id;
        if(month < 10){
            id = "#0" + month + '-' + year;
            tableId = "#table-"+object_id+"-0"+month+"-"+year;
        } else {
            id = "#" + month + '-' + year;
            tableId = "#table-"+object_id+"-"+month+"-"+year;
        }
        
        if($(tableId).attr('empty')){
            $.ajax({
                type: "POST",
                data: param,
                dataType: 'json',
                url: "/public_html/php/get_scans_by_date.php",
                success: function(data){
                    
                    $(id).after( () => {
                        return data.data;
                    });
                    $(tableId).slideToggle();
                    $(tableId).removeAttr('empty');
                    console.log(id);
                },
                error: function(e){
                    console.log(e);
                }
            });
        } else {
            $(tableId).slideToggle();
        }
        
    }
    
    function getScansetById(id) {
        const param = {
            id
        };
        
        const scanid = "#scanset" + id;
        
        if(!$(scanid).attr("got")){
            $.ajax({
                type: "POST",
                data: param,
                dataType: 'json',
                url: "/public_html/php/get_scanset_by_id.php",
                success: function(data){
                    $(scanid).after( () => {
                        return data.data;
                    });
                    $(scanid).attr('got', 'got');
                    $('.scans-of-' + id).slideToggle(50);
                },
                error: function(e){
                    console.log(e);
                }
            });
        } else {
            $('.scans-of-' + id).slideToggle(50);
        }
    }
        
    function moveToUser(user_id){
        const param = {
            user_id
        };
        $.ajax({
            type: "POST",
            url: "/public_html/php/get_user_filesys_objects.php",
            data: param,
            dataType: 'json',
            success: function(data){
                newRenderer.setObjectId = false;
                newRenderer.openFolder(data);
                $("#new-folder-btn").addClass("isDisabled").removeAttr("data-toggle").removeAttr("data-target");
                $("#new-file-btn").addClass("isDisabled").removeAttr("data-toggle").removeAttr("data-target");
            },
            error: function(e){
                console.log(e)
            }
        });
    }
        
    function openMainFolder(type){
        object_id = newRenderer.ObjectId;
        const param = {
            type,
            object_id
        };
        $.ajax({
            type: "POST",
            url: "/public_html/php/open_main_folder.php",
            data: param,
            dataType: 'json',
            success: function(data){
                newRenderer.openFolder(data, type);
                $("#new-folder-btn").removeClass("isDisabled").attr("data-toggle", "modal").attr("data-target", "#newFolder");
                $("#new-file-btn").addClass("isDisabled").removeAttr("data-toggle").removeAttr("data-target");
            },
            error: function(e){
                console.log(e)
            }
        });
    }
    
    function getFiles(scans_id){
        user_id = newRenderer.UserId;
        newRenderer.setFolderId = scans_id;
        const param = {
            scans_id,
            user_id
        };
        $.ajax({
            type: "POST",
            url: "/public_html/php/get_files.php",
            data: param,
            dataType: 'json',
            success: function(data){
                newRenderer.openFolder(data.content, newRenderer.TypeId, data.folderName, data.isArend);
                $("#new-folder-btn").addClass("isDisabled").removeAttr("data-toggle").removeAttr("data-target");
                $("#new-file-btn").removeClass("isDisabled").attr("data-toggle", "modal").attr("data-target", "#newFile");
            },
            error: function(e){
                console.log(e)
            }
        });
    }
    
    function putTenantIntoArchive(scans_id) {
        const param = {
            scans_id,
            object_id: newRenderer.ObjectId,
            user_id: newRenderer.UserId
        }
        $.ajax({
            type: "POST",
            url: "/public_html/php/put_tenant_into_archive.php",
            data: param,
            dataType: 'json',
            success: function(data){
                newRenderer.openFolder(data.content, newRenderer.TypeId, data.folderName, data.isArend);
                $("#put-tenant-into-archive-btn").html("Успешно!");
                setTimeout(() => { $("#put-tenant-into-archive-btn").html("Переместить арендатора в архив"); }, 3000);
            },
            error: function(e){
                console.log(e)
            }
        });
    }
    
    function addNewObject(){
        if(($("#new-object-name").val() != '')){
            const user_id = $("#new-object-user-id").val();
            var param = {
                user_id,
                object_name: $("#new-object-name").val()
            }
            $.ajax({
            type: "POST",
            url: "/public_html/php/create_object.php",
            data: param,
            success: function(data){
                $('#newObject').hide();
                $('.modal-backdrop').hide();
                $("#ticket-box").removeAttr('user_id');
                getUserObjects(user_id, true);
            },
            error: function(e){
                console.log(e)
            }
        });
        }
        else{
            $("#object-create-btn").html("Название пустое!").attr("disabled","disabled");
            setTimeout(function(){$("#object-create-btn").html("Подтвердить").removeAttr("disabled");}, 3000);
        }
    }
    
    function addNewFolder(){
        if(($("#new-folder-name").val() != '')){
            const param = {
                object_id: newRenderer.ObjectId,
                type: newRenderer.TypeId,
                name: $("#new-folder-name").val(),
                month: $("#new-folder-month").val(),
                year: $("#new-folder-year").val()
            }
            $.ajax({
                type: "POST",
                url: "/public_html/php/create_folder.php",
                data: param,
                dataType: 'json',
                success: function(data){
                    /*$('#newFolder').modal('hide');
                    if($('div').is('.modal-backdrop.fade')){
                        $(".modal-backdrop.fade").detach();
                    }*/
                    $('#newFolder').hide();
                    $('.modal-backdrop').hide();
                    newRenderer.openFolder(data, newRenderer.TypeId);
                },
                error: function(e){
                    console.log(e)
                }
            });
        }
        else{
            $("#new-folder-btn").html("Название пустое!").attr("disabled","disabled");
            setTimeout(function(){$("#new-folder-btn").html("Подтвердить").removeAttr("disabled");}, 3000);
        }
    }
    
    function updateFolderName(folder_id){
        const value = $("#folder-" + folder_id + "-name input").val();
        const param = {
            folder_id,
            value
        };
        if(value != ''){
            $.ajax({
                type: "POST",
                url: "/public_html/php/update_folder_name.php",
                data: param,
                success: function(val){
                    if(!val){
                        $("#folder-" + folder_id + "-name").removeClass("on-edit");
                        $("#folder-" + folder_id + "-name").html(value);
                        $("#folder-" + folder_id + "-name").parent(".file-link").attr("onclick", "openFolder(" + folder_id + ")");
                    }
                },
                error: function(e){
                    console.log(e)
                }
            });
        } else {
            var del = confirm("Вы уверены, что хотите удалить эту папку?");
            const object_id = newRenderer.ObjectId;
            const type = newRenderer.TypeId;
            const user_id = newRenderer.UserId;
            const delParam = {
                type,
                object_id,
                folder_id,
                user_id
            };
            if(del){
                $.ajax({
                   type: "POST",
                   url: "/public_html/php/delete_folder.php",
                   data: delParam,
                   dataType: 'json',
                   success: function(data){
                       console.log(data);
                       newRenderer.openFolder(data, type);
                   }
                });
            }
        }
            
    }
    
    function addNewFile(){
        if(($("#files").val() != '')){
            const param = {
                scans_id: newRenderer.FolderId,
                commentary: $("scan-commentary").val(),
                file: $("#files").val(),
                sum: $("#scan-sum").val(),
                user_id: newRenderer.UserId
            };
            $.ajax({
            type: "POST",
            url: "/public_html/php/create_scan.php",
            data: param,
            dataType: 'json',
            success: function(data){
                $('#newFile').hide();
                $("#files").val('');
                $(".file_upload mark").html("Файл не выбран");
                $('.modal-backdrop').hide();
                newRenderer.openFolder(data.content, newRenderer.TypeId, data.folderName);
            },
            error: function(e){
                console.log(e)
            }
        });
        }
        else{
            $("#new-file-btn").html("Название пустое!").attr("disabled","disabled");
            setTimeout(function(){$("#new-file-btn").html("Подтвердить").removeAttr("disabled");}, 3000);
        }
    }
    
    function deleteFile(file){
        var param = {
            file_id: file,
            user_id: newRenderer.UserId,
            scans_id: newRenderer.FolderId
        };
        var del = confirm("Вы уверены, что хотите удалить этот файл?");
        if(del){
            $.ajax({
               type: "POST",
               url: "/public_html/php/delete_file.php",
               data: param,
               dataType: 'json',
               success: function(data){
                   newRenderer.openFolder(data.content, newRenderer.TypeId, data.folderName);
               }
            });
        }
    }
    
    function getUserInfo(){
        const param = {
            user_id: newRenderer.UserId  
        };
        $.ajax({
            type: "POST",
            url: "/public_html/php/get_user_info.php",
            data: param,
            dataType: 'json',
            success: function(data){
                prepareBiometryUpload();
                newRenderer.getUserInfo(data);
                $("#new-folder-btn").addClass("isDisabled").removeAttr("data-toggle").removeAttr("data-target");
                $("#new-file-btn").addClass("isDisabled").removeAttr("data-toggle", "modal").removeAttr("data-target", "#newFile");
            },
            error: function(e){
                console.log(e)
            }
        });
    }
    
    function updateUserParam(field){
        const value = $("#user-" + field + " input").val();
        let user_id;
        if(typeof newRenderer != 'undefined'){
            user_id = newRenderer.UserId;
        } else {
            user_id = -1;
        }
        const param = {
            field,
            value,
            user_id
        };
        $.ajax({
            type: "POST",
            url: "/public_html/php/update_user_param.php",
            data: param,
            success: function(val){
                console.log(val);
                let output;
                if(field !== 'password'){
                            output = value + ' <a onclick="changeUserParam(\'' + field + '\', \'' + value + '\')"><i class="fas fa-edit"></i></a>';
                } else {
                    output = '******** <a onclick="changeUserParam(\'password\')"><i class="fas fa-edit"></i></a>';
                }
                $("#user-" + field).html(output);
            },
            error: function(e){
                console.log(e)
            }
        });
    }

    function deleteUser(){
        var param = {
            user_id: newRenderer.UserId
        };
        var del = confirm("Вы уверены, что хотите удалить этого пользователя?");
        if(del){
            $.ajax({
               type: "POST",
               url: "/public_html/php/put_user_into_archive.php",
               data: param,
               dataType: 'json',
               success: function(data){
                   $("#user-delete-btn").html("Успешно!");
               }
            });
        }
    }
    
    function getAdminInfo(){
        const param = {
            object_id: newRenderer.ObjectId
        };
        $.ajax({
            type: "POST",
            url: "/public_html/php/get_admin_info.php",
            data: param,
            dataType: 'json',
            success: function(data){
                console.log(data);
                newRenderer.getAdminInfo(data);
                $("#new-folder-btn").addClass("isDisabled").removeAttr("data-toggle").removeAttr("data-target");
                $("#new-file-btn").addClass("isDisabled").removeAttr("data-toggle", "modal").removeAttr("data-target", "#newFile");
            },
            error: function(e){
                console.log(e)
            }
        });
    }
    
    function updateAdminParam(field){
        const value = $("#admin-" + field + " input").val();
        const param = {
            field,
            value
        };
        $.ajax({
            type: "POST",
            url: "/public_html/php/update_admin_param.php",
            data: param,
            success: function(val){
                if(!val){
                    let output;
                    if(value){
                                output = value + ' <a onclick="changeAdminParam(\'' + field + '\', \'' + value + '\')"><i class="fas fa-edit"></i></a>';
                    } else {
                        output = '******** <a onclick="changeAdminParam(\'password\')"><i class="fas fa-edit"></i></a>';
                    }
                    $("#admin-" + field).html(output);
                }
            },
            error: function(e){
                console.log(e)
            }
        });
    }
    
    function updateObjectName(id) {
        const param = {
            id,
            name: $("#new-object-name").val()
        };
        $.ajax({
            type: "POST",
            url: "/public_html/php/update_object_name.php",
            data: param,
            success: function(data){
                $("#new-object-name-btn").html("Успешно!");
                setTimeout(() => { $("#new-object-name-btn").html("Подтвердить"); }, 3000);
            },
            error: function(e){
                console.log(e)
            }
        });
    }

    function deleteObject(id){
        var param = {
            id
        };
        var del = confirm("Вы уверены, что хотите удалить этот объект?");
        if(del){
            $.ajax({
               type: "POST",
               url: "/public_html/php/put_object_into_archive.php",
               data: param,
               dataType: 'json',
               success: function(data){
                   $("#object-delete-btn").html("Успешно!");
               }
            });
        }
    }
    
    function updateUserOrder(tableId) {
        let folders = [];
        $("#" + tableId + " input").each((index, elem) => {
            folders[index] = {
               id: $(elem).attr('folder-id'),
               order: $(elem).val()
            };
        });
        const param = {
            folders
        }
        $.ajax({
            type: "POST",
            url: "/public_html/php/update_user_order.php",
            data: param,
            success: function(data){
                $("#user-order-btn-" + tableId).html("Успешно!");
                setTimeout(() => { $("#user-order-btn-" + tableId).html("Подтвердить"); }, 3000);
            },
            error: function(e){
                console.log(e)
            }
        });
    }
    
    function getObjectNews(){
        const param = {
            object_id: newRenderer.ObjectId
        };
        $.ajax({
            type: "POST",
            url: "/public_html/php/get_object_news.php",
            data: param,
            dataType: 'json',
            success: function(data){
                newRenderer.openObjectNews(data);
            },
            error: function(e){
                console.log(e)
            }
        });
    }
    
    function addObjectNews(){
        if(($("#new-news").val() != '')){
            const param = {
                object_id: newRenderer.ObjectId,
                user_id: newRenderer.UserId,
                text: $("#new-news").val()
            };
            $.ajax({
                type: "POST",
                url: "/public_html/php/add_object_news.php",
                data: param,
                dataType: 'json',
                success: function(data){
                    newRenderer.openObjectNews(data);
                },
                error: function(e){
                    console.log(e)
                }
            });
        }
        else{
            $("#new-news-btn").html("Введите текст новости!").attr("disabled","disabled");
            setTimeout(function(){$("#new-news-btn").html("Добавить новость").removeAttr("disabled");}, 3000);
        }
    }
    
    function updateNews(id) {
        const text = $("#news-" + id + " .news-text-wrapper textarea").val();
        const date = $("#news-" + id + " .news-date-wrapper input").val();
        const param = {
            id,
            text,
            date
        };
        $.ajax({
            type: "POST",
            url: "/public_html/php/update_object_news.php",
            data: param,
            success: function(){
                html2out = '<p>' + nl2br(text) + '</p>';
                $("#news-" + id + " .news-text-wrapper").html(html2out);
                $("#news-" + id + " .news-date-wrapper").html(date);
                const button = $("#news-" + id + " .float-right");
                button.attr("onclick", "editNews(" + id + ")");
                button.html("Изменить");
            },
            error: function(e){
                console.log(e)
            }
        });
    }
    
    function deleteNews(id){
        var param = {
            object_id: newRenderer.ObjectId,
            id
        };
        var del = confirm("Вы уверены, что хотите удалить эту новость?");
        if(del){
            $.ajax({
               type: "POST",
               url: "/public_html/php/delete_news.php",
               data: param,
               dataType: 'json',
               success: function(data){
                   console.log(param);
                   console.log(data);
                   newRenderer.openObjectNews(data);
               }
            });
        }
    }
    
    function nl2br( str ) {	// Inserts HTML line breaks before all newlines in a string
    	// 
    	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    
    	return str.replace(/([^>])\n/g, '$1<br/>');
    }
