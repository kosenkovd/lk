function getRemainingTime() {
	var e = Date.now(),
		n = one - e;
	dremaining = n, dremaining = dremaining / 1e3 - dremaining % 1e3 / 1e3, dremaining = dremaining / 60 - dremaining % 60 / 60, dremaining = dremaining / 60 - dremaining % 60 / 60, dremaining = dremaining / 24 - dremaining % 24 / 24;
	var i, a;
	switch (dremaining % 10) {
		case 0:
			i = dremaining + " дней", a = "календарей";
			break;
		case 1:
			i = dremaining + " день", a = "календарей";
			break;
		case 2:
		case 3:
		case 4:
			i = dremaining + " дня", a = "календаря";
			break;
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
			i = dremaining + "! дней", a = "календарей"
	}
	switch (dremaining % 100) {
		case 11:
		case 12:
		case 13:
		case 14:
			i = dremaining + " дней", a = "календарей"
	}
	hremaining = n - 24 * dremaining * 60 * 60 * 1e3, hremaining = hremaining / 1e3 - hremaining % 1e3 / 1e3, hremaining = hremaining / 60 - hremaining % 60 / 60, hremaining = hremaining / 60 - hremaining % 60 / 60;
	var m;
	switch (hremaining % 10) {
		case 0:
			m = hremaining + " часов";
			break;
		case 1:
			m = hremaining + " час";
			break;
		case 2:
		case 3:
		case 4:
			m = hremaining + " часа";
			break;
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
			m = hremaining + " часов"
	}
	switch (hremaining % 100) {
		case 11:
		case 12:
		case 13:
		case 14:
			m = hremaining + " часов"
	}
	mremaining = n - 24 * dremaining * 60 * 60 * 1e3 - 60 * hremaining * 60 * 1e3, mremaining = mremaining / 1e3 - mremaining % 1e3 / 1e3, mremaining = mremaining / 60 - mremaining % 60 / 60;
	var r;
	switch (mremaining % 10) {
		case 0:
			r = mremaining + " минут";
			break;
		case 1:
			r = mremaining + " минута";
			break;
		case 2:
		case 3:
		case 4:
			r = mremaining + " минуты";
			break;
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
			r = mremaining + " минут"
	}
	switch (mremaining % 100) {
		case 11:
		case 12:
		case 13:
		case 14:
			r = mremaining + " минут"
	}
	sremaining = n - 24 * dremaining * 60 * 60 * 1e3 - 60 * hremaining * 60 * 1e3 - 60 * mremaining * 1e3, sremaining = sremaining / 1e3 - sremaining % 1e3 / 1e3;
	var s;
	switch (sremaining % 10) {
		case 0:
			s = sremaining + " секунд";
			break;
		case 1:
			s = sremaining + " секунда";
			break;
		case 2:
		case 3:
		case 4:
			s = sremaining + " секунды";
			break;
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
			s = sremaining + " секунд"
	}
	switch (sremaining % 100) {
		case 11:
		case 12:
		case 13:
		case 14:
			s = sremaining + " секунд"
	}
	$("#day").html(i), $("#hour").html(m), $("#minute").html(r), $("#second").html(s), $("#calendar").html(a)
}

    $("#flyingbanner").on("click", function() {
    	$("#flyingbanner").css("box-shadow:0 0 15px 0 rgba(0,0,0,1)")
    });
    var one = new Date("January 1 2019 00:00:01");
	getRemainingTime();
	setInterval(getRemainingTime, 1e3);