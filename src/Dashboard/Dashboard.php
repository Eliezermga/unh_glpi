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

namespace Glpi\Dashboard;

use Ramsey\Uuid\Uuid;
use Session;

class Dashboard extends \CommonDBTM
{
    protected $id      = 0;
    protected $key     = "";
    protected $title   = "";
    protected $embed   = false;
    protected $items   = null;
    protected $rights  = null;
    protected $filters  = "";

    public static $all_dashboards = [];
    public static $rightname = 'dashboard';

    public function __construct(string $dashboard_key = "")
    {
        $this->key = $dashboard_key;
    }

    public static function getIndexName()
    {
        return "key";
    }

    public function load(bool $force = false)
    {
        $loaded = true;
        if (
            $force
            || count($this->fields) == 0
            || $this->fields['id'] == 0
            || strlen($this->fields['name']) == 0
        ) {
            $loaded = $this->getFromDB($this->key);
        }

        if ($loaded) {
            if ($force || $this->items === null) {
                $this->items = Item::getForDashboard($this->fields['id']);
            }

            if ($force || $this->rights === null) {
                $this->rights = Right::getForDashboard($this->fields['id']);
            }
        }

        return $this->fields['id'] ?? false;
    }

    public function getFromDB($ID)
    {
        global $DB;

        $iterator = $DB->request([
            'FROM'  => self::getTable(),
            'WHERE' => [
                'key' => $ID
            ],
            'LIMIT' => 1
        ]);
        if (count($iterator) == 1) {
            $this->fields = $iterator->current();
            $this->key    = $ID;
            $this->post_getFromDB();
            return true;
        } else if (count($iterator) > 1) {
            trigger_error(
                sprintf('getFromDB expects to get one result, %1$s found!', count($iterator)),
                E_USER_WARNING
            );
        }

        return false;
    }

    public function getTitle(): string
    {
        $this->load();
        return $this->fields['name'] ?? "";
    }

    public function canViewCurrent(): bool
    {
        if (self::canView() && !$this->isPrivate()) {
            return true;
        }

        $this->load();
        $rights = self::convertRights($this->rights ?? []);
        return self::checkRights($rights);
    }

    public function saveNew(
        string $title = "",
        string $context = "core",
        array $items = [],
        array $rights = []
    ): string {
        $this->fields['name']   = $title;
        $this->fields['context'] = $context;
        $this->key    = \Toolbox::slugify($title);
        $this->items  = $items;
        $this->rights = $rights;

        $this->save();

        return $this->key;
    }

    public function save(bool $skip_child = false)
    {
        global $DB, $GLPI_CACHE;

        $DB->updateOrInsert(self::getTable(), [
            'key'     => $this->key,
            'name'    => $this->fields['name'],
            'context' => $this->fields['context']
        ], [
            'key'  => $this->key
        ]);

        $this->getFromDB($this->key);

        if (!$skip_child && count($this->items) > 0) {
            $this->saveItems($this->items);
        }

        if (!$skip_child && count($this->rights) > 0) {
            $this->saveRights($this->rights);
        }

        $cache_key = "dashboard_card_" . $this->key;
        $GLPI_CACHE->delete($cache_key);
    }

    public function cleanDBonPurge()
    {
        $this->deleteChildrenAndRelationsFromDb([
            Item::class,
            Right::class,
            Filter::class,
        ]);
    }

    public function saveItems(array $items = [])
    {
        $this->load();
        $this->items   = $items;

        $this->deleteChildrenAndRelationsFromDb([
            Item::class,
        ]);

        Item::addForDashboard($this->fields['id'], $items);
    }

    public function saveTitle(string $title = "")
    {
        if (!strlen($title)) {
            return;
        }

        $this->load();
        $this->fields['name'] = $title;
        $this->save(true);
    }

    public function saveRights(array $rights = [])
    {
        $this->load();
        $this->rights = $rights;

        $this->deleteChildrenAndRelationsFromDb([
            Right::class,
        ]);

        Right::addForDashboard($this->fields['id'], $rights);
    }

    public function saveFilter(string $filters = ''): void
    {
        $this->load();
        $this->filters = $filters;

        Filter::addForDashboard($this->fields['id'], $filters);
    }

    public function getFilter(): string
    {
        $this->load();
        $this->filters = Filter::getForDashboard($this->fields['id']);
        return $this->filters;
    }

