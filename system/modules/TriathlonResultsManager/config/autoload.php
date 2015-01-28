<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package TriathlonResultsManager
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'TriathlonResultsManager',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'TriathlonResultsManager\TriathlonResultsManagerHelper'          => 'system/modules/TriathlonResultsManager/classes/TriathlonResultsManagerHelper.php',

	// Models
	'TriathlonResultsManager\TriathlonResultsCompetitionsModel'      => 'system/modules/TriathlonResultsManager/models/TriathlonResultsCompetitionsModel.php',
	'TriathlonResultsManager\TriathlonResultsModel'                  => 'system/modules/TriathlonResultsManager/models/TriathlonResultsModel.php',
	'TriathlonResultsManager\TriathlonResultsReportsModel'           => 'system/modules/TriathlonResultsManager/models/TriathlonResultsReportsModel.php',

	// Modules
	'TriathlonResultsManager\ModuleTriathlonResultsManagerMyReports' => 'system/modules/TriathlonResultsManager/modules/ModuleTriathlonResultsManagerMyReports.php',
	'TriathlonResultsManager\ModuleTriathlonResultsManagerMyResults' => 'system/modules/TriathlonResultsManager/modules/ModuleTriathlonResultsManagerMyResults.php',
	'TriathlonResultsManager\ModuleTriathlonResultsManagerReport'    => 'system/modules/TriathlonResultsManager/modules/ModuleTriathlonResultsManagerReport.php',
	'TriathlonResultsManager\ModuleTriathlonResultsManagerResults'   => 'system/modules/TriathlonResultsManager/modules/ModuleTriathlonResultsManagerResults.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_triathlonResultsManagerMyReports' => 'system/modules/TriathlonResultsManager/templates/modules',
	'mod_triathlonResultsManagerMyResults' => 'system/modules/TriathlonResultsManager/templates/modules',
	'mod_triathlonResultsManagerReport'    => 'system/modules/TriathlonResultsManager/templates/modules',
	'mod_triathlonResultsManagerResults'   => 'system/modules/TriathlonResultsManager/templates/modules',
));
