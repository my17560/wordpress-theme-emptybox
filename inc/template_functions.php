<?php
// =============================================================================
/**
 * Utility functions used by the theme
 *
 * @package emptybox
 */
// =============================================================================

/**
 * Get sidebar ID for the given template type.
 *
 * @param	string		$id				ID.
 * @param	string		$baseType		Base template type. See emptybox_get_template_types().
 * @param	string		$subType		Sub template type. See emptybox_get_template_types().
 * @param	boolean		$havePost		Whether current page has post or not.
 *
 * @return	Sidebar ID
 */
function emptybox_get_sidebar_id($id, $baseType, $subType = "", $havePost = true)
{

	$sidebarId = "";

	if ($baseType == "404") {
		$havePost = true;
	}

	$noResult = ( $havePost ? "" : "-noresult" );

	if ($subType && is_active_sidebar($id . "-" . $subType . $noResult)) {
		$sidebarId = $id . "-" . $subType . $noResult;
	} else if (is_active_sidebar($id . "-" . $baseType . $noResult)) {
		$sidebarId = $id . "-" . $baseType . $noResult;
	}

	return $sidebarId;

}

// -----------------------------------------------------------------------------

/**
 * Get template type for current page.
 *
 * @return	Template type
 */
function emptybox_get_template_types()
{

	$baseType = "";
	$subType = "";

	if (is_404())
	{
		$baseType = "404";
	} else if (is_home() && is_front_page()) {
		$baseType = "archive";
		$subType = "home";
	} else if (is_home()) {
		$baseType = "singular";
		$subType = "home";
	} else if (is_front_page()) {
		$baseType = "singular";
		$subType = "frontpage";
	} else if (is_page()) {
		$baseType = "singular";
		$subType = "page";
	} else if (is_single()) {
		$baseType = "singular";
		$subType = "single";
	} else if (is_search()) {
		$baseType = "archive";
		$subType = "search";
	} else if (is_category()) {
		$baseType = "archive";
		$subType = "category";
	} else if (is_tag()) {
		$baseType = "archive";
		$subType = "tag";
	} else if (is_date()) {
		$baseType = "archive";
		$subType = "date";
	} else if (is_year()) {
		$baseType = "archive";
		$subType = "year";
	} else if (is_month()) {
		$baseType = "archive";
		$subType = "month";
	} else if (is_day()) {
		$baseType = "archive";
		$subType = "day";
	} else if (is_author()) {
		$baseType = "archive";
		$subType = "author";
	}

	return array($baseType, $subType);

}

// -----------------------------------------------------------------------------

/**
 * Get a value from an array.
 *
 * @return	Template type
 */
function emptybox_safeget($arr, $key, $default = null)
{

	if (array_key_exists($key, $arr)) {
		return $arr[$key];
	} else {
		return $default;
	}

}
