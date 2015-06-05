jQuery(function() {
    jQuery('ul.nav').on('click', 'a', function(e) {       
        	e.preventDefault();        	
			var target = jQuery(this).attr('href');			
    		var stop = jQuery(target).offset().top;
            var delay = 1000;                   		  		 		    		
        	jQuery('body').animate({scrollTop: stop + 'px'}, delay);
		});
	
});

jQuery(function() {
    jQuery('ul.page-nav').on('click', 'a', function(e) {       
        	e.preventDefault();        			
        	var target = jQuery(this).attr('href');	
        	jQuery(target).parent().children('.page-active').addClass('page-inactive');			
        	jQuery(target).parent().children('.page-active').removeClass('page-active');
            jQuery(target).parent().children('.page-nav-active').removeClass('page-nav-active');                       
            jQuery(this).addClass('page-nav-active');            			
        	jQuery(target).removeClass('page-inactive');			
			jQuery(target).addClass('page-active');
            var backgroundImg = jQuery(target).parent().children('.page-active').attr('data-background');
            jQuery(target).backstretch(backgroundImg);
	
    });
});



jQuery('.info-page').waypoint(function() {
    var backgroundImg = jQuery(this).attr('data-background');
    jQuery(this).backstretch(backgroundImg);
},{offset: '75%'});