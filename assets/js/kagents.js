/* ===== Дополнительное меню контрагента ===== */

function openKagentSubMenu(id){
    $("#userList").html('<ul class="nav" style="margin-top: 0;"><li class="nav-item"><h2><strong>'+$("#kAgent"+id).attr('kagname')+'</strong></h2></li><li class="nav-item" onclick="printAllTickets('+id+')"><a>Распечатать полную переписку</a></li><li class="nav-item" onclick="showKAgentInfo('+id+')"><a>Просмотреть данные контрагента</a></li><li class="nav-item" onclick="openKAgentUpdateMenu('+id+')"><a>Изменить данные контрагента</a></li><li class="nav-item" onclick="deleteKagent('+id+')"><a>Удалить контрагента</a></li></ul>');
    $(".gobackbutton").attr("onclick","");
    $("#userList").attr("kagentid",id);
    var width = $("#kagent-box").outerWidth()/2;
    if(width < 731){
        $("#kagent-box").css("transform","translateX(-"+width+"px)");
    }
}

function openInactiveKagentSubMenu(id){
    $("#userList").html('<ul class="nav" style="margin-top: 0;"><li class="nav-item"><h2><strong>'+$("#inactiveKagent"+id).attr('kagname')+'</strong></h2></li><li class="nav-item" onclick="recreateKagent('+id+')"><a>Вернуть контрагента из архива</a></li></ul>');
    $(".gobackbutton").attr("onclick","");
    $("#userList").attr("kagentid",id);
}

function openKAgentUpdateMenu(id){
    var info = getKAgentInfo(id);
    var form = '<ul class="nav"><li class="nav-item"><h2><strong>'+$("#kAgent"+id).attr('kagname')+'</strong></h2></li></ul> <div class="login-form" style="margin-top: 20px;"><div class="form-group email"><label class="sr-only" for="fios">Название: '+ info["name"] +'</label><input id="fios" name="login" maxlength="100" type="text" class="form-control login-email" placeholder="Название: '+ info["name"] +'"></div><!--//form-group--><div class="form-group"><label class="sr-only" for="login-password">Телефон: '+ info["tel"] +'</label><input id="login-password" maxlength="32" name="password" type="text" class="form-control login-password" placeholder="Телефон: '+ info["tel"] +'"></div><!--//form-group--><div class="form-group email"><label class="sr-only" for="email">Веб-сайт: '+ info["www"] +'</label><input id="email" name="email" maxlength="32" type="email" class="form-control login-email" placeholder="Веб-сайт: '+ info["www"] +'"></div><!--//form-group--><!--//form-group--><button onclick="updateKAgent(' + id +')" class="btn btn-block btn-cta-primary">Подтвердить</button></div>';
    $("#userList").html(form);
    $(".gobackbutton").attr("onclick","goBackOnKAgentPopup("+$("#userList").attr("kagentid")+")");
}

function goBackOnKAgentPopup(id){
    $("#userList").html('<ul class="nav" style="margin-top: 0;"><li class="nav-item"><h2><strong>'+$("#kAgent"+id).attr('kagname')+'</strong></h2></li><li class="nav-item" onclick="showKAgentInfo('+id+')"><a>Просмотреть данные контрагента</a></li><li class="nav-item" onclick="openKAgentUpdateMenu('+id+')"><a>Изменить данные контрагента</a></li><li class="nav-item" onclick="deleteKagent('+id+')"><a>Удалить контрагента</a></li></ul>');
    $(".gobackbutton").attr("onclick","");    
}

function showKAgentInfo(id){
    var info = getKAgentInfo(id);
    data = '<ul class="nav" style="margin-top: 0; margin-left: 5px;"><li class="nav-item"><h2><strong>'+$("#kAgent"+id).attr('kagname')+'</strong></h2></li><li class="nav-item"><p>ID:  '+info["id"]+'</p></li><li class="nav-item"><p>Телефон:  '+info["tel"]+'</p></li><li class="nav-item"><p>Веб-сайт:  '+info["www"]+'</p></li>';
    $("#userList").html(data);
    $(".gobackbutton").attr("onclick","goBackOnKAgentPopup("+$("#userList").attr("kagentid")+")");
}

/* ===== Дополнительное меню пользователей контрагента ===== */

function openSubMenu(id, is_inactive){
    $('.usermenu').empty();
    $('.gobackbutton:not(#goBackMenu)').css("display","none");
    $('#gobackbutton'+id).css("display","inline");
    usermenuhtml= '<ul class="nav" style="margin-top: 0;">';
    if(!is_inactive){
        usermenuhtml += '<li class="nav-item"><a href="/help?user_id='+id+'" target="_blank">Добавить отчет</a></li>';
        usermenuhtml += '<li class="nav-item"><a href="/photohelp?user_id='+id+'" target="_blank">Добавить фотоотчет</a></li>';
    }
    usermenuhtml += '<li class="nav-item" onclick="showUserInfo('+id+', '+is_inactive+')"><a>Просмотреть данные пользователя</a></li><li class="nav-item" onclick="openUpdateMenu('+id+', '+is_inactive+')"><a>Изменить данные пользователя</a></li><li class="nav-item" onclick="openReInviteMenu('+id+')"><a>Повторно пригласить пользователя</a></li>';
    var str = $('#user'+id+' a').html();
    if(is_inactive) {
        usermenuhtml+='</ul>';
    }
    else{
        usermenuhtml+= '<li class="nav-item" onclick="putUserIntoArchieve('+id+')"><a>Поместить пользователя в архив</a></li></ul>';
    }
    $("#usermenu"+id).html(usermenuhtml);
    $(".gobackbutton").attr("onclick","getKAgentUsers("+$("#userList").attr("kagentid")+")");
    $("#userList").attr("userid",id);
}


