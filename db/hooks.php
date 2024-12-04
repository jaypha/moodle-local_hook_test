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
 * List of hooks used in this plugin.
 *
 * @package local_hook_test
 * @copyright 2024 Monash University (https://www.monash.edu)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Do not define these if it is a unit test.
if (!PHPUNIT_TEST) {
    $callbacks = [
        [
            'hook' => core_backup\hook\after_restore_root_define_settings::class,
            'callback' => '\local_hook_test\backup\restore_extension_callbacks::extend_settings',
            'priority' => 500,
        ],
        [
            'hook' => core_backup\hook\after_copy_form_definition::class,
            'callback' => '\local_hook_test\backup\restore_extension_callbacks::extend_copy_form',
            'priority' => 500,
        ],
        [
            'hook' => core_backup\hook\before_copy_course_execute::class,
            'callback' => '\local_hook_test\backup\restore_extension_callbacks::before_copy_execute',
            'priority' => 500,
        ],
        [
            'hook' => core_backup\hook\copy_helper_process_formdata::class,
            'callback' => '\local_hook_test\backup\restore_extension_callbacks::copy_helper_process_formdata',
            'priority' => 500,
        ],
    ];
}
