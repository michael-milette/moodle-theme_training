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

require_once($CFG->dirroot . '/theme/bootstrapbase/renderers.php');

/**
 * Training core renderers.
 *
 * @package    theme_training
 * @copyright  2015 Frédéric Massart - FMCorz.net, 2017 TNG Consulting Inc. - www.tngconsulting.ca
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_training_core_renderer extends theme_bootstrapbase_core_renderer {

    /**
     * Either returns the parent version of the header bar, or a version with the logo replacing the header.
     *
     * @since Moodle 2.9
     * @param array $headerinfo An array of header information, dependant on what type of header is being displayed. The following
     *                          array example is user specific.
     *                          heading => Override the page heading.
     *                          user => User object.
     *                          usercontext => user context.
     * @param int $headinglevel What level the 'h' tag will be.
     * @return string HTML for the header bar.
     */
    public function context_header($headerinfo = null, $headinglevel = 1) {
        if ($this->should_render_logo($headinglevel)) {
            return html_writer::tag('div', '', array('class' => 'logo'));
        }
        return parent::context_header($headerinfo, $headinglevel);
    }

    /**
     * Determines if we should render the logo.
     *
     * @param int $headinglevel What level the 'h' tag will be.
     * @return bool Should the logo be rendered.
     */
    protected function should_render_logo($headinglevel = 1) {
        global $PAGE;

        // Render the full size logo on the front page or login page.
        // All other pages will get the small logo to reduce unncessary scrolling.
        // A logo must be defined in the theme or the site.
        // Handling of logo size for mobile devices is done through CSS.
        if ($PAGE->pagelayout == 'frontpage' || $PAGE->pagelayout == 'login') {
            $logo = $this->get_logo_url();
        } else {
            $logo = $this->get_compact_logo_url();
        }
        if ($headinglevel == 1 && !empty($logo)) {
            return true;
        }

        return false;
    }

    /**
     * Returns the navigation bar home reference.
     *
     * The logo is only rendered on pages where the logo is not displayed.
     *
     * @param bool $returnlink Whether to wrap the icon and the site name in links or not
     * @return string The site name or the logo or both depending on the theme settings.
     */
    public function navbar_home($returnlink = true) {
        global $CFG, $SITE;

        $imageurl = $this->get_logo_url(null, 35);
        if (!$this->should_render_logo() || empty($imageurl)) {
            // If there is no logo we always show the site name.
            return $this->get_home_ref($returnlink);
        }

        $sitename = format_string($SITE->fullname, true, array('context' => context_course::instance(SITEID)));
        $image = html_writer::img($imageurl, $sitename, array('class' => 'logo'));

        if ($returnlink) {
            $logocontainer = html_writer::link(new moodle_url('/'), $image,
                array('class' => 'logo-container', 'title' => get_string('home')));
        } else {
            $logocontainer = html_writer::tag('span', $image, array('class' => 'logo-container'));
        }

        return $logocontainer;
    }

    /**
     * Returns a reference to the site home.
     *
     * It can be either a link or a span.
     *
     * @param bool $returnlink
     * @return string
     */
    protected function get_home_ref($returnlink = true) {
        global $CFG, $SITE;

        $sitename = format_string($SITE->fullname, true, array('context' => context_course::instance(SITEID)));

        if ($returnlink) {
            return html_writer::link(new moodle_url('/'), $sitename, array('class' => 'brand', 'title' => get_string('home')));
        }

        return html_writer::tag('span', $sitename, array('class' => 'brand'));
    }

    /**
     * Return the theme logo URL, else the site's logo URL, if any.
     *
     * Note that maximum sizes are only applied to the site logos.
     *
     * @param int $maxwidth The maximum width, or null when the maximum width does not matter.
     * @param int $maxheight The maximum height, or null when the maximum height does not matter.
     * @return moodle_url|false
     */
    public function get_logo_url($maxwidth = null, $maxheight = 100) {
        global $CFG;

        if (!empty($this->page->theme->settings->logo)) {
            $url = $this->page->theme->setting_file_url('logo', 'logo');
            // Get a URL suitable for moodle_url.
            $relativebaseurl = preg_replace('|^https?://|i', '//', $CFG->wwwroot);
            $url = str_replace($relativebaseurl, '', $url);
            return new moodle_url($url);
        }
        // Get site logo.
        return parent::get_logo_url($maxwidth, $maxheight);
    }

    /**
     * Return the theme's compact logo URL, else the site's compact logo URL, if any.
     *
     * Note that maximum sizes are only applied to the site logos.
     *
     * @param int $maxwidth The maximum width, or null when the maximum width does not matter.
     * @param int $maxheight The maximum height, or null when the maximum height does not matter.
     * @return moodle_url|false
     */
    public function get_compact_logo_url($maxwidth = 100, $maxheight = 100) {
        global $CFG;

        if (!empty($this->page->theme->settings->smalllogo)) {
            $url = $this->page->theme->setting_file_url('smalllogo', 'smalllogo');
            // Get a URL suitable for moodle_url.
            $relativebaseurl = preg_replace('|^https?://|i', '//', $CFG->wwwroot);
            $url = str_replace($relativebaseurl, '', $url);
            return new moodle_url($url);
        }
        // Get site compact logo.
        return parent::get_compact_logo_url($maxwidth, $maxheight);
    }

    /**
     *  Applies Moodle filters to custom menu.
     *
     *  @param custom_menu $menu Current custom menu object.
     *  @return Rendered custom_menu that has been filtered.
     */
    public function custom_menu($custommenuitems = '') {
        global $CFG;

        if (empty($custommenuitems) && !empty($CFG->custommenuitems)) {
            $custommenuitems = format_text($CFG->custommenuitems, FORMAT_MOODLE, array(
                    'noclean' => true,
                    'para' => false,
                    'newlines' => false,
                    'context' => context_course::instance(SITEID)
                ));
        }
        $custommenu = new custom_menu($custommenuitems, current_language());
        return $this->render_custom_menu($custommenu);
    }

}

class theme_training_core_renderer extends core_renderer {

    /**
     * Returns the URL for the favicon.
     *
     * @return string The favicon URL
     */
    public function favicon() {
        if (!empty($this->page->theme->settings->favicon)) {
            return $this->page->theme->setting_file_url('favicon', 'favicon');
        }
        return parent::favicon();
    }
}