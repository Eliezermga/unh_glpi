# Changelog

The present file will list all changes made to the project; according to the
[Keep a Changelog](http://keepachangelog.com/) project.

## [1.1.30] - 2023-03-30
Several fixes

## [1.1.29] - 2023-03-29
Update third party dependencies
Rework hardware JSON file build

## [1.1.28] - 2023-02-23

Revert management IP refactoring
Revert keep network equipments IP node out of IPS

## [1.1.27] - 2023-02-02

Refactor management IP
Manage assettag

## [1.1.26] - 2023-0-1-25

Keep network equipments IP node out of IPS
Fix LLDP connections ifnumber cast

## [1.1.25] - 2022-11-29

Fix integers conversion from XML

## [1.1.24] - 2022-11-24

Fix sysdescr handling

## [1.1.23] - 2022-11-21

Handle unmanaged assets

## [1.1.22] - 2022-11-16

Fix network port aggregation as string

## [1.1.21] - 2022-10-21

Fix last boot date format

## [1.1.20] - 2022-09-23

Drop storage interface pattern
Remove unneeded files from release

## [1.1.19] - 2022-07-13

Add new examples

## [1.1.18] - 2022-07-11

Update examples

## [1.1.17] - 2022-06-29

Propely handle standalone components
Fix tag conversion
Improve schema documentation

## [1.1.16] - 2022-06-10

vmtype is no longer required
Add missing model and serial on controllers
Drop vmtype pattern

## [1.1.15] - 2022-06-03

Handle powersupplies max_power conversion

## [1.1.14] - 2022-04-07

Add more possible values for ports status
Add more CPUs archs

## [1.1.13] - 2022-02-14

Add extra schema properties
Fix network data conversion
Add missing printers properties

## [1.1.12] - 2022-01-21

Soft cast for integers and booleans
Minor schema fixes

## [1.1.11] - 2022-01-05

Missing battery power conversions

## [1.1.10] - 2021-11-16

Update virtual machines regexp
Fix IPs conversion from network discoveries

## [1.1.9] - 2021-11-10

Add credentials id

## [1.1.8] - 2021-11-03

Network discoveries conversion
Add job id

## [1.1.7] - 2021-09-20

Improve batteries capacity and voltage conversion

## [1.1.6] - 2021-09-16

Missed possible date format in conversions
Use constants instead of private properties for external JSON files

## [1.1.5] - 2021-07-29

Remove obsolete hardware/oscomments
Remove obsolete virtualmachines/vmid
Improve update example with several memory components updated

## [1.1.4] - 2021-07-19

Drop accountinfo

## [1.1.3] - 2021-07-19

Add secure_boot support
Add tag node

## [1.1.2] - 2021-07-19

Change query to action

## [1.1.1] - 2021-07-06

Rework databases schemas a bit

## [1.1.0] - 2021-06-28

Various schema update/fixes/improvements, including:

List instances under related database, makes updates easier
Do not allow additional properties
Handle no longer existing nodes; rename old networks/macaddr
Fix OS installation date
Various fixes
Disable replacements that should not exists (no if(in|out)(octets|bytes) in connections
Fix examples, missing backup date in dbs specs
Network compoonents can have ip and mac (wifi access points), and firmwares versions
Rework DB schema, rename main node
No ifalias on connections

## [1.0.9] - 2021-06-11

Add databases support
Few fixes on lod data
Add timezone support on datetime

## [1.0.8] - 2021-05-17

Missed conversions

## [1.0.7] - 2021-05-17

Fix invalid schema properties

## [1.0.6] - 2021-04-29

Schema validation was not effective

## [1.0.5] - 2021-03-24

Add partial inventory support

## [1.0.4] - 2021-03-19

Fix camera formats specs
Add designation on cameras

## [1.0.3] - 2021-03-11

Fix conversion in some cases
Fix conversion whith only one camera
Add remote management version

## [1.0.2] - 2021-01-20

Split download source files and conversion
Add separate download command

## [1.0.1] - 2021-01-20

Fix issue downloading iftypes source file
Add license

## [1.0.0] - 2021-01-18

First release; compatible with fusioninventory agent
