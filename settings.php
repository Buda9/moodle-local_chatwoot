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
 * Plugin administration pages are defined here.
 *
 * @package     local_chatwoot
 * @category    admin
 * @copyright   2024 Davor Budimir <davor@vokabula.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
// TODO: Define the plugin settings page.
// https://docs.moodle.org/dev/Admin_settings
}

if ($hassiteconfig) {
    // Create the new settings page.
    $settings = new admin_settingpage('local_chatwoot', get_string('pluginname', 'local_chatwoot'));

    // Create.
    $ADMIN->add('localplugins', $settings);

    // Add a checkbox setting to the settings for this page.
    $name = 'local_chatwoot/enabled';
    $title = get_string('enabled', 'local_chatwoot');
    $description = get_string('enabled_help', 'local_chatwoot');
    $default = '0';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $settings->add($setting);

    // Add a string setting for base_url
    $name = 'local_chatwoot/base_url';
    $title = get_string('base_url', 'local_chatwoot');
    $description = get_string('base_url_help', 'local_chatwoot');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $settings->add($setting);

    // Add a string setting for website_token
    $name = 'local_chatwoot/website_token';
    $title = get_string('website_token', 'local_chatwoot');
    $description = get_string('website_token_help', 'local_chatwoot');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_NOTAGS);
    $settings->add($setting);

    // Add a string setting for hmac_token
    $name = 'local_chatwoot/hmac_token';
    $title = get_string('hmac_token', 'local_chatwoot');
    $description = get_string('hmac_token_help', 'local_chatwoot');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_NOTAGS);
    $settings->add($setting);

    // Add a select setting for position
    $name = 'local_chatwoot/position';
    $title = get_string('position', 'local_chatwoot');
    $description = get_string('position_help', 'local_chatwoot');
    $default = 'right';
    $choices = array('left' => 'Left', 'right' => 'Right');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Add a select setting for type
    $name = 'local_chatwoot/type';
    $title = get_string('type', 'local_chatwoot');
    $description = get_string('type_help', 'local_chatwoot');
    $default = 'expanded_bubble';
    $choices = array('standard' => 'Standard', 'expanded_bubble' => 'Expanded Bubble');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Add a string setting for launcherTitle
    $name = 'local_chatwoot/launcherTitle';
    $title = get_string('launcherTitle', 'local_chatwoot');
    $description = get_string('launcherTitle_help', 'local_chatwoot');
    $default = 'Podrška';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $settings->add($setting);

    // Add a checkbox setting for showPopoutButton
    $name = 'local_chatwoot/showPopoutButton';
    $title = get_string('showPopoutButton', 'local_chatwoot');
    $description = get_string('showPopoutButton_help', 'local_chatwoot');
    $default = '1';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settings->add($setting);

    // Add a checkbox setting for hideMessageBubble
    $name = 'local_chatwoot/hideMessageBubble';
    $title = get_string('hideMessageBubble', 'local_chatwoot');
    $description = get_string('hideMessageBubble_help', 'local_chatwoot');
    $default = '0';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settings->add($setting);

    // Add a checkbox setting for showUnreadMessagesDialog
    $name = 'local_chatwoot/showUnreadMessagesDialog';
    $title = get_string('showUnreadMessagesDialog', 'local_chatwoot');
    $description = get_string('showUnreadMessagesDialog_help', 'local_chatwoot');
    $default = '1';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settings->add($setting);

    // Add a checkbox setting for useBrowserLanguage
    $name = 'local_chatwoot/useBrowserLanguage';
    $title = get_string('useBrowserLanguage', 'local_chatwoot');
    $description = get_string('useBrowserLanguage_help', 'local_chatwoot');
    $default = '1';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settings->add($setting);

    // Add a select setting for darkMode
    $name = 'local_chatwoot/darkMode';
    $title = get_string('darkMode', 'local_chatwoot');
    $description = get_string('darkMode_help', 'local_chatwoot');
    $default = 'auto';
    $choices = array('light' => 'Light', 'dark' => 'Dark', 'auto' => 'Auto');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);

    // Add a string setting to the settings for this page.
    $name = 'local_chatwoot/ignored_script_names';
    $title = get_string('ignored_script_names', 'local_chatwoot');
    $description = get_string('ignored_script_names_help', 'local_chatwoot');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_NOTAGS);
    $settings->add($setting);
}