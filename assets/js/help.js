/* ===== Мучаем красивый ввод картинки и файла в подержке ===== */
window.onload = function(){
    // Prevent Bootstrap dialog from blocking focusin
    $(document).on('focusin', function (e) {
        if ($(e.target).closest(".mce-window").length) {
            e.stopImmediatePropagation();
        }
    });
    var first = true;

            
    fileUpload();
    photoFileUpload();
        
        };
        
function fileUpload(id){
    if(id === undefined){
        var wrapper = $(".file_upload"),
        inp = wrapper.find("input"),
        btn = wrapper.find(".button"),
        lbl = wrapper.find("mark");
    } else {
        id = id-1;
        var wrapper = $("#filewrapper"+id),
        inp = wrapper.find("input"),
        btn = wrapper.find(".button"),
        lbl = wrapper.find("mark");
        console.log(id);
    }
    
    // Crutches for the :focus style:
    inp.focus(function () {
        wrapper.addClass("focus");
    }).blur(function () {
        wrapper.removeClass("focus");
    });

    var file_api = (window.File && window.FileReader && window.FileList && window.Blob) ? true : false;

    inp.change(function () {
        var file_name;
        if (file_api && inp[0].files[0])
            file_name = inp[0].files[0].name;
        else
            file_name = inp.val().replace("C:\\fakepath\\", '');

        if (!file_name.length)
            return;

        if (lbl.is(":visible")) {
            lbl.text(file_name);
            btn.text("Выбрать");
        } else
            btn.text(file_name);
    }).change();

    $(window).resize(function () {
        $(".file_upload input").triggerHandler("change");
    });
}

function photoFileUpload(){
        var wrapper = $(".photo_file_upload"),
        inp = wrapper.find("input"),
        btn = wrapper.find(".button"),
        lbl = wrapper.find("mark");
    
    // Crutches for the :focus style:
    inp.focus(function () {
        wrapper.addClass("focus");
    }).blur(function () {
        wrapper.removeClass("focus");
    });

    var file_api = (window.File && window.FileReader && window.FileList && window.Blob) ? true : false;

    inp.change(function () {
        var file_name;
        if (file_api && inp[0].files[0]){
            length = inp[0].files.length;
            file_count = 'Загружено файлов: ' + length;
        }        else
            file_name = inp.val().replace("C:\\fakepath\\", '');

        if (!file_count.length)
            return;

        if (lbl.is(":visible")) {
            lbl.text(file_count);
            btn.text("Выбрать");
        } else
            btn.text(file_count);
    }).change();

    $(window).resize(function () {
        $(".file_upload input").triggerHandler("change");
    });
}
        
function deleteImage(num){
    $("#preview div:nth-child("+num+")").remove();
    if(num == 1){
        $("#screen").val('');
    }
    else{
        $("#screen1").val('');
    }
}

var scanCounter = 2;
function appendScanArea() {
    var out = '<div class="form-group">';
    out += '<label class="file_upload" id="filewrapper'+scanCounter+'">';
    out += '<span class="button btn-cta-primary">выбрать</span>';
    out += '<mark>файл не выбран</mark>';
    out += '<input type="file" name="file'+scanCounter+'" id="file'+scanCounter+'">';
    out += '</label>';
    out += '</div><!--//form-group-->';
    out += '<div class="form-group">';
    out += '<label class="sr-only" for="problem'+scanCounter+'">Комментарий</label>';
    out += '<textarea id="problem'+scanCounter+'" class="form-control" name="problem'+scanCounter+'" rows="5" placeholder="Комментарий"></textarea>';
    out += '</div><!--//form-group-->';
    out += '<div class="form-group">';
    out += '<label class="sr-only" for="sum'+scanCounter+'">Сумма</label>';
    out += '<input type="number" id="sum'+scanCounter+'" class="form-control" name="sum'+scanCounter+'" placeholder="Сумма"></input>';
    out += '</div><!--//form-group-->';
    out += '<div class="form-check">';
    out += '<input class="form-check-input" type="checkbox" name="is_income'+scanCounter+'" value="1" id="is_income'+scanCounter+'">';
    out += '<label class="form-check-label" for="is_income'+scanCounter+'">';
    out += 'Доход';
    out += '</label>';
    out += '</div>';
    scanCounter++;
    $("#scans").append(out);
    fileUpload(scanCounter);
}