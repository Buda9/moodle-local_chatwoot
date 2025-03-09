<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Helper class for Chatwoot integration
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
     * Get Chatwoot configuration settings
     *
     * @return \stdClass Configuration object with all Chatwoot settings
     */
    private function get_config(): \stdClass {
        $config = new \stdClass();
        
        // Base settings
        $config->base_url = get_config('local_chatwoot', 'base_url');
        $config->website_token = get_config('local_chatwoot', 'website_token');
        $config->hmac_token = get_config('local_chatwoot', 'hmac_token');
        
        // Widget display settings
        $config->position = get_config('local_chatwoot', 'position');
        $config->type = get_config('local_chatwoot', 'type');
        $config->showPopoutButton = get_config('local_chatwoot', 'showPopoutButton') ? 'true' : 'false';
        $config->hideMessageBubble = get_config('local_chatwoot', 'hideMessageBubble') ? 'true' : 'false';
        $config->showUnreadMessagesDialog = get_config('local_chatwoot', 'showUnreadMessagesDialog') ? 'true' : 'false';
        $config->useBrowserLanguage = get_config('local_chatwoot', 'useBrowserLanguage') ? 'true' : 'false';
        $config->darkMode = get_config('local_chatwoot', 'darkMode');
        $config->hideLauncherTitleOnMobile = get_config('local_chatwoot', 'hideLauncherTitleOnMobile');
        
        return $config;
    }
    
    /**
     * Get user data for Chatwoot widget
     * 
     * @param string $hmac_token The HMAC token for user identity validation
     * @return \stdClass User data object
     */
    private function get_user_data(string $hmac_token): \stdClass {
        global $USER, $CFG, $SITE;
        
        $userdata = new \stdClass();
        
        $userdata->username = $USER->username ?? "guest";
        $userdata->email = $USER->email ?? "";
        $userdata->firstname = $USER->firstname ?? "";
        $userdata->lastname = $USER->lastname ?? "";
        $userdata->fullname = trim($userdata->firstname . " " . $userdata->lastname);
        $userdata->firstaccess = $USER->firstaccess ?? "";
        $userdata->language = $USER->lang ?? $CFG->lang;
        
        // Generate HMAC for identity validation
        $identifier = $SITE->shortname."-".$USER->id;
        $userdata->identifier = $identifier;
        $userdata->identifier_hash = hash_hmac('sha256', $identifier, $hmac_token);
        
        // Avatar URL
        $userdata->avatar_url = new \moodle_url('/user/pix.php/' . $USER->id . '/f1.jpg');
        
        return $userdata;
    }
    
    /**
     * Get course data for Chatwoot widget
     * 
     * @param \stdClass|null $course The course object
     * @return \stdClass|null Course data object or null if no course
     */
    private function get_course_data(?\stdClass $course): ?\stdClass {
        global $USER;
        
        if (empty($course)) {
            return null;
        }
        
        $coursedata = new \stdClass();
        
        $coursedata->title = $course->fullname ?? $course->name;
        $coursedata->title = format_string($coursedata->title, true, ['context' => \context_system::instance()]);
        $coursedata->shortname = $course->shortname;
        $coursedata->id = $course->id;
        
        // Course description
        $coursedata->description = "";
        if (!empty($course->summary)) {
            $coursedata->description = format_text($course->summary, FORMAT_MOODLE, 
                ['context' => \context_system::instance(), 'para' => false]);
            $coursedata->description = preg_replace("/\r|\n/", "", $coursedata->description);
            $coursedata->description = strip_tags($coursedata->description);
        }
        
        // User roles in this course
        $coursedata->roles = [];
        $coursedata->roles_str = "";
        $context = \context_course::instance($course->id);
        if ($roles = get_user_roles($context, $USER->id)) {
            foreach ($roles as $role) {
                $coursedata->roles[] = $role->shortname;
            }
            $coursedata->roles_str = implode(", ", $coursedata->roles);
        }
        
        return $coursedata;
    }
    
    /**
     * Generate CSS for mobile launcher title hiding
     * 
     * @param bool $hideLauncherTitleOnMobile Whether to hide launcher title on mobile
     * @return string CSS code
     */
    private function generate_mobile_css(bool $hideLauncherTitleOnMobile): string {
        if (!$hideLauncherTitleOnMobile) {
            return '';
        }
        
        return '
        <style>
            @media screen and (max-width: 768px) {
                .woot-widget-bubble.woot-widget--expanded div {
                    display: none !important;
                }
                .woot-widget-bubble.woot-widget--expanded svg {
                    margin-right: 14px !important;
                }
            }
        </style>';
    }
    
    /**
     * Generate Chatwoot widget initialization script
     * 
     * @param \stdClass $config Configuration settings
     * @param string $launcherTitle The localized launcher title
     * @return string JavaScript initialization code
     */
    private function generate_widget_script(\stdClass $config, string $launcherTitle): string {
        $script = '
        <script>
            window.chatwootSettings = {
                "position": "'.$config->position.'",
                "type": "'.$config->type.'",
                "launcherTitle": "'.$launcherTitle.'",
                "showPopoutButton": '.$config->showPopoutButton.',
                "hideMessageBubble": '.$config->hideMessageBubble.',
                "showUnreadMessagesDialog": '.$config->showUnreadMessagesDialog.',
                "useBrowserLanguage": '.$config->useBrowserLanguage.',
                "darkMode": "'.$config->darkMode.'"';

        // Set the language if useBrowserLanguage is false
        if ($config->useBrowserLanguage === 'false') {
            $script .= ',
                "locale": "'.$config->language.'"';
        }

        $script .= '
            };

            document.addEventListener("DOMContentLoaded", function() {
                (function(d,t) {
                    var BASE_URL="'.$config->base_url.'";
                    var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
                    g.src=BASE_URL+"/packs/js/sdk.js";
                    g.defer = true;
                    g.async = true;
                    s.parentNode.insertBefore(g,s);
                    g.onload=function(){
                        window.chatwootSDK.run({
                            websiteToken: "'.$config->website_token.'",
                            baseUrl: BASE_URL
                        })
                    }
                })(document,"script");
            });
        </script>';
        
        return $script;
    }
    
    /**
     * Generate user metadata script for Chatwoot
     * 
     * @param \stdClass $userdata User data 
     * @param \stdClass|null $coursedata Course data or null
     * @return string JavaScript for setting user metadata
     */
    private function generate_metadata_script(\stdClass $userdata, ?\stdClass $coursedata): string {
        global $CFG, $SITE;
        
        $script = 
        '<script>
            document.addEventListener("DOMContentLoaded", function() {
                window.addEventListener("chatwoot:ready", function() {
                    window.$chatwoot.setUser("'.$userdata->identifier.'", {
                        email: "'.$userdata->email.'",
                        name: "'.$userdata->fullname.'",
                        avatar_url: "'.$userdata->avatar_url->out(false).'",
                        identifier_hash: "'.$userdata->identifier_hash.'",
                        created_at: '.$userdata->firstaccess.'
                    });
                    window.$chatwoot.setCustomAttributes({
                        moodle_version: "Moodle '.$CFG->release.'",
                        company_id: "'.$SITE->shortname.'",
                        company_name: "'.$SITE->fullname.'",
                        company_website: "'.$CFG->wwwroot.'",
                        user_language: "'.$userdata->language.'"';

        // Add course data if available
        if (!empty($coursedata)) {
            $script .= ',
                active_course_title: "'.$coursedata->title.'",
                active_course_shortname: "'.$coursedata->shortname.'",
                active_course_description: "'.$coursedata->description.'",
                active_course_id: '.$coursedata->id.',
                active_course_roles: "'.$coursedata->roles_str.'"';
        }

        $script .= '
                    });
                });
            });
        </script>';
        
        return $script;
    }

    /**
     * Generate the Chatwoot Javascript to embed.
     *
     * @param null|\stdClass $context Context instance
     * @param null|\stdClass $course Related course instance
     * @return null|string A string containing the Chatwoot embed code, otherwise, null.
     */
    public function embed_chatwoot(?\stdClass $context, ?\stdClass $course): ?string {
        // Trap any catchable error.
        try {
            // Get configuration settings
            $config = $this->get_config();
            
            // Get user data
            $userdata = $this->get_user_data($config->hmac_token);
            
            // Get course data if available
            $coursedata = $this->get_course_data($course);
            
            // Get the translated launcher title
            $launcherTitle = get_string('launcherTitle_text', 'local_chatwoot');
            
            // Build the complete embed code
            $embed_code = '';
            
            // Add mobile CSS if needed
            $embed_code .= $this->generate_mobile_css($config->hideLauncherTitleOnMobile);
            
            // Add widget initialization script
            $embed_code .= $this->generate_widget_script($config, $launcherTitle);
            
            // Add user and metadata script
            $embed_code .= $this->generate_metadata_script($userdata, $coursedata);
            
            return $embed_code;
        } catch (\Exception $e) {
            // Do nothing here.
            return null;
        }
    }
}