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
 * Class ModuleTriathlonResultsManagerMyReports
 *
 * Front end module "triathlonResultsManagerMyReports".
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class ModuleTriathlonResultsManagerMyReports extends \ModuleTriathlonResultsManagerResults
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_triathlonResultsManagerMyReports';

	/**
	 * Generate module
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['triathlonResultsManagerMyReports'][0]) . ' ###';
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
		if (!FE_USER_LOGGED_IN)
		{
			$this->Template->hasError = true;
			$this->Template->errorMessage = $GLOBALS['TL_LANG']['ERR']['TriathlonResultsManager']['notAuthenticatedMyReports'];
		}
		else
		{
			$this->import('FrontendUser', 'User');
		}
		parent::compile();
	}
}

?>