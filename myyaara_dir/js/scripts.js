(function($) {
  "use strict";
  //Activate Tooltip
    $(function () {
        $("[data-toggle='tooltip']").tooltip();
    });
	
	$('.newsticker').newsTicker({max_rows:1});
	
    //Add Bootstrap Plus and Minus Icon to Accordion
    var $active = $('.accordion .panel-collapse.in').prev().addClass('active');
    $active.find('a').append('<i class="fa fa-minus"></i>');
    $('.accordion .panel-heading').not($active).find('a').append('<i class="fa fa-plus"></i>');
    $('.accordion').on('show.bs.collapse', function (e)
    {
        $(this).find('.panel-heading.active').removeClass('active').find('.fa').toggleClass('fa-plus fa-minus');
        $(e.target).prev().addClass('active').find('.fa').toggleClass('fa-plus fa-minus');
    });
    $('.accordion').on('hide.bs.collapse', function (e)
    {
        $(e.target).prev().removeClass('active').find('.fa').removeClass('fa-minus').addClass('fa-plus');
    });

    //Adding Panel border to Active Class for Accordion 2
    $('.accordion-style2').find('.active').parent().addClass('panel-border-active');
    $('.accordion-style2').on('show.bs.collapse', function (e)
    {
        $(e.target).prev().parent().addClass('panel-border-active');
    });
    $('.accordion-style2').on('hide.bs.collapse', function (e)
    {
        $(e.target).prev().parent().removeClass('panel-border-active');
    });

    //Adding Panel border to Active Class for Accordion 3
    $('.accordion-style3').find('.active').parent().addClass('icon-border-active');
    $('.accordion-style3').on('show.bs.collapse', function (e)
    {
        $(e.target).prev().parent().addClass('icon-border-active');
    });
    $('.accordion-style3').on('hide.bs.collapse', function (e)
    {
        $(e.target).prev().parent().removeClass('icon-border-active');
    });

    //Fixed Top

	var menu = $('.fixed-top');
	
	function scroll() {
		if ($(window).scrollTop() >= origOffsetY) {
			$('.fixed-top').addClass('sticky-top');
			$('.content').addClass('content-fixed-top');
		} else {
			$('.fixed-top').removeClass('sticky-top');
			$('.content').removeClass('content-fixed-top');
		}
	}

	if(menu.length > 0) {
		var origOffsetY = menu.offset().top;
		document.onscroll = scroll;
	};
})(jQuery);