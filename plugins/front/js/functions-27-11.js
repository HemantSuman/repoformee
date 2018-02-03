// ***************Top menu function************
function topMenuToggle(){
	$('.select-options .has-dropdown .dropdown-icon').on('click', function(){
		$(this).toggleClass('active').next('.dropdown').slideToggle();
	});
}


// ***************Select The Dropdown text and Image function************
function selectDropText(){
	$('.select-options li a').on('click', function(){
		var grabText = $(this).text();
		var grabImg = $(this).find('img').attr('src');

		$('.custom-selectbox .selected .selected-text').text(grabText);
		$('.custom-selectbox .selected .selected-img').attr('src', grabImg);

		$('.select-options').hide();

	});
}


// ***************Toggle Top bar menu function************
function toggleTopBarSelectBox(){
	$('.selected').on('click', function(){
		$('.select-options').slideDown();
	});
}

// ***************Hide the top bar select on click of document function************
$(document).mouseup(function(e)
{
    var container = $(".select-options");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
        container.hide(); 
    }
});


 $(document).ready(function(){
        $(".custom-selectbox").click(function(){            
            $(".main-cat-dropdown").toggleClass("main-cat-show" , 100);
        });

        $(".custom-selectbox").click(function(){            
            $(".custom-selectbox").toggleClass("after-menu" , 100);
        });

        $(".p_cat_li").click(function(){

        	var thisObj = $(this);
        	var p_cat_id =  $(thisObj).attr('cat_id')
        	console.log(p_cat_id);
        	$('.sub-category-slider-sec').hide();
        	$('.child_cat_div_'+p_cat_id).show();

        });

        $('.cat-menu-link').click(function() {
		    $('.cat-menu-link.current').removeClass('current');
		    $(this).closest('.cat-menu-link').addClass('current');
		});

		$('.sm-refine-search').click(function() {
		    $('.pws-sidebar').toggle('slow');		    
		});

		
 });






//mcustome scroll bar
function mcustome() {
	$(".mcustom").mCustomScrollbar({theme:"dark-3",
			//setHeight:675,
			axis:"y",
			contentTouchScroll: true,});
	$(".chatbox").mCustomScrollbar({
		theme:"dark-3",
		setHeight:300,
		axis:"y",
		contentTouchScroll: true,
		 setTop:"-999999px"

	});

}

/* Equal Height of Element
==================================*/
function heightAdjust() {
	if($(window).width() < 480) {
		$('#signupGroup .gray-box').unSyncHeight();
		$('.same-ht').unSyncHeight();
		$('.product-box').unSyncHeight();
		$('.grid-view .list-row').unSyncHeight();
		$('.useraddrow .listing-inner').unSyncHeight();
		$('.p-listing grid .grid-item').unSyncHeight();


	} else {
		$('#signupGroup .gray-box').syncHeight({updateOnResize: true});
		$('.same-ht').syncHeight({updateOnResize: true});
		$('.product-box').syncHeight({updateOnResize: true});
		$('.grid-view .list-row').syncHeight({updateOnResize: true});
		$('.useraddrow .listing-inner').syncHeight({updateOnResize: true});
		$('.p-listing grid .grid-item').syncHeight({updateOnResize: true});
	}
}

/* Responsive Menu + Dropdown
==================================*/
$('.menuWrap nav').flexMenu({ responsivePattern: 'none'});
$('.menu-icon').click(function(){
	$(this).toggleClass('menuActive');
	$('.menuWrap nav').toggleClass('active');
});

function socialShareToggle(){
	$(".social-share").click(function(){ $(".pt-share-icons").toggle(100); });
}

/*fix header on scroll*/
function stickyHeader(){
	//Check to see if the window is top if not then display button
	if($(window).width()>767){
  		$(window).scroll(function(){
		    if ($(this).scrollTop() > 100) {
		      $('header').addClass('sticky');
		    } else {
		      $('header').removeClass('sticky');
		    }

  		});
  	}
}

