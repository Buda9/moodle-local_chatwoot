<?php
// This file is part of the chatwoot local plugin for Moodle
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
 * Library of interface functions and constants for module chatwoot
 *
 * All the core Moodle functions, needed to allow the module to work
 * integrated in Moodle should be placed here.
 *
 * All the chatwoot specific functions, needed to implement all the module
 * logic, should go to locallib.php. This will help to save some memory when
 * Moodle is performing actions across all modules.
 *
 * @package     local_chatwoot
 * @copyright   2024 Davor Budimir <davor@vokabula.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Add extra HTML meta elements according to the Chatwoot widget specification.
 *
 * Give plugins an opportunity to add any head elements.
 * The callback must always return a string containing valid html head content.
 *
 * Implemented in MDL-53978 (Moodle 3.3).
 *
 * @return string A string containing the Chatwoot embed code otherwise, an empty string.
 */
function local_chatwoot_before_standard_html_head() {
    global $PAGE;
    // Trap any catchable error.
    try {
        $enabled = (bool)get_config('local_chatwoot', 'enabled');
        if (!$enabled) {
            return '';
        }
        list($context, $course, $cm) = get_context_info_array($PAGE->context->id);
        
        $ignored_scripts_str = get_config('local_chatwoot', 'ignored_script_names');
        $ignored_scripts = explode(",", $ignored_scripts_str);
        $ignore = false;
        foreach($ignored_scripts as $ignored){
            if($_SERVER['SCRIPT_NAME'] == trim($ignored)){
                $ignore = true;    
            }
        }
        if(!$ignore){
            $response = (new \local_chatwoot\helper)->embed_chatwoot($context, $course);
            if (!empty($response)) {
                return $response;
            }
        }else{
            return '';
        }
    } catch (Exception $e) {
        // Do nothing here.
        return '';
    }
    return '';
}