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
 * Theme selector block.
 *
 * @package    block_theme_selector
 * @copyright  &copy; 2015-onwards G J Barnard in respect to modifications of original code:
 *             https://github.com/johntron/moodle-theme-selector-block by John Tron, see:
 *             https://github.com/johntron/moodle-theme-selector-block/issues/1.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// phpcs:disable moodle.Files.LangFilesOrdering

$string['pluginname'] = 'Theme selector';
$string['by'] = 'by';
$string['changetheme'] = 'Change theme:';
$string['createwindow'] = 'Create window';
$string['resetthemecache'] = 'Reset theme cache';
$string['theme_selector:addinstance'] = 'Add a new Theme Selector block';
$string['theme_selector:myaddinstance'] = 'Add a new Theme Selector block to Dashboard';
$string['windowsize'] = 'Window size:';

// Settings.
$string['siteconfigwarning'] = 'Only users with the \'moodle/site:config\' capability can change themes.  Or ask a user who has the capability to enable \'URL Switching\' for the block.';
$string['aliasedtheme'] = 'Alias to use for theme {$a}';
$string['aliasedtheme_desc'] = 'If text is entered here it will be used instead of the theme\'s name in the selector instead';
$string['excludedthemes'] = 'Excluded themes';
$string['excludedthemes_desc'] = 'Excluded themes will not be available to select.';
$string['urlswitch'] = 'URL switching';
$string['urlswitch_desc'] = 'Switch using the URL, requires the core theme \'allowthemechangeonurl\' setting to be set.';
$string['urlswitchwarning'] = 'URL switching setting not configured, check block installation.';
$string['urlswitchurlwarning'] = 'The core theme \'allowthemechangeonurl\' setting needs to be set.';
$string['windowinformation'] = 'Window information';
$string['windowinformation_desc'] = 'Display information about the current inner window size and allow creation of a new window of the given dimensions.';
