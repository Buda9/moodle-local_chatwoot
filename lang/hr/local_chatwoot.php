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
$string['enabled'] = 'Omogućeno';
$string['enabled_help'] = 'Omogući Chatwoot integraciju.';

$string['privacy:metadata'] = 'Lokalni Chatwoot plugin ne pohranjuje nikakve osobne podatke.';

$string['base_url'] = 'Osnovni URL za Chatwoot';
$string['base_url_help'] = 'Unesite osnovni URL vaše Chatwoot instance (npr. https://help.vokabula.com).';

$string['website_token'] = 'Token za Chatwoot stranicu';
$string['website_token_help'] = 'Unesite svoj Chatwoot token za stranicu. Ovaj token možete pronaći u Chatwootu pod Postavke - Poštanski sandučići - Postavke - Token za stranicu.';

$string['hmac_token'] = 'HMAC Token';
$string['hmac_token_desc'] = 'Unesite svoj HMAC token ovdje.';

$string['ignored_script_names'] = 'Ignorirani skripti';
$string['ignored_script_names_help'] = 'Nemoj učitati Chatwoot widget iz sljedećih datoteka (odvojeno zarezom).';

$string['position'] = 'Pozicija Widgeta';
$string['position_help'] = 'Odaberite poziciju Chatwoot widgeta (lijevo ili desno).';
$string['type'] = 'Tip Widgeta';
$string['type_help'] = 'Odaberite tip Chatwoot widgeta (standardni ili prošireni balon).';
$string['launcherTitle'] = 'Naslov Launchera';
$string['launcherTitle_help'] = 'Postavite naslov za launcher Chatwoot widgeta.';
$string['launcherTitle_note'] = 'Napomena: Naslov pokretača se sada upravlja putem jezičnih nizova. Za promjenu naslova, molimo uredite jezične datoteke.';
$string['showPopoutButton'] = 'Prikaži Popout Gumb';
$string['showPopoutButton_help'] = 'Omogući ili onemogući popout gumb u Chatwoot widgetu.';
$string['hideMessageBubble'] = 'Sakrij Balon Poruke';
$string['hideMessageBubble_help'] = 'Omogući ili onemogući skrivanje balona poruke.';
$string['showUnreadMessagesDialog'] = 'Prikaži Dijalog Nepročitanih Poruka';
$string['showUnreadMessagesDialog_help'] = 'Omogući ili onemogući dijalog nepročitanih poruka.';
$string['useBrowserLanguage'] = 'Koristi Jezik Preglednika';
$string['useBrowserLanguage_help'] = 'Koristi jezik preglednika za Chatwoot widget.';
$string['darkMode'] = 'Tamni Režim';
$string['darkMode_help'] = 'Odaberite postavku tamnog režima za Chatwoot widget.';

$string['privacy:metadata:chatwoot_client'] = 'Kako bi se integrirao s udaljenom Chatwoot uslugom, neki korisnički podaci moraju biti razmijenjeni s tom uslugom.';
$string['privacy:metadata:chatwoot_client:userid'] = 'ID korisnika se šalje iz Moodlea kako bi vam omogućio pristup vašim podacima na udaljenom sustavu.';
$string['privacy:metadata:chatwoot_client:fullname'] = 'Vaše puno ime se šalje udaljenom sustavu radi boljeg korisničkog iskustva.';
$string['privacy:metadata:chatwoot_client:email'] = 'Vaš e-mail se šalje Chatwootu radi e-mail obavijesti i povezivanja razgovora s vašim računom.';
$string['privacy:metadata:chatwoot_client:created_at'] = 'Vrijeme kada je vaš račun kreiran se šalje Chatwootu kako bi se pružio kontekst o povijesti vašeg računa.';

// Launcher title
$string['launcherTitle_text'] = 'Trebaš pomoć';