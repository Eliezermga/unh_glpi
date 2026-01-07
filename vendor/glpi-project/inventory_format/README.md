GLPI Inventory format
---------------------

This is the specification for inventory format integrated in GLPI core.

It relies on [JSON Schema](https://json-schema.org).

The [inventory.schema.json](inventory.schema.json) file is the JSON schema itself.

The [lib/php](lib/php) directory contains a PHP class that cans handle conversion from XML files to new format; with some adjustments. You can either use directly ``Convert`` from your project, or rely on the [executable script](bin/convert) provided.
