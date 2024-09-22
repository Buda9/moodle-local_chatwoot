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

/**
 * Admin setting for disabled text input.
 *
 * @package    local_chatwoot
 * @copyright  2024 Davor Budimir <davor@vokabula.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_chatwoot;

defined('MOODLE_INTERNAL') || die();

class admin_setting_configtext_disabled extends \admin_setting_configtext {

    /**
     * Output the HTML for this setting.
     *
     * @param mixed $data
     * @param string $query
     * @return string
     */
    public function output_html($data, $query='') {
        $default = $this->get_defaultsetting();
        $context = (object) [
            'id' => $this->get_id(),
            'name' => $this->get_full_name(),
            'size' => $this->size,
            'value' => $data,
            'forceltr' => $this->get_force_ltr(),
            'disabled' => true,
        ];
        $element = \html_writer::empty_tag('input', [
            'type' => 'text',
            'id' => $context->id,
            'name' => $context->name,
            'size' => $context->size,
            'value' => $context->value,
            'class' => 'form-control',
            'disabled' => 'disabled'
        ]);

        return format_admin_setting($this, $this->visiblename, $element, $this->description, true, '', $default, $query);
    }
}