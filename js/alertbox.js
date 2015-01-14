/**
 * Jquery alertbox plugin
 * @version 1.0
 * @author Satyam Kumawat  <satyam2707@gmail.com>
 * @package Jquery validation helper
 * This program is free software.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY.
 */

(function($)
{
	var globals;
	var methods = {
		
	  _showError : function()
	  {
			form = $(this);
	  },	
	  showAlert : function()
	 {
		if(globals.allowBg)
		{
			this._createBgPopUp();
		}
		this._createFrontPopUp();
		//this._alignpopup();
			
	  },
	  _createFrontPopUp:function()
	   { 
	     $('#PopupWrapper').remove();
		 var popup = jQuery('<div>')
		             .attr('id','PopupWrapper')
		             .addClass(globals.popupClass);
		 this._createClose(popup);
		 this._getContent(popup);
		 
	   },
	   _getContent : function(popup)
	   {
		     // alert(typeof(globals.div));   
			  if(typeof(globals.div) != 'undefined')
			  {
				  data = $(globals.div).html();
				  jQuery(popup).append(data).appendTo('body');
				  methods._alignpopup();
				
			  }
			  else if(typeof(globals.url) != 'undefined')
			  {
					
					   $.ajax({url:globals.url,
								beforeSend:function()
								{
									loader =jQuery('<div>')
											 .addClass('loader')
											 .css({'color':'red','font-size':'18px','text-align':'center','padding':'20px'})
											 .html('<img src="images/process_spinner.gif">');
													 
									jQuery(popup)
									      .append(loader)
									      .appendTo('body');
								methods._alignpopup(100);	
								},
								success :function(data)
								{
								   
								   //alert(data)
								    jQuery(popup).append(data);
								    jQuery(popup).find('.loader').remove();
								   
								     
								}
							});
			  }
			  else
			  {
				 
				
				  data = jQuery('<div>')
				          .css({'color':'red','font-size':'18px','text-align':'center','padding':'20px'})
				          .html('Please set a content div or Ajax Url');
				  
				 jQuery(popup).append(data).appendTo('body');
				 methods._alignpopup();
				 
			  }
		 
	   },
	   
	   _createBgPopUp : function()
	   {
		   $('#alertbox').remove();
		   bg = jQuery('<div>')
		         .attr({'id':'alertbox',
					    'class' :globals.bgClass
					   })
				 .css({'position':'absolute',
					   'left':0,
					   'top':0,
					   'opacity' :0.6})
				  .prependTo('body');
		     
			
	   },
	   _alignpopup: function(defaultMargin)
	   {
		//alert(defaultMargin);
		   var container = 'PopupWrapper';
		   leftmargin = $('#'+container).outerWidth()/2;
		   topmargin =  $('#'+container).outerHeight()/2;
		   defaultMargin = defaultMargin ? defaultMargin :0
		   $('#'+container).css({'margin-left': '-' + leftmargin+'px',
					 'margin-top': '-' + (topmargin + parseInt(defaultMargin)) +'px'});
		   /*var width = $(window).width();
		   var height = $(window).height();
		   leftmargin = width/2-($('#'+container).width()/2);
		   topmargin = height/2-($('#'+container).height()/2);
		 
		   defaultMargin = defaultMargin ? defaultMargin :70
		   $('#'+container).css({'left':leftmargin,
					 'top':topmargin - parseInt(defaultMargin)});  */
	  },
	_createClose: function(container)
	{
		var closeBtn =  jQuery("<div>")
						.addClass('close')
						.html(globals.closeIcon)
						.bind('click',function()
						 {
						   $('#PopupWrapper').fadeOut(100);
						   $('#alertbox').fadeOut(100);
						});
						
		$(container).append(closeBtn);
	   
	},
	close :function()
	{
		 $('#PopupWrapper').remove();
		 $('#alertbox').remove();
	}
	   
	}
	
	$.fn.alerbox = function(options)
	{
          //alert($(ti).attr('id'));
	  var settings = $.extend({},{
							'defaultEvent': 'click', 							'bgClass' :'alertbox',
							'popupClass' :'popuparea',
							'containerClass' : 'alertContainer',
							'allowBg' : true,
							'closeIcon' : '<img src="images/close.png" title="close" alt="close icon">'
							},
					options);
	  
	  
	  eventType = settings.defaultEvent;
	  
	  if(typeof(options) == 'string')
	  {
		method = options;  
		return  methods[method].apply();
		
		 
	  }else{
		jQuery(this).bind(eventType,function()
		{
		        globals = settings;
			method = methods.showAlert();
		       
		});
	  }
	  
	  
	 
		 
	}
	
	
})(jQuery);
<!-- END OF FORM VALIDATION CLASS-->