    public function cloneCurrent(): array
    {
        $this->load();

        $this->fields['name'] = sprintf(__('Copy of %s'), $this->fields['name']);
        $this->key = \Toolbox::slugify($this->fields['name']);

        $this->items = array_map(function (array $item) {
            $item['gridstack_id'] = $item['card_id'] . Uuid::uuid4();
            return $item;
        }, $this->items);

        $this->rights = self::convertRights($this->rights);

        $this->save();

        return [
            'title' => $this->fields['name'],
            'key'   => $this->key
        ];
    }

    public static function getAll(bool $force = false, bool $check_rights = true, ?string $context = 'core'): array
    {
        global $DB;

        if ($force || count(self::$all_dashboards) == 0) {
            self::$all_dashboards = [];

            $dashboards = iterator_to_array($DB->request(self::getTable()));
            $items      = iterator_to_array($DB->request(Item::getTable()));
            $rights     = iterator_to_array($DB->request(Right::getTable()));

            foreach ($dashboards as $dashboard) {
                $key = $dashboard['key'];
                $id  = $dashboard['id'];

                $d_rights = array_filter($rights, static function ($right_line) use ($id) {
                    return $right_line['dashboards_dashboards_id'] == $id;
                });
                $dashboardItem = new self($key);
                if ($check_rights && !$dashboardItem->canViewCurrent()) {
                    continue;
                }
                $dashboard['rights'] = self::convertRights($d_rights);

                $d_items = array_filter($items, static function ($item) use ($id) {
                    return $item['dashboards_dashboards_id'] == $id;
                });
                $d_items = array_map(static function ($item) {
                    $item['card_options'] = importArrayFromDB($item['card_options']);
                    return $item;
                }, $d_items);
                $dashboard['items'] = $d_items;

                self::$all_dashboards[$key] = $dashboard;
            }
        }

        if ($context !== null && $context !== '') {
            return array_filter(self::$all_dashboards, static function ($dashboard) use ($context) {
                return $dashboard['context'] === $context;
            });
        }

        return self::$all_dashboards;
    }

    public static function convertRights(array $raw_rights = []): array
    {
        $rights = [
            'entities_id' => [],
            'profiles_id' => [],
            'users_id'    => [],
            'groups_id'   => [],
        ];
        foreach ($raw_rights as $right_line) {
            $fk = getForeignKeyFieldForItemType($right_line['itemtype']);
            $rights[$fk][] = $right_line['items_id'];
        }

        return $rights;
    }

    public static function checkRights(array $rights = []): bool
    {
        $default_rights = [
            'entities_id' => [],
            'profiles_id' => [],
            'users_id'    => [],
            'groups_id'   => [],
        ];
        $rights = array_merge_recursive($default_rights, $rights);

        if (!Session::getLoginUserID()) {
            return false;
        }

        if (
            count(array_intersect($rights['entities_id'], $_SESSION['glpiactiveentities']))
            || in_array($_SESSION["glpiactiveprofile"]['id'], $rights['profiles_id'])
            || in_array($_SESSION['glpiID'], $rights['users_id'])
            || count(array_intersect($rights['groups_id'], $_SESSION['glpigroups']))
        ) {
            return true;
        }

        return false;
    }

    public static function importFromJson($import = null)
    {
        if (!is_array($import)) {
            if (!\Toolbox::isJSON($import)) {
                return false;
            }
            $import = json_decode($import, true);
        }

        foreach ($import as $key => $dashboard) {
            $dash_object = new self($key);
            $dash_object->saveNew(
                $dashboard['title']  ?? $key,
                $dashboard['context']  ?? "core",
                $dashboard['items']  ?? [],
                $dashboard['rights'] ?? []
            );
        }

        return true;
    }

    public function setPrivate($is_private)
    {
        $this->load();

        return $this->update([
            'id'       => $this->fields['id'],
            'key'      => $this->fields['key'],
            'users_id' => ($is_private ? Session::getLoginUserID() : 0)
        ]);
    }

    public function getPrivate()
    {
        $this->load();
        if (!isset($this->fields['users_id'])) {
            return '0';
        }
        return $this->fields['users_id'] != '0' ? '1' : '0';
    }

    public function isPrivate(): bool
    {
        if ((bool)$this->getPrivate() === false) {
            return false;
        }
        return $this->fields['users_id'] != Session::getLoginUserID();
    }
}
