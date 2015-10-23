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
 * Table tl_triathlon_results_competitions
 */
$GLOBALS['TL_DCA']['tl_triathlon_results_competitions'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'           => 'Table',
		'ptable'                  => 'tl_triathlon_results_reports',
		'ctable'                  => array('tl_triathlon_results'),
		'switchToEdit'            => true,
		'enableVersioning'        => true,
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
			'fields'                  => array('sorting'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;sort,search,limit',
			'headerFields'            => array('eventDate', 'eventType', 'eventName', 'reportDate', 'reportMember'),
			'child_record_callback'   => array('tl_triathlon_results_competitions', 'listCompetition'),
			'child_record_class'      => 'no_padding'
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
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['edit'],
				'href'                => 'table=tl_triathlon_results',
				'icon'                => 'edit.gif'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['editheader'],
				'href'                => 'table=tl_triathlon_results_competitions&amp;act=edit',
				'icon'                => 'header.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return TriathlonResultsManager.toggleVisibility(this, %s);"',
				'button_callback'     => array('tl_triathlon_results_competitions', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__' => array('type'),
		'default'      => '{competition_legend},name,type,performanceEvaluation;{disciplines_legend},disciplines;{deactivation_legend},disable'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'type_single' => 'ageGroupRating',
		'type_relay'  => '',
		'type_league' => 'league',
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
			'foreignKey'              => 'tl_triathlon_results_reports.eventName',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
		),
		'sorting' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['MSC']['sorting'],
			'sorting'                 => true,
			'flag'                    => 11,
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['name'],
			'exclude'                 => true,
			'sorting'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['type'],
			'default'                 => 'single',
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options'                 => array('single', 'relay', 'league'),
			'reference'               => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['competitionType'],
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true),
			'sql'                     => "varchar(64) NOT NULL default 'single'"
		),
		'league' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['league'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options'                 => array('triathlon'=>array('triathlon_1_bundesliga', 'triathlon_2_bundesliga', 'triathlon_regionalliga', 'triathlon_landesliga')),
			'reference'               => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['league'],
			'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'ageGroupRating' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['ageGroupRating'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'performanceEvaluation' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['performanceEvaluation'],
			'default'                 => 'time',
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options'                 => array('time', 'distance', 'laps'),
			'reference'               => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['competitionPerformanceEvaluation'],
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true),
			'sql'                     => "varchar(64) NOT NULL default 'time'"
		),
		'disciplines' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines'],
			'exclude'                 => true,
			'inputType'               => 'multiColumnWizard',
			'eval'                    => array('tl_class'=>'clr','columnFields'=>tl_triathlon_results_competitions::getDisciplineColumns()),
			'load_callback' => array
			(
				array('tl_triathlon_results_competitions', 'setDefaultDisciplines')
			),
			'sql'                     => "blob NULL"
		),
		'disable' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disable'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		)
	)
);