/*Custom category selectbox
=====================================*/
function customSelectBox(){
	var selectWrap = $(".custom-selectbox");
	var selectVal = $(".custom-selectbox .selected");
	var selectOptions = $(".custom-selectbox .select-options");
	var selectOptionsli = $(".custom-selectbox .select-options li");
	var selectOptionsVal = $(".custom-selectbox .select-options li ul a");
	selectVal.click(function(){
		selectOptions.show();
		selectWrap.addClass("open");

	});
	$(document).click(function(e) {
		if( e.target.id != 'selectval') {
			if( e.target.id != 'dropdown-icon') {
				selectOptions.hide();
				selectWrap.removeClass("open");

			}
		}
	});
	selectOptionsVal.click(function(e){
		selectVal.html($(this).html());
		selectOptionsli.removeClass("active");
		$(this).parent().addClass("active");
		//$('ul.dropdown').slideUp();
		selectOptions.hide();
	});

	/*if  li has nth level elements*/
	if(selectOptionsli.children('ul').length > 0){
		//selectOptionsli.children('ul').before('<span id="dropdown-icon" class="dropdown-icon"></span>');
		selectOptionsli.children('ul').addClass("dropdown");
		selectOptionsli.children('ul').parent().addClass("has-dropdown");
	}
	/*$(document).on('click', '.dropdown-icon', function(){
		$(this).next('ul').toggle(100);
	});*/
}

//multilevelDropdown


/*custom toggle filter for refine search*/
function toggleFilter(){
	var toggleFilter = $(".toggle-filter");
	var toggleElement = $(".toggle-element");
	var toggleFilterLabel = $(".toggle-filter label");
	if(toggleFilter.children('ul').length > 0){
		toggleElement.before('<span class="dropdown-arrow"></span>');
	}
	toggleFilterLabel.click(function(){
		$(this).siblings(".toggle-element").toggle(200);
		$(this).parent().toggleClass('active');
	})

}

/*Refine search mobile view
================================*/
function refineSearchMobile(){
	/*mobile-view*/
	if($(window).width() < 992){
		var searchTitle = $("aside.search-section .title");
		var searchForm = $("aside.search-section .search-form");

		searchTitle.click(function(){
			searchForm.css({"display": "block"});
		});
	}
}

/*ddslick intialization
=============================*/
function customCategorySearch(){
	$('#select-category').ddslick();
	$('#my-selectbox-1').ddslick();
	$('#my-selectbox-2').ddslick();
	$('#my-selectbox-3').ddslick();
	$('#my-selectbox-4').ddslick();
	$('#my-selectbox-5').ddslick();
	$('#my-selectbox-6').ddslick();
	$('#my-selectbox-7').ddslick();
	$('#my-selectbox-8').ddslick();
	//$('#select-options-1').ddslick();
	$('#select-options-2').ddslick();
}

/*home page tabbing carousel
===============================*/
function bannerCarousel(){
	var items = $('.banner-carousel img');
	if(items.length > 1) {
		$('.banner-carousel').owlCarousel({
			animateOut: 'fadeOut',
	    	animateIn: 'fadeIn',
	    	lazyLoad:true,
			loop: true,
			margin:0,
			items:1,
			autoplay:true,
			smartSpeed:1000,
			dots: true,
			nav:false,
			mouseDrag:false,
			responsiveClass:true,
		    responsive:{
		        0:{
		            dots:false,
		        },
		        767:{
		            dots:false,
		        }
		    }
		});
	} else {
		$('.banner-carousel').owlCarousel({
			animateOut: 'fadeOut',
	    	animateIn: 'fadeIn',
	    	lazyLoad:true,
			loop: false,
			margin:0,
			items:1,
			autoplay:true,
			smartSpeed:1000,
			dots: false,
			nav:false,
			mouseDrag:false
		});
	}
}

