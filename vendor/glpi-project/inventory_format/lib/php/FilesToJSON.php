<?php

/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2015-2018 Teclib' and contributors.
 *
 * http://glpi-project.org
 *
 * based on GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2003-2014 by the INDEPNET Development Team.
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * GLPI is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * GLPI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 *
 * PHP version 7
 *
 * @category  Inventory
 * @package   Glpi
 * @author    Johan Cwiklinski <jcwiklinski@teclib.com>
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL License 3.0 or (at your option) any later version
 * @link      https://glpi-project.org
 */

namespace Glpi\Inventory;

/**
 * Converts old FusionInventory XML format to new JSON schema
 * for automatic inventory.
 *
 * @category  Inventory
 * @package   Glpi
 * @author    Johan Cwiklinski <jcwiklinski@teclib.com>
 * @copyright 2018-2023 GLPI Team and Contributors
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL License 3.0 or (at your option) any later version
 * @link      https://glpi-project.org
 */
final class FilesToJSON
{
    public const TYPE_PCI = 'pciid';
    public const TYPE_USB = 'usbid';
    public const TYPE_OUI = 'ouis';
    public const TYPE_IFTYPE = 'iftype';

    private const SOURCES_URLS = [
        self::TYPE_PCI    => 'https://pci-ids.ucw.cz/v2.2/pci.ids',
        self::TYPE_USB    => 'http://www.linux-usb.org/usb.ids',
        self::TYPE_OUI    => 'https://standards-oui.ieee.org/oui/oui.txt',
        self::TYPE_IFTYPE => 'https://www.iana.org/assignments/smi-numbers/smi-numbers-5.csv',
    ];

    /**
     * @var string
     */
    private $path = __DIR__ . '/../../data';

    /**
     * Get JSON file path
     *
     * @param string $type Type (either 'pci', 'usb' or 'oui')
     *
     * @return string
     */
    public function getJsonFilePath(string $type): string
    {
        return $this->path . '/' . $type . '.json';
    }

    /**
     * Download new sources
     *
     * @throws \RuntimeException
     * @return void
     */
    public function refreshSources()
    {
        foreach (self::SOURCES_URLS as $type => $uri) {
            $path     = $this->getSourceFilePath($type);
            $contents = $this->callCurl($uri);

            if (file_put_contents($path, $contents) !== strlen($contents)) {
                throw new \RuntimeException(sprintf('Unable to write content in %s.', $path));
            }
        }
    }

    /**
     * Runs all conversions
     *
     * @throws \RuntimeException
     * @return void
     */
    public function run(): void
    {
        $this->convertPciFile();
        $this->convertUsbFile();
        $this->convertOUIFile();
        $this->convertIftypeFile();
    }

    /**
     * Return source file name for given type.
     *
     * @param string $type
     * @return string
     */
    private function getSourceFilename(string $type): string
    {
        $basename = null;

        switch ($type) {
            case self::TYPE_PCI:
                $basename = 'pci.ids';
                break;
            case self::TYPE_USB:
                $basename = 'usb.ids';
                break;
            case self::TYPE_OUI:
                $basename = 'oui.txt';
                break;
            case self::TYPE_IFTYPE:
                $basename = 'iftype.csv';
                break;
            default:
                throw new \RuntimeException('Unknown type ' . $type);
        }

        return $basename;
    }

    /**
     * Get source file path
     *
     * @param string $type File type
     *
     * @return string
     */
    private function getSourceFilePath(string $type): string
    {
        return $this->path . '/' . $this->getSourceFilename($type);
    }

    /**
     * Get file for type
     *
     * @param string  $type     Type
     * @throws \RuntimeException
     * @return resource
     */
    private function getSourceFile(string $type)
    {
        $path = $this->getSourceFilePath($type);

        if (!file_exists($path)) {
            // Fallback to default source file
            $path = __DIR__ . '/../../source_files/' . $this->getSourceFilename($type);

            if (!file_exists($path)) {
                throw new \RuntimeException(sprintf('Source file %s not found.', $this->getSourceFilename($type)));
            }
        }

        $file = fopen($path, 'r');

        if ($file === false) {
            throw new \RuntimeException(sprintf('Unable to open source file %s.', $path));
        }

        return $file;
    }

    /**
     * Convert PCI file from IDS to JSON
     *
     * @throws \RuntimeException
     * @return void
     */
    private function convertPciFile(): void
    {
        $pciFile = $this->getSourceFile(self::TYPE_PCI);
        $pci_ids = [];

        while ($buffer = fgets($pciFile)) {
            $stack = [];
            if (preg_match("/^(\w+)\s*(.+)/i", $buffer, $stack)) {
                $vendorId = $stack[1];
                $pci_ids[$vendorId] = $stack[2];
            }

            $stack = [];
            if (preg_match("/^\t(\w+)\s*(.+)/i", $buffer, $stack)) {
                $deviceId = $stack[1];
                $pci_ids[$vendorId . '::' . $deviceId] = $stack[2];
            }
        }

        if (!feof($pciFile)) {
            // Ensure source file reading reach end of file.
            throw new \RuntimeException('Error while reading PCI source file.');
        }

        $this->writeJsonFile(self::TYPE_PCI, $pci_ids);
    }

