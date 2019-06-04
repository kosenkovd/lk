/* ===== Распознём речь ===== */
window.onload= function () {
            window.ya.speechkit.settings.apikey = 'e64240be-1ceb-465f-b0e8-f9cbea0807c7';
            $("#question").focusin(function(){
                ya.speechkit.recognize({
                doneCallback: function (text) {
                    $('#question').val(text);
                }
            });
            });
            var textline = new ya.speechkit.Textline('my_id', {
            onInputFinished: function(text) {
                // Финальный текст.
                alert(text);
            }
        });
        }