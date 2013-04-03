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
    $logo = null;
    if (!empty($theme->settings->logo)) {
        if ($logourl = get_config('theme_afterburner', 'logo')) { // ... 'theme_afterburner/logo' from settings.php.
            $logofile = moodle_url::make_file_url("$CFG->httpswwwroot/pluginfile.php", $logourl);
            $logo = $logofile->out(false);
        }
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
