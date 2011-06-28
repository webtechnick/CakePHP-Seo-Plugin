(function($){
	$.fn.clearDefault = function(){
		return this.each(function(){
			
			var default_value = $(this).val();
			$(this).focus(function(){
				if ($(this).val() == default_value) $(this).val("");
			});
			$(this).blur(function(){
				if ($(this).val() == "") $(this).val(default_value);
			});
		});
	};
})(jQuery);

$(document).ready(function() {
	$('input:text.clear_default').clearDefault();
});