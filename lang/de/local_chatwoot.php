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
$string['enabled'] = 'Aktiviert';
$string['enabled_help'] = 'Aktiviere die Chatwoot-Integration.';

$string['privacy:metadata'] = 'Das lokale Chatwoot-Plugin speichert selbst keine personenbezogenen Daten.';

$string['base_url'] = 'Chatwoot-Basis-URL';
$string['base_url_help'] = 'Geben Sie die Basis-URL Ihrer Chatwoot-Instanz ein (z. B. https://help.vokabula.com).';

$string['website_token'] = 'Chatwoot-Website-Token';
$string['website_token_help'] = 'Geben Sie Ihr Chatwoot-Website-Token ein. Sie finden dieses unter Chatwoot - Einstellungen - Posteingänge - Einstellungen - Website-Token.';

$string['hmac_token'] = 'HMAC-Token';
$string['hmac_token_desc'] = 'Geben Sie hier Ihren HMAC-Token ein.';

$string['ignored_script_names'] = 'Ignorierte Skripte';
$string['ignored_script_names_help'] = 'Laden Sie das Chatwoot-Widget nicht aus den folgenden Dateien (durch Kommas getrennt).';

$string['position'] = 'Widget-Position';
$string['position_help'] = 'Wählen Sie die Position des Chatwoot-Widgets (links oder rechts).';
$string['type'] = 'Widget-Typ';
$string['type_help'] = 'Wählen Sie den Typ des Chatwoot-Widgets (Standard oder erweitertes Blasen-Widget).';
$string['launcherTitle'] = 'Launcher-Titel';
$string['launcherTitle_help'] = 'Legen Sie den Titel für den Launcher des Chatwoot-Widgets fest.';
$string['launcherTitle_note'] = 'Hinweis: Der Launcher-Titel wird jetzt über Sprachzeichenfolgen verwaltet. Um den Titel zu ändern, bearbeiten Sie bitte die Sprachdateien.';
$string['showPopoutButton'] = 'Popout-Button anzeigen';
$string['showPopoutButton_help'] = 'Aktivieren oder deaktivieren Sie den Popout-Button im Chatwoot-Widget.';
$string['hideMessageBubble'] = 'Nachrichtenblase ausblenden';
$string['hideMessageBubble_help'] = 'Aktivieren oder deaktivieren Sie das Ausblenden der Nachrichtenblase.';
$string['showUnreadMessagesDialog'] = 'Dialog für ungelesene Nachrichten anzeigen';
$string['showUnreadMessagesDialog_help'] = 'Aktivieren oder deaktivieren Sie den Dialog für ungelesene Nachrichten.';
$string['useBrowserLanguage'] = 'Browsersprache verwenden';
$string['useBrowserLanguage_help'] = 'Verwenden Sie die Browsersprache für das Chatwoot-Widget.';
$string['darkMode'] = 'Dunkelmodus';
$string['darkMode_help'] = 'Wählen Sie die Dunkelmodus-Einstellung für das Chatwoot-Widget.';

$string['privacy:metadata:chatwoot_client'] = 'Um eine Integration mit dem entfernten Chatwoot-Dienst zu ermöglichen, müssen einige Benutzerdaten mit diesem Dienst ausgetauscht werden.';
$string['privacy:metadata:chatwoot_client:userid'] = 'Die Benutzer-ID wird von Moodle gesendet, um den Zugriff auf Ihre Daten im entfernten System zu ermöglichen.';
$string['privacy:metadata:chatwoot_client:fullname'] = 'Ihr vollständiger Name wird an das entfernte System gesendet, um ein besseres Benutzererlebnis zu ermöglichen.';
$string['privacy:metadata:chatwoot_client:email'] = 'Ihre E-Mail wird an Chatwoot gesendet, um E-Mail-Benachrichtigungen zu ermöglichen und Gespräche mit Ihrem Konto zu verknüpfen.';
$string['privacy:metadata:chatwoot_client:created_at'] = 'Die Zeit, zu der Ihr Konto erstellt wurde, wird an Chatwoot gesendet, um einen Kontext zu Ihrer Kontohistorie bereitzustellen.';

// Launcher title
$string['launcherTitle_text'] = 'Benötigen Sie Hilfe?';