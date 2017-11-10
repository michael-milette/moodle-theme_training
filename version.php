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
 * Training theme is based on the Moodle Clean theme.
 *
 * @package    theme_training
 * @copyright  2013 Moodle, moodle.org
 * @copyright  2017 TNG Consulting Inc. - www.tngconsulting.ca
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$plugin->version   = 2017110900; // Based on Clean version 2016120500.
$plugin->requires  = 2016052300; // Moodle 3.1.0.
$plugin->component = 'theme_training';
$plugin->release = '0.2.0';
$plugin->maturity = MATURITY_ALPHA;
$plugin->dependencies = array(
    'theme_bootstrapbase'  => 2016052300,
);
