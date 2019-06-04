/* ===== Распознём речь ===== */
window.onload= function () {
                if(navigator.geolocation) {
navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            alert(latitude+' '+longitude);
}, function(){ alert("ASD"); });
 
} else {
    alert("Geolocation API не поддерживается в вашем браузере");
}
        }