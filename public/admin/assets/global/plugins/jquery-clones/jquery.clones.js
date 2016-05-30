/**
 * clones plugin for jQuery
 * PEYMAN KHODABANDE
 */

(function($) {

	// jQuery plugin definition
	$.fn.clones = function(params) {

		// merge default and user parameters
		params = $.extend( {minlength: 0, maxlength: 99999}, params);

		// traverse all nodes
		this.each(function() {
			var $t = $(this);

			$(document).on('click','.item .add' , function(event) {
				$(this).parents('.item').clone().appendTo(".clones");
				var lengthItem = $t.find('.item').length;

				$(".item").last().find('input').each(function(index, el) {
					var res = $(this).data('name').replace("xxx", lengthItem-1);
					$(this).attr('name', res);
				});

				$(".item").last().find('input').val("");
				$(".item .empty").last().val("");
			});			

			$(document).on('click','.item .remove' , function(event) {
				if($t.find('.item').length > 1){
					$(this).parents('.item').remove();
				}
			});

		});

		// allow jQuery chaining
		return this;
	};

})(jQuery);