/*featured carousel
===============================*/
function featuredCarousel(){
	$('.featured-carousel').owlCarousel({
		animateOut: 'fadeOut',
    	animateIn: 'fadeIn',
		loop: true,
		margin:30,
		items:4,
		autoplay:true,
		smartSpeed:1000,
		autoplayTimeout:2000,
		dots: false,
		nav:false,
		navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
		responsiveClass:true,
	    responsive:{
	        0:{
	            items:2,
	            margin:10,
	            nav:false,
	        },
	        600:{
	            items:3,
	            nav:false,
	            margin:10
	        },
	        1000:{
	            items:4
	        }

	    }
	});
}




//featured carousel
//===============================
//function featuredCarousel(){
//	$('.header-search-category').owlCarousel({
//		animateOut: 'fadeOut',
//    	animateIn: 'fadeIn',
//		loop: true,
//		margin:2,
//		items:4,
//		autoplay:true,
//		smartSpeed:1000,
//		autoplayTimeout:2000,
//		dots: false,
//		nav:true,
//		navText: ["<i class='fa fa-caret-left'></i>","<i class='fa fa-caret-right'></i>"],
//		responsiveClass:true,
//	    responsive:{
//	        0:{
//	            items:2,
//	            margin:10,
//	            nav:false,
//	        },
//	        600:{
//	            items:3,
//	            nav:false,
//	            margin:10
//	        },
//	        1000:{
//	            items:10
//	        }
//
//	    }
//	});
//}



/*fashion sale banner carousel
===================================*/
function fashionSale() {
	var items = $('.fashion-sale img');
	if(items.length > 1) {
	    $('.fashion-sale').owlCarousel({
		    items:1,
		    lazyLoad:true,
		    loop:true,
		    margin:10,
		    autoplay:true
		});
	} else {
	    $('.fashion-sale').owlCarousel({
		    items:1,
		    lazyLoad:true,
		    loop:false,
		    margin:10,
		    autoplay:true
		});
	}
}


/*adevertisement banner carousel
===================================*/
function advbanner(){
	var items = $('.adv-banner img');
	if(items.length > 1) {
	    $('.adv-banner').owlCarousel({
		    items:1,
		    lazyLoad:true,
		    loop:true,
		    margin:10,
		    autoplay:true
		});
	} else {
	    $('.adv-banner').owlCarousel({
		    items:1,
		    lazyLoad:true,
		    loop:false,
		    margin:10,
		    autoplay:true
		});
	}
}

/*car-details page main slider banner
==========================================*/
$('#image-gallery').lightSlider({
    gallery:true,
    item:1,
    thumbItem:12,
    slideMargin: 0,
    speed:500,
		adaptiveHeight:true,
    auto:false,
    loop:true,
		prevHtml:'<i class="fa fa-long-arrow-left"></i>',
		nextHtml:'<i class="fa fa-long-arrow-right"></i>',
    onSliderLoad: function() {
        $('#image-gallery').removeClass('cS-hidden');
    }
});

/*accordian toggle function
==========================================*/
function accordianItem(){
	var itemDesc = jQuery("ul.accordian .item-desc");
    $(document).on('click', '.item-title', function(){

        if($(this).next().is(':visible'))
		{
            $(this).next('.item-desc').slideToggle(200);
            $(this).parent().toggleClass('active');
        }
        else
		{
            itemDesc.slideUp(200);
            itemDesc.parent().removeClass('active');
            $(this).next('.item-desc').slideDown(200);
            $(this).parent().addClass('active');
        }
    });
    $(window).on('load', function()
	{
		itemDesc.eq(0).slideDown(200);
		itemDesc.eq(0).parent().addClass('active');
	});
}

function mobileToggleFunction(){
	if($(window).width()<767){
		$(".mobile-toggle h4").click(function(){
			/*if($(this).parent().hasClass("active")){
				$(this).parent().toggleClass("active");
			}
			else{
				$("h4").parent().removeClass("active");
				$(this).parent().addClass("active");
			}*/

			if($(this).parent().find("ul").is(":visible")){
				$(this).parent().find("ul").slideUp(100);
			}
			else{
				$(".mobile-toggle").find("ul").slideUp(100);
				$(this).parent().find("ul").slideDown(100);
			}

		});
	}
}