/**
 * Class tl_triathlon_results_competitions
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_triathlon_results_competitions extends Backend
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * List a competition
	 * @param array
	 * @return string
	 */
	public function listCompetition($row)
	{
		$strReturn = '<div class="tl_content_left' . ($row['disable'] ? ' disabled' : '') . '">'
				   . $row['name'];

		switch ($row['type'])
		{
			case 'relay'  : $strReturn .= '<span style="color:#b3b3b3; padding-left:5px;">' . $GLOBALS['TL_LANG']['TriathlonResultsManager']['competitionType']['relay'] . '</span>'; break;
			case 'league' : $strReturn .= '<span style="color:#b3b3b3; padding-left:5px;">' . $GLOBALS['TL_LANG']['TriathlonResultsManager']['league'][$row['league']] . '</span>'; break;
		}

		$arrPlainDisciplines = \TriathlonResultsManagerHelper::getPlainDisciplines(deserialize($row['disciplines']), $row['performanceEvaluation']);
		if (!empty($arrPlainDisciplines))
		{
			$strReturn .= ' (' . implode($GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines_delimiter'], $arrPlainDisciplines) . ')';
		}


		$objResult = \TriathlonResultsModel::findByPid($row['id']);
		if ($objResult == null)
		{
			$strReturn .= '<span class="tl_warn_no_child_elements">' . $GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['warn_no_results'] . '</span>';
		}

		return $strReturn . "</div>\n";
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
		if (!$this->User->hasAccess('tl_triathlon_results_competitions::disable', 'alexf'))
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
	 * Disable/enable a competition
	 * @param integer
	 * @param boolean
	 * @param \DataContainer
	 */
	public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
	{
		// Check permissions
		if (!$this->User->hasAccess('tl_triathlon_results_competitions::disable', 'alexf'))
		{
			$this->log('Not enough permissions to activate/deactivate results competition ID "'.$intId.'"', __METHOD__, TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$objVersions = new Versions('tl_triathlon_results_competitions', $intId);
		$objVersions->initialize();

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_triathlon_results_competitions']['fields']['disable']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_triathlon_results_competitions']['fields']['disable']['save_callback'] as $callback)
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
		$this->Database->prepare("UPDATE tl_triathlon_results_competitions SET tstamp=$time, disable='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
					   ->execute($intId);

		$objVersions->create();
		$this->log('A new version of record "tl_triathlon_results_competitions.id='.$intId.'" has been created'.$this->getParentEntries('tl_triathlon_results_competitions', $intId), __METHOD__, TL_GENERAL);
	}

	/**
	 * Get the columns for the disciplines.
	 * @return array
	 */
	public static function getDisciplineColumns()
	{
		$performanceEvaluation = "time";
		if (\Input::get('act') == "edit")
		{
			$objResultsCompetition = \TriathlonResultsCompetitionsModel::findByPk(\Input::get('id'));
			if ($objResultsCompetition != null)
			{
				$performanceEvaluation = $objResultsCompetition->performanceEvaluation;
			}

		}

		$arrDisciplineColumns = array
		(
			'discipline' => array
			(
				'label'         => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines_discipline'],
				'exclude'       => true,
				'inputType'     => 'select',
				'eval'          => array('mandatory'=>true,'includeBlankOption'=>true, 'style'=>'width: 250px;'),
				'options'       => array('swim', 'bike', 'run', 'others'),
				'reference'     => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines']
			),
			'discipline_freetext' => array
			(
				'label'         => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines_discipline_freetext'],
				'exclude'       => true,
				'inputType'     => 'text',
				'eval'          => array('style'=>'width: 250px;')
			)
		);

		if ($performanceEvaluation == 'distance' || $performanceEvaluation == 'laps')
		{
			$arrDisciplineColumns['time'] = array
			(
				'label'         => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines_time'],
				'exclude'       => true,
				'inputType'     => 'inputUnit',
				'options'       => array('h', 'min'),
				'eval'          => array('mandatory'=>true,'rgxp'=>'digit', 'style'=>'width: 100px;')
			);
		}
		else
		{
			$arrDisciplineColumns['distance'] = array
			(
				'label'         => &$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines_distance'],
				'exclude'       => true,
				'inputType'     => 'inputUnit',
				'options'       => array('km', 'm'),
				'eval'          => array('mandatory'=>true,'rgxp'=>'digit', 'style'=>'width: 100px;')
			);
		}

		return $arrDisciplineColumns;
	}

	/**
	 * Dynamically set the default competition disciplines
	 * @param mixed
	 * @param \DataContainer
	 * @return string
	 */
	public function setDefaultDisciplines($varValue, DataContainer $dc)
	{
		if ($dc->activeRecord->tstamp > 0)
		{
			return $varValue;
		}

		$objResultsReport = \TriathlonResultsReportsModel::findByPk($dc->activeRecord->pid);

		if ($objResultsReport != null && count($GLOBALS['TL_TRIATHLON_RESULTS_MANAGER']['disciplines'][$objResultsReport->eventType]) > 0)
		{
			$varValue = serialize($GLOBALS['TL_TRIATHLON_RESULTS_MANAGER']['disciplines'][$objResultsReport->eventType]);
		}
		return $varValue;
	}

}

?>