<?php

namespace tests\units;

use mageekguy\atoum;

/**
 * Unit tests for the PluginUnhassetsAsset class.
 *
 * These tests verify that the defensive guard against GLPI search option
 * collisions is correctly implemented.  The developer documentation notes
 * that each unit test should correspond to an existing class and reside in
 * the `tests/units` directory【426500206292199†L83-L89】.  This file covers the
 * behaviour of PluginUnhassetsAsset::getSearchOptionsToAdd().
 */
class PluginUnhassetsAssetTest extends atoum\test
{
    /**
     * Ensure that getSearchOptionsToAdd() returns an empty array.
     *
     * GLPI uses numeric search option identifiers across all item types.  When
     * a plugin incorrectly adds its search options to native types, duplicate
     * IDs can occur and trigger warnings【233499453614808†L140-L160】.  Our plugin
     * overrides the method to return an empty array, preventing any
     * integration with native types.  This test asserts that behaviour.
     */
    public function testGetSearchOptionsToAddReturnsEmpty()
    {
        $this
            ->array(\PluginUnhassetsAsset::getSearchOptionsToAdd())
                ->isEmpty();
    }
}