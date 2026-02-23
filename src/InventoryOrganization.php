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
 * InventoryOrganization Class
 * 
 * Manages inventory structuring and organization for GLPI
 * Provides tools for entity creation, location management, material types,
 * standardized labeling, and inventory coherence checking.
 */
class InventoryOrganization extends CommonGLPI
{
    public static $rightname = 'config';

    /**
     * Labeling configuration table
     */
    const LABELING_CONFIG_KEY = 'inventory_labeling_config';

    /**
     * Default labeling format
     */
    const DEFAULT_LABEL_FORMAT = 'UNH-{TYPE}-{NUM}';

    /**
     * Get type name
     *
     * @param int $nb Number for plural
     * @return string
     */
    public static function getTypeName($nb = 0)
    {
        return __('Inventory Organization');
    }

    /**
     * Get menu shortcut
     *
     * @return string
     */
    public static function getMenuShorcut()
    {
        return 'o';
    }

    /**
     * Get icon for the menu
     *
     * @return string
     */
    public static function getIcon()
    {
        return 'ti ti-building-warehouse';
    }

    /**
     * Get menu content for navigation
     *
     * @return array|false
     */
    public static function getMenuContent()
    {
        if (!self::canView()) {
            return false;
        }

        $menu = [
            'title'    => self::getTypeName(),
            'page'     => '/front/inventoryorganization.php',
            'icon'     => self::getIcon(),
            'links'    => [
                'search' => '/front/inventoryorganization.php',
            ],
            'options'  => [
                'entity' => [
                    'title' => __('Entities'),
                    'page'  => '/front/inventoryorganization.entity.php',
                    'icon'  => 'ti ti-building',
                ],
                'location' => [
                    'title' => __('Locations'),
                    'page'  => '/front/inventoryorganization.location.php',
                    'icon'  => 'ti ti-map-pin',
                ],
                'type' => [
                    'title' => __('Material Types'),
                    'page'  => '/front/inventoryorganization.type.php',
                    'icon'  => 'ti ti-devices',
                ],
                'labeling' => [
                    'title' => __('Labeling'),
                    'page'  => '/front/inventoryorganization.labeling.php',
                    'icon'  => 'ti ti-tag',
                ],
                'coherence' => [
                    'title' => __('Coherence Check'),
                    'page'  => '/front/inventoryorganization.coherence.php',
                    'icon'  => 'ti ti-checkbox',
                ],
            ],
        ];

        return $menu;
    }

    /**
     * Check if user can view this module
     *
     * @return bool
     */
    public static function canView()
    {
        // Allow any logged-in user to view
        return Session::getLoginUserID() !== false;
    }

    /**
     * Check if user can create/update in this module
     *
     * @return bool
     */
    public static function canCreate()
    {
        // Allow if user can create entities OR has config rights OR has ticket update rights
        return Session::haveRight(Entity::$rightname, CREATE)
            || Session::haveRight('config', UPDATE) 
            || Session::haveRight('ticket', UPDATE)
            || Session::haveRight('location', CREATE);
    }

    /**
     * Check if user can update in this module
     *
     * @return bool
     */
    public static function canUpdate()
    {
        return self::canCreate();
    }

