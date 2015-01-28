/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Core
 * @see     https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Class TriathlonResultsManager
 *
 * Provide methods to handle Ajax requests.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 */
var TriathlonResultsManager =
{
	/**
	 * Toggle the visibility of an element
	 *
	 * @param {object} el    The DOM element
	 * @param {string} id    The ID of the target element
	 * @param {string} table The table name
	 *
	 * @returns {boolean}
	 */
	toggleVisibility: function(el, id, table) {
		var returnValue = AjaxRequest.toggleVisibility(el, id, table);
		
		if (returnValue == false) {
			
			el.blur();

			var div = el.getParent('div')

			// Toggle disabled
			div.getParent('div').getElement('div.tl_content_left').toggleClass('disabled');

			return false;
		}
	}
};