function openUpdateMenu(id, is_inactive){
    var info = getUserInfo(id, is_inactive);
    var form = ' <div class="login-form" style="margin-top: 0;"><div class="form-group password"><label class="sr-only" for="login-password">Пароль</label><input id="login-password" maxlength="32" name="password" type="text" class="form-control login-password" placeholder="Пароль" value="Пароль: *****"></div><!--//form-group--><div class="form-group email"><label class="sr-only" for="phone_number">Номер: '+info["phone_number"].substr(34, 18)+'</label><input id="phone_number" name="phone_number" maxlength="32" type="text" class="form-control login-email" value="'+info["phone_number"].substr(34, 18)+'" placeholder="Номер: '+info["phone_number"].substr(34, 18)+'"></div><!--//form-group-->';
    form+='<div class="form-group email"><label class="sr-only" for="fioo">ФИО</label><input id="fioo" maxlength="60" name="fioo" type="text" class="form-control login-password" placeholder="ФИО" value="'+info['fio']+'"></div>';
    form += '<div class="form-group">'+ info["kontragentselect"] + '</div>';
    form += '<div class="form-group">'+ info["isadminselect"] + '</div>';
    form += '<button onclick="updateUser(' + id + ')" class="btn btn-block btn-cta-primary">Подтвердить</button></div>';
    form += '<script> $("#phone_number").mask("+7 (999) 999-99-99"); </script>';
    $("#usermenu"+id).html(form);
    $(".gobackbutton").attr("onclick","goBackOnPopup("+$("#userList").attr("userid")+")");
}
        
function openReInviteMenu(id){
    var info = getUserInfo(id);
    var form = ' <div class="login-form" style="margin-top: 0;"><div class="form-group password"><label class="sr-only" for="login-password">Пароль</label><input id="pass" maxlength="32" name="password" type="text" class="form-control login-password" placeholder="Пароль" autocomplete="off"></div><!--//form-group--><button onclick="reInviteUser(' + id +')" class="btn btn-block btn-cta-primary">Пригласить</button></div>';
    $("#usermenu"+id).html(form);
    $(".gobackbutton").attr("onclick","goBackOnPopup("+$("#userList").attr("userid")+")");
}
function goBackOnPopup(id){
    $("#usermenu"+id).html('<ul class="nav" style="margin-top: 0;"><li class="nav-item" onclick="showUserInfo('+id+')"><a>Просмотреть данные пользователя</a></li><li class="nav-item" onclick="openUpdateMenu('+id+')"><a>Изменить данные пользователя</a></li><li class="nav-item" onclick="openReInviteMenu('+id+')"><a>Повторно пригласить пользователя</a></li><li class="nav-item" onclick="putUserIntoArchieve('+id+')"><a>Поместить пользователя в архив</a></li><li class="nav-item" onclick="getStreamAccess('+id+')"><a>Доступ в трансляцию</a></li></ul>');
    $(".gobackbutton").attr("onclick","getKAgentUsers("+$("#userList").attr("kagentid")+")");
}

function showUserInfo(id, is_inactive){
    var userID = id;
    var info = getUserInfo(userID, is_inactive);
    data = '<ul class="nav" style="margin-top: 0; margin-left: 5px;"><li class="nav-item"><p>ID:  '+info["id"]+'</p></li><li class="nav-item"><p>Email:  '+info["email"]+'</p></li><li class="nav-item"><p>Телефон:  '+info["phone_number"]+'</p></li>';
    switch(info["is_admin"]){
        case '0':
            data += '<li class="nav-item"><p>Обычный пользователь</p></li></ul>';
            break;
        case '1':
            data += '<li class="nav-item"><p>Админ</p></li></ul>';
            break;
    }
    
    $("#usermenu"+id).html(data);
    $(".gobackbutton").attr("onclick","goBackOnPopup("+$("#userList").attr("userid")+")");
}


/* ===== Вставка картинок в тикетах ===== */


function pasteSheet(){
    $("#preview").click(function () { $("#preview").css("box-shadow", "0 0  2px 0 #999999"); });
        $("input, textarea").focus(function () { $("#preview").css("box-shadow", "none"); });
        $("button").click(function () { $("#preview").css("box-shadow", "none"); });
        var el = document.getElementById('preview');


        try{
        el.addEventListener('paste', function (e) {
            var clipboard = e.clipboardData;

            if (clipboard && clipboard.items) {
                // В буфере обмена может быть только один элемент
                var item = clipboard.items[0];

                if (item && item.type.indexOf('image/') > -1) {
                    // Получаем картинку в виде блоба
                    var blob = item.getAsFile();

                    if (blob) {
                        // Читаем файл и вставляем его в data:uri
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);

                        reader.onload = function (event) {
                            var img = new Image(200, 125);
                            var source = event.target.result;
                            img.src = source;
                            $("#screen").val(source.substr(22));
                            $("#preview img").remove();
                            el.appendChild(img);
                            $("#preview img").css({"display":"block"});
                        }

                    }
                }
            }

        });
        }
        catch(e){
            
        }
}

function goBack(){
    $("#userList").empty();
}
