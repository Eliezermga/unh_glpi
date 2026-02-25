<?php

namespace tests\units;

use mageekguy\atoum;

/**
 * Unit tests for the PluginUnhassetsAssetTab class.
 *
 * AssetTab extends CommonGLPI and is used solely to add an information tab
 * on native GLPI item pages.  In our modified plugin, this class is no
 * longer registered via Plugin::registerClass(), but the defensive guard
 * against search option injection remains.  This test checks that
 * getSearchOptionsToAdd() returns an empty array and that the class
 * inherits from CommonGLPI.
 */
class PluginUnhassetsAssetTabTest extends atoum\test
{
    public function testGetSearchOptionsToAddReturnsEmpty()
    {
        $this
            ->array(\PluginUnhassetsAssetTab::getSearchOptionsToAdd())
                ->isEmpty();
    }

    public function testClassExtendsCommonGLPI()
    {
        $this
            ->boolean(is_subclass_of(\PluginUnhassetsAssetTab::class, \CommonGLPI::class))
                ->isTrue();
    }
}