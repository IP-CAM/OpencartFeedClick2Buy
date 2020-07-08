<?php
class ControllerFeedClick2BuyCSV extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('feed/click2buy_csv');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('click2buy_csv', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->document->addScript('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js');

		$data['store_id'] = $this->language->get('store_id');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');

		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_data_feed'] = $this->language->get('entry_data_feed');
		$data['entry_data_feed_seperator'] = $this->language->get('entry_data_feed_seperator');

 		$data['entry_source_language'] = $this->language->get('entry_source_language');
 		$data['entry_category'] = $this->language->get('entry_category');
 		$data['entry_securitycode'] = $this->language->get('entry_securitycode');
 		$data['entry_location_zip'] = $this->language->get('entry_location_zip');
		$data['entry_store_id'] = $this->language->get('entry_store_id');
 		// $data['entry_delivery_time'] = $this->language->get('entry_delivery_time');
 		// $data['entry_language_id'] = $this->language->get('entry_language_id');
 		// $data['entry_delivery_price_calc'] = $this->language->get('entry_delivery_price_calc');
 		// $data['entry_delivery_weight_calc'] = $this->language->get('entry_delivery_weight_calc');
 		// $data['entry_payment_methods'] = $this->language->get('entry_payment_methods');
 		// $data['entry_payment_method'] = $this->language->get('entry_payment_method');
 		// $data['entry_payment_cost'] = $this->language->get('entry_payment_cost');
 		// $data['entry_payment_max'] = $this->language->get('entry_payment_max');
 		// $data['entry_payment_free'] = $this->language->get('entry_payment_free');
 		// $data['entry_payment_method_2'] = $this->language->get('entry_payment_method_2');
 		// $data['entry_payment_cost_2'] = $this->language->get('entry_payment_cost_2');
 		// $data['entry_payment_max_2'] = $this->language->get('entry_payment_max_2');
 		// $data['entry_payment_free_2'] = $this->language->get('entry_payment_free_2');
 		// $data['entry_payment_method_3'] = $this->language->get('entry_payment_method_3');
 		// $data['entry_payment_cost_3'] = $this->language->get('entry_payment_cost_3');
 		// $data['entry_payment_max_3'] = $this->language->get('entry_payment_max_3');
 		// $data['entry_payment_free_3'] = $this->language->get('entry_payment_free_3');
 		// $data['entry_order_minimum_sum'] = $this->language->get('entry_order_minimum_sum');
 		// $data['entry_order_minimum_fee'] = $this->language->get('entry_order_minimum_fee');
 		// $data['entry_order_minimum_comment'] = $this->language->get('entry_order_minimum_comment');
 		$data['entry_data_feed_seperator'] = $this->language->get('entry_data_feed_seperator');

 		$data['help_category'] = $this->language->get('help_category');
 		// $data['help_delivery_time'] = $this->language->get('help_delivery_time');
 		// $data['help_delivery_price_calc'] = $this->language->get('help_delivery_price_calc');
 		// $data['help_delivery_weight_calc'] = $this->language->get('help_delivery_weight_calc');
 		// $data['help_payment_method'] = $this->language->get('help_payment_method');
 		// $data['help_payment_cost'] = $this->language->get('help_payment_cost');
 		// $data['help_payment_max'] = $this->language->get('help_payment_max');
 		// $data['help_payment_free'] = $this->language->get('help_payment_free');
 		// $data['help_payment_method_2'] = $this->language->get('help_payment_method_2');
 		// $data['help_payment_cost_2'] = $this->language->get('help_payment_cost_2');
 		// $data['help_payment_max_2'] = $this->language->get('help_payment_max_2');
 		// $data['help_payment_free_2'] = $this->language->get('help_payment_free_2');
 		// $data['help_payment_method_3'] = $this->language->get('help_payment_method_3');
 		// $data['help_payment_cost_3'] = $this->language->get('help_payment_cost_3');
 		// $data['help_payment_max_3'] = $this->language->get('help_payment_max_3');
 		// $data['help_payment_free_3'] = $this->language->get('help_payment_free_3');
 		// $data['help_order_minimum_sum'] = $this->language->get('help_order_minimum_sum');
 		// $data['help_order_minimum_fee'] = $this->language->get('help_order_minimum_fee');
 		// $data['help_order_minimum_comment'] = $this->language->get('help_order_minimum_comment');
 		// $data['help_payment_methods'] = $this->language->get('help_payment_methods');
 		$data['help_data_feed_seperator'] = $this->language->get('help_data_feed_seperator');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$this->load->model('feed/click2buy_csv');

		$settings = $this->model_feed_click2buy_csv->getSetting('click2buy_csv');

		if (isset($this->request->post['click2buy_csv_language_id'])) {
		    	  $data['click2buy_csv_language_id'] = $this->request->post['click2buy_csv_language_id'];
		} else {
				$data['click2buy_csv_language_id'] = $this->config->get('click2buy_csv_language_id');
		}

		$this->load->model('setting/store');

		$stores = $this->model_setting_store->getStores();


		$data['stores'][] = array(
			'name' => $this->config->get('config_name'),
			'store_id' =>0
			);

		$data['stores'] = array_merge($data['stores'], $stores);


		$query = $this->db->query("SELECT language_id, name FROM " . DB_PREFIX . "language");
		$data['languages'] = $query->rows;

		#Load Categories

		$this->load->model('catalog/category');

		$data['categories'] = $this->model_catalog_category->getCategories(0);

		if (isset($this->request->post['click2buy_csv_product_category'])) {
			$data['product_category'] = unserialize($this->request->post['click2buy_csv_product_category']);
		} elseif (isset($settings['click2buy_csv_product_category'])) {
			$data['product_category'] = $settings['click2buy_csv_product_category'];
		} else {
			$data['product_category'] = array();
		}

		#Load manufacturers

		$this->load->model('catalog/manufacturer');

		$data['manufacturers'] = $this->model_catalog_manufacturer->getManufacturers();

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_feed'),
			'href' => $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('feed/click2buy_csv', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('feed/click2buy_csv', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['click2buy_csv_manufacturer'])) {
			$data['click2buy_csv_manufacturer'] = $this->request->post['click2buy_csv_manufacturer'];
		} else {
			$data['click2buy_csv_manufacturer'] = $this->config->get('click2buy_csv_manufacturer');
		}

		if (isset($this->request->post['click2buy_csv_status'])) {
			$data['click2buy_csv_status'] = $this->request->post['click2buy_csv_status'];
		} else {
			$data['click2buy_csv_status'] = $this->config->get('click2buy_csv_status');
		}

		if (isset($this->request->post['click2buy_csv_location_zip'])) {
			$data['click2buy_csv_location_zip'] = $this->request->post['click2buy_csv_location_zip'];
		} else {
			$data['click2buy_csv_location_zip'] = $this->config->get('click2buy_csv_location_zip');
		}

		if (isset($this->request->post['click2buy_csv_store_id'])) {
			$data['click2buy_csv_store_id'] = $this->request->post['click2buy_csv_store_id'];
		} else {
			$data['click2buy_csv_store_id'] = $this->config->get('click2buy_csv_store_id');
		}
		//
		// if (isset($this->request->post['click2buy_csv_delivery_time'])) {
		// 	$data['click2buy_csv_delivery_time'] = $this->request->post['click2buy_csv_delivery_time'];
		// } else {
		// 	$data['click2buy_csv_delivery_time'] = $this->config->get('click2buy_csv_delivery_time');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_delivery_price_calc'])) {
		// 	$data['click2buy_csv_delivery_price_calc'] = $this->request->post['click2buy_csv_delivery_price_calc'];
		// } else {
		// 	$data['click2buy_csv_delivery_price_calc'] = $this->config->get('click2buy_csv_delivery_price_calc');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_delivery_weight_calc'])) {
		// 	$data['click2buy_csv_delivery_weight_calc'] = $this->request->post['click2buy_csv_delivery_weight_calc'];
		// } else {
		// 	$data['click2buy_csv_delivery_weight_calc'] = $this->config->get('click2buy_csv_delivery_weight_calc');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_method'])) {
		// 	$data['click2buy_csv_payment_method'] = $this->request->post['click2buy_csv_payment_method'];
		// } else {
		// 	$data['click2buy_csv_payment_method'] = $this->config->get('click2buy_csv_payment_method');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_cost'])) {
		// 	$data['click2buy_csv_payment_cost'] = $this->request->post['click2buy_csv_payment_cost'];
		// } else {
		// 	$data['click2buy_csv_payment_cost'] = $this->config->get('click2buy_csv_payment_cost');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_max'])) {
		// 	$data['click2buy_csv_payment_max'] = $this->request->post['click2buy_csv_payment_max'];
		// } else {
		// 	$data['click2buy_csv_payment_max'] = $this->config->get('click2buy_csv_payment_max');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_free'])) {
		// 	$data['click2buy_csv_payment_free'] = $this->request->post['click2buy_csv_payment_free'];
		// } else {
		// 	$data['click2buy_csv_payment_free'] = $this->config->get('click2buy_csv_payment_free');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_method_2'])) {
		// 	$data['click2buy_csv_payment_method_2'] = $this->request->post['click2buy_csv_payment_method_2'];
		// } else {
		// 	$data['click2buy_csv_payment_method_2'] = $this->config->get('click2buy_csv_payment_method_2');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_cost_2'])) {
		// 	$data['click2buy_csv_payment_cost_2'] = $this->request->post['click2buy_csv_payment_cost_2'];
		// } else {
		// 	$data['click2buy_csv_payment_cost_2'] = $this->config->get('click2buy_csv_payment_cost_2');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_max_2'])) {
		// 	$data['click2buy_csv_payment_max_2'] = $this->request->post['click2buy_csv_payment_max_2'];
		// } else {
		// 	$data['click2buy_csv_payment_max_2'] = $this->config->get('click2buy_csv_payment_max_2');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_free_2'])) {
		// 	$data['click2buy_csv_payment_free_2'] = $this->request->post['click2buy_csv_payment_free_2'];
		// } else {
		// 	$data['click2buy_csv_payment_free_2'] = $this->config->get('click2buy_csv_payment_free_2');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_method_3'])) {
		// 	$data['click2buy_csv_payment_method_3'] = $this->request->post['click2buy_csv_payment_method_3'];
		// } else {
		// 	$data['click2buy_csv_payment_method_3'] = $this->config->get('click2buy_csv_payment_method_3');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_cost_3'])) {
		// 	$data['click2buy_csv_payment_cost_3'] = $this->request->post['click2buy_csv_payment_cost_3'];
		// } else {
		// 	$data['click2buy_csv_payment_cost_3'] = $this->config->get('click2buy_csv_payment_cost_3');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_max_3'])) {
		// 	$data['click2buy_csv_payment_max_3'] = $this->request->post['click2buy_csv_payment_max_3'];
		// } else {
		// 	$data['click2buy_csv_payment_max_3'] = $this->config->get('click2buy_csv_payment_max_3');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_free_3'])) {
		// 	$data['click2buy_csv_payment_free_3'] = $this->request->post['click2buy_csv_payment_free_3'];
		// } else {
		// 	$data['click2buy_csv_payment_free_3'] = $this->config->get('click2buy_csv_payment_free_3');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_payment_methods'])) {
		// 	$data['click2buy_csv_payment_methods'] = $this->request->post['click2buy_csv_payment_methods'];
		// } else {
		// 	$data['click2buy_csv_payment_methods'] = $this->config->get('click2buy_csv_payment_methods');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_order_minimum_sum'])) {
		// 	$data['click2buy_csv_order_minimum_sum'] = $this->request->post['click2buy_csv_order_minimum_sum'];
		// } else {
		// 	$data['click2buy_csv_order_minimum_sum'] = $this->config->get('click2buy_csv_order_minimum_sum');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_order_minimum_fee'])) {
		// 	$data['click2buy_csv_order_minimum_fee'] = $this->request->post['click2buy_csv_order_minimum_fee'];
		// } else {
		// 	$data['click2buy_csv_order_minimum_fee'] = $this->config->get('click2buy_csv_order_minimum_fee');
		// }
		//
		// if (isset($this->request->post['click2buy_csv_order_minimum_comment'])) {
		// 	$data['click2buy_csv_order_minimum_comment'] = $this->request->post['click2buy_csv_order_minimum_comment'];
		// } else {
		// 	$data['click2buy_csv_order_minimum_comment'] = $this->config->get('click2buy_csv_order_minimum_comment');
		// }

		if (isset($this->request->post['click2buy_csv_data_feed_seperator'])) {
			$data['click2buy_csv_data_feed_seperator'] = $this->request->post['click2buy_csv_data_feed_seperator'];
		} elseif ($this->config->get('click2buy_csv_data_feed_seperator') <> '') {
			$data['click2buy_csv_data_feed_seperator'] = $this->config->get('click2buy_csv_data_feed_seperator');
		} else {
			$data['click2buy_csv_data_feed_seperator'] = '\'';
		}

		if (isset($this->request->post['click2buy_csv_data_feed_seperator_2'])) {
			$data['click2buy_csv_data_feed_seperator_2'] = $this->request->post['click2buy_csv_data_feed_seperator_2'];
		} elseif ($this->config->get('click2buy_csv_data_feed_seperator_2') <> '') {
			$data['click2buy_csv_data_feed_seperator_2'] = $this->config->get('click2buy_csv_data_feed_seperator_2');
		} else {
			$data['click2buy_csv_data_feed_seperator_2'] = '|';
			//$data['click2buy_csv_data_feed_seperator_2'] = ';';
		}

		$data['data_feed'] = HTTP_CATALOG . 'index.php?route=feed/click2buy_csv';
		$data['store_feed'] = HTTP_CATALOG . 'index.php?route=feed/click2buy_csv/store';

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('feed/click2buy_csv.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'feed/click2buy_csv')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
