(function($){$.clock={version:"2.0.1",locale:{}};t=[];$.fn.clock=function(d){var c={it:{
weekdays:["Domenica","Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato"],
months:["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"]},en:{
weekdays:["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"],
months:["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]},es:{
weekdays:["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"],
months:["Enero","Febrero","Marzo","Abril","May","junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]},de:{
weekdays:["Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag"],
months:["Januar","Februar","März","April","könnte","Juni","Juli","August","September","Oktober","November","Dezember"]},
fr:{weekdays:["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"],
months:["Janvier","Février","Mars","Avril","May","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"]},
ru:{weekdays:["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"],
months:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"]}};
return this.each(function(){$.extend(c,$.clock.locale);d=d||{};d.timestamp=d.timestamp||"z";
y=new Date().getTime();d.sysdiff=0;if(d.timestamp!="z"){d.sysdiff=d.timestamp-y}d.langSet=d.langSet||"en";
d.format=d.format||((d.langSet!="en")?"24":"12");
d.calendar=d.calendar||"true";if(!$(this).hasClass("jqclock")){$(this).addClass("jqclock")}var e=function(g){if(g<10){g="0"+g}return g},
f=function(j,n){var r=$(j).attr("id");if(n=="destroy"){clearTimeout(t[r])}else{m=new Date(new Date().getTime()+n.sysdiff);var p=m.getHours(),
l=m.getMinutes(),v=m.getSeconds(),u=m.getDay(),i=m.getDate(),k=m.getMonth(),q=m.getFullYear(),o="",z="",w=n.langSet;
if(n.format=="12"){o=" AM";if(p>11){o=" PM"}if(p>12){p1=p-12}if(p==0){p1=12}}p=e(p);l=e(l);v=e(v);
if(n.calendar!="false"){z=((w=="en")?"<span class='clockdate'>"+c[w].weekdays[u]+", "+i+" "+c[w].months[k]+" "+q+"</span>":"<span class='clockdate'>"+c[w].weekdays[u]+", "+i+" "+c[w].months[k]+" "+q+"</span>")}$(j).html(z+"<div class='clocktime'> Jam:  "+p+":"+l+":"+v+o+"</div>");t[r]=setTimeout(function(){f($(j),n)},1000)}};f($(this),d)})};return this})(jQuery);