/*grid-view listing function
================================*/
function viewListing(){
	$(document).on("click", ".view-type li", function(){
		$(this).parent().children("li").removeClass("active");
		$(this).addClass("active");
		$('.search-listing.grid-view>ul>li').unSyncHeight();
		if($(this).hasClass("list_view")){
			//alert("list_view");
			$(".search-listing").addClass("list-view").removeClass("grid-view");
			$('.search-listing.grid-view .list-row').unSyncHeight();
		}
		else{
			//alert("grid_view");
			$(".search-listing").addClass("grid-view").removeClass("list-view");
			$('.search-listing.grid-view .list-row').syncHeight({updateOnResize: true});
		}

	})
}

function datepickerFunction(){
	try {
		$(".datepicker").datepicker();
	}
	catch (e) {
	   console.log(e + " found on current page");
	}
}

function timepickerFunction(){
	try {
		$(".timepicker1").timepicker();

	}
	catch (e) {
	   console.log(e + " found on current page");
	}
}
function colorpickerFunction(){
	try {
		$("#cp2").colorpicker();
	}
	catch (e) {
	   console.log(e + " found on current page");
	}
}

/*function mixitUp(){
	 try {
	  var $container = $('.grid');
	        // init Masonry
	        var $grid = $('.grid').masonry({
	            // options...
	        });

	        $container.imagesLoaded(function () {
	            $container.masonry('reloadItems');
	            $container.masonry({
	                isInitLayout: true,
	                //itemSelector: '.mason_jar_item'
	            });
	        });
	 }
	 catch (e) {
	    console.log(e + " found on current page");
	 }
}*/

function bxsliderPager(){
	try {
		$('.bxslider').bxSlider({
		  pagerCustom: '#bx-pager',
		  controls: false
		});
	}
	catch (e) {
	   //console.log(e + " found on current page");
	}
}

function multilevelDropdown(){
	$('ul.dropdown-list').dropdown({
		toggleText: 'All Categories',
		maxHeight: 100,
		// Classes
		classes: {
		  // Icons
		  backIcon: 'fa fa-angle-left',
		  iconNext: 'fa fa-angle-right'
		},
	});

	$('ul.km-list').dropdown({
		toggleText: '0Km',
		maxHeight: 100,
		// Classes
		classes: {
		  // Icons
		  backIcon: 'fa fa-angle-left',
		  iconNext: 'fa fa-angle-right'
		},
	});

}


function customSelect(){
//	$( ".custom-select" ).selectmenu();
}

function searchfieldOffeset(){
	$(".saved-search").click(function(){
		var searchOffeset= $(".searchfield").offset();
		var searchfieldWidth = $(".searchfield").outerWidth();
		if($(".dropdown-menu.saved-search-popup").is(':visible')){
            $(".dropdown-menu.saved-search-popup").css({
				display: "none"
			});
        }
        else{
        	//console.log(searchOffeset);
			$(".dropdown-menu.saved-search-popup").css({
				top: searchOffeset.top + 57,
				left: searchOffeset.left,
				width: searchfieldWidth,
				position: "absolute",
				display: "block"
			});
        }
	});
	$(window).click(function() {
		$(".dropdown-menu.saved-search-popup").css({
			display: "none"
		});
	});
	$(".dropdown-menu.saved-search-popup").click(function(event){
	    event.stopPropagation();
	});
}


$(document).ready(function () {
	mcustome();
	bannerCarousel();
	heightAdjust();
	featuredCarousel();
	fashionSale();
	advbanner();
	stickyHeader();
	customCategorySearch();
	viewListing();
	datepickerFunction();
	bxsliderPager();
	multilevelDropdown();
	customSelect();
	customSelectBox();
	socialShareToggle();
	toggleFilter();
	accordianItem();
	searchfieldOffeset();
	timepickerFunction();
	colorpickerFunction();

	// ********************
	topMenuToggle();
	selectDropText();
	toggleTopBarSelectBox();

});