    /**
     * Get dashboard statistics
     *
     * @return array
     */
    public static function getDashboardStats()
    {
        global $DB;

        $stats = [
            'entities'   => 0,
            'locations'  => 0,
            'computers'  => 0,
            'monitors'   => 0,
            'printers'   => 0,
            'phones'     => 0,
            'peripherals' => 0,
            'total_assets' => 0,
            'issues'     => 0,
        ];

        // Count entities
        $result = $DB->request([
            'COUNT' => 'cnt',
            'FROM'  => 'glpi_entities'
        ]);
        if ($row = $result->current()) {
            $stats['entities'] = $row['cnt'];
        }

        // Count locations
        $result = $DB->request([
            'COUNT' => 'cnt',
            'FROM'  => 'glpi_locations'
        ]);
        if ($row = $result->current()) {
            $stats['locations'] = $row['cnt'];
        }

        // Count computers
        $result = $DB->request([
            'COUNT' => 'cnt',
            'FROM'  => 'glpi_computers',
            'WHERE' => ['is_deleted' => 0]
        ]);
        if ($row = $result->current()) {
            $stats['computers'] = $row['cnt'];
        }

        // Count monitors
        $result = $DB->request([
            'COUNT' => 'cnt',
            'FROM'  => 'glpi_monitors',
            'WHERE' => ['is_deleted' => 0]
        ]);
        if ($row = $result->current()) {
            $stats['monitors'] = $row['cnt'];
        }

        // Count printers
        $result = $DB->request([
            'COUNT' => 'cnt',
            'FROM'  => 'glpi_printers',
            'WHERE' => ['is_deleted' => 0]
        ]);
        if ($row = $result->current()) {
            $stats['printers'] = $row['cnt'];
        }

        // Count phones
        $result = $DB->request([
            'COUNT' => 'cnt',
            'FROM'  => 'glpi_phones',
            'WHERE' => ['is_deleted' => 0]
        ]);
        if ($row = $result->current()) {
            $stats['phones'] = $row['cnt'];
        }

        // Count peripherals
        $result = $DB->request([
            'COUNT' => 'cnt',
            'FROM'  => 'glpi_peripherals',
            'WHERE' => ['is_deleted' => 0]
        ]);
        if ($row = $result->current()) {
            $stats['peripherals'] = $row['cnt'];
        }

        $stats['total_assets'] = $stats['computers'] + $stats['monitors'] + 
                                  $stats['printers'] + $stats['phones'] + 
                                  $stats['peripherals'];

        // Count coherence issues
        $stats['issues'] = count(self::getCoherenceIssues());

        return $stats;
    }

    /**
     * Get coherence issues in the inventory
     *
     * @return array
     */
    public static function getCoherenceIssues()
    {
        global $DB;

        $issues = [];

        // Assets without location
        $asset_tables = [
            'glpi_computers'   => __('Computers'),
            'glpi_monitors'    => __('Monitors'),
            'glpi_printers'    => __('Printers'),
            'glpi_phones'      => __('Phones'),
            'glpi_peripherals' => __('Peripherals'),
        ];

        foreach ($asset_tables as $table => $type_name) {
            $result = $DB->request([
                'SELECT' => ['id', 'name'],
                'FROM'   => $table,
                'WHERE'  => [
                    'is_deleted'   => 0,
                    'locations_id' => 0
                ],
                'LIMIT'  => 10
            ]);

            foreach ($result as $row) {
                $issues[] = [
                    'type'    => 'no_location',
                    'severity' => 'warning',
                    'message' => sprintf(__('%s "%s" has no location assigned'), $type_name, $row['name']),
                    'asset_type' => $type_name,
                    'asset_id'   => $row['id'],
                    'asset_name' => $row['name'],
                ];
            }
        }

        // Assets without entity (should never happen, but check anyway)
        foreach ($asset_tables as $table => $type_name) {
            $result = $DB->request([
                'SELECT' => ['id', 'name'],
                'FROM'   => $table,
                'WHERE'  => [
                    'is_deleted'   => 0,
                    'entities_id'  => 0
                ],
                'LIMIT'  => 10
            ]);

            foreach ($result as $row) {
                $issues[] = [
                    'type'    => 'root_entity',
                    'severity' => 'info',
                    'message' => sprintf(__('%s "%s" is in root entity'), $type_name, $row['name']),
                    'asset_type' => $type_name,
                    'asset_id'   => $row['id'],
                    'asset_name' => $row['name'],
                ];
            }
        }

        // Check for duplicate serial numbers
        foreach (['glpi_computers', 'glpi_monitors', 'glpi_printers'] as $table) {
            $type_name = $asset_tables[$table];
            $result = $DB->request([
                'SELECT' => ['serial', 'COUNT' => 'cnt'],
                'FROM'   => $table,
                'WHERE'  => [
                    'is_deleted' => 0,
                    ['NOT' => ['serial' => '']]
                ],
                'GROUPBY' => 'serial',
                'HAVING'  => ['cnt' => ['>', 1]],
                'LIMIT'   => 5
            ]);

            foreach ($result as $row) {
                $issues[] = [
                    'type'    => 'duplicate_serial',
                    'severity' => 'error',
                    'message' => sprintf(__('Duplicate serial number "%s" found in %s (%d occurrences)'), 
                                        $row['serial'], $type_name, $row['cnt']),
                    'serial'  => $row['serial'],
                ];
            }
        }

        return $issues;
    }

