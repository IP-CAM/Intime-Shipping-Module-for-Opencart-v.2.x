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

class ControllerShippingIntime extends Controller {

    private $error = array();

    public function __construct($registry) {

        parent::__construct($registry);

        $this->data = $this->load->language('shipping/intime');
        $this->load->model('setting/setting');
    }

    public function index() {
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('intime', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->document->setTitle($this->language->get('heading_title'));

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_shipping'),
            'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('shipping/intime', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('shipping/intime', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['update'] = $this->url->link('shipping/intime/update', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['token']  = $this->session->data['token'];

        if (isset($this->request->post['intime_id'])) {
            $this->data['intime_id'] = $this->request->post['intime_id'];
        } else {
            $this->data['intime_id'] = $this->config->get('intime_id');
        }

        if (isset($this->request->post['intime_key'])) {
            $this->data['intime_key'] = $this->request->post['intime_key'];
        } else {
            $this->data['intime_key'] = $this->config->get('intime_key');
        }

        if (isset($this->request->post['intime_sender_place'])) {
            $this->data['intime_sender_place'] = $this->request->post['intime_sender_place'];
        } else {
            $this->data['intime_sender_place'] = $this->config->get('intime_sender_place');
        }

        if (isset($this->request->post['intime_sender_state'])) {
            $this->data['intime_sender_state'] = $this->request->post['intime_sender_state'];
        } else {
            $this->data['intime_sender_state'] = $this->config->get('intime_sender_state');
        }

        if (isset($this->request->post['intime_sender_city'])) {
            $this->data['intime_sender_city'] = $this->request->post['intime_sender_city'];
        } else {
            $this->data['intime_sender_city'] = $this->config->get('intime_sender_city');
        }

        if (isset($this->request->post['intime_sender_warehouse_code'])) {
            $this->data['intime_sender_warehouse_code'] = $this->request->post['intime_sender_warehouse_code'];
        } else {
            $this->data['intime_sender_warehouse_code'] = $this->config->get('intime_sender_warehouse_code');
        }

        if (isset($this->request->post['intime_sender_phone'])) {
            $this->data['intime_sender_phone'] = $this->request->post['intime_sender_phone'];
        } else {
            $this->data['intime_sender_phone'] = $this->config->get('intime_sender_phone');
        }

        if (isset($this->request->post['intime_insurance_сost'])) {
            $this->data['intime_insurance_сost'] = $this->request->post['intime_insurance_сost'];
        } else {
            $this->data['intime_insurance_сost'] = $this->config->get('intime_insurance_сost');
        }

        if (isset($this->request->post['intime_pod_amount'])) {
            $this->data['intime_pod_amount'] = $this->request->post['intime_pod_amount'];
        } else {
            $this->data['intime_pod_amount'] = $this->config->get('intime_pod_amount');
        }

        if (isset($this->request->post['intime_pod_payment_type'])) {
            $this->data['intime_pod_payment_type'] = $this->request->post['intime_pod_payment_type'];
        } else {
            $this->data['intime_pod_payment_type'] = $this->config->get('intime_pod_payment_type');
        }

        if (isset($this->request->post['intime_geo_zone_id'])) {
            $this->data['intime_geo_zone_id'] = $this->request->post['intime_geo_zone_id'];
        } else {
            $this->data['intime_geo_zone_id'] = $this->config->get('intime_geo_zone_id');
        }

        if (isset($this->request->post['intime_status'])) {
            $this->data['intime_status'] = $this->request->post['intime_status'];
        } else {
            $this->data['intime_status'] = $this->config->get('intime_status');
        }

        if (isset($this->request->post['intime_comment'])) {
            $this->data['intime_comment'] = $this->request->post['intime_comment'];
        } else {
            $this->data['intime_comment'] = $this->config->get('intime_comment');
        }

        if (isset($this->request->post['intime_sort_order'])) {
            $this->data['intime_sort_order'] = $this->request->post['intime_sort_order'];
        } else {
            $this->data['intime_sort_order'] = $this->config->get('intime_sort_order');
        }

        $this->data['warehouses'] = array();

        $this->load->model('localisation/geo_zone');

        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        $this->template = 'shipping/intime.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function autocomplete() {

        $json = array();

        if (isset($this->request->post['filter_city'])) {

            $this->load->library('intime/database');

            $intime_database = new IntimeDatabase($this->config, $this->db);
            $results = $intime_database->getWarehouses(array('filter_city' => $this->request->post['filter_city']));

            foreach ($results as $result) {
                $json[] = array(
                    'warehouse_code' => $result['code'],
                    'name'           => $result['city'] . ' (' . $result['state'] . ')',
                    'city'           => $result['city'],
                    'state'          => $result['state'],
                );
            }
        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->setOutput(json_encode($json));
    }

    public function warehouse() {

        $json = array();

        if (isset($this->request->get['filter_state']) && isset($this->request->get['filter_city'])) {

            $this->load->library('intime/database');

            $intime_database = new IntimeDatabase($this->config, $this->db);
            $results = $intime_database->getWarehouses(
                array(
                    'filter_state' => $this->request->get['filter_state'],
                    'filter_city'  => $this->request->get['filter_city']
                ), 1000, true
            );

            foreach ($results as $result) {
                $json[] = array(
                    'warehouse_code' => $result['code'],
                    'name'           => sprintf($this->language->get('text_warehouse_number_in_city'), $result['warehouse_number_in_city'], $result['adress']),
                );
            }
        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->setOutput(json_encode($json));
    }

    public function update() {

        // Load dependencies
        $this->load->library('intime/intime');
        $this->load->library('intime/database');

        // Init counter variables
        $warehouses_updated = 0;

        // API init
        $intime = new Intime($this->config->get('intime_id'), $this->config->get('intime_key'));
        $intime_database = new IntimeDatabase($this->config, $this->db);

        // Get Intime departments
        $results = $intime->catalogList('Departments');


        // Save data into the database
        if (isset($results['InterfaceState']) && $results['InterfaceState'] == 'OK' && isset($results['ListCatalog']['Catalog'])) {

            // Reset DB
            $intime_database->resetDB();

            // Update DB
            foreach ($results['ListCatalog']['Catalog'] as $result) {

                $warehouse_number_in_city = 0;
                $weight_limit = 0;
                $limited_length = 0;
                $parcel = 0;
                $liter_code = false;
                $state = false;
                $city = false;
                $adress = false;
                $telephone = false;

                foreach ($result['AppendField'] as $field) {

                    if ($field['AppendFieldName'] == 'WarehouseNumberInCity') {
                        $warehouse_number_in_city = trim($field['AppendFieldValue']);
                    }

                    if ($field['AppendFieldName'] == 'WeightLimit') {
                        $weight_limit = trim($field['AppendFieldValue']);
                    }

                    if ($field['AppendFieldName'] == 'LimitedLength') {
                        $limited_length = trim($field['AppendFieldValue']);
                    }

                    if ($field['AppendFieldName'] == 'Parcel' && $field['AppendFieldValue'] == 'Да') {
                        $parcel = 1;
                    }

                    if ($field['AppendFieldName'] == 'LiterCode') {
                        $liter_code = trim($field['AppendFieldValue']);
                    }

                    if ($field['AppendFieldName'] == 'State') {
                        $state = trim($field['AppendFieldValue']);
                    }

                    if ($field['AppendFieldName'] == 'City') {
                        $city = trim($field['AppendFieldValue']);
                    }

                    if ($field['AppendFieldName'] == 'Adress') {
                        $adress = trim($field['AppendFieldValue']);
                    }

                    if ($field['AppendFieldName'] == 'Tel') {
                        $telephone = trim($field['AppendFieldValue']);
                    }
                }

                $warehouse_code = $intime_database->addWarehouse( $result['Code'],
                                                                $result['Name'],
                                                                $warehouse_number_in_city,
                                                                $weight_limit,
                                                                $limited_length,
                                                                $parcel,
                                                                $liter_code,
                                                                $state,
                                                                $city,
                                                                $adress,
                                                                $telephone);

                if ($warehouse_code) {
                    $warehouses_updated++;
                }
            }
        }

        // Success
        $this->session->data['success'] = sprintf($this->language->get('text_update_success'), $warehouses_updated);
        $this->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'shipping/intime')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}
