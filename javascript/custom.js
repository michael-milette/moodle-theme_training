// This file is part of Training Theme for Moodle - http://moodle.org/
//
// Training is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Training Theme for Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Training Theme for Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * JavaScript library for Training theme.
 *
 * @module    moodle-theme_training
 * @package   theme_training
 * @copyright 2017 TNG Consulting Inc. - www.tngconsulting.ca
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

/**
 * Show Back to Top button when the user scrolls down 30px from the top of the page.
 *
 * @method themeTrainingScrollToTop
 */
function themeTrainingScrollToTop() {
    if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
        document.getElementById("back-to-top").style.display = "inline-block";
    } else {
        document.getElementById("back-to-top").style.display = "none";
    }
}
window.onscroll = function() {
    themeTrainingScrollToTop();
};