$(window).on('resize', function() {
  	bannerCarousel();
	heightAdjust();
	featuredCarousel();
	fashionSale();
	advbanner();
	stickyHeader();
	stickyHeader();
	customCategorySearch();
	viewListing();
	datepickerFunction();
	refineSearchMobile();
	mobileToggleFunction();
	searchfieldOffeset();
	timepickerFunction();
	colorpickerFunction();
});

$(window).on('load resize', function() {
	//mixitUp();
	refineSearchMobile();
	mobileToggleFunction();
	mcustome();

});

/*call a function on click my tablist
=========================================*/
$(document).on("click", "#myTabs a", function(){
	//mixitUp();
});

$( "#accordion" ).accordion();

/*Slick Slider for Automotive Detail page*/
$(document).on('ready', function() {      
   $('.slider-for').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: false,		  
	  asNavFor: '.slider-nav'
	});
	$('.slider-nav').slick({
	  slidesToShow: 5,
	  vertical: true,
	  slidesToScroll: 1,
	  asNavFor: '.slider-for',
	  dots: false,	
	  focusOnSelect: true,

	  responsive: [    
	    {
	      breakpoint: 768,
	      settings: {  
	        vertical: false,
	        arrows: false,	        
	        slidesToShow: 3
	      }
	    }
	  ]
	});   
});
/*Slick Slider close*/

/*Slick Slider for Real Estate Detail page*/
$(document).on('ready', function() {      
   $('.real-slider-for').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: false,		  
	  asNavFor: '.real-slider-nav'
	});
	$('.real-slider-nav').slick({
	  slidesToShow: 8,
	  vertical: true,
	  slidesToScroll: 1,	  
	  dots: false,	
	  focusOnSelect: true,

	  responsive: [    
	    {
	      breakpoint: 768,
	      settings: {  
	        vertical: false,
	        arrows: false,	        
	        slidesToShow: 3
	      }
	    }
	  ]
	});   
});
/*Slick Slider close*/

/*Slick Slider for Home Garden Detail page*/
$(document).on('ready', function() {      
   $('.home-slider-for').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  infinite: false,
	  arrows: false,		  
	  asNavFor: '.home-slider-nav'
	});
	$('.home-slider-nav').slick({
	  slidesToShow: 5,
	  infinite: false,	      
	  slidesToScroll: 1,
	  asNavFor: '.home-slider-for',
	  dots: false,	
	  arrows : false,	
	  focusOnSelect: true,
	  responsive: [    
	    {
	      breakpoint: 768,
	      settings: {  	        
	        arrows: false,	        
	        slidesToShow: 3
	      }
	    }
	  ]
	});  
    
    /*Real Estate listing Slider*/
	$('.real-list').slick({
	  dots: false,
	  infinite: false,	
	}); 

	/*Category Slider*/
	$('.category-slider').slick({
	  slidesToShow: 10,
	  slidesToScroll: 1,
	  infinite: false,
	  arrows: true , 
	  responsive: [    
	    {
	      breakpoint: 1200,
	      settings: {  	        	                
	        slidesToShow: 6
	      }
	     },
	     {
	      breakpoint: 992,
	      settings: {  	        	                
	        slidesToShow: 5
	      }
	     },
	     {
	      breakpoint: 767,
	      settings: {  	        	                
	        slidesToShow: 3
	      }
	     },
	     {
	      breakpoint: 501,
	      settings: {  	        	                
	        slidesToShow: 2
	      }
	     },
	  ]
	});
	/*Category Slider*/
	$('.sub-category-slider').slick({
	  slidesToShow: 6,
	  slidesToScroll: 1,
	  variableWidth: true,
	  infinite: false,
	  arrows: true
	});


	
});
/*Slick Slider close*/


/*Read More - Read Less*/
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 500;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Read more";
    var lesstext = "Read less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
/*Read More - Read Less Close*/

