# Moodle Chatwoot plugin #

Chatwoot is a free and open-source alternative to Intercom. This plugin integrates the Chatwoot chat widget into Moodle, allowing you to provide real-time support and communication directly on your Moodle platform. Plugin automatically "collects" users first and last name, email and phone number.

## Features

1. Embeds Chatwoot chat widget on the Moodle frontend.
2. Automatically retrieves and configures necessary settings from the Moodle database.
3. Supports guest and logged-in users.

## Compatibility

- Use 'main' branch for Moodle 3.10 to Moodle 4.3
- Use 'STABLE_404' for Moodle 4.4 and up

## Installation

1. Download the plugin files.
2. Place the local_chatwood folder in your Moodle's /local directory and rename it to chatwood.
3. Navigate to your Moodle site and complete the installation process.
4. Configure the plugin settings.

## Configuration

1. Go to Site administration > Plugins > Local plugins > Chatwoot settings.
2. Enter your Chatwoot websiteToken and baseUrl.
3. Optionaly, enter other settings like dark mode, etc.

## Usage

The Chatwoot chat widget will automatically appear on the frontend of your Moodle site for all users.

## License ##

2024 Davor Budimir <davor@vokabula.com>

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <http://www.gnu.org/licenses/>.
