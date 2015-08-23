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
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

class block_theme_selector extends block_base {

    public function init() {
        $this->title = get_string('pluginname', 'block_theme_selector');
    }

    function has_config() {
        return true;
    }

    public function hide_header() {
        return false;
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        global $COURSE, $CFG;
        $coursecontext = context_course::instance($COURSE->id);
        $this->content = new stdClass();
        $this->content->text = '';
        if (!empty($CFG->block_theme_selector_urlswitch)) {
            $selectdataarray = array('data-sesskey' => sesskey(), 'data-device' => 'default', 'data-urlswitch' => $CFG->block_theme_selector_urlswitch);
            if ($CFG->block_theme_selector_urlswitch == 2) {
                $pageurl = $this->page->url->out(false);
                $selectdataarray['data-url'] = $pageurl;
                $selectdataarray['data-urlparams'] = (strpos($pageurl, '?') === false) ? 1 : 2;
                $allowthemechangeonurl = get_config('core', 'allowthemechangeonurl');
            }
            $this->page->requires->js_call_amd('block_theme_selector/block_theme_selector', 'init', array());

            if (((has_capability('moodle/site:config', $coursecontext)) && ($CFG->block_theme_selector_urlswitch == 1)) ||
                (($CFG->block_theme_selector_urlswitch == 2) && ($allowthemechangeonurl))) {
                // Add a dropdown to switch themes.
                $themes = core_component::get_plugin_list('theme');
                $options = array();
                foreach($themes as $theme => $themedir) {
                    $options[$theme] = ucfirst($theme);
                }
                if ($CFG->block_theme_selector_urlswitch == 1) {
                    $current = core_useragent::get_device_type_theme('default');
                } else {
                    unset($options['base']);
                    unset($options['bootstrapbase']);
                    $current = $this->page->theme->name;
                }
                $select = html_writer::select($options, 'choose', $current, false, $selectdataarray);
                $this->content->text .= get_string('changetheme', 'block_theme_selector').': '.$select;

                $this->content->text .= '<br /><br />';

                $this->content->text .= html_writer::start_tag('form', array('action' => new moodle_url('/theme/index.php'), 'method' => 'post'));
                if (has_capability('moodle/site:config', $coursecontext)) {
                    // Add a button to reset theme caches.
                    $this->content->text .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'sesskey', 'value' => sesskey()));
                    $this->content->text .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'reset', 'value' => '1'));
                    $this->content->text .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'device', 'value' => 'default'));
                    $this->content->text .= html_writer::tag('button', get_string('resetthemecache', 'block_theme_selector'), array('type' => 'submit'));
                }
                $this->content->text .= html_writer::end_tag('form');

                $this->content->text .= '<br />';
            } else if (($CFG->block_theme_selector_urlswitch == 2) && (!$allowthemechangeonurl)) {
                $this->content->text .= html_writer::tag('p', get_string('urlswitchurlwarning', 'block_theme_selector'));
            }
        } else {
            $this->content->text .= html_writer::tag('p', get_string('urlswitchwarning', 'block_theme_selector'));
        }

        return $this->content;
    }
}