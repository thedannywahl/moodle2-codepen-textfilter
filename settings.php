<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * plugin details
 *
 * @package		filter
 * @subpackage	codepen
 * @copyright	2014 Danny Wahl www.iyWare.com
 * @license		http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    $settings->add(new admin_setting_heading('filter_codepen/info',
    		get_string('settingheading', 'filter_codepen'),
    		get_string('settingheading_info', 'filter_codepen')));
    
    $settings->add(new admin_setting_configmulticheckbox('filter_codepen/formats',
            get_string('settingformats', 'filter_codepen'),
            get_string('settingformats_desc', 'filter_codepen'),
            array(FORMAT_HTML => 1, FORMAT_MARKDOWN => 1, FORMAT_MOODLE => 1), format_text_menu()));
            
    $settings->add(new admin_setting_configtext('filter_codepen/height',
    		get_string('settingheight', 'filter_codepen'),
    		get_string('settingheight_desc', 'filter_codepen'),
    		'268',
    		PARAM_INT,
    		3));
    
    $settings->add(new admin_setting_heading('filter_codepen/credits',
    		get_string('settingcredits', 'filter_codepen'),
    		get_string('settingcredits_desc', 'filter_codepen')));
}