    /**
     * Convert USB file from IDS to JSON
     *
     * @throws \RuntimeException
     * @return void
     */
    private function convertUsbFile(): void
    {
        $usbFile = $this->getSourceFile(self::TYPE_USB);
        $usb_ids = [];

        while ($buffer = fgets($usbFile)) {
            $stack = [];
            if (preg_match("/^(\w+)\s*(.+)/i", $buffer, $stack)) {
                $vendorId = $stack[1];
                $usb_ids[$vendorId] = $stack[2];
            }

            $stack = [];
            if (preg_match("/^\t(\w+)\s*(.+)/i", $buffer, $stack)) {
                $deviceId = $stack[1];
                $usb_ids[$vendorId . '::' . $deviceId] = $stack[2];
            }
        }

        if (!feof($usbFile)) {
            // Ensure source file reading reach end of file.
            throw new \RuntimeException('Error while reading USB source file.');
        }

        $this->writeJsonFile(self::TYPE_USB, $usb_ids);
    }


    /**
     * Convert OUI file from TXT to JSON
     *
     * @throws \RuntimeException
     * @return void
     */
    private function convertOUIFile(): void
    {
        $ouiFile = $this->getSourceFile(self::TYPE_OUI);
        $ouis = [];

        while ($buffer = fgets($ouiFile)) {
            $stack = [];
            if (preg_match("/^(\S+)\s*\(hex\)\t{2}(.+)/i", $buffer, $stack)) {
                $mac = strtr($stack[1], '-', ':');
                $ouis[$mac] = trim($stack[2]);
            }
        }

        if (!feof($ouiFile)) {
            // Ensure source file reading reach end of file.
            throw new \RuntimeException('Error while reading OUI source file.');
        }

        $this->writeJsonFile(self::TYPE_OUI, $ouis);
    }

    /**
     * Convert iftype file from CSV to JSON
     *
     * @throws \RuntimeException
     * @return void
     */
    private function convertIftypeFile(): void
    {
        $iftypeFile = $this->getSourceFile(self::TYPE_IFTYPE);
        $iftypes = [];

        while ($line = fgetcsv($iftypeFile)) {
            $iftypes[] = [
                'decimal'     => $line[0],
                'name'        => $line[1],
                'description' => $line[2] ?? '',
                'references'  => $line[3] ?? ''
            ];
        }

        if (!feof($iftypeFile)) {
            // Ensure source file reading reach end of file.
            throw new \RuntimeException('Error while reading IFtype source file.');
        }

        $this->writeJsonFile(self::TYPE_IFTYPE, $iftypes);
    }

    /**
     * Write converted source into corresponding file.
     *
     * @param string $type
     * @param array $data
     * @throws \RuntimeException
     * @return void
     */
    private function writeJsonFile(string $type, array $data): void
    {
        $path     = $this->getJsonFilePath($type);
        $contents = json_encode($data, JSON_PRETTY_PRINT);

        if ($contents === false) {
            throw new \RuntimeException(sprintf('Error while encoding "%s" data to JSON.', $type));
        }

        if (!file_put_contents($path, $contents) === strlen($contents)) {
            throw new \RuntimeException(sprintf('Unable to write "%s" JSON into "%s".', $type, $path));
        }
    }

    /**
     * Executes a curl call
     *
     * @param string $url   URL to retrieve
     * @throws \RuntimeException
     * @return string
     */
    private function callCurl($url): string
    {
        $ch = curl_init($url);

        $opts = [
            CURLOPT_URL             => $url,
            CURLOPT_USERAGENT       => "GLPI/Inventory format 1.0",
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_FOLLOWLOCATION  => true,
        ];
        curl_setopt_array($ch, $opts);

        $content = curl_exec($ch);
        $curl_error = curl_error($ch) ?: null;
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $msgerr = null;
        if ($curl_error !== null) {
            $msgerr = $curl_error;
        } elseif ($status_code !== 200) {
            $msgerr = sprintf(
                'HTTP code %s received from %s',
                $status_code,
                $url
            );
        } elseif (empty($content)) {
            $msgerr = sprintf(
                'No data available on %s',
                $url
            );
        }

        if ($msgerr !== null) {
            throw new \RuntimeException($msgerr);
        }

        return $content;
    }
}