    /**
     * Get location hierarchy
     *
     * @param int $parent_id Parent location ID
     * @return array
     */
    public static function getLocationHierarchy($parent_id = 0)
    {
        global $DB;

        $locations = [];

        $result = $DB->request([
            'SELECT' => ['id', 'name', 'completename', 'level', 'entities_id'],
            'FROM'   => 'glpi_locations',
            'WHERE'  => ['locations_id' => $parent_id],
            'ORDER'  => 'name ASC'
        ]);

        foreach ($result as $row) {
            $row['children'] = self::getLocationHierarchy($row['id']);
            $row['asset_count'] = self::countAssetsInLocation($row['id']);
            $locations[] = $row;
        }

        return $locations;
    }

    /**
     * Count assets in a location
     *
     * @param int $location_id Location ID
     * @return int
     */
    public static function countAssetsInLocation($location_id)
    {
        global $DB;

        $count = 0;
        $tables = ['glpi_computers', 'glpi_monitors', 'glpi_printers', 
                   'glpi_phones', 'glpi_peripherals'];

        foreach ($tables as $table) {
            $result = $DB->request([
                'COUNT' => 'cnt',
                'FROM'  => $table,
                'WHERE' => [
                    'is_deleted'   => 0,
                    'locations_id' => $location_id
                ]
            ]);
            if ($row = $result->current()) {
                $count += $row['cnt'];
            }
        }

        return $count;
    }

    /**
     * Get material types with counts
     *
     * @return array
     */
    public static function getMaterialTypes()
    {
        global $DB;

        $types = [];

        // Computer types
        $result = $DB->request([
            'SELECT' => ['glpi_computertypes.id', 'glpi_computertypes.name', 'COUNT' => 'cnt'],
            'FROM'   => 'glpi_computertypes',
            'LEFT JOIN' => [
                'glpi_computers' => [
                    'ON' => [
                        'glpi_computers' => 'computertypes_id',
                        'glpi_computertypes' => 'id'
                    ]
                ]
            ],
            'WHERE' => ['OR' => [
                ['glpi_computers.is_deleted' => 0],
                ['glpi_computers.id' => null]
            ]],
            'GROUPBY' => 'glpi_computertypes.id',
            'ORDER'   => 'glpi_computertypes.name ASC'
        ]);

        foreach ($result as $row) {
            $types['computer'][] = [
                'id'    => $row['id'],
                'name'  => $row['name'],
                'count' => $row['cnt'] ?? 0,
                'category' => __('Computers'),
                'icon'  => 'ti ti-device-desktop'
            ];
        }

        // Monitor types
        $result = $DB->request([
            'SELECT' => ['glpi_monitortypes.id', 'glpi_monitortypes.name', 'COUNT' => 'cnt'],
            'FROM'   => 'glpi_monitortypes',
            'LEFT JOIN' => [
                'glpi_monitors' => [
                    'ON' => [
                        'glpi_monitors' => 'monitortypes_id',
                        'glpi_monitortypes' => 'id'
                    ]
                ]
            ],
            'WHERE' => ['OR' => [
                ['glpi_monitors.is_deleted' => 0],
                ['glpi_monitors.id' => null]
            ]],
            'GROUPBY' => 'glpi_monitortypes.id',
            'ORDER'   => 'glpi_monitortypes.name ASC'
        ]);

        foreach ($result as $row) {
            $types['monitor'][] = [
                'id'    => $row['id'],
                'name'  => $row['name'],
                'count' => $row['cnt'] ?? 0,
                'category' => __('Monitors'),
                'icon'  => 'ti ti-device-tv'
            ];
        }

        // Printer types
        $result = $DB->request([
            'SELECT' => ['glpi_printertypes.id', 'glpi_printertypes.name', 'COUNT' => 'cnt'],
            'FROM'   => 'glpi_printertypes',
            'LEFT JOIN' => [
                'glpi_printers' => [
                    'ON' => [
                        'glpi_printers' => 'printertypes_id',
                        'glpi_printertypes' => 'id'
                    ]
                ]
            ],
            'WHERE' => ['OR' => [
                ['glpi_printers.is_deleted' => 0],
                ['glpi_printers.id' => null]
            ]],
            'GROUPBY' => 'glpi_printertypes.id',
            'ORDER'   => 'glpi_printertypes.name ASC'
        ]);

        foreach ($result as $row) {
            $types['printer'][] = [
                'id'    => $row['id'],
                'name'  => $row['name'],
                'count' => $row['cnt'] ?? 0,
                'category' => __('Printers'),
                'icon'  => 'ti ti-printer'
            ];
        }

        return $types;
    }

