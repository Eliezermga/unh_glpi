<?php

/**
 * UNH Custom Migration - Add university-specific fields to Entity
 */

use Glpi\DatabaseUtils;

/**
 * Add university-specific fields to Entity
 *
 * @return bool
 */
function addUniversityFieldsToEntity()
{
    global $DB;

    $table = 'glpi_entities';

    // Add physical_location field
    if (!$DB->fieldExists($table, 'physical_location')) {
        $DB->query(
            "ALTER TABLE `" . $table . "`
             ADD COLUMN `physical_location` VARCHAR(255) NULL DEFAULT NULL
             AFTER `address`"
        );
    }

    // Add responsible_user_id field
    if (!$DB->fieldExists($table, 'responsible_user_id')) {
        $DB->query(
            "ALTER TABLE `" . $table . "`
             ADD COLUMN `responsible_user_id` INT(11) NULL DEFAULT NULL
             AFTER `physical_location`"
        );
    }

    return true;
}

if (!addUniversityFieldsToEntity()) {
    echo "Error: Unable to add university fields to Entity\n";
    return false;
}

echo "University fields added to Entity successfully\n";
return true;
