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
 * @copyright  2013 Gareth J Barnard
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Gets file from the provided settings.
 *
 * @param string $theme theme name with component prefix, i.e. 'theme_afterburner' as established in theme
                        settings.php for admin_setting_configfilepicker.
 * @param string $setting setting name, i.e. 'logo' as established in theme settings.php for admin_setting_configfilepicker.
 * @return file null if file not found, file if found.
 */
function theme_get_file_from_setting($theme, $setting) {
    $file = null;
    if ($filename = get_config($theme, $setting)) {
        $context = context_system::instance();
        $thefile = moodle_url::make_pluginfile_url($context->id, $theme, $theme.'_'.$setting, 0, '/', $filename);
        echo $thefile->out(false);
        $file = $thefile->out(false);
    }
    return $file;
}

/**
 * Serves the stored file from the provided settings.
 *
 * @param stdClass $course course object
 * @param stdClass $cm course module object
 * @param stdClass $context context object
 * @param string $filearea file area
 * @param array $args extra arguments
 * @param bool $forcedownload whether or not force download
 * @param string $theme theme name with component prefix, i.e. 'theme_afterburner'.
 * @param array $options additional options affecting the file serving
 * @return bool false if file not found, true if found.
 */
function theme_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, $theme, array $options=array()) {
    global $CFG;
    require_once("$CFG->libdir/filelib.php");

    if ($context->contextlevel == CONTEXT_SYSTEM) {
        array_shift($args); // ignore revision - designed to prevent caching problems only

        $fs = get_file_storage();
        $relativepath = implode('/', $args);

        $fullpath = "/{$context->id}/{$theme}/{$filearea}/0/{$relativepath}";
        $fullpath = rtrim($fullpath, '/');
        if ($file = $fs->get_file_by_hash(sha1($fullpath))) {
            send_stored_file($file, 86400, 0, $forcedownload, $options);
            return true;
        } else {
            send_file_not_found();
            return false;
        }
    } else {
        send_file_not_found();
        return false;
    }
}