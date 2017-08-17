(function($)
{

	/* Slim Scroll Widgets */
	$('.widget-scroll').each(function(){
		$(this).find('.widget-body > div').height($(this).attr('data-scroll-height')).niceScroll();
	});
	
	/* Other non-widget Slim Scroll areas */
	$('.slim-scroll').each(function(){
		$(this).slimScroll();
	});

	$('.slim-admin').each(function(){
		$(this).slimScroll({
			// width in pixels of the visible scroll area
	        width : 'auto',

	        // height in pixels of the visible scroll area
	        height : '300px',

		    // width in pixels of the scrollbar and rail
	        size : '7px',

	        // scrollbar color, accepts any hex/color value
	        color: '#000',

	        // scrollbar position - left/right
	        position : 'right',

	        // distance in pixels between the side edge and the scrollbar
	        distance : '1px',

	        // default scroll position on load - top / bottom / $('selector')
	        start : 'top',

	        // sets scrollbar opacity
	        opacity : .4,

	        // enables always-on mode for the scrollbar
	        alwaysVisible : true,

	        // check if we should hide the scrollbar when user is hovering over
	        disableFadeOut : false,

	        // sets visibility of the rail
	        railVisible : false,

	        // sets rail color
	        railColor : '#333',

	        // sets rail opacity
	        railOpacity : .2,

	        // whether  we should use jQuery UI Draggable to enable bar dragging
	        railDraggable : true,

	        // defautlt CSS class of the slimscroll rail
	        railClass : 'slimScrollRail',

	        // defautlt CSS class of the slimscroll bar
	        barClass : 'slimScrollBar',

	        // defautlt CSS class of the slimscroll wrapper
	        wrapperClass : 'slimScrollDiv',

	        // check if mousewheel should scroll the window if we reach top/bottom
	        allowPageScroll : false,

	        // scroll amount applied to each mouse wheel step
	        wheelStep : 50,

	        // scroll amount applied when user is using gestures
	        touchScrollStep : 200,

	        // sets border radius
	        borderRadius: '7px',

	        // sets border radius of the rail
	        railBorderRadius : '7px'
		});
	});

})(jQuery);