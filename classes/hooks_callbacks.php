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

namespace local_chatwoot;

defined('MOODLE_INTERNAL') || die();

/**
 * Hook callbacks for Chatwoot plugin.
 *
 * @package     local_chatwoot
 * @copyright   2024 Davor Budimir <davor@vokabula.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class hooks_callbacks {
    /**
     * Before standard HTML head hook callback.
     *
     * @param \core\hook\output\before_standard_head_html_generation $hook
     */
    public static function before_standard_html_head(\core\hook\output\before_standard_head_html_generation $hook): void {
        global $PAGE;

        try {
            $enabled = (bool)get_config('local_chatwoot', 'enabled');
            if (!$enabled) {
                return;
            }

            list($context, $course, $cm) = get_context_info_array($PAGE->context->id);

            $ignored_scripts_str = get_config('local_chatwoot', 'ignored_script_names');
            $ignored_scripts = explode(",", $ignored_scripts_str);
            $ignore = false;
            foreach($ignored_scripts as $ignored){
                if($_SERVER['SCRIPT_NAME'] == trim($ignored)){
                    $ignore = true;
                    break;
                }
            }

            if(!$ignore){
                $response = (new helper)->embed_chatwoot($context, $course);
                if (!empty($response)) {
                    $hook->add_html($response);
                }
            }
        } catch (\Exception $e) {
            // Do nothing here.
        }
    }
}