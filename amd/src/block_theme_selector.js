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
 * @module     block_theme_selector
 * @copyright  &copy; 2015-onwards G J Barnard in respect to modifications of original code:
 *             https://github.com/johntron/moodle-theme-selector-block by John Tron, see:
 *             https://github.com/johntron/moodle-theme-selector-block/issues/1.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import $ from 'jquery';
import log from 'core/log';

/**
 * Selector.
 */
const selector = () => {
    $('.block_theme_selector select').on('change', function (e) {
        var $select = $(e.target);
        var choose = $select.find(':selected').val();
        var urlswitch = $select.data('urlswitch');
        if (urlswitch == 2) {
            var changeparam;
            var urlparams = $select.data('urlparams');
            if (urlparams == 1) {
                changeparam = '?';
            } else {
                changeparam = '&';
            }
            changeparam += 'theme=' + choose;
            window.location = $select.data('url') + changeparam;
        } else {
            var params = {
                'sesskey': $select.data('sesskey'),
                'device': $select.data('device'),
                'choose': choose
            };
            window.location = '/theme/index.php?' + $.param(params);
        }
    });

    if ($('.themeselectorwindow').length) {
        $('input[name="themeselectorwindowwidth"]').val(window.innerWidth);
        $('input[name="themeselectorwindowheight"]').val(window.innerHeight);
        $('#themeselectorcreatewindow').click(function (e) {
            e.preventDefault();
            var width = $('input[name="themeselectorwindowwidth"]').val();
            var height = $('input[name="themeselectorwindowheight"]').val();
            var mywindow = window.open(window.location.href, "",
                "scrollbars=yes, toolbar=yes, width=" + width + ", height=" + height);
            mywindow.focus();
        });
    }
};

/**
 * Init.
 */
export const init = () => {
    log.debug('Block Theme Selector ES6 Selector init');
    if (document.readyState !== 'loading') {
        log.debug("Block Theme Selector ES6 Selector init DOM content already loaded");
        selector();
    } else {
        log.debug("Block Theme Selector ES6 Selector init JS DOM content not loaded");
        document.addEventListener('DOMContentLoaded', function () {
            log.debug("Block Theme Selector ES6 Selector init JS DOM content loaded");
            selector();
        });
    }
};
