<?php

namespace tests\units;

use mageekguy\atoum;

/**
 * Unit tests for the PluginUnhassetsLicense class.
 *
 * The License class extends CommonDBTM but should not inject its search
 * options into native GLPI item types.  This test ensures that
 * getSearchOptionsToAdd() returns an empty array, thereby avoiding
 * duplicate key warnings reported by GLPI【233499453614808†L140-L160】.
 */
class PluginUnhassetsLicenseTest extends atoum\test
{
    public function testGetSearchOptionsToAddReturnsEmpty()
    {
        $this
            ->array(\PluginUnhassetsLicense::getSearchOptionsToAdd())
                ->isEmpty();
    }
}