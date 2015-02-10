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
		$GLOBALS['TL_BODY'][] = <<<EOT
<script type="text/javascript">
	var tableHeads = {starters: "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['starters']}", time: "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['time']}", overallPlace: "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['overallPlace']}", ageGroupPlace: "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['ageGroupPlace']}"};
	var womenHeader = "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['women_header']}";
	var buttonAddWomanTitle = "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_add_woman_title']}";
	var buttonDelWomanTitle = "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_del_woman_title']}";
	var menHeader = "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['men_header']}";
	var buttonAddManTitle = "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_add_man_title']}";
	var buttonDelManTitle = "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_del_man_title']}";
	var selectCompetitionTemplateTitle = "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['select_competition_template_title']}";
	var selectCompetitionTemplateFirstOption = "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['select_competition_template_first_option']}";
	var selectCompetitionTemplateOptgroup = "{$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['select_competition_template_optgroup']}";
</script>'
EOT;
		$GLOBALS['TL_CSS'][] = 'system/modules/TriathlonResultsManager/assets/css/triathlon_results_manager_report.css';
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
}

?>