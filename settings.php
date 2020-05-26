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
 * @package    block
 * @subpackage theme_selector
 * @copyright  &copy; 2015-onwards G J Barnard in respect to modifications of original code:
 *             https://github.com/johntron/moodle-theme-selector-block by John Tron, see:
 *             https://github.com/johntron/moodle-theme-selector-block/issues/1.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    /* URL Switching - 1 = no, 2 = yes. */
    $name = 'block_theme_selector_urlswitch';
    $title = get_string('urlswitch', 'block_theme_selector');
    $description = get_string('urlswitch_desc', 'block_theme_selector');
    $default = 2;
    $choices = array(
        1 => new lang_string('no'),   // No.
        2 => new lang_string('yes')   // Yes.
    );
    $settings->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    /* Inner window information - 1 = no, 2 = yes. */
    $name = 'block_theme_selector_window';
    $title = get_string('windowinformation', 'block_theme_selector');
    $description = get_string('windowinformation_desc', 'block_theme_selector');
    $default = 1;
    $choices = array(
        1 => new lang_string('no'),   // No.
        2 => new lang_string('yes')   // Yes.
    );
    $settings->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

    $themes = core_component::get_plugin_list('theme');
    $options = array();
    foreach ($themes as $theme => $themedir) {
        $options[$theme] = ucfirst(get_string('pluginname', 'theme_' . $theme));
    }
    $settings->add(new admin_setting_configmultiselect('block_theme_selector_excludedthemes',
            get_string('excludedthemes', 'block_theme_selector'), get_string('excludedthemes_desc', 'block_theme_selector'),
            '', $options));

    foreach ($themes as $theme => $themedir) {
        $settings->add(new admin_setting_configtext("block_theme_selector_aliasedtheme_$theme",
                get_string('aliasedtheme', 'block_theme_selector', $theme), get_string('aliasedtheme_desc', 'block_theme_selector'), '',
                PARAM_TEXT));
    }
}
