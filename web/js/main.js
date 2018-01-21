(function($) {
	$(document).on('scroll', function (e) {
		var num = $(document).scrollTop() / 100;
		var alpha = Math.pow(num,num)/120 + 0.1;
	    $(".navbar").css('background-color', 'rgba(8,58,129,'+ alpha +')');
	});
})(jQuery); 