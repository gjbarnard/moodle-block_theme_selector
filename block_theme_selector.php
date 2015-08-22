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
        return true;
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        global $COURSE, $CFG;
        $coursecontext = context_course::instance($COURSE->id);
        $this->content = new stdClass();
        $this->content->text = '';
        $this->page->requires->js_call_amd('block_theme_selector/block_theme_selector', 'init',
            array(array('urlswitch' => $CFG->block_theme_selector_urlswitch, 'url' => $this->page->url->out(true))));

        if (has_capability('moodle/site:config', $coursecontext)) {
            // Add a dropdown to switch themes.
            $themes = core_component::get_plugin_list('theme');
            $options = array();
            foreach($themes as $theme => $themedir) {
                $options[$theme] = ucfirst($theme);
            }
            $select = html_writer::select($options, 'choose', core_useragent::get_device_type_theme('default'), false, array('data-sesskey' => sesskey(), 'data-device' => 'default'));
            $this->content->text .= get_string('changetheme', 'block_theme_selector').': '.$select;

            $this->content->text .= '<br /><br />';

            // Add a button to reset theme caches
            $this->content->text .= html_writer::start_tag('form', array('action' => new moodle_url('/theme/index.php'), 'method' => 'post'));
            $this->content->text .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'sesskey', 'value' => sesskey()));
            $this->content->text .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'reset', 'value' => '1'));
            $this->content->text .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'device', 'value' => 'default'));
            $this->content->text .= html_writer::tag('button', get_string('resetthemecache', 'block_theme_selector'), array('type' => 'submit'));
            $this->content->text .= html_writer::end_tag('form');

            $this->content->text .= '<br />';
        }

        return $this->content;
    }
}