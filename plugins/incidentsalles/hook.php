<?php

function plugin_incidentsalles_install() {
    $migration = new Migration(PLUGIN_INCIDENTSALLES_VERSION);
    return PluginIncidentsallesInstall::install($migration);
}

function plugin_incidentsalles_uninstall() {
    $migration = new Migration(PLUGIN_INCIDENTSALLES_VERSION);
    return PluginIncidentsallesInstall::uninstall($migration);
}