    /**
     * Get labeling configuration
     *
     * @return array
     */
    public static function getLabelingConfig()
    {
        $config = Config::getConfigurationValue('core', self::LABELING_CONFIG_KEY);
        
        if (empty($config)) {
            return [
                'format'  => self::DEFAULT_LABEL_FORMAT,
                'prefix'  => 'UNH',
                'padding' => 3,
                'types'   => [
                    'computer'   => 'PC',
                    'laptop'     => 'LAP',
                    'monitor'    => 'MON',
                    'printer'    => 'IMP',
                    'phone'      => 'TEL',
                    'projector'  => 'PROJ',
                    'peripheral' => 'PER',
                ],
            ];
        }

        return json_decode($config, true);
    }

    /**
     * Save labeling configuration
     *
     * @param array $config Configuration array
     * @return bool
     */
    public static function saveLabelingConfig($config)
    {
        return Config::setConfigurationValues('core', [
            self::LABELING_CONFIG_KEY => json_encode($config)
        ]);
    }

    /**
     * Generate next label for an asset type
     *
     * @param string $asset_type Asset type (computer, monitor, etc.)
     * @return string
     */
    public static function generateNextLabel($asset_type)
    {
        global $DB;

        $config = self::getLabelingConfig();
        $prefix = $config['prefix'] ?? 'UNH';
        $type_code = $config['types'][$asset_type] ?? strtoupper(substr($asset_type, 0, 3));
        $padding = $config['padding'] ?? 3;

        // Find the highest number for this type
        $pattern = $prefix . '-' . $type_code . '-%';
        
        $tables = [
            'computer'   => 'glpi_computers',
            'monitor'    => 'glpi_monitors',
            'printer'    => 'glpi_printers',
            'phone'      => 'glpi_phones',
            'peripheral' => 'glpi_peripherals',
        ];

        $max_num = 0;
        $table = $tables[$asset_type] ?? 'glpi_computers';

        $result = $DB->request([
            'SELECT' => ['name'],
            'FROM'   => $table,
            'WHERE'  => ['name' => ['LIKE', $pattern]],
            'ORDER'  => 'name DESC',
            'LIMIT'  => 1
        ]);

        if ($row = $result->current()) {
            // Extract number from name like "UNH-PC-042"
            if (preg_match('/-(\d+)$/', $row['name'], $matches)) {
                $max_num = (int) $matches[1];
            }
        }

        $next_num = $max_num + 1;
        return sprintf('%s-%s-%0' . $padding . 'd', $prefix, $type_code, $next_num);
    }

