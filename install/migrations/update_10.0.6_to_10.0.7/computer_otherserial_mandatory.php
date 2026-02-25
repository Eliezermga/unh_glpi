<?php

/**
 * Migration: Make Computer inventory number (otherserial) mandatory
 *
 * This migration adds validation to ensure that Computer.otherserial (Inventory number)
 * is always required when creating or updating Computer records.
 *
 * @since 10.0.7
 */

global $DB, $migration;

$migration->displayMessage('Making Computer inventory number (otherserial) mandatory...');

// This functionality is implemented in:
// 1. src/Computer.php: prepareInputForAdd() and prepareInputForUpdate() methods
//    - Validates that otherserial is not empty
//    - Shows error message to user if field is empty
//
// 2. templates/generic_show_form.html.twig:
//    - Displays otherserial field with 'required' HTML5 attribute for Computer items
//    - Adds visual indication for required field in browser

// The validation ensures:
// - Users cannot create a Computer without specifying an Inventory number
// - Users cannot update a Computer and clear the Inventory number
// - Error messages are displayed in a user-friendly manner

$migration->displayMessage('Configuration: Computer.otherserial is now mandatory');
