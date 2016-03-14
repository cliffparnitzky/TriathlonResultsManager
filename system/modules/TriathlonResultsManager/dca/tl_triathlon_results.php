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
 * Table tl_triathlon_results
 */
$GLOBALS['TL_DCA']['tl_triathlon_results'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'           => 'Table',
		'ptable'                  => 'tl_triathlon_results_competitions',
		'enableVersioning'        => true,
		'notCopyable'             => true,
		'doNotCopyRecords'        => true,
		'onload_callback' => array
		(
			array('tl_triathlon_results', 'initPalettes'),
			//array('tl_triathlon_results', 'clearData')
		),
		'oncut_callback' => array
		(
			//array('tl_triathlon_results', 'clearData')
		),
		'onsubmit_callback' => array
		(
			//array('tl_triathlon_results', 'clearData')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array (
			'mode'                    => 4,
			'fields'                  => array('overallPlace'),
			'flag'                    => 11,
			'panelLayout'             => 'filter;sort,search,limit',
			'headerFields'            => array('pid', 'name', 'disciplines', 'type', 'ageGroupRating'),
			'header_callback'         => array('tl_triathlon_results', 'extendHeader'),
			'child_record_callback'   => array('tl_triathlon_results', 'listResult')
		),
		'label' => array (
			'group_callback'          => array('tl_triathlon_results', 'formatGroup')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return TriathlonResultsManager.toggleVisibility(this, %s);"',
				'button_callback'     => array('tl_triathlon_results', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__' => array('singleStarterType'),
		'default'      => '{singleStart_legend},singleStarterType;{time_legend},timeHours,timeMinutes,timeSeconds;{place_legend},overallPlace,overallStarters,ageGroupPlace,ageGroupStarters;{deactivation_legend},disable'
	),
	
	// Subpalettes
	'subpalettes' => array
	(
		'singleStarterType_member'   => 'singleStarter',
		'singleStarterType_freetext' => 'singleStarterFreetext_name,singleStarterFreetext_gender'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_triathlon_results_competitions.name',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'singleStarterType' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['singleStarterType'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => 'member',
			'inputType'               => 'radio',
			'options'                 => array('member', 'freetext'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_triathlon_results']['singleStarterTypeOptions'],
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr w50', 'submitOnChange'=>true, 'helpwizard'=>true),
			'sql'                     => "varchar(32) NOT NULL default 'member'"
		),
		'singleStarter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['singleStarter'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_member.CONCAT(firstname, " ", lastname)',
			'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'clr w50'),
			'sql'                     => "int(10) unsigned NULL",
			'relation'                => array('type'=>'hasOne', 'load'=>'eager')
		),
		'singleStarterFreetext_name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['singleStarterFreetext_name'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>512, 'tl_class'=>'clr w50'),
			'sql'                     => "varchar(512) NOT NULL default ''"
		),
		'singleStarterFreetext_gender' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['singleStarterFreetext_gender'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'select',
			'options'                 => array('male', 'female'),
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(32) NOT NULL default ''" 
		),
		'relayStarter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter'],
			'exclude'                 => true,
			'inputType'               => 'multiColumnWizard',
			'eval'                    => array
			(
				'tl_class'     => 'clr',
				'columnFields' => array
				(
					'discipline' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_discipline'],
						'exclude'       => true,
						'inputType'     => 'select',
						'eval'          => array('mandatory'=>true, 'includeBlankOption'=>true, 'style'=>'width: 120px;'),
						'options'       => array('swim', 'bike', 'run', 'others'),
						'reference'     => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines']
					),
					'discipline_freetext' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_discipline_freetext'],
						'exclude'       => true,
						'inputType'     => 'text',
						'eval'          => array('style'=>'width: 120px;')
					),
					'starter' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_starter'],
						'exclude'       => true,
						'inputType'     => 'select',
						'eval'          => array('chosen'=>true, 'includeBlankOption'=>true, 'style'=>'width: 120px;'),
						'foreignKey'    => 'tl_member.CONCAT(firstname, " ", lastname)',
						'reference'     => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines']
					),
					'starter_freetext' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_starter_freetext'],
						'exclude'       => true,
						'inputType'     => 'text',
						'eval'          => array('style'=>'width: 120px;')
					),
					'timeHours' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_timeHours'],
						'exclude'       => true,
						'inputType'     => 'text',
						'eval'          => array('rgxp'=>'digit', 'maxlength'=>2, 'style'=>'width: 75px;'),
						'load_callback' => array
						(
							array('tl_triathlon_results', 'loadTimeField')
						)
					),
					'timeMinutes' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_timeMinutes'],
						'exclude'       => true,
						'inputType'     => 'text',
						'eval'          => array('rgxp'=>'digit', 'maxlength'=>2, 'style'=>'width: 75px;'),
						'load_callback' => array
						(
							array('tl_triathlon_results', 'loadTimeField')
						)
					),
					'timeSeconds' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_timeSeconds'],
						'exclude'       => true,
						'inputType'     => 'text',
						'eval'          => array('rgxp'=>'digit', 'maxlength'=>2, 'style'=>'width: 75px;'),
						'load_callback' => array
						(
							array('tl_triathlon_results', 'loadTimeField')
						)
					)
				)
			),
			'sql'                     => "blob NULL"
		),
		'relayRatingType' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['relayRatingType'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'search'                  => true,
			'inputType'               => 'select',
			'options'                 => array('female', 'male', 'mixed'),
			'reference'               => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType'],
			'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'clr w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'relayName' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['relayName'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'timeHours' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['timeHours'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w30', 'rgxp'=>'digit', 'maxlength'=>2),
			'load_callback' => array
			(
				array('tl_triathlon_results', 'loadTimeField')
			),
			'save_callback' => array
			(
				function($varValue, DataContainer $dc)
				{
					return tl_triathlon_results::saveTimeField($varValue, tl_triathlon_results::TIME_MAX_HOURS);
				}
			),
			'sql'                     => "smallint(2) unsigned NULL"
		),
		'timeMinutes' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['timeMinutes'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w30', 'rgxp'=>'digit', 'maxlength'=>2),
			'load_callback' => array
			(
				array('tl_triathlon_results', 'loadTimeField')
			),
			'save_callback' => array
			(
				function($varValue, DataContainer $dc)
				{
					return tl_triathlon_results::saveTimeField($varValue, tl_triathlon_results::TIME_MAX_MINUTES);
				}
			),
			'sql'                     => "smallint(2) unsigned NULL"
		),
		'timeSeconds' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['timeSeconds'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w30', 'rgxp'=>'digit', 'maxlength'=>2),
			'load_callback' => array
			(
				array('tl_triathlon_results', 'loadTimeField')
			),
			'save_callback' => array
			(
				function($varValue, DataContainer $dc)
				{
					return tl_triathlon_results::saveTimeField($varValue, tl_triathlon_results::TIME_MAX_SECONDS);
				}
			),
			'sql'                     => "smallint(2) unsigned NULL"
		),
		'distance' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['distance'],
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'inputType'               => 'inputUnit',
			'options'                 => array('km', 'm'),
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'maxlength'=>5, 'rgxp'=>'digit'),
			'sql'                     => "varchar(255) NULL"
		),
		'laps' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['laps'],
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 12,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'maxlength'=>5, 'rgxp'=>'digit'),
			'sql'                     => "varchar(5) NULL"
		),
		'overallPlace' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['overallPlace'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'rgxp'=>'digit', 'maxlength'=>5),
			'save_callback' => array
			(
				function($varValue, DataContainer $dc)
				{
					return tl_triathlon_results::savePlaceField($varValue, 'overallPlace', 'overallStarters', $dc);
				}
			),
			'sql'                     => "smallint(5) unsigned NULL"
		),
		'overallStarters' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['overallStarters'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'rgxp'=>'digit', 'maxlength'=>5),
			'save_callback' => array
			(
				function($varValue, DataContainer $dc)
				{
					return tl_triathlon_results::savePlaceField($varValue, 'overallStarters', 'overallPlace', $dc);
				}
			),
			'sql'                     => "smallint(5) unsigned NULL"
		),
		'ageGroupPlace' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['ageGroupPlace'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'rgxp'=>'digit', 'maxlength'=>5),
			'save_callback' => array
			(
				function($varValue, DataContainer $dc)
				{
					return tl_triathlon_results::savePlaceField($varValue, 'ageGroupPlace', 'ageGroupStarters', $dc);
				}
			),
			'sql'                     => "smallint(5) unsigned NULL"
		),
		'ageGroupStarters' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['ageGroupStarters'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'rgxp'=>'digit', 'maxlength'=>5),
			'save_callback' => array
			(
				function($varValue, DataContainer $dc)
				{
					return tl_triathlon_results::savePlaceField($varValue, 'ageGroupStarters', 'ageGroupPlace', $dc);
				}
			),
			'sql'                     => "smallint(5) unsigned NULL"
		),
		'disable' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results']['disable'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default ''"
		)
	)
);

