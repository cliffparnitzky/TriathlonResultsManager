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
$GLOBALS['TL_LANG']['tl_triathlon_results']['singleStarter']                    = array('Einzelstarter', 'Wählen Sie den Einzelstarter aus. Wenn der gewünschte Einzelstarter nicht auswählbar ist lassen Sie das Feld leer und tragen den Namen im Feld \'Einzelstarter Freitext\' ein.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['singleStarter_freetext']           = array('Einzelstarter Freitext', 'Geben Sie den Namen des Einzelstarters an, wenn Sie das Feld \'Einzelstarter\' leer gelassen haben.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter']                     = array('Staffelstarter', 'Wählen Sie die Staffelstarter für dieses Ergebnis aus und geben Sie die Disziplin in der Sie gestartet sind an, sowie die Zeit, die sie für die Diziplin benötigt haben.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_discipline']          = array('Disziplin', 'Geben Sie die Disziplin an. Wenn die gewünschte Disziplin nicht auswählbar ist verwenden Sie \'Sonstiges\' und tragen die Bezeichnung dann im Feld \'Disziplin Freitext\' ein.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_discipline_freetext'] = array('Disziplin Freitext', 'Geben Sie die Bezeichnung der Disziplin an, wenn Sie als Disziplin \'Sonstiges\' gewählt haben.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_starter']             = array('Starter', 'Wählen Sie den Starter aus. Wenn der gewünschte Starter nicht auswählbar ist lassen Sie das Feld leer und tragen den Namen im Feld \'Starter Freitext\' ein.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_starter_freetext']    = array('Starter Freitext', 'Geben Sie den Namen des Starters an, wenn Sie das Feld \'Starter\' leer gelassen haben.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_timeHours']           = array('Zeit: h', 'Geben Sie die Stunden der Zeit an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_timeMinutes']         = array('Zeit: min', 'Geben Sie die Minuten der Zeit an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStarter_timeSeconds']         = array('Zeit: sek', 'Geben Sie die Sekunden der Zeit an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['relayRatingType']                  = array('Wertungstyp der Staffel', 'Geben Sie den Wertungstyp der Staffel an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['relayName']                        = array('Staffelname', 'Geben Sie den Namen der Staffel an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['timeHours']                        = array('Stunden', 'Geben Sie die Stunden der Gesamtzeit an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['timeMinutes']                      = array('Minuten', 'Geben Sie die Minuten der Gesamtzeit an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['timeSeconds']                      = array('Sekunden', 'Geben Sie die Sekunden der Gesamtzeit an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['distance']                         = array('Strecke', 'Geben Sie die Gesamtstrecke an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['overallPlace']                     = array('Platz im Gesamtklassement', 'Geben Sie die Platzierung im Gesamtklassement pro Wertungstyp (Männer, Frauen, Mixed) an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['overallStarters']                  = array('Anzahl Teilnehmer im Gesamtklassement', 'Geben Sie die Anzahl der Teilnehmer im Gesamtklassement pro Wertungstyp (Männer, Frauen, Mixed) an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['ageGroupPlace']                    = array('Platz in der Altersklasse', 'Geben Sie die Platzierung in der Altersklasse an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['ageGroupStarters']                 = array('Anzahl Teilnehmer in der Altersklasse', 'Geben Sie die Anzahl der Teilnehmer in der Altersklasse an.');
$GLOBALS['TL_LANG']['tl_triathlon_results']['disable']                          = array('Deaktivieren', 'Das Ergebnis deaktivieren, um eine Ausgabe im Frontend zu unterbinden.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_triathlon_results']['singleStart_legend']  = 'Einzelstart';
$GLOBALS['TL_LANG']['tl_triathlon_results']['relayStart_legend']   = 'Staffelstart';
$GLOBALS['TL_LANG']['tl_triathlon_results']['time_legend']         = 'Gesamtzeit';
$GLOBALS['TL_LANG']['tl_triathlon_results']['distance_legend']     = 'Gesamtstrecke';
$GLOBALS['TL_LANG']['tl_triathlon_results']['place_legend']        = 'Platzierung';
$GLOBALS['TL_LANG']['tl_triathlon_results']['deactivation_legend'] = 'Deaktivierung';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_triathlon_results']['new']    = array('Neues Ergebnis', 'Ein neues Ergebnis anlegen');
$GLOBALS['TL_LANG']['tl_triathlon_results']['show']   = array('Details des Ergebnis', 'Details des Ergebnis ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_triathlon_results']['edit']   = array('Ergebnis bearbeiten', 'Ergebnis ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_triathlon_results']['cut']    = array('Ergebnis verschieben', 'Ergebnis ID %s verschieben');
$GLOBALS['TL_LANG']['tl_triathlon_results']['delete'] = array('Ergebnis löschen', 'Ergebnis ID %s löschen');
$GLOBALS['TL_LANG']['tl_triathlon_results']['toggle'] = array('Ergebnis aktivieren/deaktivieren', 'Ergebnis ID %s aktivieren/deaktivieren');

/**
 * Group support
 */
$GLOBALS['TL_LANG']['tl_triathlon_results']['group_timeHours']   = "ab %s h";
$GLOBALS['TL_LANG']['tl_triathlon_results']['group_timeMinutes'] = "ab %s min";

?>