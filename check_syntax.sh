#!/bin/bash

# Script to check PHP syntax in parallel to avoid timeouts

# Find all PHP files excluding vendor and tests
find . -name "*.php" -not -path "./vendor/*" -not -path "./tests/*" | \
xargs -n1 -P$(nproc) php -l

# Exit with the status of xargs (0 if all checks passed, non-zero if any failed)
exit $?
