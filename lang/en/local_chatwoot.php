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
 * Plugin strings are defined here.
 *
 * @package     local_chatwoot
 * @category    string
 * @copyright   2024 Davor Budimir <davor@vokabula.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Chatwoot';
$string['enabled'] = 'Enabled';
$string['enabled_help'] = 'Enable Chatwoot integration.';
$string['privacy:metadata'] = 'The Chatwoot local plugin does not store any personal data itself.';

$string['base_url'] = 'Chatwoot Base URL';
$string['base_url_help'] = 'Enter the base URL of your Chatwoot instance (e.g. https://help.vokabula.com).';

$string['website_token'] = 'Chatwoot Website Token';
$string['website_token_help'] = 'Enter your Chatwoot website token. You can find this in Chatwoot under Settings - Inboxes - Settings - Website Token.';

$string['hmac_token'] = 'HMAC Token';
$string['hmac_token_desc'] = 'Enter your HMAC token here.';

$string['ignored_script_names'] = 'Ignored Scripts';
$string['ignored_script_names_help'] = 'Do not load Chatwoot widget from the following files (comma-separated).';

$string['position'] = 'Widget Position';
$string['position_help'] = 'Choose the position of the Chatwoot widget (left or right).';
$string['type'] = 'Widget Type';
$string['type_help'] = 'Choose the type of the Chatwoot widget (standard or expanded bubble).';
$string['launcherTitle'] = 'Launcher Title';
$string['launcherTitle_help'] = 'Set the title for the Chatwoot widget launcher.';
$string['showPopoutButton'] = 'Show Popout Button';
$string['showPopoutButton_help'] = 'Enable or disable the popout button in the Chatwoot widget.';
$string['hideMessageBubble'] = 'Hide Message Bubble';
$string['hideMessageBubble_help'] = 'Enable or disable hiding of the message bubble.';
$string['showUnreadMessagesDialog'] = 'Show Unread Messages Dialog';
$string['showUnreadMessagesDialog_help'] = 'Enable or disable the unread messages dialog.';
$string['useBrowserLanguage'] = 'Use Browser Language';
$string['useBrowserLanguage_help'] = 'Use the browser language for the Chatwoot widget.';
$string['darkMode'] = 'Dark Mode';
$string['darkMode_help'] = 'Choose the dark mode setting for the Chatwoot widget.';

$string['privacy:metadata:chatwoot_client'] = 'In order to integrate with a remote Chatwoot service, some user data needs to be exchanged with that service.';
$string['privacy:metadata:chatwoot_client:userid'] = 'The userid is sent from Moodle to allow you to access your data on the remote system.';
$string['privacy:metadata:chatwoot_client:fullname'] = 'Your full name is sent to the remote system to allow a better user experience.';
$string['privacy:metadata:chatwoot_client:email'] = 'Your email is sent to Chatwoot to allow for email notifications and to link conversations to your account.';
$string['privacy:metadata:chatwoot_client:created_at'] = 'The time when your account was created is sent to Chatwoot to provide context about your account history.';