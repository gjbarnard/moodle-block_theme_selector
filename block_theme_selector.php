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

        global $COURSE, $CFG;
        $coursecontext = context_course::instance($COURSE->id);
        $this->content = new stdClass();
        $this->content->text = '';
        if (!empty($CFG->block_theme_selector_urlswitch)) {

            $allowthemechangeonurl = get_config('core', 'allowthemechangeonurl');
            if (((has_capability('moodle/site:config', $coursecontext)) && ($CFG->block_theme_selector_urlswitch == 1)) ||
                (($CFG->block_theme_selector_urlswitch == 2) && ($allowthemechangeonurl))) {

                $selectdataarray = ['data-sesskey' => sesskey(), 'data-device' => 'default',
                    'data-urlswitch' => $CFG->block_theme_selector_urlswitch, ];
                if ($CFG->block_theme_selector_urlswitch == 2) {
                    $pageurl = $this->page->url->out(false);
                    $selectdataarray['data-url'] = $pageurl;
                    $selectdataarray['data-urlparams'] = (strpos($pageurl, '?') === false) ? 1 : 2;
                }
                $selectdataarray['aria-labelledby'] = 'themeselectorselectlabel';
                $selectdataarray['id'] = 'themeselectorselect';
                $this->page->requires->js_call_amd('block_theme_selector/block_theme_selector', 'init', []);

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
                $this->content->text .= html_writer::start_tag('form', ['class' => 'themeselectorselect']);
                $this->content->text .= html_writer::tag('label', get_string('changetheme', 'block_theme_selector'),
                    ['id' => 'themeselectorselectlabel', 'for' => 'themeselectorselect']);
                $this->content->text .= html_writer::select($options, 'choose', $current, false, $selectdataarray);
                $this->content->text .= html_writer::end_tag('form');

                if (has_capability('moodle/site:config', $coursecontext)) {
                    // Add a button to reset theme caches.
                    $this->content->text .= html_writer::start_tag('form', ['action' => new url('/theme/index.php'),
                        'method' => 'post', 'class' => 'themeselectorreset', ]);
                    $this->content->text .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'sesskey',
                        'value' => sesskey(), ]);
                    $this->content->text .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'reset',
                        'value' => '1', ]);
                    $this->content->text .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'device',
                        'value' => 'default', ]);
                    $this->content->text .= html_writer::tag('button', get_string('resetthemecache', 'block_theme_selector'),
                        ['type' => 'submit']);
                    $this->content->text .= html_writer::end_tag('form');
                }
                if ($CFG->block_theme_selector_window == 2) {
                    $this->content->text .= html_writer::start_tag('form', ['class' => 'themeselectorwindow']);
                    $this->content->text .= html_writer::tag('label', get_string('windowsize', 'block_theme_selector'),
                        ['id' => 'themeselectorwindowlabel', 'for' => 'themeselectorwindowwidth']);
                    $this->content->text .= html_writer::empty_tag('input', ['type' => 'number',
                        'id' => 'themeselectorwindowwidth', 'name' => 'themeselectorwindowwidth',
                        'aria-labelledby' => 'themeselectorwindowlabel',
                        'min' => '1', 'max' => '9999', ]);
                    $this->content->text .= html_writer::tag('span', get_string('by', 'block_theme_selector'));
                    $this->content->text .= html_writer::empty_tag('input', ['type' => 'number',
                        'id' => 'themeselectorwindowheight', 'name' => 'themeselectorwindowheight',
                        'aria-labelledby' => 'themeselectorwindowlabel',
                        'min' => '1', 'max' => '9999', ]);
                    $this->content->text .= html_writer::tag('button', get_string('createwindow', 'block_theme_selector'),
                        ['id' => 'themeselectorcreatewindow']);
                    $this->content->text .= html_writer::end_tag('form');
                }
            } else if ($CFG->block_theme_selector_urlswitch == 1) {
                $this->content->text .= html_writer::tag('p', get_string('siteconfigwarning', 'block_theme_selector'));
            } else if (($CFG->block_theme_selector_urlswitch == 2) && (!$allowthemechangeonurl)) {
                $this->content->text .= html_writer::tag('p', get_string('urlswitchurlwarning', 'block_theme_selector'));
            }
        } else {
            $this->content->text .= html_writer::tag('p', get_string('urlswitchwarning', 'block_theme_selector'));
        }

        return $this->content;
    }
}
