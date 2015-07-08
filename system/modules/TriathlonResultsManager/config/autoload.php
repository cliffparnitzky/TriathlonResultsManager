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
	'CliffParnitzky\Contao\TriathlonResultsManager',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'CliffParnitzky\Contao\TriathlonResultsManager\TriathlonResultsManagerHelper'          => 'system/modules/TriathlonResultsManager/classes/TriathlonResultsManagerHelper.php',

	// Elements
	'CliffParnitzky\Contao\TriathlonResultsManager\ContentTriathlonResultsManagerResults'  => 'system/modules/TriathlonResultsManager/elements/ContentTriathlonResultsManagerResults.php',

	// Models
	'CliffParnitzky\Contao\TriathlonResultsManager\TriathlonResultsCompetitionsModel'      => 'system/modules/TriathlonResultsManager/models/TriathlonResultsCompetitionsModel.php',
	'CliffParnitzky\Contao\TriathlonResultsManager\TriathlonResultsModel'                  => 'system/modules/TriathlonResultsManager/models/TriathlonResultsModel.php',
	'CliffParnitzky\Contao\TriathlonResultsManager\TriathlonResultsReportsModel'           => 'system/modules/TriathlonResultsManager/models/TriathlonResultsReportsModel.php',

	// Modules
	'CliffParnitzky\Contao\TriathlonResultsManager\ModuleTriathlonResultsManagerMyReports' => 'system/modules/TriathlonResultsManager/modules/ModuleTriathlonResultsManagerMyReports.php',
	'CliffParnitzky\Contao\TriathlonResultsManager\ModuleTriathlonResultsManagerMyResults' => 'system/modules/TriathlonResultsManager/modules/ModuleTriathlonResultsManagerMyResults.php',
	'CliffParnitzky\Contao\TriathlonResultsManager\ModuleTriathlonResultsManagerReport'    => 'system/modules/TriathlonResultsManager/modules/ModuleTriathlonResultsManagerReport.php',
	'CliffParnitzky\Contao\TriathlonResultsManager\ModuleTriathlonResultsManagerResults'   => 'system/modules/TriathlonResultsManager/modules/ModuleTriathlonResultsManagerResults.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'block_triathlonResultsManagerGeneral' => 'system/modules/TriathlonResultsManager/templates/block',
	'block_triathlonResultsManagerResults' => 'system/modules/TriathlonResultsManager/templates/block',
	'ce_triathlonResultsManagerResults'    => 'system/modules/TriathlonResultsManager/templates/elements',
	'mod_triathlonResultsManagerMyReports' => 'system/modules/TriathlonResultsManager/templates/modules',
	'mod_triathlonResultsManagerMyResults' => 'system/modules/TriathlonResultsManager/templates/modules',
	'mod_triathlonResultsManagerReport'    => 'system/modules/TriathlonResultsManager/templates/modules',
	'mod_triathlonResultsManagerResults'   => 'system/modules/TriathlonResultsManager/templates/modules',
));
