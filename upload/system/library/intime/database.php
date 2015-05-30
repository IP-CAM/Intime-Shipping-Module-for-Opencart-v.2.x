<?php

/**
 * OpenCart Ukrainian Community
 * This Product Made in Ukraine
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License, Version 3
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/copyleft/gpl.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 *
 * @category   OpenCart
 * @package    Intime Shipping
 * @copyright  Copyright (c) 2011 Eugene Lifescale (a.k.a. Shaman) by OpenCart Ukrainian Community (http://opencart-ukraine.tumblr.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License, Version 3
 */

final class IntimeDatabase {

    private $db;
    private $config;

    public function __construct($config, $db) {

        // Init variables
        $this->db     = $db;
        $this->config = $config;

        // Install the database
        $this->db->query("
        CREATE TABLE IF NOT EXISTS `intime_warehouse` (
          `warehouse_id` int(11) NOT NULL AUTO_INCREMENT,
          `language_id` int(11) NOT NULL,
          `warehouse_number_in_city` int(11) NOT NULL,
          `weight_limit` decimal(5,2) NOT NULL,
          `limited_length` decimal(5,2) NOT NULL,
          `parcel` tinyint(4) NOT NULL,
          `name` varchar(255) NOT NULL,
          `code` varchar(255) NOT NULL,
          `liter_code` varchar(255) NOT NULL,
          `state` varchar(255) NOT NULL,
          `city` varchar(255) NOT NULL,
          `adress` varchar(255) NOT NULL,
          `telephone` varchar(255) NOT NULL,
          PRIMARY KEY (`warehouse_id`),
          UNIQUE KEY `code` (`language_id`,`code`),
          KEY `language_id` (`language_id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
    }

    public function resetDB() {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "intime_warehouse`");
    }

    public function addWarehouse(
        $code,
        $name,
        $warehouse_number_in_city,
        $weight_limit,
        $limited_length,
        $parcel,
        $liter_code,
        $state,
        $city,
        $adress,
        $telephone) {

        $this->db->query("INSERT INTO `" . DB_PREFIX . "intime_warehouse` SET
        `code` = '" . $this->db->escape($code) . "',
        `liter_code` = '" . $this->db->escape($liter_code) . "',
        `language_id` = '" . (int)$this->config->get('config_language_id') . "',
        `warehouse_number_in_city` = '" . (int) $warehouse_number_in_city . "',
        `weight_limit` = '" . (float) $weight_limit . "',
        `limited_length` = '" . (float) $limited_length . "',
        `parcel` = '" . (int) $parcel . "',
        `name` = '" . $this->db->escape($name) . "',
        `state` = '" . $this->db->escape($state) . "',
        `city` = '" . $this->db->escape($city) . "',
        `adress` = '" . $this->db->escape($adress) . "',
        `telephone` = '" . $this->db->escape($telephone) . "'");

        return $this->db->getLastId();
    }

    public function getWarehouse($warehouse_id) {
        $result = $this->db->query("SELECT * FROM `" . DB_PREFIX . "intime_warehouse` WHERE `warehouse_id` = '" . (int) $warehouse_id . "' AND `language_id` = '" . (int)$this->config->get('config_language_id') . "' LIMIT 1");
        return $result->row;
    }

    public function getWarehouses(array $data, $limit = 20, $strict = false) {

        $sql  = "SELECT * FROM `" . DB_PREFIX . "intime_warehouse` WHERE `language_id` = '" . (int)$this->config->get('config_language_id') . "'";

        if (isset($data['filter_state'])) {
            $sql .= " AND `state` LIKE '" . $this->db->escape($data['filter_state']) . ($strict ? false : "%") . "'";
        }

        if (isset($data['filter_city'])) {
            $sql .= " AND `city` LIKE '" . $this->db->escape($data['filter_city']) . ($strict ? false : "%") . "'";
        }

        switch (true) {
            case isset($data['filter_state']) && isset($data['filter_city']):
                $sql .= " GROUP BY `warehouse_id`";
            break;
            case isset($data['filter_city']):
                $sql .= " GROUP BY `city`";
            break;
            default:
                $sql .= " GROUP BY `warehouse_id`";
        }

        $sql .= " LIMIT " . (int) $limit;

        $result = $this->db->query($sql);
        return $result->rows;
    }
}
