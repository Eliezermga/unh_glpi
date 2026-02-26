<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * http://glpi-project.org
 *
 * @copyright 2015-2023 Teclib' and contributors.
 * @copyright 2003-2014 by the INDEPNET Development Team.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * ---------------------------------------------------------------------
 */

/**
 * @var DB $DB
 * @var Migration $migration
 */

// Create unicity rule for Asset Tag (otherserial) on Computer globally
// This ensures that each equipment has a unique inventory number across the system
if (!countElementsInTable('glpi_fieldunicities', ['itemtype' => 'Computer', 'fields' => 'otherserial'])) {
    $migration->addPostQuery(
        $DB->buildInsert(
            'glpi_fieldunicities',
            [
                'itemtype'      => 'Computer',
                'fields'        => 'otherserial',
                'name'          => __('Asset Tag Unicity'),
                'is_active'     => 1,
                'is_recursive'  => 1,
                'entities_id'   => 0,
                'action_refuse' => 1,
                'action_notify' => 1,
                'comment'       => __('Ensures that each computer has a unique inventory number (Asset Tag) across all entities'),
                'date_creation' => new \QueryExpression("NOW()"),
                'date_mod'      => new \QueryExpression("NOW()")
            ]
        )
    );

    $migration->displayWarning('Unicity rule created for Computer Asset Tag (otherserial) - globally applied');
}
