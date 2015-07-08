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
 * Class TriathlonResultsModel
 *
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    Models
 */
class TriathlonResultsModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_triathlon_results';
	
		
	/**
	 * Find results by their parent ID
	 *
	 * @param integer $intPid     The results competitions ID
	 * @param array   $arrOptions An optional options array
	 *
	 * @return \Model\Collection|null A collection of models or null if there are no results
	 */
	public static function findByPid($intPid, array $arrOptions=array())
	{
		$t = static::$strTable;
		
		$arrColumns = array("$t.pid=?");
		$arrValues = array($intPid);
		
		if ($arrOptions['column'])
		{
			$arrColumns = array_merge($arrColumns, $arrOptions['column']);
			unset($arrOptions['column']);
		}
		if ($arrOptions['value'])
		{
			$arrValues = array_merge($arrValues, $arrOptions['value']);
			unset($arrOptions['value']);
		}

		return static::findBy($arrColumns, $arrValues, $arrOptions);
	}
	
	/**
	 * Find active results by their parent ID
	 *
	 * @param integer $intPid     The results competitions ID
	 * @param array   $arrOptions An optional options array
	 *
	 * @return \Model\Collection|null A collection of models or null if there are no active results
	 */
	public static function findActiveByPid($intPid, array $arrOptions=array())
	{
		$t = static::$strTable;
		$arrOptions['column'][] = "$t.disable=''";

		return static::findByPid($intPid, $arrOptions);
	}

}