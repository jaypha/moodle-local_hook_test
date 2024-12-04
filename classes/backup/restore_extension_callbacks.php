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

namespace local_hook_test\backup;

use base_setting;
use restore_generic_setting;
use backup_setting_ui_checkbox;
use core_backup\hook\before_copy_course_execute;
use core_backup\hook\after_restore_root_define_settings;
use core_backup\hook\after_copy_form_definition;
use core_backup\hook\copy_helper_process_formdata;

/**
 * Callbacks for testing
 *
 * @package local_hook_test
 * @copyright 2024 Monash University (https://www.monash.edu)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_extension_callbacks {
    /**
     * Tests the after_restore_root_define_settings hook.
     *
     * @param after_restore_root_define_settings $hook
     */
    public static function extend_settings(after_restore_root_define_settings $hook) {
        $task = $hook->task;
        $defaultvalue = true;
        $changeable = true;

        // Add a setting 'somebox' to the restore task.
        $somebox = new restore_generic_setting('somebox', base_setting::IS_BOOLEAN, $defaultvalue);
        $somebox->set_ui(new backup_setting_ui_checkbox($somebox, 'Some box'));
        $somebox->get_ui()->set_changeable($changeable);
        $task->add_setting($somebox);
    }

    /**
     * Tests the after_copy_form_definition settigns hook.
     *
     * @param after_copy_form_definition $hook
     */
    public static function extend_copy_form(after_copy_form_definition $hook) {
        // Add an element 'somebox' to the copy course form.
        $mform = $hook->mform;
        $mform->addElement('advcheckbox', 'somebox',get_string('somebox', 'local_hook_test'));
        $mform->addHelpButton('somebox', 'somebox', 'local_hook_test');
    }

    /**
     * Tests the before_copy_course_execute hook.
     *
     * @param before_copy_course_execute $hook
     */
    public static function before_copy_execute(before_copy_course_execute $hook) {
        $plan = $hook->plan;
        $copyinfo = $hook->copyinfo;

        // Set the 'somebox' setting from the somebox field in copyinfo.
        $somebox = $plan->get_setting('somebox');
        $somebox->set_value($copyinfo->somebox);

    }

    /**
     * Tests the copy_helper_process_formdata hook.
     *
     * @param copy_helper_process_formdata $hook
     */
    public static function copy_helper_process_formdata(copy_helper_process_formdata $hook) {
        // Add an extra field 'somebox'.
        $hook->add_extra_field('somebox');
    }
}
