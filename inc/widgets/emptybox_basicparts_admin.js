// =============================================================================
/**
 * Basic parts widget javascript file for admin page.
 *
 * @package emptybox
 */
// =============================================================================

var emptybox = (function ($) {
	/**
	 * Hide/Show elements according to type.
	 *
 	 * @param	{Object}		widget				Widget element.
 	 * @param	{Object}		type				Type.
	 */
	function initType(widget, type)
	{

		// Hide all
		$(widget).find('.emptybox-basicparts-par_code').hide();
		$(widget).find('.emptybox-basicparts-par_dateformat').hide();
		$(widget).find('.emptybox-basicparts-par_nexttext').hide();
		$(widget).find('.emptybox-basicparts-par_prevtext').hide();
		$(widget).find('.emptybox-basicparts-par_midsize').hide();
		$(widget).find('.emptybox-basicparts-par_screenreadertext').hide();
		$(widget).find('.emptybox-basicparts-par_arialabel').hide();
		$(widget).find('.emptybox-basicparts-par_class').hide();
		$(widget).find('.emptybox-basicparts-par_insameterm').hide();
		$(widget).find('.emptybox-basicparts-par_excludedterms').hide();
		$(widget).find('.emptybox-basicparts-par_taxonomy').hide();

		// Show
		switch (type) {
			case "entry_createdate":
			case "entry_updatedate":
				$(widget).find('.emptybox-basicparts-par_dateformat').show();
				break;
			case "post_navigation":
				$(widget).find('.emptybox-basicparts-par_nexttext').show();
				$(widget).find('.emptybox-basicparts-par_prevtext').show();
				$(widget).find('.emptybox-basicparts-par_screenreadertext').show();
				$(widget).find('.emptybox-basicparts-par_arialabel').show();
				$(widget).find('.emptybox-basicparts-par_class').show();
				$(widget).find('.emptybox-basicparts-par_insameterm').show();
				$(widget).find('.emptybox-basicparts-par_excludedterms').show();
				$(widget).find('.emptybox-basicparts-par_taxonomy').show();
				break;
			case "posts_navigation":
				$(widget).find('.emptybox-basicparts-par_nexttext').show();
				$(widget).find('.emptybox-basicparts-par_prevtext').show();
				$(widget).find('.emptybox-basicparts-par_screenreadertext').show();
				$(widget).find('.emptybox-basicparts-par_arialabel').show();
				$(widget).find('.emptybox-basicparts-par_class').show();
			case "posts_pagination":
				$(widget).find('.emptybox-basicparts-par_midsize').show();
				$(widget).find('.emptybox-basicparts-par_nexttext').show();
				$(widget).find('.emptybox-basicparts-par_prevtext').show();
				$(widget).find('.emptybox-basicparts-par_screenreadertext').show();
				$(widget).find('.emptybox-basicparts-par_arialabel').show();
				$(widget).find('.emptybox-basicparts-par_class').show();
				break;
			case "html":
			case "code":
				$(widget).find('.emptybox-basicparts-par_code').show();
				break;
		}

	}

	/**
	 * Hide/Show elements according to wrapper type.
	 *
 	 * @param	{Object}		widget				Widget element.
 	 * @param	{Object}		wrapper				Wrapper type.
	 */
	function initWrapper(widget, wrapper)
	{

		// Hide all
		$(widget).find('.emptybox-basicparts-wrapper_id').hide();
		$(widget).find('.emptybox-basicparts-wrapper_class').hide();

		// Show
		switch (wrapper) {
			case 'none':
			case '':
			case undefined:
				break;
			default:
				$(widget).find('.emptybox-basicparts-wrapper_id').show();
				$(widget).find('.emptybox-basicparts-wrapper_class').show();
				break;
		}

	}

	// Init a widget when added to a widget area
	$(document).on("widget-added", function(event, widget){
		$(widget).find('.emptybox-basicparts-type select').on('change', function(){
			initType(widget, this.value);
		});

		$(widget).find('.emptybox-basicparts-wrapper select').on('change', function(){
			initWrapper(widget, this.value);
		});
	});

	return {
		"initWrapper": initWrapper,
		"initType": initType,
	};
})(jQuery);
