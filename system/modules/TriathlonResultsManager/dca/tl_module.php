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
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['triathlonResultsManagerReport']    = '{title_legend},name,headline,type;{triathlonResultsManagerFilterSort_legend},triathlonResultsManagerFilterMemberGroups;{template_legend:hide},customTpl,triathlonResultsManagerTplUseDefaultCss;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['triathlonResultsManagerResults']   = '{title_legend},name,headline,type;{triathlonResultsManagerFilterSort_legend},triathlonResultsManagerFilterReportEventDateStart,triathlonResultsManagerFilterReportEventDateEnd,triathlonResultsManagerFilterReportEventType,triathlonResultsManagerFilterReportEvent,triathlonResultsManagerFilterCompetitionType,triathlonResultsManagerSortReportDateField,triathlonResultsManagerSortReportDateDirection,triathlonResultsManagerSortResultRatingTypeOrder;{template_legend:hide},customTpl,triathlonResultsManagerTplUseIconsForDisciplines;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['triathlonResultsManagerMyReports'] = '{title_legend},name,headline,type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['triathlonResultsManagerMyResults'] = '{title_legend},name,headline,type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'triathlonResultsManagerFilterCompetitionType';

$GLOBALS['TL_DCA']['tl_module']['subpalettes']['triathlonResultsManagerFilterCompetitionType_none']   = 'triathlonResultsManagerFilterResultSingleRatingType,triathlonResultsManagerFilterResultRelayRatingType';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['triathlonResultsManagerFilterCompetitionType_single'] = 'triathlonResultsManagerFilterResultSingleRatingType';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['triathlonResultsManagerFilterCompetitionType_relay']  = 'triathlonResultsManagerFilterResultRelayRatingType';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['triathlonResultsManagerFilterCompetitionType_league'] = 'triathlonResultsManagerFilterCompetitionLeague,triathlonResultsManagerFilterResultSingleRatingType';

/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerFilterReportEventDateStart'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterReportEventDateStart'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
	'sql'                     => "varchar(10) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerFilterReportEventDateEnd'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterReportEventDateEnd'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
	'sql'                     => "varchar(10) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerFilterReportEventType'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterReportEventType'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options'                 => array('swim', 'bike', 'run', 'duathlon', 'triathlon', 'others'),
	'reference'               => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['eventType'],
	'eval'                    => array('tl_class'=>'clr w50', 'multiple'=>true),
	'sql'                     => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerFilterReportEvent'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterReportEvent'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'              => 'tl_triathlon_results_reports.CONCAT(FROM_UNIXTIME(eventDate, GET_FORMAT(DATE,"EUR")), ": ", eventName)',
	'options_callback'        => array('tl_module_TriathlonResultsManager', 'getFilterReportEventOptions'),
	'eval'                    => array('tl_class'=>'w50', 'multiple'=>true, 'chosen'=>true),
	'sql'                     => "blob NULL",
	'relation'                => array('type'=>'hasMany', 'load'=>'lazy')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerFilterCompetitionType'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterCompetitionType'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('none', 'single', 'relay', 'league'),
	'reference'               => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['competitionType'],
	'eval'                    => array('tl_class'=>'clr w50', 'submitOnChange'=>true),
	'sql'                     => "varchar(64) NOT NULL default 'none'"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerFilterCompetitionLeague'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterCompetitionLeague'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('triathlon'=>array('triathlon_1_bundesliga', 'triathlon_2_bundesliga', 'triathlon_regionalliga', 'triathlon_landesliga')),
	'reference'               => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['league'],
	'eval'                    => array('tl_class'=>'w50', 'includeBlankOption'=>true),
	'sql'                     => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerFilterResultSingleRatingType'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterResultSingleRatingType'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('female', 'male'),
	'reference'               => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType'],
	'eval'                    => array('tl_class'=>'clr w50', 'includeBlankOption'=>true),
	'sql'                     => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerFilterResultRelayRatingType'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterResultRelayRatingType'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('female', 'male', 'mixed'),
	'reference'               => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType'],
	'eval'                    => array('tl_class'=>'clr w50', 'includeBlankOption'=>true),
	'sql'                     => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerFilterMemberGroups'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterMemberGroups'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'              => 'tl_member_group.name',
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50','chosen'=>true, 'multiple'=>true),
	'sql'                     => "blob NULL",
	'relation'                => array('type'=>'hasMany', 'load'=>'lazy')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerSortReportDateField'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortReportDateField'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('eventDate', 'reportDate'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortReportDateFields'],
	'eval'                    => array('tl_class'=>'clr w50'),
	'sql'                     => "varchar(64) NOT NULL default 'eventDate'"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerSortReportDateDirection'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortReportDateDirection'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('ASC', 'DESC'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortReportDateDirections'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default 'ASC'"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerSortResultRatingTypeOrder'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortResultRatingTypeOrder'],
	'default'                 => array('female', 'male', 'mixed'),
	'exclude'                 => true,
	'inputType'               => 'checkboxWizard',
	'options'                 => array('female', 'male', 'mixed'),
	'reference'               => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType'],
	'eval'                    => array('multiple'=>true, 'tl_class'=>'clr w50'),
	'save_callback' => array
	(
		array('tl_module_TriathlonResultsManager', 'selectAllSortResultRatingTypeOrderOptions')
	),
	'sql'                     => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerTplUseIconsForDisciplines'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerTplUseIconsForDisciplines'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'clr w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerTplUseDefaultCss'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerTplUseDefaultCss'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'clr w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);

/**
 * Class tl_module_TriathlonResultsManager
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2011-2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_module_TriathlonResultsManager extends tl_module
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Returns all
	 */
	public function getFilterReportEventOptions(DataContainer $dc)
	{
		$arrOptions = array();
		$objResultsReports = \TriathlonResultsReportsModel::findAllActive(array('order'=>'eventDate DESC'));
		if ($objResultsReports != null)
		{
			while ($objResultsReports->next())
			{
				$arrOptions[$objResultsReports->id] = \Date::parse(\Config::get('dateFormat'), $objResultsReports->eventDate) . ": " . $objResultsReports->eventName;
			}
		}

		return $arrOptions;
	}

	/**
	 * Ensure all options for 'triathlonResultsManagerSortResultRatingTypeOrder' are selected
	 * @param mixed
	 * @param \DataContainer
	 * @return mixed
	 * @throws \Exception
	 */
	public function selectAllSortResultRatingTypeOrderOptions($varValue, DataContainer $dc)
	{
		$arrResultingOptions = deserialize($varValue);
		$arrExpectedOptions = $GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerSortResultRatingTypeOrder']['options'];

		if (empty($arrResultingOptions))
		{
			$arrResultingOptions = array();
		}

		foreach ($arrExpectedOptions as $expectedOption)
		{
			if (array_search($expectedOption, $arrResultingOptions) === FALSE)
			{
				$arrResultingOptions[] = $expectedOption;
			}
		}

		$varValue = serialize($arrResultingOptions);

		return $varValue;
	}

}

?>