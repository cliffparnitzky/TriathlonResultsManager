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
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterReportEventDateStart']   = array('Filterung ab Veranstaltungsdatum', 'Wählen Sie das Veranstaltungsdatum aus, ab dem Ergebnismeldungen angezeigt werden sollen. Lassen Sie das Feld leer, wenn der Start nicht begrenzt sein soll.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterReportEventDateEnd']     = array('Filterung bis Veranstaltungsdatum', 'Wählen Sie das Veranstaltungsdatum aus, bis zu dem Ergebnismeldungen angezeigt werden sollen. Lassen Sie das Feld leer, wenn das Ende nicht begrenzt sein soll.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterReportEventType']        = array('Filterung nach Veranstaltungstypen', 'Wählen Sie die Veranstaltungstypen aus, von denen die Ergebnismeldungen angezeigt werden sollen. Lassen Sie das Feld leer, um keine Begrenzung auf den Veranstaltungstypen festzulegen.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterReportEvent']            = array('Filterung nach Veranstaltungen', 'Wählen Sie die Veranstaltungen aus, von denen die Ergebnisse angezeigt werden sollen. Lassen Sie das Feld leer, um keine Begrenzung auf die Veranstaltung festzulegen.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterReportEventInternal']    = array('Filterung nach internen Veranstaltungen', 'Wählen Sie ob Ergebnisse von internen Veranstaltungen angezeigt werden sollen.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterCompetitionType']        = array('Filterung nach Wettkampftyp', 'Wählen Sie den Wettkampftyp aus, von dem die Ergebnisse angezeigt werden sollen. Lassen Sie das Feld leer, um keine Begrenzung auf den Wettkampftyp festzulegen.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterCompetitionLeague']      = array('Filterung nach Liga', 'Wählen Sie die Liga aus, von der die Ergebnisse angezeigt werden sollen. Lassen Sie das Feld leer, um keine Begrenzung auf die Liga festzulegen.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterResultSingleRatingType'] = array('Filterung nach Wertungstyp der Einzelstarter', 'Wählen Sie den Wertungstyp der Einzelstarter aus, von dem die Ergebnisse angezeigt werden sollen. Lassen Sie das Feld leer, um keine Begrenzung auf den Wertungstyp der Einzelstarter festzulegen.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterResultRelayRatingType']  = array('Filterung nach Wertungstyp der Staffeln', 'Wählen Sie den Wertungstyp der Staffeln aus, von dem die Ergebnisse angezeigt werden sollen. Lassen Sie das Feld leer, um keine Begrenzung auf den Wertungstyp der Staffeln festzulegen.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterMemberGroups']           = array('Filterung erlaubter Mitgliedergruppen', 'Wählen Sie die Mitgliedergruppen aus, für welche im Frontend Mitglieder zur Ergebnismeldungen zur Verfügung stehen sollen.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortReportDateField']          = array('Sortierung nach Datumswert der Ergebnismeldungen', 'Wählen Sie das Feld aus, nach dem sortiert werden soll.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortReportDateDirection']      = array('Sortierrichtung des Datumswerts', 'Wählen Sie die Richtung für die Sortierung des Datumswerts aus.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortResultRatingTypeOrder']    = array('Sortierung der Wertungstypen', 'Geben Sie die Sortierung der Wertungstypen an. Alle Checkboxen müssen selektiert sein. Ändern Sie die Reihenfolge durch verschieben der Checkboxen.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerTplUseIconsForDisciplines']    = array('Icons für Disziplinen verwenden', 'Geben Sie an, ob die Diziplinen als Icons dargestellt werden sollen.');
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerTplUseDefaultCss']             = array('Default CSS verwenden', 'Geben Sie an, ob das Default CSS verwendet werden soll.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerFilterSort_legend'] = 'Filterung und Sortierung der Ausgabe';

/**
 * Options
 */
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortReportDateFields']['eventDate']  = "Veranstaltungsdatum";
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortReportDateFields']['reportDate'] = "Meldungsdatum";
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortReportDateDirections']['ASC']    = "Aufsteigend (neuestes Datum am Ende)";
$GLOBALS['TL_LANG']['tl_module']['triathlonResultsManagerSortReportDateDirections']['DESC']   = "Absteigend (neuestes Datum am Anfang)";

?>