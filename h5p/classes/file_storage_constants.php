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
 * Class \core_h5p\file_storage_constants.
 *
 * @package    core_h5p
 * @copyright  2019 Victor Deniz <victor@moodle.com>, base on code by Joubel AS
 * @copyright  2023 G J Barnard {@link https://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_h5p;

/**
 * Class to store H5P file storage constants.
 *
 * Allows use of constants without needing to resolve the Moodle\H5PFileStorage interface
 * which is unknown to the autoloader unless H5P dependencies are loaded, which is not required
 * just to use them.
 *
 * @package    core_h5p
 * @copyright  2019 Victor Deniz <victor@moodle.com>
 * @copyright  2023 G J Barnard {@link https://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class file_storage_constants {
    /** The component for H5P. */
    public const COMPONENT   = 'core_h5p';
    /** The library file area. */
    public const LIBRARY_FILEAREA = 'libraries';
    /** The content file area */
    public const CONTENT_FILEAREA = 'content';
    /** The cached assest file area. */
    public const CACHED_ASSETS_FILEAREA = 'cachedassets';
    /** The export file area */
    public const EXPORT_FILEAREA = 'export';
    /** The export css file area */
    public const CSS_FILEAREA = 'css';
    /** The icon filename */
    public const ICON_FILENAME = 'icon.svg';
}
