$(function(){
	
	var note = $('#note'),
		ts = new Date(2014, 11, 28,0,0,0,0),
		newYear = true;
	
	
	ts = new Date(1417132800000);
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			var message = "";
			
			message += days + " day" + ( days==1 ? '':'s' ) + ", ";
			message += hours + " hour" + ( hours==1 ? '':'s' ) + ", ";
			message += minutes + " minute" + ( minutes==1 ? '':'s' ) + " and ";
			message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
			
			if(newYear){
				message += "left until black friday!";
			}
			else {
				message += "";
			}
			
			note.html(message);
		}
	});
	
});
