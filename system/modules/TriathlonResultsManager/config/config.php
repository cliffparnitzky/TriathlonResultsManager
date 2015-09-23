<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2015 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    TriathlonResultsManager
 * @license    LGPL
 */

/**
 * Backend modules
 */
array_insert($GLOBALS['BE_MOD']['content'], -1, array
(
	'triathlonResultsManager' => array
	(
		'tables'     => array('tl_triathlon_results_reports', 'tl_triathlon_results_competitions', 'tl_triathlon_results'),
		'icon'       => 'system/modules/TriathlonResultsManager/assets/icon_reports.png',
		'stylesheet' => 'system/modules/TriathlonResultsManager/assets/css/triathlon_results_manager_be.css',
	)
));

/**
 * Front end module
 */
$GLOBALS['FE_MOD']['triathlonResultsManager']['triathlonResultsManagerReport']    = 'ModuleTriathlonResultsManagerReport';    // ... Ergebnismeldung, Multiform uses DISTINCT(tl_triathlon_results_reports.event_name) and DISTINCT(tl_triathlon_results_competitions.name) für Vorlagen
$GLOBALS['FE_MOD']['triathlonResultsManager']['triathlonResultsManagerResults']   = 'ModuleTriathlonResultsManagerResults';
$GLOBALS['FE_MOD']['triathlonResultsManager']['triathlonResultsManagerMyReports'] = 'ModuleTriathlonResultsManagerMyReports'; // ... Meine Ergebnismeldungen (filter by tl_triathlon_results_reports.report_member)
$GLOBALS['FE_MOD']['triathlonResultsManager']['triathlonResultsManagerMyResults'] = 'ModuleTriathlonResultsManagerMyResults'; // ... Meine Ergebnisse (filter by tl_triathlon_results.athlete)

/**
 * Add content element
 */
$GLOBALS['TL_CTE']['triathlonResultsManager']['triathlonResultsManagerResults'] = 'ContentTriathlonResultsManagerResults';

/**
 * Adding custom JavaScript
 */
if (TL_MODE == 'BE')
{
    $GLOBALS['TL_JAVASCRIPT']['triathlon_results_manager'] = 'system/modules/TriathlonResultsManager/assets/js/triathlon_results_manager_be.js';
}

/**
 * Default competition disciplines configuration
 */
$GLOBALS['TL_TRIATHLON_RESULTS_MANAGER']['disciplines'] = array
(
	'swim' => array
	(
		array('discipline'=>'swim', 'distance'=>array('value'=>'', 'unit'=>''))
	),
	'bike' => array
	(
		array('discipline'=>'bike', 'distance'=>array('value'=>'', 'unit'=>''))
	),
	'run' => array
	(
		array('discipline'=>'run', 'distance'=>array('value'=>'', 'unit'=>''))
	),
	'duathlon' => array
	(
		array('discipline'=>'run', 'distance'=>array('value'=>'', 'unit'=>'')),
		array('discipline'=>'bike', 'distance'=>array('value'=>'', 'unit'=>'')),
		array('discipline'=>'run', 'distance'=>array('value'=>'', 'unit'=>''))
	),
	'triathlon' => array
	(
		array('discipline'=>'swim', 'distance'=>array('value'=>'500', 'unit'=>'m')),
		array('discipline'=>'bike', 'distance'=>array('value'=>'20', 'unit'=>'km')),
		array('discipline'=>'run', 'distance'=>array('value'=>'5', 'unit'=>'km'))
	),
	'others' => array
	(
		array('discipline'=>'others', 'distance'=>array('value'=>'', 'unit'=>''))
	)
);

?>