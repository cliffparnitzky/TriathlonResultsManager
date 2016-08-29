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
namespace CliffParnitzky\Contao\TriathlonResultsManager;

/**
 * Class TriathlonResultsManagerHelper
 *
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    Models
 */
class TriathlonResultsManagerHelper
{
	const REPORT_INTERNAL_PUBLIC = 'public';
	const REPORT_INTERNAL_ONLY   = 'internal';
	const REPORT_INTERNAL_ALL    = 'all';
	
	
	/**
	 * Return the name of the icon for the given place.
	 *
	 * @param $intPlace int The place to get the icon name for.
	 * @param $blnIsAgeGroup bool True if the icon is for age group.
	 * @return String The name of the icon or empty string if no icon could be determined.
	 */
	public static function getPlaceIconName($intPlace, $blnIsAgeGroup)
	{
		$strIcon = 'place_';

		if ($blnIsAgeGroup)
		{
			$strIcon .= 'agegroup_';
		}
		else
		{
			$strIcon .= 'overall_';
		}
		switch (intval($intPlace))
		{
			case 1  : $strIcon .= 'gold.png'; break;
			case 2  : $strIcon .= 'silver.png'; break;
			case 3  : $strIcon .= 'bronze.png'; break;
			default : $strIcon = '';
		}
		return $strIcon;
	}

	/**
	 * Return the path to the icon for the given place.
	 *
	 * @param $intPlace int The place to get the icon path for.
	 * @param $blnIsAgeGroup bool True if the icon is for age group.
	 * @return String The path to the icon or empty string if no icon could be determined.
	 */
	public static function getPlaceIconPath($intPlace, $blnIsAgeGroup)
	{
		$strIcon = self::getPlaceIconName($intPlace, $blnIsAgeGroup);
		if (!empty($strIcon))
		{
			return 'system/modules/TriathlonResultsManager/assets/' . $strIcon;
		}
		return '';
	}

	/**
	 * Return the html of the icon for the given place.
	 *
	 * @param $intPlace int The place to get the icon for.
	 * @param $blnIsAgeGroup bool True if the icon is for age group.
	 * @return String The html to the icon or empty string if no icon could be determined.
	 */
	public static function getPlaceIconHtml($intPlace, $blnIsAgeGroup)
	{
		$strIconPath = self::getPlaceIconPath($intPlace, $blnIsAgeGroup);
		if (!empty($strIconPath))
		{
			$strAltTitle = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['place_overall'], $intPlace);
			if ($blnIsAgeGroup)
			{
				$strAltTitle = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['place_agegroup'], $intPlace);
			}

