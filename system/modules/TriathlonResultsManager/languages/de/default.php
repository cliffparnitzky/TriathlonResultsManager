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
 * Misc text values
 */
$GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines_delimiter']         = " + ";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['relayStarter_delimiter']        = "<br/>";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['distance_format']               = "%s %s";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['discipline_distance_format']    = "%s: %s";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['place_format']                  = "%s./%s";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['time_format']                   = "%s:%s:%s h";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['starter_format']                = "%s %s";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['relayStarters_format']          = "%s (%s: %s)";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['relayStarters_format']          = "%s (%s: %s)";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['relayStarters_format_no_time']  = "%s (%s)";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['relayName_format']              = '<div class="relay_name">%s</div>';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['starter_freetext_format']       = '<span class="starter_freetext">%s</span>';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report_format']                 = 'gemeldet am %s von %s';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report_format_no_member']       = 'gemeldet am %s';

/**
 * Place tooltips
 */
$GLOBALS['TL_LANG']['TriathlonResultsManager']['place_overall']  = "%s. Gesamtplatz";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['place_agegroup'] = "%s. Alterklassenplatz";

/**
 * Event types
 */
$GLOBALS['TL_LANG']['TriathlonResultsManager']['eventType']['swim']      = "Schwimmen";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['eventType']['bike']      = "Radfahren";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['eventType']['run']       = "Laufen";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['eventType']['duathlon']  = "Duathlon";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['eventType']['triathlon'] = "Triathlon";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['eventType']['others']    = "Sonstiges";

/**
 * Disciplines
 */
$GLOBALS['TL_LANG']['TriathlonResultsManager']['competitionType']['none']   = "-";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['competitionType']['single'] = "Einzelstart";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['competitionType']['relay']  = "Staffel";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['competitionType']['league'] = "Ligarennen";

/**
 * Performance evaluation kinds
 */
$GLOBALS['TL_LANG']['TriathlonResultsManager']['competitionPerformanceEvaluation']['time']     = "Zeit";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['competitionPerformanceEvaluation']['distance'] = "Strecke";

/**
 * Rating types
 */
$GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType']['female']     = "Frauen";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType']['male']       = "Männer";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType']['mixed']      = "Mixed";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['ratingType']['others']     = "Sonstige";

/**
 * Leagues
 */
$GLOBALS['TL_LANG']['TriathlonResultsManager']['league']['triathlon']              = "Triathlon Liga";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['league']['triathlon_1_bundesliga'] = "1. Bundesliga";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['league']['triathlon_2_bundesliga'] = "2. Bundesliga";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['league']['triathlon_regionalliga'] = "Regionalliga";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['league']['triathlon_landesliga']   = "Landesliga";

/**
 * Disciplines
 */
$GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines']['swim']   = "Schwimmen";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines']['bike']   = "Radfahren";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines']['run']    = "Laufen";
$GLOBALS['TL_LANG']['TriathlonResultsManager']['disciplines']['others'] = "Sonstiges";

/**
 * Errors
 */
$GLOBALS['TL_LANG']['ERR']['timeValueIncorrect']                 = 'Der Wert "%s" ist nicht erlaubt! Es darf maximal "%s" eingegeben werden.';
$GLOBALS['TL_LANG']['ERR']['placeValueIncorrect']                = 'Der Platz "%s" muss kleiner/gleich der Gesamtanzahl "%s" sein.';
$GLOBALS['TL_LANG']['ERR']['placeStartersValueIncorrect']        = 'Die Gesamtanzahl "%s" muss größer/gleich dem Platz "%s" sein.';
$GLOBALS['TL_LANG']['ERR']['singleStarter_not_set']              = "Es ist kein Einzelstarter festgelegt.";
$GLOBALS['TL_LANG']['ERR']['relayStarter_not_set']               = "Es ist kein Staffelstarter festgelegt.";
$GLOBALS['TL_LANG']['ERR']['relayStarters_not_set']              = "Es sind keine Staffelstarter festgelegt.";
$GLOBALS['TL_LANG']['ERR']['relayDisciplinesStartersDifference'] = "Die Anzahl der Starter weicht von der Anzahl der Einzeldisziplinen ab.";

/**
 * Frontend modules
 */
$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['starters']      = 'Teilnehmer';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['time']          = 'Zeit';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['distance']      = 'Strecke';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['overallPlace']  = 'Platz Gesamt';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['thead']['ageGroupPlace'] = 'Platz Altersklasse';

/**
 * Report module
 */
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['event_header']                             = 'Datum und Name der Veranstaltung';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['input_date_day_title']                     = 'Datum der Veranstaltung: Tag';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['input_date_month_title']                   = 'Datum der Veranstaltung: Monat';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['input_date_year_title']                    = 'Datum der Veranstaltung: Jahr';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['select_eventName_template_title']          = 'Vorlagenauswahl für den Veranstaltungsnamen, dieser kann noch angepasst werden';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['select_eventName_template_first_option']   = '>>> Vorlage auswählen';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['input_eventName_title']                    = 'Name der Veranstaltung';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['competition_header']                       = 'Wettkämpfe';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_add_competition_title']             = 'Wettkampf hinzufügen';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_del_competition_title']             = 'Letzten Wettkampf löschen';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['women_header']                             = 'Frauen';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_add_woman_title']                   = 'Frau hinzufügen';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_del_woman_title']                   = 'Letzte Frau löschen';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['men_header']                               = 'Männer';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_add_man_title']                     = 'Mann hinzufügen';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['button_del_man_title']                     = 'Letzten Mann löschen';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['select_competition_template_title']        = 'Vorlagenauswahl für den Wettkampfnamen, dieser kann noch angepasst werden';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['select_competition_template_first_option'] = '>>> Vorlage auswählen';
$GLOBALS['TL_LANG']['TriathlonResultsManager']['report']['select_competition_template_optgroup']     = 'Vorlagenauswahl ...';


?>