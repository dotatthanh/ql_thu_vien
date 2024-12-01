$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// Slider
var Slider=function(){
	if($('.slider').length>0){
		$('.slider').slick({
			infinite: true,
			speed: 500,
			autoplay: true,
			autoplaySpeed: 2000,
			arrows: true,
			dots: false,
			prevArrow:'<a href="#" title="" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>',
			nextArrow:'<a href="#" title="" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>'
		});
	}
		
};

// Menu
var Menu=function(){
	$('.btn-menu').click(function(){
		$('.menu-mb').addClass('open');
		$('.menu-mb').removeClass('close');
	});

	$('.menu-mb').find("ul li").each(function() {
		if($(this).find("ul>li").length > 0){
			$(this).append('<i class="fa fa-angle-down btn-drop1" aria-hidden="true"></i>');
		}
	});

	$('.btn-drop1').click(function(){
		$(this).toggleClass('fa-angle-down').toggleClass('fa-angle-up');
		$('.btn-drop1').parent('li').children('ul').toggleClass('active1');
	});

	$('.btn-close').click(function(){
		$(this).parent('.menu-mb').removeClass('open');
		$(this).parent('.menu-mb').addClass('close');
	});
};

// Lọc theo giá
var Sliderfilter=function(){
	if($( "#slider-range" ).length>0)
	{
		var numMin;
      	var numMax;
		$( "#slider-range" ).slider({
			range: true,
			min: 100000,
			max: 5000000,
			step: 100000,
			values: [ 100000, 5000000 ],
			slide: function( event, ui ) {
				numMin=ui.values[ 0 ].toLocaleString();;
				numMax= ui.values[ 1 ].toLocaleString();;
				$( "#amount" ).val(numMin+ " - " + numMax );


			}
	    });
	      var numMin1= $( "#slider-range" ).slider( "values", 0 ).toLocaleString();
	      var numMax1= $( "#slider-range" ).slider( "values", 1 ).toLocaleString();
	    $( "#amount" ).val(  numMin1 + " - " + numMax1);
	}
};


var Sliderbookdetail=function(){
	$('.slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.slider-nav'
		});
	$('.slider-nav').slick({
		slidesToShow: 3,
		slidesToScroll: 3,
		asNavFor: '.slider-for',
		dots: true,
		focusOnSelect: true,
		arrows: false,
		dots: false
	});
};
// Backtotop
var Backtotop = function(){
	$(window).scroll(function(){
		if($(window).scrollTop() >$('.slider-index').height()){
			$('.back-to-top').addClass('show');
		}
		else{
			$('.back-to-top').removeClass('show');

		}
	});

	$('.back-to-top').click(function(){
		$("html, body").animate({scrollTop: 0}, 500);
	});
};

// Input number
var Inputnumber=function(){
	var number=$('.input-number').val();
	$('.plus').click(function(){
		var val = parseInt(number);
	  	val= val + 1;
	  	number= val;
	  	$('.input-number').val(val);
	});
	$('.minus').click(function(){
		var val = parseInt(number);
	  	if(number ==1){
	  		val=1;
	  	}
	  	else{
	  		val= val - 1;
	  	}
	  	$('.input-number').val(val);
	  	number = val;
	});
};


// Select2

var Select2 = function(){
	if($( ".select2" ).length>0) {
		$(".select2").select2({ 
		});
	}
}

// var UpdateCart = function(){
// 	$('.updatecart').click(function(event) {
// 		let rowid = $(this).attr('id');
// 		let qty = $(this).parent().parent().find('.qty').val();
// 		let token = $("input[name='_token']").val();
// 		$.ajax({
// 			url: 'update-product-cart/'+rowid+'/'+qty,
// 			type: 'GET',
// 			cache: false,
// 			data: {
// 				"_token": token,
// 				"id": rowid,
// 				"qty": qty
// 			},
// 			success:function (data){
// 				if (data == "oke") {
// 					window.location = "pages"
// 				}
// 			}
// 		});
// 	});
// };

// Menu
var MenuAdmin=function(){
	$('.btn-menu-admin').click(function(){
		$('.menu-admin').toggleClass('show');
	});

	$('.btn-drop-admin').click(function(){
		$(this).toggleClass('fa-angle-down').toggleClass('fa-angle-up');
		$(this).parent('li').children('ul').stop().slideToggle(500);
	});

	$('.lili').click(function(){
		$(this).parent('li').children('i').toggleClass('fa-angle-down').toggleClass('fa-angle-up');
		$(this).parent('li').children('ul').stop().slideToggle(500);
	});

	$('.btn-close-admin').click(function(){
		$(this).parent('.menu-admin').toggleClass('show');
	});
};

$(function(){
	Slider();
	Menu();
	Sliderbookdetail();
	Sliderfilter();
	Inputnumber();
	Backtotop();
	Select2();
	MenuAdmin();
	// UpdateCart();
});




// fb
$(document).ready(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


$("select.select2Role").select2({});
