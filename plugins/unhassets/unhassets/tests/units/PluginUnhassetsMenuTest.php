<?php

namespace tests\units;

use mageekguy\atoum;

/**
 * Unit tests for the PluginUnhassetsMenu class.
 *
 * The menu class builds the navigation structure for the plugin.  After
 * removing the integration of native GLPI asset pages, the menu should
 * include only the plugin’s own pages (dashboard, asset, reservation and
 * license).  This test verifies that no keys corresponding to native
 * GLPI types exist in the returned menu structure.
 */
class PluginUnhassetsMenuTest extends atoum\test
{
    public function testMenuContainsOnlyPluginPages()
    {
        $menu = \PluginUnhassetsMenu::getMenuContent();

        $this
            ->array($menu)
                ->hasKey('options');

        $options = $menu['options'];
        // Ensure that custom pages exist
        $this
            ->boolean(isset($options['dashboard']))->isTrue()
            ->boolean(isset($options['asset']))->isTrue()
            ->boolean(isset($options['reservation']))->isTrue()
            ->boolean(isset($options['license']))->isTrue();

        // Ensure that native GLPI pages have been removed
        foreach (['computer', 'monitor', 'software', 'networkequipment', 'printer', 'peripheral', 'phone'] as $nativeKey) {
            $this->boolean(isset($options[$nativeKey]))->isFalse();
        }
    }
}