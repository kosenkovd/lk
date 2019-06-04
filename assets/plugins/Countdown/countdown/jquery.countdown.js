/**
 * @name		jQuery Countdown Plugin
 * @author		Martin Angelov
 * @version 	1.0
 * @url			http://tutorialzine.com/2011/12/countdown-jquery/
 * @license		MIT License
 */

(function($){
	
	// Количество секунд в каждом временном отрезке
	var days	= 24*60*60,
		hours	= 60*60,
		minutes	= 60;
	
	// Создаем плагин
	$.fn.countdown = function(prop){
		
		var options = $.extend({
			callback	: function(){},
			timestamp	: 0
		},prop);
		
		var left, d, h, m, s, positions;

		// инициализируем плагин
		init(this, options);
		
		positions = this.find('.position');
		
		(function tick(){
			
			// Осталось времени
			left = Math.floor((options.timestamp - (new Date())) / 1000);
			
			if(left < 0){
				left = 0;
			}
			
			// Осталось дней
			d = Math.floor(left / days);
			updateDuoo(6, 7, 8, d);
			left -= d*days;
			
			// Осталось часов
			h = Math.floor(left / hours);
			updateDuo(4, 5, h);
			left -= h*hours;
			
			// Осталось минут
			m = Math.floor(left / minutes);
			updateDuo(2, 3, m);
			left -= m*minutes;
			
			// Осталось секунд
			s = left;
			updateDuo(0, 1, s);
			
			// Вызываем возвратную функцию пользователя
			options.callback(d, h, m, s);
			
			// Планируем следующий вызов данной функции через 1 секунду
			setTimeout(tick, 1000);
		})();
		
		// Данная функция обновляет две цифоровые позиции за один раз
		function updateDuo(minor,major,value){
			switchDigit(positions.eq(minor),Math.floor(value/10)%10);
			switchDigit(positions.eq(major),value%10);
		}
		function updateDuoo(minor,major,media,value){
			switchDigit(positions.eq(minor),Math.floor((value/10)/10)%10);
			switchDigit(positions.eq(major),Math.floor(value/10)%10);
			switchDigit(positions.eq(media),value%10);
		}
		return this;
	};


	function init(elem, options){
		elem.addClass('countdownHolder');

		// Создаем разметку внутри контейнера
		$.each(['Seconds','Minutes','Hours'],function(i){
			$('<span class="count'+this+'">').html(
				'<span class="position">\
					<span class="digit static">0</span>\
				</span>\
				<span class="position">\
					<span class="digit static">0</span>\
				</span>'
			).appendTo(elem);
			
		    
			
			if(this!="Days"){
				elem.append('<span class="countDiv countDiv'+i+'"></span>');
			}
		});
        $.each(['Days'],function(i){
			$('<span class="count'+this+'">').html(
				'<span class="position">\
					<span class="digit static">0</span>\
				</span>\
				<span class="position">\
					<span class="digit static">0</span>\
				</span>\
				<span class="position">\
					<span class="digit static">0</span>\
				</span>'
			).appendTo(elem);
			
		    
			
			if(this!="Days"){
				elem.append('<span class="countDiv countDiv'+i+'"></span>');
			}
		});
	}

	// Создаем анимированный переход между двумя цифрами
	function switchDigit(position,number){
		
		var digit = position.find('.digit')
		
		if(digit.is(':animated')){
			return false;
		}
		
		if(position.data('digit') == number){
			// Мы уже вывели данную цифру
			return false;
		}
		
		position.data('digit', number);
		
		var replacement = $('<span>',{
			'class':'digit',
			css:{
				top:'-2.1em',
				opacity:0
			},
			html:number
		});
		
		// Класс .static добавляется, когда завершается анимация.
		// Выполнение идет более плавно.
		
		digit
			.before(replacement)
			.removeClass('static')
			.animate({top:'2.5em',opacity:0},'fast',function(){
				digit.remove();
			})

		replacement
			.delay(100)
			.animate({top:0,opacity:1},'fast',function(){
				replacement.addClass('static');
			});
	}
})(jQuery);