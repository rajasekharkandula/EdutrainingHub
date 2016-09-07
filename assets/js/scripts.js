// Drop Down Menus
$(document).ready(function(){
    $('ul.nav li.dropdown').hover(function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
    }, function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
    });
    $('ul.nav li.dropdown .dropdown-catery  ul  li').hover(function() {
    	$(this).parent('ul').find('li').removeClass('selected'); 
    	$(this).addClass('selected');
    	var li_index = $(this).index();    
		$(this).parent().parent().parent().parent('.dropdown-menu').find('.dropdown-courses-list').addClass('hide');
		$(this).parent().parent().parent().parent('.dropdown-menu').find('.dropdown-courses-list').removeClass('show');
		
		$(this).parent().parent().parent().parent('.dropdown-menu').find('.dropdown-courses-list').eq(li_index).removeClass('hide');
		$(this).parent().parent().parent().parent('.dropdown-menu').find('.dropdown-courses-list').eq(li_index).addClass('show');
    });  
    $('ul.nav li.dropdown .dropdown-main-menu ul li').hover(function() {    
    	$(this).find('.dropdown-menu ul > li').removeClass('selected');   
		$(this).find('.dropdown-menu ul > li:first-child').addClass('selected');
		
		$(this).find('.dropdown-menu .dropdown-courses-list').removeClass('show');
		$(this).find('.dropdown-menu .dropdown-courses-list').addClass('hide'); 
		$(this).find('.dropdown-menu .dropdown-courses-list').eq(0).addClass('show');
    });

    // Move down
    $(".jumper").on("click", function( e ) {

        e.preventDefault();

        $("body, html").animate({ 
            scrollTop: $( $(this).attr('href') ).offset().top 
        }, 600);

    });

    // Testimonials
    $(function() {
    "use strict";  

    if ($(".testimonial-slider-block").length) {
        var sync1 = $(".testimonial-slider-info");
        var sync2 = $(".testimonial-thumbs");
        sync2.owlCarousel({
            autoPlay : true,
            singleItem : true,
            slideSpeed : 1000,
            navigation : false,
            pagination : true,
            responsiveRefreshRate : 200
        });

        sync1.owlCarousel({
            autoPlay : true,
            items : 3,
            slideSpeed : 1000,
            itemsDesktop : [1199, 3],
            itemsDesktopSmall : [979, 3],
            itemsTablet : [768, 3],
            itemsMobile : [479, 3],
            pagination : false,
            responsiveRefreshRate : 100,
            afterInit : function(el) {
                $(".owl-item").eq(0).addClass("synced");
            }
        });

        $(".testimonial-slider-info").on("click", ".owl-item", function(e) {
            e.preventDefault();
            var number = $(this).data("owlItem");
            sync2.trigger("owl.goTo", number);
        });

        setInterval(function() {
            var index_val = sync2.find('.owl-pagination .owl-page.active').index();
            console.log(index_val)
            sync1.find(".owl-item").removeClass('active');
            sync1.find(".owl-item").eq(index_val).addClass('active');
        }, 10);

    };

    

});
    
// footer fixed.
$(window).scroll(function(){
      if ($(this).scrollTop() > 135) {
          $('.subfooter').addClass('fixed');
      } else {
          $('.subfooter').removeClass('fixed');
      }
  });


$( ".course-img-det,.download-brow" )
  .on( "mouseenter", function() {
    $(this).parent().children(".download-brow").css("display","block"); 
  })
  .on( "mouseleave", function() {
    $(".download-brow").css("display","none"); 
  });

// Login form
$('.forgotpass').click(function(){ 
  $('.logins-form,.newuser-wr,.forgotpass').hide();
  $('.forgot-pass-wr,.sign-in').show();  
}); 
$('.newuser').click(function(){
  $('.logins-form,.forgot-pass-wr,.newuser').hide();
  $('.newuser-wr,.sign-in,.forgotpass').show();  
});
$('.sign-in').click(function(){
  $('.newuser-wr,.forgot-pass-wr,.sign-in').hide();
  $('.logins-form,.forgotpass,.newuser').show();  
});
}); 