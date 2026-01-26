<?php

/**
 * Migration to add location_type field to glpi_locations table
 * 
 * This migration adds a location_type field to distinguish between
 * Site, Building, Floor, Room, and Other location types
 * for better organization in university environments.
 */

/**
 * @var DB $DB
 * @var Migration $migration
 */

global $DB;

// Add location_type column if it doesn't exist
if (!$DB->fieldExists('glpi_locations', 'location_type')) {
    $migration->displayMessage(sprintf(__('Adding field %1$s to table %2$s'), 'location_type', 'glpi_locations'));
    
    $migration->addField(
        'glpi_locations',
        'location_type',
        'string',
        [
            'value' => '',
            'after' => 'name'
        ]
    );
    
    $migration->addKey('glpi_locations', 'location_type', 'location_type');
    
    $migration->migrationOneTable('glpi_locations');
    
    $migration->displayMessage(__('Location type field added successfully.'));
} else {
    $migration->displayMessage(__('Location type field already exists.'));
}

