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

defined('MOODLE_INTERNAL') || die;

$plugin->release = '405.1.1';
$plugin->version = 2024101701;
$plugin->requires = 2024100700.00; // 4.5 (Build: 20241007).
$plugin->supported = [405, 500]; // Supported Moodle version.
$plugin->maturity = MATURITY_STABLE;
$plugin->component = 'block_theme_selector';
