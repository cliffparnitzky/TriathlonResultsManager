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
 * Class TriathlonResultsManagerHelper
 *
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    Models
 */
class TriathlonResultsManagerHelper
{
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
				if ($strPerformanceEvaluation == 'distance')
				{
					$strDistance = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['distance_format'], str_replace('.', $GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $discipline['time']['value']), $discipline['time']['unit']);
				}
				else
				{
					$strDistance = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['distance_format'], str_replace('.', $GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $discipline['distance']['value']), $discipline['distance']['unit']);
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

				$strRelayStarter = self::getStarterName($relayStarter['starter'], $relayStarter['starter_freetext']);
				if ($strRelayStarter == null)
				{
					$strRelayStarter = '<div class="tl_error">' . $GLOBALS['TL_LANG']['ERR']['relayStarter_not_set'] . '</div>';
				}

				if (strlen($relayStarter['timeHours']) > 0 && strlen($relayStarter['timeMinutes']) > 0 && strlen($relayStarter['timeSeconds']) > 0)
				{
					$strTime = sprintf($GLOBALS['TL_LANG']['TriathlonResultsManager']['time_format'], \TriathlonResultsManagerHelper::addLeadingZero($relayStarter['timeHours']), \TriathlonResultsManagerHelper::addLeadingZero($relayStarter['timeMinutes']), \TriathlonResultsManagerHelper::addLeadingZero($relayStarter['timeSeconds']));
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

}
