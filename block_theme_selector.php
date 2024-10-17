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

use core\output\html_writer;
use core\url;

/**
 * Theme selector block class.
 */
class block_theme_selector extends block_base {

    /**
     * Initialise the block.
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_theme_selector');
    }

    /**
     * States if the block has a configuration.
     *
     * @return boolean success.
     */
    public function has_config() {
        return true;
    }

    /**
     * States if the block can hide the header.
     *
     * @return boolean success.
     */
    public function hide_header() {
        return false;
    }

    /**
     * Gets the content of the block.
     *
     * @return string Markup.
     */
    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        global $CFG, $COURSE, $OUTPUT;
        $coursecontext = context_course::instance($COURSE->id);
        $this->content = new stdClass();
        $this->content->text = '';

        $templatecontext = new stdClass();

        if (!empty($CFG->block_theme_selector_urlswitch)) {
            $templatecontext->urlswitchset = true;

            $allowthemechangeonurl = get_config('core', 'allowthemechangeonurl');
            if (((has_capability('moodle/site:config', $coursecontext)) && ($CFG->block_theme_selector_urlswitch == 1)) ||
                (($CFG->block_theme_selector_urlswitch == 2) && ($allowthemechangeonurl))) {

                $templatecontext->themeselect = true;

                $selectdataarray = ['data-sesskey' => sesskey(), 'data-device' => 'default',
                    'data-urlswitch' => $CFG->block_theme_selector_urlswitch, ];
                if ($CFG->block_theme_selector_urlswitch == 2) {
                    $pageurl = $this->page->url->out(false);
                    $selectdataarray['data-url'] = $pageurl;
                    $selectdataarray['data-urlparams'] = (strpos($pageurl, '?') === false) ? 1 : 2;
                }
                $selectdataarray['aria-labelledby'] = 'themeselectorselectlabel';
                $selectdataarray['id'] = 'themeselectorselect';

                // Add a dropdown to switch themes.
                if (!empty($CFG->block_theme_selector_excludedthemes)) {
                    $excludedthemes = explode(',', $CFG->block_theme_selector_excludedthemes);
                } else {
                    $excludedthemes = [];
                }
                $themes = core_component::get_plugin_list('theme');
                $options = [];
                foreach ($themes as $theme => $themedir) {
                    if (in_array($theme, $excludedthemes)) {
                        continue;
                    }
                    if (!empty($CFG->{"block_theme_selector_aliasedtheme_$theme"})) {
                        $options[$theme] = $CFG->{"block_theme_selector_aliasedtheme_$theme"};
                    } else {
                        $options[$theme] = ucfirst(get_string('pluginname', 'theme_' . $theme));
                    }
                }
                if ($CFG->block_theme_selector_urlswitch == 1) {
                    $current = core_useragent::get_device_type_theme('default');
                } else {
                    $current = $this->page->theme->name;
                }

                $templatecontext->themeselect = html_writer::select($options, 'choose', $current, false, $selectdataarray);
                if (has_capability('moodle/site:config', $coursecontext)) {
                    // Add a button to reset theme caches.
                    $templatecontext->reseturl = new url('/theme/index.php');
                    $templatecontext->resetsesskey = sesskey();
                }
                if ($CFG->block_theme_selector_window == 2) {
                    $templatecontext->themeselectorwindowsize = true;
                }
            } else if ($CFG->block_theme_selector_urlswitch == 1) {
                $templatecontext->siteconfigwarning = true;
            } else if (($CFG->block_theme_selector_urlswitch == 2) && (!$allowthemechangeonurl)) {
                $templatecontext->urlswitchurlwarning = true;
            }
        } else {
            $templatecontext->urlswitchset = false;
        }

        $this->content->text = $OUTPUT->render_from_template('block_theme_selector/theme_selector', $templatecontext);

        return $this->content;
    }
}
