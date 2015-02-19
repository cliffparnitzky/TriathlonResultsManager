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
 * Run in a custom namespace, so the class can be replaced
 */
namespace TriathlonResultsManager;

/**
 * Class ModuleTriathlonResultsManagerReport
 *
 * Front end module "triathlonResultsManagerReport".
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class ModuleTriathlonResultsManagerReport extends \Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_triathlonResultsManagerReport';

	/**
	 * Generate module
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['triathlonResultsManagerReport'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}

	/**
	 * Compile module
	 */
	protected function compile()
	{
		// first check if required extension 'associategroups' is installed
		if (!in_array('associategroups', $this->Config->getActiveModules()))
		{
			$this->log('The extension "associategroups" is required for determining user list!', _METHOD_, TL_ERROR);
			return false;
		}

		$GLOBALS['TL_BODY'][] = <<<EOT
<script type="text/javascript">
	var translations = {
		tableHeadStarters: "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['starters']}",
		tableHeadTime: "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['time']}",
		tableHeadDistance: "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['distance']}",
		tableHeadOverallPlace: "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['overallPlace']}",
		tableHeadAgeGroupPlace: "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['ageGroupPlace']}",
		headerWomen : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['header_women']}",
		headerMen : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['header_men']}",
		buttonAddWomanImage : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_add_woman_image']}",
		buttonAddWomanTitle : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_add_woman_title']}",
		buttonDelWomanImage : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_del_woman_image']}",
		buttonDelWomanTitle : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_del_woman_title']}",
		buttonAddManImage : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_add_man_image']}",
		buttonAddManTitle : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_add_man_title']}",
		buttonDelManImage : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_del_man_image']}",
		buttonDelManTitle : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_del_man_title']}",
		inputCompetitionNameTitle : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['input_competition_name_title']}",
		selectCompetitionTemplateTitle : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['select_competition_template_title']}",
		selectCompetitionTemplateFirstOption : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['select_competition_template_first_option']}",
		selectCompetitionTemplateOptgroup : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['select_competition_template_optgroup']}",
		buttonMoveUpCompetitionImage : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_move_up_competition_image']}",
		buttonMoveUpCompetitionTitle : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_move_up_competition_title']}",
		buttonMoveDownCompetitionImage : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_move_down_competition_image']}",
		buttonMoveDownCompetitionTitle : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_move_down_competition_title']}",
		buttonMoveUpResultImage : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_move_up_result_image']}",
		buttonMoveUpResultTitle : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_move_up_result_title']}",
		buttonMoveDownResultImage : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_move_down_result_image']}",
		buttonMoveDownResultTitle : "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_move_down_result_title']}",
	};
	var women = [{$this->getMembersJavascriptArrayContent('female')}];
	var men = [{$this->getMembersJavascriptArrayContent('male')}];
</script>
EOT;
		if ($this->triathlonResultsManagerTplUseDefaultCss)
		{
			$GLOBALS['TL_CSS'][] = 'system/modules/TriathlonResultsManager/assets/css/triathlon_results_manager_report.css';
		}
		$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/TriathlonResultsManager/assets/js/triathlon_results_manager_report.js';

		$arrEvents = array();
		$objResultsReports = \TriathlonResultsReportsModel::findAll();
		if ($objResultsReports != null)
		{
			while ($objResultsReports->next())
			{
				$arrEvents[$GLOBALS['TL_LANG']['TriathlonResultsManager']['eventType'][$objResultsReports->eventType]][] = $objResultsReports->eventName;
			}
		}
		$this->Template->events = $arrEvents;
	}

	/**
	 * Reads the members from db, grouped by gender and returns them as a javascript array content.
	 *
	 * @param gender The gender of the members.
	 *
	 * @return The
	 */
	private function getMembersJavascriptArrayContent ($gender)
	{
		$arrReturn = array();
		$objMembers = $this->Database->prepare("SELECT DISTINCT m.id, m.firstname, m.lastname FROM tl_member m "
											 . "LEFT JOIN tl_member_to_group m2g ON m2g.member_id = m.id "
											 . "WHERE m.gender = ? AND m.disable = '' AND m2g.group_id IN (" . implode(",", deserialize($this->triathlonResultsManagerFilterMemberGroups)) . ") "
											 . "ORDER BY m.firstname, m.lastname")
									 ->execute($gender);

		$arrReturn[] = '{id:"", name:"-"}';
		while ($objMembers->next())
		{
			$arrReturn[] = '{id:"' . $objMembers->id . '", name:"' . $objMembers->firstname . ' ' . $objMembers->lastname . '"}';
		}

		return implode(",", $arrReturn);
	}
}

?>