    /**
     * Validate a label format
     *
     * @param string $label Label to validate
     * @return bool
     */
    public static function validateLabel($label)
    {
        $config = self::getLabelingConfig();
        $prefix = preg_quote($config['prefix'] ?? 'UNH', '/');
        $type_codes = array_values($config['types'] ?? []);
        $types_pattern = implode('|', array_map('preg_quote', $type_codes));
        
        $pattern = '/^' . $prefix . '-(' . $types_pattern . ')-\d{' . ($config['padding'] ?? 3) . ',}$/';
        
        return (bool) preg_match($pattern, $label);
    }

    /**
     * Create a new entity with simplified wizard
     *
     * @param array $data Entity data
     * @return int|bool Entity ID or false on failure
     */
    public static function createEntity($data)
    {
        $entity = new Entity();
        
        $input = [
            'name'        => $data['name'] ?? '',
            'entities_id' => $data['parent_id'] ?? 0,
            'comment'     => $data['comment'] ?? '',
            'address'     => $data['address'] ?? '',
            'postcode'    => $data['postcode'] ?? '',
            'town'        => $data['town'] ?? '',
            'country'     => $data['country'] ?? '',
        ];

        // Validate
        if (empty($input['name'])) {
            Session::addMessageAfterRedirect(__('Entity name is required'), false, ERROR);
            return false;
        }

        $entity_id = $entity->add($input);

        if ($entity_id) {
            Session::addMessageAfterRedirect(
                sprintf(__('Entity "%s" created successfully'), $input['name']),
                false,
                INFO
            );
        }

        return $entity_id;
    }

    /**
     * Create a new location with hierarchical structure
     *
     * @param array $data Location data
     * @return int|bool Location ID or false on failure
     */
    public static function createLocation($data)
    {
        $location = new Location();
        
        $input = [
            'name'         => $data['name'] ?? '',
            'locations_id' => $data['parent_id'] ?? 0,
            'entities_id'  => $data['entity_id'] ?? 0,
            'comment'      => $data['comment'] ?? '',
            'building'     => $data['building'] ?? '',
            'room'         => $data['room'] ?? '',
        ];

        // Validate
        if (empty($input['name'])) {
            Session::addMessageAfterRedirect(__('Location name is required'), false, ERROR);
            return false;
        }

        $location_id = $location->add($input);

        if ($location_id) {
            Session::addMessageAfterRedirect(
                sprintf(__('Location "%s" created successfully'), $input['name']),
                false,
                INFO
            );
        }

        return $location_id;
    }

    /**
     * Get all entities as a tree structure
     *
     * @param int $parent_id Parent entity ID
     * @return array
     */
    public static function getEntityTree($parent_id = 0)
    {
        global $DB;

        $entities = [];

        $result = $DB->request([
            'SELECT' => ['id', 'name', 'completename', 'level'],
            'FROM'   => 'glpi_entities',
            'WHERE'  => ['entities_id' => $parent_id],
            'ORDER'  => 'name ASC'
        ]);

        foreach ($result as $row) {
            $row['children'] = self::getEntityTree($row['id']);
            $entities[] = $row;
        }

        return $entities;
    }

    /**
     * Get summary for the dashboard
     *
     * @return array
     */
    public static function getSummary()
    {
        $stats = self::getDashboardStats();
        $issues = self::getCoherenceIssues();
        
        return [
            'stats'  => $stats,
            'issues' => $issues,
            'issue_summary' => [
                'total'    => count($issues),
                'errors'   => count(array_filter($issues, fn($i) => $i['severity'] === 'error')),
                'warnings' => count(array_filter($issues, fn($i) => $i['severity'] === 'warning')),
                'info'     => count(array_filter($issues, fn($i) => $i['severity'] === 'info')),
            ],
        ];
    }
}
