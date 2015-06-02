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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['name']                            = array('Wettkampfname', 'Geben Sie den Namen des Wettkampfs an.');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['type']                            = array('Wettkampftyp', 'Geben Sie den Typ des Wettkampfs an.');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['performanceEvaluation']           = array('Leistungsbewertung', 'Geben Sie die Art der Leistungsbewertung des Wettkampfs an.');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['league']                          = array('Liga', 'Geben Sie die Liga an.');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['ageGroupRating']                  = array('Alterklassenwertung', 'Geben Sie an, ob es eine Alterklassenwertung gibt.');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines']                     = array('Einzeldisziplinen', 'Geben Sie die Disziplinen des Wettkampfs an. Sortieren Sie die Disziplinen nach der Reihenfolge wie sie stattgefunden haben.');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines_discipline']          = array('Disziplin', 'Geben Sie die Disziplin an. Wenn die gewünschte Disziplin nicht auswählbar ist verwenden Sie \'Sonstiges\' und tragen die Bezeichnung dann im Feld \'Disziplin Freitext\' ein.');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines_discipline_freetext'] = array('Disziplin Freitext', 'Geben Sie die Bezeichnung der Disziplin an, wenn Sie als Disziplin \'Sonstiges\' gewählt haben.');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines_distance']            = array('Strecke', 'Geben Sie die Strecke an.');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines_time']                = array('Zeit', 'Geben Sie die Zeit an.');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disable']                         = array('Deaktivieren', 'Den Wettkampf deaktivieren, um eine Ausgabe im Frontend zu unterbinden.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['competition_legend']  = 'Wettkampf';
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['disciplines_legend']  = 'Disziplinen';
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['deactivation_legend'] = 'Deaktivierung';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['new']        = array('Neuer Wettkampf', 'Einen neuen Wettkampf anlegen');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['show']       = array('Details des Wettkampfs', 'Details des Wettkampfs ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['edit']       = array('Wettkampf bearbeiten', 'Wettkampf ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['editheader'] = array('Wettkampf-Einstellungen bearbeiten', 'Einstellungen des Wettkampfs ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['cut']        = array('Wettkampf verschieben', 'Wettkampf ID %s verschieben');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['copy']       = array('Wettkampf duplizieren', 'Wettkampf ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['delete']     = array('Wettkampf löschen', 'Wettkampf ID %s löschen');
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['toggle']     = array('Wettkampf aktivieren/deaktivieren', 'Wettkampf ID %s aktivieren/deaktivieren');

/**
 * Messages
 */
$GLOBALS['TL_LANG']['tl_triathlon_results_competitions']['warn_no_results'] = "Keine Ergebnisse vorhanden";

?>