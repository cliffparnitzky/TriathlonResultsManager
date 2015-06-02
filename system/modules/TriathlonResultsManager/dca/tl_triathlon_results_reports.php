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
 * Table tl_triathlon_results_reports
 */
$GLOBALS['TL_DCA']['tl_triathlon_results_reports'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'           => 'Table',
		'ctable'                  => array('tl_triathlon_results_competitions'),
		'switchToEdit'            => true,
		'enableVersioning'        => true,
		'notSortable'             => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array (
			'mode'                    => 2,
			'fields'                  => array('reportDate DESC'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                => array('eventDate', 'eventName'),
			'format'                => '%s - %s',
			'label_callback'        => array('tl_triathlon_results_reports', 'addIcon')
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
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['edit'],
				'href'                => 'table=tl_triathlon_results_competitions',
				'icon'                => 'edit.gif'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('tl_triathlon_results_reports', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__' => array(),
		'default'      => '{event_legend},eventDate,eventType,eventName;{report_legend},reportDate,reportMember;{deactivation_legend},disable'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'eventDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['eventDate'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard', 'doNotCopy'=>true),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'eventType' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['eventType'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options'                 => array('swim', 'bike', 'run', 'duathlon', 'triathlon', 'others'),
			'reference'               => &$GLOBALS['TL_LANG']['TriathlonResultsManager']['eventType'],
			'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'eventName' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['eventName'],
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>512, 'tl_class'=>'clr long'),
			'sql'                     => "varchar(512) NOT NULL default ''"
		),
		'reportDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['reportDate'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'default'                 => time(),
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard', 'doNotCopy'=>true),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'reportMember' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['reportMember'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_member.CONCAT(firstname, " ", lastname)',
			'eval'                    => array('chosen'=>true, 'mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50', 'doNotCopy'=>true),
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'hasOne', 'load'=>'eager')
		),
		'disable' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_triathlon_results_reports']['disable'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		)
	)
);

/**
 * Class tl_triathlon_results_reports
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_triathlon_results_reports extends Backend
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
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @param \DataContainer
	 * @param array
	 * @return string
	 */
	public function addIcon($row, $label, DataContainer $dc, $args)
	{
		$image = 'type_' . $row['eventType'];

		if ($row['disable'])
		{
			$image .= '_';
		}
		
		$objResultsCompetition = \TriathlonResultsCompetitionsModel::findByPid($row['id']);
		if ($objResultsCompetition == null)
		{
			$label .= '<span class="tl_warn_no_child_elements">' . $GLOBALS['TL_LANG']['tl_triathlon_results_reports']['warn_no_competitions'] . '</span>';
		}

		return sprintf('<div class="list_icon" style="background-image:url(\'system/modules/TriathlonResultsManager/assets/%s.png\')">%s</div>', $image, $label);
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
		if (!$this->User->hasAccess('tl_triathlon_results_reports::disable', 'alexf'))
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
	 * Disable/enable a report
	 * @param integer
	 * @param boolean
	 * @param \DataContainer
	 */
	public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
	{
		// Check permissions
		if (!$this->User->hasAccess('tl_triathlon_results_reports::disable', 'alexf'))
		{
			$this->log('Not enough permissions to activate/deactivate results report ID "'.$intId.'"', __METHOD__, TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$objVersions = new Versions('tl_triathlon_results_reports', $intId);
		$objVersions->initialize();

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_triathlon_results_reports']['fields']['disable']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_triathlon_results_reports']['fields']['disable']['save_callback'] as $callback)
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
		$this->Database->prepare("UPDATE tl_triathlon_results_reports SET tstamp=$time, disable='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
					   ->execute($intId);

		$objVersions->create();
		$this->log('A new version of record "tl_triathlon_results_reports.id='.$intId.'" has been created'.$this->getParentEntries('tl_triathlon_results_reports', $intId), __METHOD__, TL_GENERAL);
	}
}

?>