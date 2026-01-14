<?php

function plugin_accesssecurite_install() {
    $migration = new Migration(PLUGIN_ACCESSSECURITE_VERSION);
    return PluginAccesssecuriteInstall::install($migration);
}

function plugin_accesssecurite_uninstall() {
    $migration = new Migration(PLUGIN_ACCESSSECURITE_VERSION);
    return PluginAccesssecuriteInstall::uninstall($migration);
}
