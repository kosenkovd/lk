window.onload = function() {
    
    /* ======= Обратный отсчет ======= */   

	var note = $('#note'),
		ts = new Date(2019, 0, 1);
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			switch (days % 10) {
		case 0:
			i = "дней", a = "календарей";
			break;
		case 1:
			i = "день", a = "календарень";
			break;
		case 2:
		case 3:
		case 4:
			i = "дня", a = "календаря";
			break;
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
			i = "дней", a = "календарей"
	}
	switch (days % 100) {
		case 11:
		case 12:
		case 13:
		case 14:
			i = "дней", a = "календарей"
	}
			
				message = "<span style=' color: #ec6952;'>" + i + ".</span> <a style='color:#444444;' href='http://perfectcrm.ru/kvartal/triokalendar.php' target='_blank'>Калькулятор " + a + "</a>!";
			
			note.html(message);
			$("#dayesrem").html(i);
		}
	});
}