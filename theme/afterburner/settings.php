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
 * Theme settings.
 *
 * @package    theme
 * @subpackage afterburner
 * @copyright  2011 Mary Evans
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // Logo file setting.
    $name = 'theme_afterburner/logo';
    $title = get_string('logo', 'theme_afterburner');
    $description = get_string('logodesc', 'theme_afterburner');
    $options = array('accepted_types' => 'image');
    $setting = new admin_setting_configfilepicker($name, $title, $description, null, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Foot note setting
    $name = 'theme_afterburner/footnote';
    $title = get_string('footnote', 'theme_afterburner');
    $description = get_string('footnotedesc', 'theme_afterburner');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settings->add($setting);

    // Custom CSS file
    $name = 'theme_afterburner/customcss';
    $title = get_string('customcss', 'theme_afterburner');
    $description = get_string('customcssdesc', 'theme_afterburner');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $settings->add($setting);
}