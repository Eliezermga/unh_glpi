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
    const DEFAULT_LABEL_FORMAT = 'UNH-{FAC}-{BAT}-{TYPE}-{NUM}';

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
                    'title' => __('Entités'),
                    'page'  => '/front/inventoryorganization.entity.php',
                    'icon'  => 'ti ti-building',
                ],
                'location' => [
                    'title' => __('Lieux'),
                    'page'  => '/front/inventoryorganization.location.php',
                    'icon'  => 'ti ti-map-pin',
                ],
                'type' => [
                    'title' => __('Types de matériel'),
                    'page'  => '/front/inventoryorganization.type.php',
                    'icon'  => 'ti ti-devices',
                ],
                'labeling' => [
                    'title' => __('Étiquetage'),
                    'page'  => '/front/inventoryorganization.labeling.php',
                    'icon'  => 'ti ti-tag',
                ],
                'coherence' => [
                    'title' => __('Vérification de cohérence'),
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
        // Keep creation rights aligned with real writable resources used by this module.
        return Session::haveRight(Entity::$rightname, CREATE)
            || Session::haveRight('config', UPDATE)
            || Session::haveRight('dropdown', UPDATE)
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
                'SELECT' => ['serial'],
                'COUNT'  => 'cnt',
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
            'SELECT' => [
                'glpi_computertypes.id',
                'glpi_computertypes.name',
                'COUNT' => 'glpi_computers.id AS cnt'
            ],
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
            'SELECT' => [
                'glpi_monitortypes.id',
                'glpi_monitortypes.name',
                'COUNT' => 'glpi_monitors.id AS cnt'
            ],
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
            'SELECT' => [
                'glpi_printertypes.id',
                'glpi_printertypes.name',
                'COUNT' => 'glpi_printers.id AS cnt'
            ],
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
     * Build an uppercase token from a label-like source.
     *
     * @param string $value
     * @param string $fallback
     * @param int $max_len
     * @return string
     */
    private static function buildToken($value, $fallback, $max_len = 4)
    {
        $clean = strtoupper((string) $value);
        $clean = preg_replace('/[^A-Z0-9]/', '', $clean ?? '');
        if ($clean === '') {
            return $fallback;
        }

        return substr($clean, 0, $max_len);
    }

    /**
     * Resolve faculty token from entity context.
     *
     * @param int $entities_id
     * @return string
     */
    private static function resolveFacultyToken($entities_id = 0)
    {
        global $DB;

        $entity_id = (int) $entities_id;
        if ($entity_id <= 0 && method_exists('Session', 'getActiveEntity')) {
            $entity_id = (int) Session::getActiveEntity();
        }

        if ($entity_id <= 0) {
            return 'FAC';
        }

        $result = $DB->request([
            'SELECT' => ['name', 'completename'],
            'FROM'   => 'glpi_entities',
            'WHERE'  => ['id' => $entity_id],
            'LIMIT'  => 1
        ]);

        if (!($row = $result->current())) {
            return 'FAC';
        }

        // Expected hierarchy: UNH > Faculty > Department.
        $parts = preg_split('/\s*>\s*/', (string) ($row['completename'] ?? ''), -1, PREG_SPLIT_NO_EMPTY);
        if (count($parts) >= 2) {
            return self::buildToken($parts[1], 'FAC');
        }

        return self::buildToken($row['name'] ?? '', 'FAC');
    }

    /**
     * Resolve building token from location context.
     *
     * @param int $locations_id
     * @return string
     */
    private static function resolveBuildingToken($locations_id = 0)
    {
        global $DB;

        $location_id = (int) $locations_id;
        if ($location_id <= 0) {
            return 'BAT';
        }

        $result = $DB->request([
            'SELECT' => ['name', 'completename', 'building'],
            'FROM'   => 'glpi_locations',
            'WHERE'  => ['id' => $location_id],
            'LIMIT'  => 1
        ]);

        if (!($row = $result->current())) {
            return 'BAT';
        }

        if (!empty($row['building'])) {
            return self::buildToken($row['building'], 'BAT');
        }

        // Expected hierarchy: Campus > Building > Floor > Room.
        $parts = preg_split('/\s*>\s*/', (string) ($row['completename'] ?? ''), -1, PREG_SPLIT_NO_EMPTY);
        if (count($parts) >= 2) {
            return self::buildToken($parts[1], 'BAT');
        }

        return self::buildToken($row['name'] ?? '', 'BAT');
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
    public static function generateNextLabel($asset_type, $entities_id = 0, $locations_id = 0)
    {
        global $DB;

        $config = self::getLabelingConfig();
        $prefix = $config['prefix'] ?? 'UNH';
        $type_code = $config['types'][$asset_type] ?? strtoupper(substr($asset_type, 0, 3));
        $padding = $config['padding'] ?? 3;
        $faculty = self::resolveFacultyToken($entities_id);
        $building = self::resolveBuildingToken($locations_id);
        $format = $config['format'] ?? self::DEFAULT_LABEL_FORMAT;

        $is_extended = strpos($format, '{FAC}') !== false || strpos($format, '{BAT}') !== false;

        // Find the highest number for this type
        if ($is_extended) {
            $pattern = sprintf('%s-%s-%s-%s-%%', $prefix, $faculty, $building, $type_code);
        } else {
            $pattern = $prefix . '-' . $type_code . '-%';
        }
        
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
        if ($is_extended) {
            return sprintf('%s-%s-%s-%s-%0' . $padding . 'd', $prefix, $faculty, $building, $type_code, $next_num);
        }

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
        if (empty($type_codes)) {
            return false;
        }
        $types_pattern = implode('|', array_map('preg_quote', $type_codes));
        $number_pattern = '\d{' . ($config['padding'] ?? 3) . ',}';

        // Backward compatibility:
        // - Legacy: PREFIX-TYPE-NNN
        // - Extended: PREFIX-FAC-BAT-TYPE-NNN
        $legacy_pattern = '/^' . $prefix . '-(' . $types_pattern . ')-' . $number_pattern . '$/';
        $extended_pattern = '/^' . $prefix . '-[A-Z0-9]{1,4}-[A-Z0-9]{1,4}-(' . $types_pattern . ')-' . $number_pattern . '$/';

        return (bool) preg_match($legacy_pattern, $label) || (bool) preg_match($extended_pattern, $label);
    }

    /**
     * Create a new entity with simplified wizard
     *
     * @param array $data Entity data
     * @return int|bool Entity ID or false on failure
     */
    public static function createEntity($data)
    {
        if (!Entity::canCreate()) {
            Session::addMessageAfterRedirect(__('The action you have requested is not allowed.'), false, ERROR);
            return false;
        }

        $entity = new Entity();
        $parent_id = (int) ($data['parent_id'] ?? 0);
        if ($parent_id <= 0 && method_exists('Session', 'getActiveEntity')) {
            $parent_id = (int) Session::getActiveEntity();
        }
        if ($parent_id < 0 || !Session::haveAccessToEntity($parent_id, true)) {
            Session::addMessageAfterRedirect(__('The action you have requested is not allowed.'), false, ERROR);
            return false;
        }

        $input = [
            'name'        => $data['name'] ?? '',
            'entities_id' => $parent_id,
            'comment'     => $data['comment'] ?? '',
            'address'     => $data['address'] ?? '',
            'postcode'    => $data['postcode'] ?? '',
            'town'        => $data['town'] ?? '',
            'country'     => $data['country'] ?? '',
        ];

        // Validate
        if (empty($input['name'])) {
            Session::addMessageAfterRedirect(__('Le nom de l entite est requis'), false, ERROR);
            return false;
        }

        $entity_id = $entity->add($input);

        if ($entity_id) {
            Session::addMessageAfterRedirect(
                sprintf(__('Entite "%s" creee avec succes'), $input['name']),
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
        if (!Location::canCreate()) {
            Session::addMessageAfterRedirect(__('The action you have requested is not allowed.'), false, ERROR);
            return false;
        }

        $location = new Location();
        $entity_id = (int) ($data['entity_id'] ?? 0);
        if ($entity_id <= 0 && method_exists('Session', 'getActiveEntity')) {
            $entity_id = (int) Session::getActiveEntity();
        }
        if ($entity_id < 0 || !Session::haveAccessToEntity($entity_id, true)) {
            Session::addMessageAfterRedirect(__('The action you have requested is not allowed.'), false, ERROR);
            return false;
        }

        $parent_location = (int) ($data['parent_id'] ?? 0);
        if ($parent_location > 0) {
            global $DB;
            $parent = $DB->request([
                'SELECT' => ['id', 'entities_id'],
                'FROM'   => 'glpi_locations',
                'WHERE'  => ['id' => $parent_location],
                'LIMIT'  => 1
            ])->current();

            if (!$parent || !Session::haveAccessToEntity((int) ($parent['entities_id'] ?? -1), true)) {
                $parent_location = 0;
            }
        }

        $input = [
            'name'         => $data['name'] ?? '',
            'locations_id' => $parent_location,
            'entities_id'  => $entity_id,
            'comment'      => $data['comment'] ?? '',
            'building'     => $data['building'] ?? '',
            'room'         => $data['room'] ?? '',
        ];

        // Validate
        if (empty($input['name'])) {
            Session::addMessageAfterRedirect(__('Le nom du lieu est requis'), false, ERROR);
            return false;
        }

        $location_id = $location->add($input);

        if ($location_id) {
            Session::addMessageAfterRedirect(
                sprintf(__('Lieu "%s" cree avec succes'), $input['name']),
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
