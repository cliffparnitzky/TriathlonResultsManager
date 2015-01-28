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
 * Class ModuleTriathlonResultsManagerResults
 *
 * Front end module "triathlonResultsManagerResults".
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class ModuleTriathlonResultsManagerResults extends \Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_triathlonResultsManagerResults';

	/**
	 * Generate module
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['triathlonResultsManagerResults'][0]) . ' ###';
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
		global $objPage;
		
		$arrReports = array();
		
		$tRep = \TriathlonResultsReportsModel::getTable();
		$tCom = \TriathlonResultsCompetitionsModel::getTable();
		$tRes = \TriathlonResultsModel::getTable();
		
		$arrReportOptions = array();
		$arrReportFilterColumn = array();
		$arrReportFilterValue = array();
		
		$arrCompetitionOptions = array();
		$arrCompetitionFilterColumn = array();
		$arrCompetitionFilterValue = array();
		
		$arrResultOptions = array();
		$arrResultFilterColumn = array();
		$arrResultFilterValue = array();
		
		if (!empty($this->triathlonResultsManagerFilterReportEventDateStart))
		{
			$arrReportFilterColumn[] = "$tRep.eventDate >= ?";
			$arrReportFilterValue[] = $this->triathlonResultsManagerFilterReportEventDateStart;
		}
		if (!empty($this->triathlonResultsManagerFilterReportEventDateEnd))
		{
			$arrReportFilterColumn[] = "$tRep.eventDate <= ?";
			$arrReportFilterValue[] = $this->triathlonResultsManagerFilterReportEventDateEnd;
		}
		$arrFilterReportEventTypes = deserialize($this->triathlonResultsManagerFilterReportEventType);
		if (!empty($arrFilterReportEventTypes))
		{
			$arrReportFilterColumn[] = "$tRep.eventType IN ('" . implode("','", $arrFilterReportEventTypes) . "')";
		}
		$arrFilterReportEvents = deserialize($this->triathlonResultsManagerFilterReportEvent);
		if (!empty($arrFilterReportEvents))
		{
			$arrReportFilterColumn[] = "$tRep.id IN ('" . implode("','", $arrFilterReportEvents) . "')";
		}
		
		$competitionType = $this->triathlonResultsManagerFilterCompetitionType;
		if ($this->triathlonResultsManagerFilterCompetitionType != 'none')
		{
			
			$arrReportFilterColumn[] = "$tRep.id IN (SELECT $tCom.pid FROM $tCom WHERE $tCom.type = ?)";
			$arrReportFilterValue[] = $competitionType;
			
			
			$arrCompetitionFilterColumn[] = "$tCom.type = ?";
			$arrCompetitionFilterValue[] = $competitionType;
			
			if ($this->triathlonResultsManagerFilterCompetitionType == 'league' && !empty($this->triathlonResultsManagerFilterCompetitionLeague))
			{
				$arrReportFilterColumn[] = "$tRep.id IN (SELECT $tCom.pid FROM $tCom WHERE $tCom.league = ?)";
				$arrReportFilterValue[] = $this->triathlonResultsManagerFilterCompetitionLeague;
				
				$arrCompetitionFilterColumn[] = "$tCom.league = ?";
				$arrCompetitionFilterValue[] = $this->triathlonResultsManagerFilterCompetitionLeague;
			}
		}
		
		if (!empty($this->triathlonResultsManagerFilterResultSingleRatingType) && ($competitionType == 'none' || $competitionType == 'single' || $competitionType == 'league'))
		{
			$tMem = \MemberModel::getTable();
			$arrReportFilterColumn[] = "$tRep.id IN (SELECT $tCom.pid FROM $tCom WHERE $tCom.id IN (SELECT $tRes.pid FROM $tRes WHERE $tRes.singleStarter IN (SELECT $tMem.id FROM $tMem WHERE $tMem.gender = ?)))";
			$arrReportFilterValue[] = $this->triathlonResultsManagerFilterResultSingleRatingType;
			
			$arrCompetitionFilterColumn[] = "$tCom.id IN (SELECT $tRes.pid FROM $tRes WHERE $tRes.singleStarter IN (SELECT $tMem.id FROM $tMem WHERE $tMem.gender = ?))";
			$arrCompetitionFilterValue[] = $this->triathlonResultsManagerFilterResultSingleRatingType;
			
			$arrResultFilterColumn[] = "$tRes.singleStarter IN (SELECT $tMem.id FROM $tMem WHERE $tMem.gender = ?)";
			$arrResultFilterValue[] = $this->triathlonResultsManagerFilterResultSingleRatingType;
		}
		
		if (!empty($this->triathlonResultsManagerFilterResultRelayRatingType) && ($competitionType == 'none' || $competitionType == 'relay'))
		{
			$arrReportFilterColumn[] = "$tRep.id IN (SELECT $tCom.pid FROM $tCom WHERE $tCom.id IN (SELECT $tRes.pid FROM $tRes WHERE $tRes.relayRatingType = ?))";
			$arrReportFilterValue[] = $this->triathlonResultsManagerFilterResultRelayRatingType;
			
			$arrCompetitionFilterColumn[] = "$tCom.id IN (SELECT $tRes.pid FROM $tRes WHERE $tRes.relayRatingType = ?)";
			$arrCompetitionFilterValue[] = $this->triathlonResultsManagerFilterResultRelayRatingType;
			
			$arrResultFilterColumn[] = "$tRes.relayRatingType = ?";
			$arrResultFilterValue[] = $this->triathlonResultsManagerFilterResultRelayRatingType;
		}
		
		if (count($arrReportFilterColumn) > 0)
		{
			$arrReportOptions['column'] = $arrReportFilterColumn;
			$arrReportOptions['value'] = $arrReportFilterValue;
		}
		$arrReportOptions['order'] = $this->triathlonResultsManagerSortReportDateField . ' ' . $this->triathlonResultsManagerSortReportDateDirection;
		
		$objResultsReports = \TriathlonResultsReportsModel::findAllActive($arrReportOptions); // only published
		if ($objResultsReports != null)
		{
			while ($objResultsReports->next())
			{
				$arrReport = $objResultsReports->row();
				$arrReport['formattedEventDate'] = \Date::parse($objPage->dateFormat, $arrReport['eventDate']);
				$arrReport['formattedReportDate'] = \Date::parse($objPage->dateFormat, $arrReport['reportDate']);
				$objMember = \MemberModel::findByPk($arrReport['reportMember']);
				if ($objMember != null)
				{
					$arrReport['formattedReportMember'] = $objMember->firstname . ' ' . $objMember->lastname;
					$arrReport['formattedReportDateAndMember'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['report_format'], $arrReport['formattedReportDate'], $arrReport['formattedReportMember']);
				}
				else
				{
					$arrReport['formattedReportDateAndMember'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['report_format_no_member'], $arrReport['formattedReportDate']);
				}
				
				if (count($arrCompetitionFilterColumn) > 0)
				{
					$arrCompetitionOptions['column'] = $arrCompetitionFilterColumn;
					$arrCompetitionOptions['value'] = $arrCompetitionFilterValue;
				}
				$arrCompetitionOptions['order'] = 'sorting ASC';
				
				$objResultsCompetitions = \TriathlonResultsCompetitionsModel::findActiveByPid($arrReport['id'], $arrCompetitionOptions);
				$arrCompetitions = array();
				
				if ($objResultsCompetitions != null)
				{
					while ($objResultsCompetitions->next())
					{
						$arrCompetition = $objResultsCompetitions->row();
						
						$arrPlainDistances = \TriathlonResultsManagerHelper::getPlainDistances(deserialize($arrCompetition['distances']), true);
						if (!empty($arrPlainDistances))
						{
							$arrCompetition['formattedDistances'] = implode($GLOBALS['TL_LANG']['TriathlonResultsManager']['distances_delimiter'], $arrPlainDistances);
						}
						
						if (count($arrResultFilterColumn) > 0)
						{
							$arrResultOptions['column'] = $arrResultFilterColumn;
							$arrResultOptions['value'] = $arrResultFilterValue;
						}
						
						$objResults = \TriathlonResultsModel::findActiveByPid($arrCompetition['id'], $arrResultOptions);
						$arrResults = array();
						
						if ($objResults != null)
						{
							while ($objResults->next())
							{
								$key = "";
								
								$arrResult = $objResults->row();
								
								if ($arrCompetition['type'] == 'relay')
								{
									if (!empty($arrResult['relayName']))
									{
										$arrResult['formattedRelayName'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['relayName_format'], $arrResult['relayName']);
									}
									
									$arrPlainRelayStarters = \TriathlonResultsManagerHelper::getPlainRelayStarters(deserialize($arrResult['relayStarter']));
									if (!empty($arrPlainRelayStarters))
									{
										$arrResult['formattedRelayStarteres'] = implode($GLOBALS['TL_LANG']['TriathlonResultsManager']['relayStarter_delimiter'], $arrPlainRelayStarters);;
									}
									
									$intDistancesCount = is_array($arrPlainDistances) ? count($arrPlainDistances) : 0;
									$intRelayStartersCount = (!empty($arrPlainRelayStarters) ? count($arrPlainRelayStarters) : 0);
									
									$intRelayStarterNotSetErrorCount = 0;
									if (!empty($arrPlainRelayStarters))
									{
										$intRelayStarterNotSetErrorCount = count(preg_grep('/' . $GLOBALS['TL_LANG']['ERR']['relayStarter_not_set'] . '/', $arrPlainRelayStarters));
									}
									
									if ($intRelayStartersCount == 0 || $intDistancesCount <> $intRelayStartersCount || $intRelayStarterNotSetErrorCount > 0)
									{
										// no starters set or count is different or at least one starter could no be determined
										continue;
									}
									
									$key = $this->getKeyForRatingType($arrResult['relayRatingType']);
									$arrResult['ratingType'] = $arrResult['relayRatingType'];
									$arrResult['formattedRatingType'] = $GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType'][$arrResult['ratingType']];
								}
								else
								{
									if (!empty($arrResult['singleStarter_freetext']))
									{
										$arrResult['formattedSingleStarter'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['starter_freetext_format'], $arrResult['singleStarter_freetext']);
										$key = $this->getKeyForRatingType('others');
										$arrResult['ratingType'] = 'others';
										$arrResult['formattedRatingType'] = $GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType']['others'];
									}
									else
									{
										$objMember = \MemberModel::findByPk($arrResult['singleStarter']);
										if ($objMember != null)
										{
											$arrResult['formattedSingleStarter'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['starter_format'], $objMember->firstname, $objMember->lastname);
											$key = $this->getKeyForRatingType($objMember->gender);
											$arrResult['ratingType'] = $objMember->gender;
											$arrResult['formattedRatingType'] = $GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType'][$objMember->gender];
										}
										else
										{
											// no starter set
											continue;
										}
									}
								}
								
								$key .= \TriathlonResultsManagerHelper::addLeadingZero($arrResult['timeHours']) . \TriathlonResultsManagerHelper::addLeadingZero($arrResult['timeMinutes']) . \TriathlonResultsManagerHelper::addLeadingZero($arrResult['timeSeconds']);
								
								$arrResult['formattedTime'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['time_format'], \TriathlonResultsManagerHelper::addLeadingZero($arrResult['timeHours']), \TriathlonResultsManagerHelper::addLeadingZero($arrResult['timeMinutes']), \TriathlonResultsManagerHelper::addLeadingZero($arrResult['timeSeconds']));
								$arrResult['formattedOverallPlace'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['place_format'], $arrResult['overallPlace'], $arrResult['overallStarters']) . " " . \TriathlonResultsManagerHelper::getPlaceIconHtml($arrResult['overallPlace'], false);
								$arrResult['formattedAgeGroupPlace'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['place_format'], $arrResult['ageGroupPlace'], $arrResult['ageGroupStarters']) . " " . \TriathlonResultsManagerHelper::getPlaceIconHtml($arrResult['ageGroupPlace'], true);
								
								$arrResults[$key] = $arrResult;
							}
						}
						
						if (!empty($arrResults))
						{
							ksort($arrResults);
							$arrCompetition['results'] = $arrResults;
						
							$arrCompetitions[] = $arrCompetition;
						}
					}
				}
				
				if (!empty($arrCompetitions))
				{
					$arrReport['competitions'] = $arrCompetitions;
				
					$arrReports[] = $arrReport;
				}
			}
		}
		
		$this->Template->reports = $arrReports;
	}
	
	/**
	 * Return a key for the rating type according to its defined order.
	 */
	private function getKeyForRatingType($strType)
	{
		$arrOrder = deserialize($this->triathlonResultsManagerSortResultRatingTypeOrder);
		
		if (empty($arrOrder))
		{
			$arrOrder = $GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerSortResultRatingTypeOrder']['options'];
		}
		
		$intIndex = array_search($strType, $arrOrder);
		
		if ($intIndex === FALSE)
		{
			$intIndex = count($GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerSortResultRatingTypeOrder']['options']);
		}
		return $intIndex . "_";
	}
}

?>