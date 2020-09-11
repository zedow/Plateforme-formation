
'use strict';


$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut(); 
	$("#preloder").delay(400).fadeOut("slow");


	/*------------------
		Gallery item
	--------------------*/
	if($('.course-items-area').length > 0 ) {
		var containerEl = document.querySelector('.course-items-area');
		var mixer = mixitup(containerEl);
	}

});

(function($) {

	/*------------------
		Navigation
	--------------------*/
	$('.nav-switch').on('click', function(event) {
		$('.main-menu').slideToggle(400);
		event.preventDefault();
	});


	/*------------------
		Background Set
	--------------------*/
	$('.set-bg').each(function() {
		var bg = $(this).data('setbg');
		$(this).css('background-image', 'url(' + bg + ')');
	});


	/*------------------
		Realated courses
	--------------------*/
    $('.rc-slider').owlCarousel({
		autoplay:true,
		loop: true,
		nav:true,
		dots: false,
		margin: 30,
		navText: ['', '<i class="fa fa-angle-right"></i>'],
		responsive:{
			0:{
				items:1
			},
			576:{
				items:2
			},
			990:{
				items:3
			},
			1200:{
				items:4
			}
		}
	});


    /*------------------
		Accordions
	--------------------*/
	$('.panel-link').on('click', function (e) {
		$('.panel-link').removeClass('active');
		var $this = $(this);
		if (!$this.hasClass('active')) {
			$this.addClass('active');
		}
		e.preventDefault();
	});



	/*------------------
		Circle progress
	--------------------*/
	$('.circle-progress').each(function() {
		var cpvalue = $(this).data("cpvalue");
		var cpcolor = $(this).data("cpcolor");
		var cptitle = $(this).data("cptitle");
		var cpid 	= $(this).data("cpid");

		$(this).append('<div class="'+ cpid +'"></div><div class="progress-info"><h2>'+ cpvalue +'%</h2><p>'+ cptitle +'</p></div>');

		if (cpvalue < 100) {

			$('.' + cpid).circleProgress({
				value: '0.' + cpvalue,
				size: 176,
				thickness: 9,
				fill: cpcolor,
				emptyFill: "rgba(0, 0, 0, 0)"
			});
		} else {
			$('.' + cpid).circleProgress({
				value: 1,
				size: 176,
				thickness: 9,
				fill: cpcolor,
				emptyFill: "rgba(0, 0, 0, 0)"
			});
		}

	});

})(jQuery);

function filter()
{
	$.ajaxSetup({ headers: {'csrftoken' : '{{ csrf_token() }}' } });

	$.ajax({
		type: 'GET',
		url: "{{ url('/session/filtrer') }}",
		dataType: "html",
		data: $("#ajax-form").serialize(),
		success: function(dataR) {
			$('#course-group').html(dataR);
		}
	});
}

$(".profile").delegate('.down','click',function() {
    
    var change = $(this).parent().parent().children('.adresseContainer');
    if(change.is(':hidden'))
    {
        change.slideDown();
        $(this).removeClass();
        $(this).toggleClass('fas fa-angle-up down');
    }
    else
    {
        change.slideUp();
        $(this).removeClass();
        $(this).toggleClass('fas fa-angle-down down');
    }
});

$(".profile").delegate('.trash','click',function() {
    $(this).parent().parent().fadeOut('1000',function() {
        $(this).remove();
        var nb = parseInt($("#addAdresse").attr('val')) -1;
        $("#addAdresse").attr('val',nb);
    });
    
});

$(".signup-form").delegate('.addAdresse','click', function() {
    var nb = $(this).attr('val');
    var content = $(this).parent().children('.adresses').children('.adresseBox').first().clone();
    content.children('h4').html('<i class="fas fa-angle-down down"></i>' + '  Adresse n° '+ nb + '<i class="fas fa-trash-alt trash"></i>');
    content.children().children(':input').removeAttr('value');
    $(this).parent().children('.adresses').append(content);
    nb = parseInt(nb) + 1;
    $(this).attr('val',nb);
});


