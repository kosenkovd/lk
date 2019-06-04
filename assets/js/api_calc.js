	    var aw = '';
	    window.onload = function() {
	    	$("#login-email").val(1);
	    	$.ajax({
	    		type: "GET",
	    		url: "https://api.mediasoft.su/GetSrochnost/276",
	    		dataType: 'json',
	    		success: function(data) {
	    			var i = 0;
	    			data.forEach(function(item) {
	    				if (i == 0) {
	    					i++;
	    					$("#urgency").append('<option value="' + item["ID"] + '" nacenka="' + item["nacenka"] + '" selected>' + item["name"] + '</option>');
	    				} else {
	    					$("#urgency").append('<option value="' + item["ID"] + '" nacenka="' + item["nacenka"] + '">' + item["name"] + '</option>');
	    				}
	    			});
	    		},
	    		error: function(e) {}
	    	});
	    	$.ajax({
	    		type: "GET",
	    		url: "https://api.mediasoft.su/GetMatTypes/264",
	    		dataType: 'json',
	    		success: function(data) {
	    			var i = 0;
	    			data["Values"].forEach(function(item) {
	    				if (i == 0) {
	    					$("#mat-type").append('<option value="' + item["Id"] + '" selected>' + item["Value"] + '</option>');
	    					i++;
	    					getMat(item["Id"]);
	    				} else {
	    					$("#mat-type").append('<option value="' + item["Id"] + '">' + item["Value"] + '</option>');
	    				}
	    			});
	    		},
	    		error: function(e) {}
	    	});
	    	$.ajax({
	    		type: "GET",
	    		url: "https://api.mediasoft.su/GetOperations/276",
	    		dataType: 'json',
	    		success: function(data) {
	    			data.forEach(function(item) {
	    				$("#operations").append('<p> <input onclick="checkPrice()" type="checkbox" value="' + item["ID"] + '"> ' + item["name"] + '</p>');
	    			});
	    		},
	    		error: function(e) {}
	    	});
	    	$.ajax({
	    		type: "GET",
	    		url: "https://api.mediasoft.su/GetPriceParam/276",
	    		dataType: 'json',
	    		success: function(data) {
	    			var i = 0;
	    			data["Values"].forEach(function(item) {
	    				if (i == 0) {
	    					i++;
	    					$("#colors").append('<option value="' + item["Id"] + '" selected>' + item["Value"] + '</option>');
	    					getSizes(item["Id"]);
	    				} else {
	    					$("#colors").append('<option value="' + item["Id"] + '">' + item["Value"] + '</option>');
	    				}
	    			});
	    		},
	    		error: function(e) {}
	    	});
	    }

	    function getSizes(a) {
	    	if (a === undefined) {
	    		a = $("#colors").val();
	    	}
	    	url = "https://api.mediasoft.su/GetPriceParam2/276/" + $("#colors").val();
	    	$.ajax({
	    		type: "GET",
	    		url: url,
	    		dataType: 'json',
	    		success: function(data) {
	    			$("#sizes").html('');
	    			var i = 0;
	    			data["Values"].forEach(function(item) {
	    				if (i == 0) {
	    					i++;
	    					$("#sizes").append('<option value="' + item["Id"] + '" selected>' + item["Value"] + '</option>');
	    				} else {
	    					$("#sizes").append('<option value="' + item["Id"] + '">' + item["Value"] + '</option>');
	    				}
	    			});
	    		},
	    		error: function(e) {}
	    	});
	    	checkPrice();
	    }

	    function getMat(a) {
	    	if (a === undefined) {
	    		a = $("#mat-type").val();
	    	}
	    	url = "https://api.mediasoft.su/GetMat/" + a;
	    	$.ajax({
	    		type: "GET",
	    		url: url,
	    		dataType: 'json',
	    		success: function(data) {
	    			$("#material").html('');
	    			var i = 0;
	    			data["Values"].forEach(function(item) {
	    				if (i == 0) {
	    					i++;
	    					$("#material").append('<option value="' + item["Id"] + '" selected>' + item["Value"] + '</option>');
	    				}
	    				else{
	    				    $("#material").append('<option value="' + item["Id"] + '">' + item["Value"] + '</option>');
	    				}
	    			});
	    		},
	    		error: function(e) {}
	    	});
	    	checkPrice();
	    }

	    function checkPrice() {
	    	console.log($("#material").val() + ' ;' + $("#mat-type").val() + ' ;' + $("#colors").val() + ' ;' + $("#urgency").val() + ' ;' + $("#login-email").val());
	    	if (($("#material").val() != 0) && ($("#mat-type").val() != 0) && ($("#colors").val() != 0) && ($("#sizes").val() != 0) && ($("#urgency").val() != 0) && ($("#login-email").val() != '')) {
	    		var oper = '';
	    		$("#operations p input").each(function() {
	    			if ($(this).is(":checked")) {
	    				oper = oper + $(this).attr("value") + ',';
	    			}
	    		});
	    		srokk = $("#urgency").val();
	    		srokkn = $("#urgency option[value='" + srokk + "']").attr("nacenka");
	    		oper = oper.slice(0, -1);
	    		if (oper != '') {
	    			var param = {
	    				matId: +$("#material").val(),
	    				priceNameId: +$("#colors").val(),
	    				param2Id: +$("#sizes").val(),
	    				quantity: +$("#login-email").val(),
	    				nacenka: oper,
	    				srok: +srokkn
	    			};
	    		} else {
	    			var param = {
	    				matId: +$("#material").val(),
	    				priceNameId: +$("#colors").val(),
	    				param2Id: +$("#sizes").val(),
	    				quantity: +$("#login-email").val(),
	    				nacenka: ' ',
	    				srok: +srokkn
	    			};
	    		}
	    		$.each(param, function(index, value) {
	    			console.log(index + ' = ' + value);
	    		});
	    		$.ajax({
	    			type: "POST",
	    			url: "https://api.mediasoft.su/Calculate",
	    			data: param,
	    			success: function(data) {
	    				console.log(data);
	    				$("#number").html(data);
	    				$("#buy").removeAttr("disabled");
	    			},
	    			error: function() {}
	    		});
	    	} else {
	    		$("#number").html('');
	    		$("#buy").attr("disabled", "disabled");
	    	}
	    }

	    function checkTimeoutPrice(a) {
	    	if (a) {
	    		var timerId = setInterval(function() {
	    			if (($("#login-email").val() != aw) && ($("#login-email").val() != '')) {
	    				aw = $("#login-email").val();
	    				checkPrice();
	    			}
	    		}, 1000);
	    	} else {
	    		clearInterval(timerId);
	    	}
	    }

	    function toggleOperations() {
	    	$("#operations").slideToggle();
	    	if ($("#operationToggler").attr("state") == 0) {
	    		$("#operationToggler i").css("transform", "rotate(90deg)");
	    		$("#operationToggler").attr("state", 1);
	    	} else {
	    		$("#operationToggler i").css("transform", "rotate(0)");
	    		$("#operationToggler").attr("state", 0);
	    	}
	    }
	    var aaa = 0;

	    function toggleSubMenu() {
	    	$("#operations").slideToggle();
	    	if (aaa) {
	    		$("#openSub").css("transform", "none");
	    		aaa = 0;
	    	} else {
	    		$("#openSub").css("transform", "rotate(180deg)");
	    		aaa = 1;
	    	}
	    }