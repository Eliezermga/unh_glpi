<?php

namespace tests\units;

use mageekguy\atoum;

/**
 * Unit tests for the PluginUnhassetsReservation class.
 *
 * Like the Asset and License classes, the Reservation class must not add
 * search options to native GLPI item types.  This test confirms the
 * defensive behaviour by asserting that getSearchOptionsToAdd() returns an
 * empty array【233499453614808†L140-L160】.
 */
class PluginUnhassetsReservationTest extends atoum\test
{
    public function testGetSearchOptionsToAddReturnsEmpty()
    {
        $this
            ->array(\PluginUnhassetsReservation::getSearchOptionsToAdd())
                ->isEmpty();
    }
}