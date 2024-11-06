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

namespace local_hook_test\local;

use core\event\course_restored;

/**
 * Test the addition of settings to the event data.
 *
 * @package local_hook
 * @copyright 2024 Monash University (https://www.monash.edu)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class event_processor {
    /**
     * Test the addition of settings to the event data.
     *
     * @param course_restored $event
     */
    public static function process_course_restored(course_restored $event) {
        $settings = $event->get_data()['other']['settings'];
        // Check that the value of 'somebox' is present and mtrace it's value.
        if (isset($settings['somebox'])) {
            mtrace('Inside event_processor::process_course_restored()');
            mtrace('Somebox value is ' . $settings['somebox']->get_value());
        }
    }
}
