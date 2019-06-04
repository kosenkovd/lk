var template='';
var allFunctions = ['Заводит контрагента',
'Создает заказ',
'Проводит оплату по безналу',
'Переводит в работу заказ',
'Отмечает готовность продукта',
'Выписывает счет',
'Выписывает закрывающие документы',
'Выдает заказ',
'Выполняет калькуляцию стоимости',
'Закупает материал и продукцию',
'Оформляет сотрудников',
'Распределяет заказы по менеджерам',
'Принимает входящие звонки',
'Анализирует результаты деятельности',
'Управляет ценами',
'Разрабатывает дизайн',
'Согласовывает дизайн',
'Заполняет справочник материалов (наименования и цены закупки и продажи)',
'Планирует доставку',
'Определяет сроки производства',
'Контролирует срок производства'];

var allPositions = [ 'Директор',
'Руководитель отдела продаж',
'Менеджер',
'Офис менеджер',
'Дизайнер',
'Начальник производства',
'Технолог',
'Препресс',
'Печатник',
'Кладовщик',
'Оператор копицентра',
'Специалист по закупкам',
'Бухгалтер',
'Старший менеджер'];

window.onload = function(){
    template = String($('#template').html());
    Mustache.parse(template);   // optional, speeds up future uses
    checkboxtemplate = String($('#checkboxtemplate').html());
    Mustache.parse(checkboxtemplate);
    selecttemplate = String($('#selecttemplate').html());
    Mustache.parse(selecttemplate);
    addRole(true);
};


function openProperties(num){
    var roleId = $("div[role-num='"+num+"'] > div > select").val();
    roleId = roleId.substring(4);
        if($("div").is("#properties"+roleId)){
            $(".property-sheets").css("display","none");
            $("#properties"+roleId).css("display","block").attr("visible", "visible");
        }
        else{
            $(".property-sheets").css("display","none");
            var checkboxesrendered = '';
            allFunctions.forEach((item,i,arr) => {
                checkboxesrendered += Mustache.render(checkboxtemplate, {number: i, title: item});
            })
            var rendered = Mustache.render(template, {number: roleId, position: allPositions[roleId], checkboxes: checkboxesrendered});
            $("#properties-side").append(rendered);
            
        }
}

function togglePropertiesList(num){
    if($("#role"+num).is(":checked")){
        if($("div").is("#properties"+num)){
            $("#properties"+num).css("display","block");
        }
        else{
            openProperties(num);    
        }
    }
    else{
        $("#properties"+num).css("display","none");
    }
}

function deleteRole(num){
    const lastVal = $("#role"+num).val().substring(4);
    const newOption = `<option value="role${lastVal}">${allPositions[lastVal]}</option>`;
    $(".role-selects select").each(function(){
        $(this).append(newOption);
    });
    $('div[role-num="'+num+'"').remove();
}

function addRole(startFlag){
    var roleNumber = +$("#role-container").attr("last-role");
    if(startFlag || $(".role-selects > div:last-child input").val() != ''){
        $("#role-container").attr("last-role", roleNumber+1);
        var optionsList = '';
        var usedRoles = [];
        $(".role-selects select").each(function(){
            var newRole = $(this).val();
            usedRoles.push(newRole.substring(4));
        }); 
        var roleToDelete = 0;
        var flag = true;
        for(var i = 0; i < allPositions.length; i++){
            if(find(usedRoles, i) == -1){
                if(flag){
                    optionsList += "<option value='role"+i+"' selected>"+allPositions[i]+"</option>";
                    flag = false;
                    roleToDelete = i;
                }
                else{
                    optionsList += "<option value='role"+i+"'>"+allPositions[i]+"</option>";
                }
            }
        }
        if(optionsList.length > 0) {
            if(!startFlag){
                $(".role-selects select option[value='role"+roleToDelete+"']").each(function(){
                    $(this).remove();
                });
            }
            var output = Mustache.render(selecttemplate, {number: roleNumber, options: optionsList});
            $(".role-selects").append(output);
            openProperties(roleNumber);
        }
        else{
            console.log('Все роли розданы');
        }
    }
    else{
        $("#add-role").html("Заполните все поля!").attr("disabled","disabled");
        setTimeout(function(){$("#add-role").html("Добавить роль").removeAttr("disabled");}, 3000);
    }
}