/**
 * Class tl_triathlon_results
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_triathlon_results extends Backend
{
	const TIME_MAX_HOURS = 23;
	const TIME_MAX_MINUTES = 59;
	const TIME_MAX_SECONDS = 59;

	const PLACE_OVERALL = 'overall';
	const PLACE_AGEGROUP = 'ageGroup';

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * Extend the header ...
	 * @param  $arrHeaderFields  the headerfields given from list->sorting
	 * @param  DataContainer $dc a DataContainer Object
	 * @return Array             The manipulated headerfields
	 */
	public function extendHeader($arrHeaderFields, DataContainer $dc)
	{
		$objResultsCompetition = \TriathlonResultsCompetitionsModel::findByPk($dc->id);

		$strPidFieldLabel = $GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['pid'][0];
		if (array_key_exists($strPidFieldLabel, $arrHeaderFields) )
		{
			$strText = $arrHeaderFields[$strPidFieldLabel];

			if ($objResultsCompetition != null)
			{
				$objResultsReport = \TriathlonResultsReportsModel::findByPk($objResultsCompetition->pid);

				if ($objResultsReport != null)
				{
					$strText = date(\Config::get('dateFormat'), $objResultsReport->eventDate) . ": " . $strText;
				}
			}

			$arrHeaderFields[$strPidFieldLabel] = $strText;
		}
		
		$strDisciplinesFieldLabel = $GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines'][0];
		if (array_key_exists($strDisciplinesFieldLabel, $arrHeaderFields))
		{
			$strText = "";

			if ($objResultsCompetition != null)
			{
				$arrPlainDisciplines = \TriathlonResultsManagerHelper::getPlainDisciplines(deserialize($objResultsCompetition->disciplines), $objResultsCompetition->performanceEvaluation, true);
				if (!empty($arrPlainDisciplines))
				{
					$strText = implode($GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines_delimiter'], $arrPlainDisciplines);
				}
			}

			$arrHeaderFields[$strDisciplinesFieldLabel] = $strText;
		}

		if ($objResultsCompetition != null)
		{
			if ($objResultsCompetition->type == 'league')
			{
				$arrHeaderFields[$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['league'][0]] = $GLOBALS['TL_LANG']['TriathlonResultsManager']['league'][$objResultsCompetition->league];
			}
			if ($objResultsCompetition->type != 'single')
			{
				unset($arrHeaderFields[$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['ageGroupRating'][0]]);
			}

		}

		return $arrHeaderFields;
	}

	/**
	 * List a result
	 * @param array
	 * @return string
	 */
	public function listResult($row)
	{
		$objResultsCompetition = \TriathlonResultsCompetitionsModel::findByPk($row['pid']);

		$strStarters = "";

		if ($objResultsCompetition != null && $objResultsCompetition->type == 'relay')
		{
			$strStarters = '<div class="tl_error">' . $GLOBALS['TL_LANG']['ERR']['TriathlonResultsManager']['relayStarters_not_set'] . '</div>';
			$arrPlainRelayStarters = \TriathlonResultsManagerHelper::getPlainRelayStarters(deserialize($row['relayStarter']));
			if (!empty($arrPlainRelayStarters))
			{
				$strRelayName = "";
				if (!empty($row['relayName']))
				{
					$strRelayName = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['relayName_format'], $row['relayName']);
				}
				$strStarters = $strRelayName . implode($GLOBALS['TL_LANG']['TriathlonResultsManager']['relayStarter_delimiter'], $arrPlainRelayStarters);;
			}

			$arrDisciplines = deserialize($objResultsCompetition->disciplines);
			$intDisciplinesCount = is_array($arrDisciplines) ? count($arrDisciplines) : 0;
			$intRelayStartersCount = (!empty($arrPlainRelayStarters) ? count($arrPlainRelayStarters) : 0);
			if ($intDisciplinesCount <> $intRelayStartersCount)
			{
				$strDisciplinesStartersDifference = '<div class="tl_error">' . $GLOBALS['TL_LANG']['ERR']['TriathlonResultsManager']['relayDisciplinesStartersDifference'] . '</div>';
			}
		}
		else
		{
			if ($row['singleStarterType'] == 'member')
			{
				$strStarters = \TriathlonResultsManagerHelper::getStarterName($row['singleStarter'], null);
			}
			else
			{
				$strStarters = \TriathlonResultsManagerHelper::getStarterName(-1, $row['singleStarterFreetext_name']);
			}
			
			if ($strStarters == null)
			{
				$strStarters = '<div class="tl_error">' . $GLOBALS['TL_LANG']['ERR']['TriathlonResultsManager']['singleStarter_not_set'] . '</div>';
			}
		}

		$strReturn = $strDisciplinesStartersDifference .'<div class="cte_type ' . ($row['disable'] ? 'unpublished' : 'published') . '">' . $strStarters . '</div><div class="tl_content_left' . ($row['disable'] ? ' disabled' : '') . '"><table class="tl_triathlon_results">';

		if ($objResultsCompetition->performanceEvaluation == 'distance')
		{
			$arrDistance = deserialize($row['distance']);
			$strReturn .= '<tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_triathlon_results']['distance_legend'] . ': </span></td><td>' . sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['distance_format'], \TriathlonResultsManagerHelper::addGroupedThousands($arrDistance['value']), $arrDistance['unit']) . '</td></tr>';
		}
		else if ($objResultsCompetition->performanceEvaluation == 'laps')
		{
			$strReturn .= '<tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_triathlon_results']['laps_legend'] . ': </span></td><td>' . sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['laps_format'], \TriathlonResultsManagerHelper::addGroupedThousands($row['laps'])) . '</td></tr>';
		}
		else
		{
			$strReturn .= '<tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_triathlon_results']['time_legend'] . ': </span></td><td>' . sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['time_format'], \TriathlonResultsManagerHelper::addLeadingZero($row['timeHours']), \TriathlonResultsManagerHelper::addLeadingZero($row['timeMinutes']), \TriathlonResultsManagerHelper::addLeadingZero($row['timeSeconds'])) . '</td></tr>';
		}

		$strReturn .= '<tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_triathlon_results']['overallPlace'][0] . ': </span></td><td>' . sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['place_format'], $row['overallPlace'], $row['overallStarters']) . " " . \TriathlonResultsManagerHelper::getPlaceIconHtml($row['overallPlace'], false) . '</td></tr>';

		if ($objResultsCompetition != null && $objResultsCompetition->ageGroupRating)
		{
			$strReturn .= '<tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_triathlon_results']['ageGroupPlace'][0] . ': </span></td><td>' . sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['place_format'], $row['ageGroupPlace'], $row['ageGroupStarters']) . " " . \TriathlonResultsManagerHelper::getPlaceIconHtml($row['ageGroupPlace'], true) . '</td></tr>';
		}

		if ($objResultsCompetition != null && $objResultsCompetition->type == 'relay')
		{
			$strReturn .= '<tr><td><span class="tl_label">' . $GLOBALS['TL_LANG']['tl_triathlon_results']['relayRatingType'][0] . ': </span></td><td>' . $GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType'][$row['relayRatingType']] . '</td></tr>';
		}

		return $strReturn . "</table></div>\n";
	}

	/**
	 * Format the group ...
	 * @param  String        $groupName    The current translated group name.
	 * @param  int           $sortingFlag  The sorting flag for the current field, which is used for sorting.
	 * @param  int           $sortingField The current field, which is used for sorting.
	 * @param  Array         $row          each row
	 * @param  DataContainer $dc           a DataContainer Object
	 * @return Array                       The manipulated headerfields
	 */
	public function formatGroup($groupName, $sortingFlag, $sortingField, $row, DataContainer $dc)
	{
		if ($sortingField == 'overallPlace')
		{
			return $GLOBALS['TL_LANG']['tl_triathlon_results']['overallPlace'][0] . ': ' . $groupName;
		}
		else if ($sortingField == 'ageGroupPlace')
		{
			return $GLOBALS['TL_LANG']['tl_triathlon_results']['ageGroupPlace'][0] . ': ' . $groupName;
		}
		else if ($sortingField == 'timeHours')
		{
			return $GLOBALS['TL_LANG']['tl_triathlon_results']['timeHours'][0] . ': ' . sprintf($GLOBALS['TL_LANG']['tl_triathlon_results']['group_timeHours'], $groupName);
		}
		else if ($sortingField == 'timeMinutes')
		{
			return $GLOBALS['TL_LANG']['tl_triathlon_results']['timeMinutes'][0] . ': ' . sprintf($GLOBALS['TL_LANG']['tl_triathlon_results']['group_timeMinutes'], $groupName);
		}
		else if ($sortingField == 'distance')
		{
			$strDistance = "-";
			$arrDistance = deserialize($groupName);
			if (is_array($arrDistance))
			{
				$strDistance = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['distance_format'], \TriathlonResultsManagerHelper::addGroupedThousands($arrDistance['value']), $arrDistance['unit']);
			}
			
			return $GLOBALS['TL_LANG']['tl_triathlon_results']['distance'][0] . ': ' . $strDistance;
		}
		else if ($sortingField == 'laps')
		{
			return $GLOBALS['TL_LANG']['tl_triathlon_results']['laps'][0] . ': ' . sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['laps_format'], \TriathlonResultsManagerHelper::addGroupedThousands($groupName));
		}
		return $groupName;
	}

	/**
	 * Add leading zeros to time fields.
	 * @param mixed
	 * @param \DataContainer
	 * @return string
	 */
	public function loadTimeField($varValue)
	{
		if (strlen($varValue) > 0)
		{
			$varValue = \TriathlonResultsManagerHelper::addLeadingZero($varValue);
		}
		return $varValue;
	}

	/**
	 * Check for a valid time value.
	 *
	 * @param mixed  $varValue     The field value.
	 * @param int    $intMaxValue  Maximum allowed value.
	 *
	 * @return mixed The new field value.
	 */
	public static function saveTimeField($varValue, $intMaxValue)
	{
		if (is_numeric($varValue) && (intval($varValue) > $intMaxValue))
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['TriathlonResultsManager']['timeValueIncorrect'], $varValue, $intMaxValue));
		}
		return $varValue;
	}

	/**
	 * Check for a valid place value.
	 *
	 * @param mixed          $varValue         The field value.
	 * @param String         $strField         The name of the field.
	 * @param String         $strCompareField  The name of the field.
	 * @param DataContainer  $dc               The DataContainer object.
	 *
	 * @return mixed The new field value.
	 */
	public static function savePlaceField($varValue, $strField, $strCompareField, DataContainer $dc)
	{
		if (is_numeric($varValue))
		{
			$blnIsStartersField = (strrpos($strField, 'Starters') !== FALSE);

			$intCompareValue = \Input::post($strCompareField);

			if (is_numeric($intCompareValue))
			{
				if ($blnIsStartersField && ($varValue < $intCompareValue))
				{
					throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['TriathlonResultsManager']['placeStartersValueIncorrect'], $varValue, $intCompareValue));
				}
				else if (!$blnIsStartersField && ($varValue > $intCompareValue))
				{
					throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['TriathlonResultsManager']['placeValueIncorrect'], $varValue, $intCompareValue));
				}
			}
		}
		return $varValue;
	}

	/**
	 * Initialize the palettes when loading
	 * @param \DataContainer
	 */
	public function initPalettes(DataContainer $dc)
	{
		if (\Input::get('act') == "create" || \Input::get('act') == "edit")
		{
			$intPid = \Input::get('pid');
			if (!is_numeric($intPid))
			{
				$objResult = \TriathlonResultsModel::findByPk($dc->id);
				if ($objResult != null)
				{
					$intPid = $objResult->pid;
				}
			}
			if (is_numeric($intPid))
			{
				$objResultsCompetition = \TriathlonResultsCompetitionsModel::findByPk($intPid);
				if ($objResultsCompetition != null)
				{
					if ($objResultsCompetition->type == 'relay')
					{
						$GLOBALS['TL_DCA']['tl_triathlon_results']['palettes']['default'] = str_replace('{singleStart_legend},singleStarterType;', '{relayStart_legend},relayStarter,relayRatingType,relayName;', $GLOBALS['TL_DCA']['tl_triathlon_results']['palettes']['default']);
					}
					if ($objResultsCompetition->type == 'relay' || $objResultsCompetition->type == 'league' || ($objResultsCompetition->type == 'single' && !$objResultsCompetition->ageGroupRating))
					{
						$GLOBALS['TL_DCA']['tl_triathlon_results']['palettes']['default'] = str_replace('ageGroupPlace,ageGroupStarters', '', $GLOBALS['TL_DCA']['tl_triathlon_results']['palettes']['default']);
					}
					if ($objResultsCompetition->performanceEvaluation == 'distance')
					{
						$GLOBALS['TL_DCA']['tl_triathlon_results']['palettes']['default'] = str_replace('{time_legend},timeHours,timeMinutes,timeSeconds;', '{distance_legend},distance;', $GLOBALS['TL_DCA']['tl_triathlon_results']['palettes']['default']);
					}
					else if ($objResultsCompetition->performanceEvaluation == 'laps')
					{
						$GLOBALS['TL_DCA']['tl_triathlon_results']['palettes']['default'] = str_replace('{time_legend},timeHours,timeMinutes,timeSeconds;', '{laps_legend},laps;', $GLOBALS['TL_DCA']['tl_triathlon_results']['palettes']['default']);
					}
				}
			}
		}
	}

	/**
	 * Clear data which should not be written in database
	 * @param \DataContainer
	 */
	public function clearData(DataContainer $dc)
	{
		$intPid = \Input::get('pid');
		if (!is_numeric($intPid))
		{
			$intPid = $dc->activeRecord->pid;
		}
		if (!is_numeric($intPid))
		{
			$objResult = \TriathlonResultsModel::findByPk($dc->id);
			if ($objResult != null)
			{
				$intPid = $objResult->pid;
			}
		}

		if (is_numeric($intPid))
		{
			$objResultsCompetition = \TriathlonResultsCompetitionsModel::findByPk($intPid);

			if ($objResultsCompetition != null)
			{
				$arrSet = array();

				if ($objResultsCompetition->type == 'relay')
				{
					$arrSet['singleStarter'] = "NULL";
				}
				else
				{
					$arrSet['relayStarter'] = "NULL";
				}

				if (!$objResultsCompetition->ageGroupRating)
				{
					$arrSet['ageGroupPlace'] = "NULL";
					$arrSet['ageGroupStarters'] = "NULL";
				}

				if ($objResultsCompetition->performanceEvaluation == 'distance')
				{
					$arrSet['timeHours'] = "NULL";
					$arrSet['timeMinutes'] = "NULL";
					$arrSet['timeSeconds'] = "NULL";
					$arrSet['laps'] = "NULL";
				}
				else if ($objResultsCompetition->performanceEvaluation == 'laps')
				{
					$arrSet['timeHours'] = "NULL";
					$arrSet['timeMinutes'] = "NULL";
					$arrSet['timeSeconds'] = "NULL";
					$arrSet['distance'] = "NULL";
				}
				else
				{
					$arrSet['distance'] = "NULL";
					$arrSet['laps'] = "NULL";
				}

				if (!empty($arrSet))
				{
					if (Input::get('act') != "")
					{
						$this->Database->prepare("UPDATE tl_triathlon_results %s WHERE id=?")->set($arrSet)->execute($dc->id);
					}
					else
					{
						$this->Database->prepare("UPDATE tl_triathlon_results %s WHERE pid=?")->set($arrSet)->execute($intPid);
					}
				}
			}
		}
	}

	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen(Input::get('tid')))
		{
			$this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->hasAccess('tl_triathlon_results::disable', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.$row['disable'];

		if ($row['disable'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
	}


	/**
	 * Disable/enable a result
	 * @param integer
	 * @param boolean
	 * @param \DataContainer
	 */
	public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
	{
		// Check permissions
		if (!$this->User->hasAccess('tl_triathlon_results::disable', 'alexf'))
		{
			$this->log('Not enough permissions to activate/deactivate result ID "'.$intId.'"', __METHOD__, TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$objVersions = new Versions('tl_triathlon_results', $intId);
		$objVersions->initialize();

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_triathlon_results']['fields']['disable']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_triathlon_results']['fields']['disable']['save_callback'] as $callback)
			{
				if (is_array($callback))
				{
					$this->import($callback[0]);
					$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, ($dc ?: $this));
				}
				elseif (is_callable($callback))
				{
					$blnVisible = $callback($blnVisible, ($dc ?: $this));
				}
			}
		}

		$time = time();

		// Update the database
		$this->Database->prepare("UPDATE tl_triathlon_results SET tstamp=$time, disable='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
					   ->execute($intId);

		$objVersions->create();
		$this->log('A new version of record "tl_triathlon_results.id='.$intId.'" has been created'.$this->getParentEntries('tl_triathlon_results', $intId), __METHOD__, TL_GENERAL);
	}

}

?>