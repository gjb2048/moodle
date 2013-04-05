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
 * Theme library functions.
 *
 * @package    theme
 * @subpackage afterburner
 * @copyright  2011 Mary Evans
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function afterburner_process_css($css, $theme) {
    global $CFG;

    // Set the background image for the logo.
    if (!empty($theme->settings->logo)) {
        $cache = cache::make('theme_afterburner', 'settings');
        if (!$logo = $cache->get('logo')) {
            require_once($CFG->libdir.'/adminlib.php');
            $filename = get_config('theme_afterburner','logo'); // 'theme_afterburner/logo' from settings.php.
            $context = context_system::instance();
            $logo = admin_setting_configfilepicker::get_file($filename, $context, 'theme_afterburner', 'logo');
            $cache->set('logo', $logo);
        }
    } else {
        $logo = null;
    }
    $css = afterburner_set_logo($css, $logo);

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = afterburner_set_customcss($css, $customcss);

    return $css;
}

function afterburner_set_logo($css, $logo) {
    global $OUTPUT;
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = $OUTPUT->pix_url('images/logo', 'theme');
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function afterburner_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function theme_afterburner_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options=array()) {
    if ($filearea === 'settings' and $context->contextlevel == CONTEXT_SYSTEM) {
        array_shift($args); // ignore revision - designed to prevent caching problems only

        $fs = get_file_storage();
        $relativepath = implode('/', $args);

        $fullpath = rtrim("/$context->id/theme_afterburner/settings/0/$relativepath", '/');
        if ($file = $fs->get_file_by_hash(sha1($fullpath))) {
            send_stored_file($file, 86400, 0, $forcedownload, $options);
        }
        // file_send_public_settings_file('theme_afterburner', 'settings', $args, $forcedownload, $options);
    }
    return false;
}