function changeOptions(num){
    var usedRoles = [];
    $(".role-selects select").each(function(){
        var newRole = $(this).val();
        usedRoles.push(newRole.substring(4))
    });
    $(".role-selects select").each(function(){
        var optionsList = '';
        var currentVal = $(this).val();
        currentVal = currentVal.substring(4);
        for(var i = 0; i < allPositions.length; i++){
            if(find(usedRoles, i) == -1){
                optionsList += "<option value='role"+i+"'>"+allPositions[i]+"</option>";
            }
            else if(i==currentVal){
                optionsList += "<option value='role"+i+"' selected>"+allPositions[i]+"</option>";
            }
        }
        $(this).html(optionsList);
    });
}

function find(array, value) {
    value = String(value);
  if (array.indexOf) { // если метод существует
    return array.indexOf(value);
  }

  for (var i = 0; i < array.length; i++) {
    if (array[i] === value) return i;
  }

  return -1;
}

function validateForm(){
    const head = $('#projecthead').val();
    const group = $('#workgroup').val();
    if(head === ''){
        $("#to-print").html("Укажите ФИО руководителя рабочей группы!").attr("disabled","disabled");
        setTimeout(function(){$("#to-print").html("Подготовить анкету к печати").removeAttr("disabled");}, 3000);
        return false;
    } else if(group === '') {
        $("#to-print").html("Укажите состав рабочей группы!").attr("disabled","disabled");
        setTimeout(function(){$("#to-print").html("Подготовить анкету к печати").removeAttr("disabled");}, 3000);
        return false;
    } else {
        let flag = true;
        if($(".role-selects > div:last-child input").val() == ''){
            $("#to-print").html("Заполните все количества сотрудников!").attr("disabled","disabled");
            setTimeout(function(){$("#to-print").html("Подготовить анкету к печати").removeAttr("disabled");}, 3000);
            flag = false;
        }
        return flag;
    }
}

function prepareForPrinting(){
    let wholeTeam = 0;
    var activePositions = [];
    var worksheetBody = '<body><style>h1{font-size: 24px;}h2{font-size: 18px;}p,pre,li{font-family: Times New Roman; font-size: 14px;}</style><h1>Анкета предприятия</h1>';
    $(".role-selects select").each(function() {
        activePositions.push($(this).val().substring(4));
    })
    for(var i = 0; i < activePositions.length; i++){
        var curpos = activePositions[i];
        if(i!=0){
            var worksheetPart = '<hr/>';
        }
        else{
            var worksheetPart = '';
        }
        const thisQuan = $('#quantity'+curpos).val();
        worksheetPart += '<h2>'+allPositions[curpos]+'</h2><p>В количестве '+thisQuan+' человек</p><ul>';
        let count = 0;
        for(var j = 0; j < allFunctions.length; j++) {
            if($("#properties"+curpos+" #function"+j).is(":checked")){
                worksheetPart += '<li>'+allFunctions[j]+'</li>';
                count ++;
            }
        }
        worksheetPart += '</ul>';
        if(count > 0){
            worksheetBody += worksheetPart;
            wholeTeam+=+thisQuan;
        }
    }
    worksheetBody += '<br/><h3>Рабочая группа:</h3><p>Руководитель: '+$('#projecthead').val()+'</p><p>Состав группы: '+$('#workgroup').val()+'</p><hr/>';
    worksheetBody += `<p>Общее количество пользователей: ${wholeTeam}</p><br/><br/>`;
    worksheetBody += `<pre>Руководитель организации:             __________________________         /____________________________/
                                                                                <small>Подпись</small>                                           <small>Расшифровка подписи</small></pre>`;
    worksheetBody += '</body>';
    newWin=window.open('','printWindow','Toolbar=0,Location=0,Directories=0,Status=0,Menubar=0,Scrollbars=0,Resizable=0'); 
    newWin.document.open(); 
    newWin.document.write(worksheetBody); 
    newWin.document.close(); 
    newWin.print();
}

function printPage(){
    if(validateForm()){
        prepareForPrinting();
    };
}