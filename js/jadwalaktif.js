    $(document).ready(function(){   
      setInterval(function(){  
      var d = new Date();
      var jam = d.getHours(); 
      var menit = d.getMinutes();
      var jamx = d.getTime();
      var jamx = filterTimeFormat("17:30:00");
      var jam = filterTimeFormat(jam+":"+menit);
      
      $('#jamct').html(jam);
      
      if(jam >=22.00 ) {
        $('.jam19').css("background","");
      }else if(jam >= 21.25) {
        $('.jam19').css("background","#00D96C");
        $('.jam18').css("background","");
      }else if(jam >=20.50) {
        $('.jam18').css("background","#00D96C");
        $('.jam17').css("background","");
      }else if(jam >=19.75) {
        $('.jam17').css("background","#00D96C");
        $('.jam16').css("background","");
      }else if(jam >=19.00) {
        $('.jam16').css("background","#00D96C");
        $('.jam15').css("background","");
      }else if(jam >=18.25) {
        $('.jam15').css("background","#00D96C");
        $('.jam14').css("background","");
      }else if(jam >=17.50) {
        $('.jam14').css("background","#00D96C");
        $('.jam13').css("background","");
      }else if(jam >=17.25) {
        $('.jam13').css("background","");
      }else if(jam >=16.50) {
        $('.jam13').css("background","#00D96C");
        $('.jam12').css("background","");
      }else if(jam >=15.75) {
        $('.jam12').css("background","#00D96C");
        $('.jam11').css("background","");
      }else if(jam >=15.00) {
        $('.jam11').css("background","#00D96C");
        $('.jam10').css("background","");
      }else if(jam >=14.25) {
        $('.jam10').css("background","#00D96C");
        $('.jam9').css("background","");
      }else if(jam >=13.50) {
        $('.jam9').css("background","#00D96C");
        $('.jam8').css("background","");
      }else if(jam >=12.75) {
        $('.jam8').css("background","#00D96C");
        $('.jam7').css("background","");
      }else if(jam >=12.00) {
        $('.jam7').css("background","#00D96C");
        $('.jam6').css("background","");
      }else if(jam >=11.25) {
        $('.jam6').css("background","#00D96C");
        $('.jam5').css("background","");
      }else if(jam >=10.50) {
        $('.jam5').css("background","#00D96C");
        $('.jam4').css("background","");
      }else if(jam >=9.75) {
        $('.jam4').css("background","#00D96C");
        $('.jam3').css("background","");
      }else if(jam >=9.00) {
        $('.jam3').css("background","#00D96C");
        $('.jam2').css("background","");
      }else if(jam >=8.25) {
        $('.jam2').css("background","#00D96C");
        $('.jam1').css("background","");
      }else if(jam >=7.50) {
        $('.jam1').css("background","#00D96C");
      }
      },100);
      
    function filterTimeFormat(time) {

	// Number of decimal places to round to
	var decimal_places = 2;

	// Maximum number of hours before we should assume minutes were intended. Set to 0 to remove the maximum.
	var maximum_hours = 15;

	// 3
	var int_format = time.match(/^\d+$/);

	// 1:15
	var time_format = time.match(/([\d]*):([\d]+)/);

	// 10m
	var minute_string_format = time.toLowerCase().match(/([\d]+)m/);

	// 2h
	var hour_string_format = time.toLowerCase().match(/([\d]+)h/);

	if (time_format != null) {
		hours = parseInt(time_format[1]);
		minutes = parseFloat(time_format[2]/60);
		time = hours + minutes;
	} else if (minute_string_format != null || hour_string_format != null) {
		if (hour_string_format != null) {
			hours = parseInt(hour_string_format[1]);
		} else {
			hours = 0;
		}
		if (minute_string_format != null) {
			minutes = parseFloat(minute_string_format[1]/60);
		} else {
			minutes = 0;
		}
		time = hours + minutes;
	} else if (int_format != null) {
		// Entries over 15 hours are likely intended to be minutes.
		time = parseInt(time);
		if (maximum_hours > 0 && time > maximum_hours) {
			time = (time/60).toFixed(decimal_places);
		}
	}

	// make sure what ever we return is a 2 digit float
	time = parseFloat(time).toFixed(decimal_places);

	return time;
}

   });