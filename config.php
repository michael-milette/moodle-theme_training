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
 * @copyright 2017-2018 TNG Consulting Inc. - www.tngconsulting.ca
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$THEME->name = 'training';

$THEME->doctype = 'html5';
$THEME->parents = array('bootstrapbase');
$THEME->javascripts = array('custom');
$THEME->sheets = array('custom');
$THEME->yuicssmodules = array();
$THEME->enable_dock = true;
$THEME->editor_sheets = array();

$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->csspostprocess = 'theme_training_process_css';
