// =============================================================================
/**
 * Basic parts widget javascript file for admin page.
 *
 * @package emptybox
 */
// =============================================================================

var emptybox = (function ($) {
	// Init type names
	var typeNames = {
		"none": "(None)",
		"site_title": "Site Title",
		"site_logo": "Site Logo",
		"entry_title": "Entry Title",
		"entry_content": "Entry Content",
		"entry_excerpt": "Entry Excerpt",
		"entry_thumbnail": "Entry Thumbnail",
		"entry_tags": "Entry Tags",
		"entry_createdate": "Entry Create Date",
		"entry_updatedate": "Entry Modified Date",
		"archive_title": "Archive Title",
		"post_navigation": "Post Navigation",
		"posts_navigation": "Posts Navigation",
		"posts_pagination": "Posts Pagination",
		"tag_start": "Start Tag",
		"tag_end": "End Tag",
		"html": "Custom HTML",
		"code": "Code",
	};

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
		$(widget).find('.emptybox-basicparts-par_thumbnailsize').hide();
		$(widget).find('.emptybox-basicparts-par_archive_search').hide();
		$(widget).find('.emptybox-basicparts-par_archive_tag').hide();
		$(widget).find('.emptybox-basicparts-par_archive_date').hide();
		$(widget).find('.emptybox-basicparts-par_archive_dateformat').hide();
		$(widget).find('.emptybox-basicparts-par_archive_category').hide();

		// Show
		switch (type) {
			case "entry_thumbnail":
				$(widget).find('.emptybox-basicparts-par_thumbnailsize').show();
				break;
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
				break;
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
			case "archive_title":
				$(widget).find('.emptybox-basicparts-par_archive_search').show();
				$(widget).find('.emptybox-basicparts-par_archive_tag').show();
				$(widget).find('.emptybox-basicparts-par_archive_date').show();
				$(widget).find('.emptybox-basicparts-par_archive_dateformat').show();
				$(widget).find('.emptybox-basicparts-par_archive_category').show();
				break;
		}

		// Set default title if the widget is not saved yet
		if ($(widget).attr('__emptybox_basicparts_new')) {
			$(widget).find('.emptybox-basicparts-title input').val(typeNames[type]);
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
		if ($(widget).find('.id_base').val() === 'emptybox_parts') {
			// Mark this is new
			$(widget).attr('__emptybox_basicparts_new', true);

			$(widget).find('.emptybox-basicparts-type select').on('change', function(){
				initType(widget, this.value);
			});

			$(widget).find('.emptybox-basicparts-wrapper select').on('change', function(){
				initWrapper(widget, this.value);
			});
		}
	});

	// Init a widget when saved
	$(document).on("widget-updated", function(event, widget){
		console.log("@@@updated", widget);
		if ($(widget).find('.id_base').val() === 'emptybox_parts') {
			// Remove new flag
			$(widget).removeAttr('__emptybox_basicparts_new');
		}
	});

	return {
		"initWrapper": initWrapper,
		"initType": initType,
	};

})(jQuery);
