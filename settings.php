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

if ($ADMIN->fulltree) {

    // Favicon file setting.
    $name = 'theme_training/favicon';
    $title = get_string('favicon', 'theme_training');
    $description = get_string('favicondesc', 'theme_training');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Use banners instead of logos.
    $name = 'theme_training/banner';
    $title = get_string('banner', 'theme_training');
    $description = get_string('bannerdesc', 'theme_training');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Logo file setting.
    $name = 'theme_training/logo';
    $title = get_string('logo', 'theme_training');
    $description = get_string('logodesc', 'theme_training');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Small logo file setting.
    $name = 'theme_training/smalllogo';
    $title = get_string('smalllogo', 'theme_training');
    $description = get_string('smalllogodesc', 'theme_training');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'smalllogo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Place Navbar above banner/logo?
    $name = 'theme_training/navbarabove';
    $title = get_string('navbarabove', 'theme_training');
    $description = get_string('navbarabovedesc', 'theme_training');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Invert Navbar to dark background.
    $name = 'theme_training/invert';
    $title = get_string('invert', 'theme_training');
    $description = get_string('invertdesc', 'theme_training');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Display courses using grid view.
    $name = 'theme_training/hidefrontsitepages';
    $title = get_string('hidefrontsitepages', 'theme_training');
    $description = get_string('hidefrontsitepagesdesc', 'theme_training');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Display courses using grid view.
    $name = 'theme_training/gridview';
    $title = get_string('gridview', 'theme_training');
    $description = get_string('gridviewdesc', 'theme_training');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Footnote setting.
    $name = 'theme_training/footnote';
    $title = get_string('footnote', 'theme_training');
    $description = get_string('footnotedesc', 'theme_training');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

    // Custom CSS file.
    $name = 'theme_training/customcss';
    $title = get_string('customcss', 'theme_training');
    $description = get_string('customcssdesc', 'theme_training');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $settings->add($setting);

}