			return '<img class="place place_' . $intPlace . ' ' . ($blnIsAgeGroup ? 'agegroup' : 'overall') . '" src="' . $strIconPath . '" alt="' . $strAltTitle . '" title="' . $strAltTitle . '" />';
		}
		return '';
	}

	/**
	 * Adds missing leading zeros to a value.
	 *
	 * @param int  $intValue      The value the zeros should be added to.
	 * @param int  $intMaxLength  The maximum length of the returned string. The default ist '2'.
	 *
	 * @return String The value with added leading zeros.
	 */
	public static function addLeadingZero($intValue, $intExpectedLength=2)
	{
		$strReturn = "";

		for ($i = 0; $i < ($intExpectedLength - strlen($intValue)); $i++)
		{
			$strReturn .= "0";
		}

		return $strReturn . $intValue;
	}

	/**
	 * Adds grouped thousands to a value.
	 *
	 * @param String  $strValue  The value the grouped thousands should be added to.
	 *
	 * @return String The value with added grouped thousands.
	 */
	public static function addGroupedThousands($strValue)
	{
		$arrParts = explode('.', $strValue);
		$number = $arrParts[0];
		$decimals = $arrParts[1];

		$strReturn = "";
		$valLength = strlen($number);

		for ($i = ($valLength - 1); $i >= 0; $i--)
		{
			$character = substr($number, $i, 1);
			$strReturn = $character . $strReturn;
			if ($i > 0 && (($valLength - $i) % 3 == 0))
			{
				$strReturn = $GLOBALS['TL_LANG']['MSC']['thousandsSeparator'] . $strReturn;
			}
		}

		if (strlen($decimals) > 0)
		{
			$strReturn .= $GLOBALS['TL_LANG']['MSC']['decimalSeparator'] . $decimals;
		}

		return $strReturn;
	}

	/**
	 * Extract the disciplines with disciplines to a plain value array.
	 *
	 * @param array   $arrDisciplines            The complex array of discipline data.
	 * @param String  $strPerformanceEvaluation  The value of the performance evaluation type.
	 * @param bool    $blnAddDiscipline          True if the discipline should be added to plain value (using the 'discipline_distance_format').
	 * @param bool    $blnAddDisciplineAsImage   True if the discipline should be added to plain value as image.
	 *
	 * @return array The resulting plain values in an array.
	 */
	public static function getPlainDisciplines($arrDisciplines, $strPerformanceEvaluation, $blnAddDiscipline=false, $blnAddDisciplineAsImage=false)
	{
		if (is_array($arrDisciplines))
		{
			$arrPlainDisciplines = array();
			foreach ($arrDisciplines as $discipline)
			{
				if ($strPerformanceEvaluation == 'distance' || $strPerformanceEvaluation == 'laps')
				{
					$strDistance = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['distance_format'], str_replace('.', $GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $discipline['time']['value']), $discipline['time']['unit']);
				}
				else
				{
					$strDistance = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['distance_format'], static::addGroupedThousands($discipline['distance']['value']), $discipline['distance']['unit']);
				}

				if ($blnAddDiscipline)
				{
					$strDiscipline = "";
					if ($discipline['discipline'] == 'others' && !empty($discipline['discipline_freetext']))
					{
						$strDiscipline = $discipline['discipline_freetext'];
					}
					else
					{
						if ($blnAddDisciplineAsImage)
						{
							$strDiscipline = '<img src="system/modules/TriathlonResultsManager/assets/type_' . $discipline['discipline'] . '.png" alt="' . $discipline['discipline'] . '" title="' . $GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines'][$discipline['discipline']] . '" />';
						}
						else
						{
							$strDiscipline = $GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines'][$discipline['discipline']];
						}
					}

					$arrPlainDisciplines[] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['discipline_distance_format'], $strDiscipline, $strDistance);
				}
				else
				{
					$arrPlainDisciplines[] = $strDistance;
				}
			}
			return $arrPlainDisciplines;
		}
		return null;
	}

	/**
	 * Extract the relay starters with disciplines and times to a plain value array.
	 *
	 * @param array  $arrRelayStarters  The complex array of relay startes data.
	 *
	 * @return array The resulting plain values in an array.
	 */
	public static function getPlainRelayStarters($arrRelayStarters)
	{
		if (is_array($arrRelayStarters))
		{
			$arrPlainRelayStarters = array();

			foreach ($arrRelayStarters as $relayStarter)
			{
				$strDiscipline = "";
				$strRelayStarter = "";
				$strTime = "";

				if ($relayStarter['discipline'] == 'others' && !empty($relayStarter['discipline_freetext']))
				{
					$strDiscipline .= $relayStarter['discipline_freetext'];
				}
				else
				{
					$strDiscipline .= $GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines'][$relayStarter['discipline']];
				}

				$strRelayStarter = static::getStarterName($relayStarter['starter'], $relayStarter['starter_freetext']);
				if ($strRelayStarter == null)
				{
					$strRelayStarter = '<div class="tl_error">' . $GLOBALS['TL_LANG']['ERR']['TriathlonResultsManager']['relayStarter_not_set'] . '</div>';
				}

				if (strlen($relayStarter['timeHours']) > 0 && strlen($relayStarter['timeMinutes']) > 0 && strlen($relayStarter['timeSeconds']) > 0)
				{
					$strTime = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['time_format'], static::addLeadingZero($relayStarter['timeHours']), static::addLeadingZero($relayStarter['timeMinutes']), static::addLeadingZero($relayStarter['timeSeconds']));
				}

				if (!empty($strTime))
				{
					$arrPlainRelayStarters[] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['relayStarters_format'], $strRelayStarter, $strDiscipline, $strTime);
				}
				else
				{
					$arrPlainRelayStarters[] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['relayStarters_format_no_time'], $strRelayStarter, $strDiscipline);
				}
			}

			return $arrPlainRelayStarters;
		}
		return null;
	}

	/**
	 * Extract the name of a starter from the given values.
	 *
	 * @param int     $intStarterId  The id of the starter.
	 * @param String  $strFreetext  The freetext value for the starter.
	 *
	 * @return String The resulting name of the starter or null, if no name could be determined.
	 */
	public static function getStarterName($intStarterId, $strFreetext)
	{
		$strStarter = "";
		if (!empty($strFreetext))
		{
			return sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['starter_freetext_format'], $strFreetext);
		}
		else
		{
			$objMember = \MemberModel::findByPk($intStarterId);
			if ($objMember != null)
			{
				return sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['starter_format'], $objMember->firstname, $objMember->lastname);
			}
		}
		return null;
	}

	/**
	 * Return a key for the rating type according to its defined order.
	 *
	 * @param String  $strType                       The id of the starter.
	 * @param Array   $arrSortResultRatingTypeOrder  The defined order of rating types.
	 *
	 * @return String The resulting resulting key for the rating type (never null).
	 */
	public static function getKeyForRatingType($strType, $arrSortResultRatingTypeOrder, $intOverallPlace)
	{
		\Controller::loadDataContainer('tl_module');
		if (empty($arrSortResultRatingTypeOrder))
		{
			$arrSortResultRatingTypeOrder = $GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerSortResultRatingTypeOrder']['options'];
		}

		$intIndex = array_search($strType, $arrSortResultRatingTypeOrder);

		if ($intIndex === FALSE)
		{
			$intIndex = count($GLOBALS['TL_DCA']['tl_module']['fields']['triathlonResultsManagerSortResultRatingTypeOrder']['options']);
		}
		return ($intIndex * 100000) + $intOverallPlace;
	}

	public static function getResults ($arrData)
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

		if (!empty($arrData['triathlonResultsManagerFilterReportEventDateStart']))
		{
			$arrReportFilterColumn[] = "$tRep.eventDate >= ?";
			$arrReportFilterValue[] = $arrData['triathlonResultsManagerFilterReportEventDateStart'];
		}
		if (!empty($arrData['triathlonResultsManagerFilterReportEventDateEnd']))
		{
			$arrReportFilterColumn[] = "$tRep.eventDate <= ?";
			$arrReportFilterValue[] = $arrData['triathlonResultsManagerFilterReportEventDateEnd'];
		}
		$arrFilterReportEventTypes = deserialize($arrData['triathlonResultsManagerFilterReportEventType']);
		if (!empty($arrFilterReportEventTypes))
		{
			$arrReportFilterColumn[] = "$tRep.eventType IN ('" . implode("','", $arrFilterReportEventTypes) . "')";
		}
		$arrFilterReportEvents = deserialize($arrData['triathlonResultsManagerFilterReportEvent']);
		if (!empty($arrFilterReportEvents))
		{
			$arrReportFilterColumn[] = "$tRep.id IN ('" . implode("','", $arrFilterReportEvents) . "')";
		}
		if ($arrData['triathlonResultsManagerFilterReportEventInternal'] == TriathlonResultsManagerHelper::REPORT_INTERNAL_PUBLIC)
		{
			$arrReportFilterColumn[] = "$tRep.internal = ?";
			$arrReportFilterValue[] = false;
		}
		 else if ($arrData['triathlonResultsManagerFilterReportEventInternal'] == TriathlonResultsManagerHelper::REPORT_INTERNAL_ONLY)
		{
			$arrReportFilterColumn[] = "$tRep.internal = ?";
			$arrReportFilterValue[] = true;
		}

		$competitionType = $arrData['triathlonResultsManagerFilterCompetitionType'];
		if (!empty($competitionType) && $competitionType != 'none')
		{
			$arrReportFilterColumn[] = "$tRep.id IN (SELECT $tCom.pid FROM $tCom WHERE $tCom.type = ?)";
			$arrReportFilterValue[] = $competitionType;

			$arrCompetitionFilterColumn[] = "$tCom.type = ?";
			$arrCompetitionFilterValue[] = $competitionType;

			if ($competitionType == 'league' && !empty($arrData['triathlonResultsManagerFilterCompetitionLeague']))
			{
				$arrReportFilterColumn[] = "$tRep.id IN (SELECT $tCom.pid FROM $tCom WHERE $tCom.league = ?)";
				$arrReportFilterValue[] = $arrData['triathlonResultsManagerFilterCompetitionLeague'];

				$arrCompetitionFilterColumn[] = "$tCom.league = ?";
				$arrCompetitionFilterValue[] = $arrData['triathlonResultsManagerFilterCompetitionLeague'];
			}
		}

		if (!empty($arrData['triathlonResultsManagerFilterResultSingleRatingType']) && ($competitionType == 'none' || $competitionType == 'single' || $competitionType == 'league'))
		{
			$tMem = \MemberModel::getTable();
			$arrReportFilterColumn[] = "$tRep.id IN (SELECT $tCom.pid FROM $tCom WHERE $tCom.id IN (SELECT $tRes.pid FROM $tRes WHERE $tRes.singleStarter IN (SELECT $tMem.id FROM $tMem WHERE $tMem.gender = ?)))";
			$arrReportFilterValue[] = $arrData['triathlonResultsManagerFilterResultSingleRatingType'];

			$arrCompetitionFilterColumn[] = "$tCom.id IN (SELECT $tRes.pid FROM $tRes WHERE $tRes.singleStarter IN (SELECT $tMem.id FROM $tMem WHERE $tMem.gender = ?))";
			$arrCompetitionFilterValue[] = $arrData['triathlonResultsManagerFilterResultSingleRatingType'];

			$arrResultFilterColumn[] = "($tRes.singleStarter IN (SELECT $tMem.id FROM $tMem WHERE $tMem.gender = ?) || $tRes.singleStarterFreetext_gender = ?)";
			$arrResultFilterValue[] = $arrData['triathlonResultsManagerFilterResultSingleRatingType'];
			$arrResultFilterValue[] = $arrData['triathlonResultsManagerFilterResultSingleRatingType'];
		}

		if (!empty($arrData['triathlonResultsManagerFilterResultRelayRatingType']) && ($competitionType == 'none' || $competitionType == 'relay'))
		{
			$arrReportFilterColumn[] = "$tRep.id IN (SELECT $tCom.pid FROM $tCom WHERE $tCom.id IN (SELECT $tRes.pid FROM $tRes WHERE $tRes.relayRatingType = ?))";
			$arrReportFilterValue[] = $arrData['triathlonResultsManagerFilterResultRelayRatingType'];

			$arrCompetitionFilterColumn[] = "$tCom.id IN (SELECT $tRes.pid FROM $tRes WHERE $tRes.relayRatingType = ?)";
			$arrCompetitionFilterValue[] = $arrData['triathlonResultsManagerFilterResultRelayRatingType'];

			$arrResultFilterColumn[] = "$tRes.relayRatingType = ?";
			$arrResultFilterValue[] = $arrData['triathlonResultsManagerFilterResultRelayRatingType'];
		}

		if (count($arrReportFilterColumn) > 0)
		{
			$arrReportOptions['column'] = $arrReportFilterColumn;
			$arrReportOptions['value'] = $arrReportFilterValue;
		}
		$arrReportOptions['order'] = $arrData['triathlonResultsManagerSortReportDateField'] . ' ' . $arrData['triathlonResultsManagerSortReportDateDirection'];

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
						
						$arrCompetition['performanceEvaluationThead'] = $GLOBALS['TL_LANG']['TriathlonResultsManager']['thead'][$objResultsCompetitions->performanceEvaluation];

						$arrPlainDisciplines = static::getPlainDisciplines(deserialize($arrCompetition['disciplines']), $objResultsCompetitions->performanceEvaluation, true, $arrData['triathlonResultsManagerTplUseIconsForDisciplines']);
						if (!empty($arrPlainDisciplines))
						{
							$arrCompetition['formattedDisciplines'] = implode($GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines_delimiter'], $arrPlainDisciplines);
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

									$arrPlainRelayStarters = static::getPlainRelayStarters(deserialize($arrResult['relayStarter']));
									if (!empty($arrPlainRelayStarters))
									{
										$arrResult['formattedRelayStarteres'] = implode($GLOBALS['TL_LANG']['TriathlonResultsManager']['relayStarter_delimiter'], $arrPlainRelayStarters);;
									}

									$intDisciplinesCount = is_array($arrPlainDisciplines) ? count($arrPlainDisciplines) : 0;
									$intRelayStartersCount = (!empty($arrPlainRelayStarters) ? count($arrPlainRelayStarters) : 0);

									$intRelayStarterNotSetErrorCount = 0;
									if (!empty($arrPlainRelayStarters))
									{
										$intRelayStarterNotSetErrorCount = count(preg_grep('/' . $GLOBALS['TL_LANG']['ERR']['TriathlonResultsManager']['relayStarter_not_set'] . '/', $arrPlainRelayStarters));
									}

									if ($intRelayStartersCount == 0 || $intDisciplinesCount <> $intRelayStartersCount || $intRelayStarterNotSetErrorCount > 0)
									{
										// no starters set or count is different or at least one starter could no be determined
										continue;
									}

									$key = static::getKeyForRatingType($arrResult['relayRatingType'], deserialize($arrData['triathlonResultsManagerSortResultRatingTypeOrder']), $arrResult['overallPlace']);
									$arrResult['ratingType'] = $arrResult['relayRatingType'];
									$arrResult['formattedRatingType'] = $GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType'][$arrResult['ratingType']];
								}
								else
								{
									if ($arrResult['singleStarterType'] == 'freetext' && !empty($arrResult['singleStarterFreetext_name']))
									{
										$arrResult['formattedSingleStarter'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['starter_freetext_format'], $arrResult['singleStarterFreetext_name']);
										$key = static::getKeyForRatingType($arrResult['singleStarterFreetext_gender'], deserialize($arrData['triathlonResultsManagerSortResultRatingTypeOrder']), $arrResult['overallPlace']);
										$arrResult['ratingType'] = $arrResult['singleStarterFreetext_gender'];
										$arrResult['formattedRatingType'] = $GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType'][$arrResult['singleStarterFreetext_gender']];
									}
									else
									{
										$objMember = \MemberModel::findByPk($arrResult['singleStarter']);
										if ($objMember != null)
										{
											$arrResult['formattedSingleStarter'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['starter_format'], $objMember->firstname, $objMember->lastname);
											$key = static::getKeyForRatingType($objMember->gender, deserialize($arrData['triathlonResultsManagerSortResultRatingTypeOrder']), $arrResult['overallPlace']);
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

								if ($objResultsCompetitions->performanceEvaluation == 'distance')
								{
									$arrDistance = deserialize($arrResult['distance']);
									$arrResult['formattedPerformanceEvaluationValue'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['distance_format'], static::addGroupedThousands($arrDistance['value']), $arrDistance['unit']);
								}
								else if ($objResultsCompetitions->performanceEvaluation == 'laps')
								{
									$arrResult['formattedPerformanceEvaluationValue'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['laps_format'], static::addGroupedThousands($arrResult['laps']));
								}
								else
								{
									$arrResult['formattedPerformanceEvaluationValue'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['time_format'], static::addLeadingZero($arrResult['timeHours']), static::addLeadingZero($arrResult['timeMinutes']), static::addLeadingZero($arrResult['timeSeconds']));
								}

								$arrResult['formattedOverallPlace'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['place_format'], $arrResult['overallPlace'], $arrResult['overallStarters']) . " " . static::getPlaceIconHtml($arrResult['overallPlace'], false);
								$arrResult['formattedAgeGroupPlace'] = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['place_format'], $arrResult['ageGroupPlace'], $arrResult['ageGroupStarters']) . " " . static::getPlaceIconHtml($arrResult['ageGroupPlace'], true);

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
		return $arrReports;
	}

}
