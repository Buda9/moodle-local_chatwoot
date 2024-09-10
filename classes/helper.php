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
 * @package     local_chatwoot
 * @copyright   2024 Davor Budimir <davor@vokabula.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_chatwoot;

defined('MOODLE_INTERNAL') || die();

/**
 * Class helper
 *
 * @package     local_chatwoot
 * @copyright   2024 Davor Budimir <davor@vokabula.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class helper {

    /**
     * Generate the Chatwoot Javascript to embed.
     *
     * @param null|stdClass $context Context instance
     * @param null|stdClass $course Related course instance
     * @return null|string A string containing the Chatwoot embed code, otherwise, null.
     */
    public function embed_chatwoot($context, $course) {
        global $USER, $CFG, $SITE;

        // Trap any catchable error.
        try {
            // Grab settings for the plugin from the database
            $base_url = get_config('local_chatwoot', 'base_url');
            $website_token = get_config('local_chatwoot', 'website_token');
            $hmac_token = get_config('local_chatwoot', 'hmac_token'); // User Identity Validation token

            // Get Chatwoot settings from the config
            $position = get_config('local_chatwoot', 'position');
            $type = get_config('local_chatwoot', 'type');
            $launcherTitle = get_config('local_chatwoot', 'launcherTitle');
            $showPopoutButton = get_config('local_chatwoot', 'showPopoutButton') ? 'true' : 'false';
            $hideMessageBubble = get_config('local_chatwoot', 'hideMessageBubble') ? 'true' : 'false';
            $showUnreadMessagesDialog = get_config('local_chatwoot', 'showUnreadMessagesDialog') ? 'true' : 'false';
            $useBrowserLanguage = get_config('local_chatwoot', 'useBrowserLanguage') ? 'true' : 'false';
            $darkMode = get_config('local_chatwoot', 'darkMode');

            // Get active course info
            if(!empty($course)){
                $course_title = empty($course->fullname) ? $course->name : $course->fullname;
                $course_title = format_string($course_title, true, array('context' => \context_system::instance()));
                $course_desc = "";
                if (!empty($course->summary)) {
                    $course_desc = format_text($course->summary, FORMAT_MOODLE, array('context' => \context_system::instance(), 'para' => false));
                    $course_desc = preg_replace("/\r|\n/", "", $course_desc);
                }

                // Get roles for the active course
                $course_roles = array();
                $course_roles_str = "";
                $context = \context_course::instance($course->id);
                if($roles = get_user_roles($context, $USER->id)){
                    foreach ($roles as $role){
                        $course_roles[] = $role->shortname;
                    }
                    $course_roles_str = implode(", ", $course_roles);
                }
            }

            $username = isset($USER->username) ? $USER->username : "guest";
            $email = isset($USER->email) ? $USER->email : "";
            $firstname = isset($USER->firstname) ? $USER->firstname : "";
            $lastname = isset($USER->lastname) ? $USER->lastname : "";
            $fullname = trim($firstname . " " . $lastname);
            $firstaccess = isset($USER->firstaccess) ? $USER->firstaccess : "";

            // Generate HMAC for identity validation
            $identifier = $SITE->shortname."-".$USER->id;
            $identifier_hash = hash_hmac('sha256', $identifier, $hmac_token);

            // Build the JS code to embed
            $embed_code =
            '<script>
                window.chatwootSettings = {
                    "position": "'.$position.'",
                    "type": "'.$type.'",
                    "launcherTitle": "'.$launcherTitle.'",
                    "showPopoutButton": '.$showPopoutButton.',
                    "hideMessageBubble": '.$hideMessageBubble.',
                    "showUnreadMessagesDialog": '.$showUnreadMessagesDialog.',
                    "useBrowserLanguage": '.$useBrowserLanguage.',
                    "darkMode": "'.$darkMode.'"
                };

                document.addEventListener("DOMContentLoaded", function() {
                    (function(d,t) {
                        var BASE_URL="'.$base_url.'";
                        var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
                        g.src=BASE_URL+"/packs/js/sdk.js";
                        g.defer = true;
                        g.async = true;
                        s.parentNode.insertBefore(g,s);
                        g.onload=function(){
                            window.chatwootSDK.run({
                                websiteToken: "'.$website_token.'",
                                baseUrl: BASE_URL
                            })
                        }
                    })(document,"script");
                });
            </script>';

            // Add user and course metadata
            $embed_code .=
            '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    window.addEventListener("chatwoot:ready", function() {
                        window.$chatwoot.setUser("'.$identifier.'", {
                            email: "'.$email.'",
                            name: "'.$fullname.'",
                            avatar_url: "'.$CFG->wwwroot.'/user/pix.php/'.$USER->id.'/f1.jpg",
                            identifier_hash: "'.$identifier_hash.'",
                            created_at: '.$firstaccess.'
                        });
                        window.$chatwoot.setCustomAttributes({
                            moodle_version: "Moodle '.$CFG->release.'",
                            company_id: "'.$SITE->shortname.'",
                            company_name: "'.$SITE->fullname.'",
                            company_website: "'.$CFG->wwwroot.'"';

                    if(!empty($course)){
                        $embed_code .= ',
                                active_course_title: "'.$course_title.'",
                                active_course_shortname: "'.$course->shortname.'",
                                active_course_description: "'.strip_tags($course_desc).'",
                                active_course_id: '.$course->id.',
                                active_course_roles: "'.$course_roles_str.'"';
                    }

                $embed_code .= '
                        });
                    });
                });
            </script>';

            return $embed_code;
        } catch (Exception $e) {
            // Do nothing here.
            return null;
        }

        return null;
    }
}