<?php
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
 * Training theme is based on the Moodle Clean and Bootstrapbase themes.
 *
 * @package   theme_training
 * @copyright 2013 Moodle, moodle.org
 * @copyright 2017 TNG Consulting Inc. - www.tngconsulting.ca
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Parses CSS before it is cached.
 *
 * This function can make alterations and replace patterns within the CSS.
 *
 * @param string $css The CSS
 * @param theme_config $theme The theme config object.
 * @return string The parsed CSS The parsed CSS.
 */
function theme_training_process_css($css, $theme) {
    global $OUTPUT;

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }

    // Add CSS to display courses in grid view on front page.
    if (!empty($theme->settings->gridview)) {
        $customcss .= '
            .courses:not(.frontpage-category-combo) {
              display:flex;
              flex-wrap: wrap;
            }
            .courses:not(.frontpage-category-combo) .coursebox .content .teachers,
            .courses:not(.frontpage-category-combo) .coursebox .content .courseimage,
            .courses:not(.frontpage-category-combo) .coursebox .content .coursefile {
              width: 100%;
            }
            .courses:not(.frontpage-category-combo) .coursebox {
              width: 359px;
              margin-right:30px;
              padding-right: 15px
            }
            .courses:not(.frontpage-category-combo) .coursebox .content {
              display: flex;
              flex-direction: column;
            }
            .courses:not(.frontpage-category-combo) .coursebox .content .summary {
              width: 100%;
              order: 2;
            }
        ';
    }

    // Add ability to hide site pages and links to them in the navigation block on the front page.
    // They will re-appear when in edit mode. This enables us to create public site pages without
    // having to enable guest user.
    if (!empty($theme->settings->hidefrontsitepages)) {
        $customcss .= '
            body#page-site-index:not(.editing) .activity.page.modtype_page {
                display:none;
            }
            .block_navigation .type_activity.depth_3 {
              display: none;
            }
            body.notloggedin .block_navigation .type_activity.depth_2 {
              display: none;
            }
        ';
    }
    $css = theme_training_set_customcss($css, $customcss);

    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_training_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM and ($filearea === 'logo' || $filearea === 'smalllogo')) {
        $theme = theme_config::load('training');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_training_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Returns an object containing HTML for the areas affected by settings.
 *
 * Do not add Clean specific logic in here, child themes should be able to
 * rely on that function just by declaring settings with similar names.
 *
 * @param renderer_base $output Pass in $OUTPUT.
 * @param moodle_page $page Pass in $PAGE.
 * @return stdClass An object with the following properties:
 *      - navbarclass A CSS class to use on the navbar. By default ''.
 *      - heading HTML to use for the heading. A logo if one is selected or the default heading.
 *      - footnote HTML to use as a footnote. By default ''.
 */
function theme_training_get_html_for_settings(renderer_base $output, moodle_page $page) {
    global $CFG;
    $return = new stdClass;

    $return->navbarclass = '';
    if (!empty($page->theme->settings->invert)) {
        $return->navbarclass .= ' navbar-inverse';
    }

    // Only display the logo on the front page and login page, if one is defined.
    if (!empty($page->theme->settings->logo) &&
            ($page->pagelayout == 'frontpage' || $page->pagelayout == 'login')) {
        $return->heading = html_writer::tag('div', '', array('class' => 'logo'));
    } else {
        $return->heading = $output->page_heading();
    }

    $return->footnote = '';
    if (!empty($page->theme->settings->footnote)) {
        $return->footnote = '<div class="footnote text-center">'.format_text($page->theme->settings->footnote).'</div>';
    }

    return $return;
}
