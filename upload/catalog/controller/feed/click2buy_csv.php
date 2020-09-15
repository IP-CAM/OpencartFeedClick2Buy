	<?php
    class ControllerFeedClick2BuyCSV extends Controller
    {
        public function store()
        {
            set_time_limit(1800);
            $start_time = time();

            if ($this->config->get('click2buy_csv_status')) {
                $this->load->model('feed/click2buy_csv');
                $data = $this->model_feed_click2buy_csv->getSetting('click2buy_csv');

                if ($data['click2buy_csv_manufacturer']) {
                    $strstart   = $data['click2buy_csv_data_feed_seperator'];
                    $strnext    = $data['click2buy_csv_data_feed_seperator'] . $data['click2buy_csv_data_feed_seperator_2'] . $data['click2buy_csv_data_feed_seperator'];
                    $strnextinf = "$";
                    $strclose   = $data['click2buy_csv_data_feed_seperator'];
                    $strnl      = "\n";
                    $output     = "";

                    if ($data['click2buy_csv_language_id']) {
                        $this->config->set('click2buy_csv_language_id', $data['click2buy_csv_language_id']);
                    }

                    if (!isset($data['click2buy_csv_status'])) {
                        die($data['error']);
                    }

                    $output .= $strstart;

                    $output .= 'outlet_id' . $strnext;
                    $output .= 'outlet_name' . $strnext;
                    $output .= 'address' . $strnext;
                    $output .= 'zip_code' . $strnext;
                    $output .= 'town' . $strnext;
                    $output .= 'country_code' . $strnext;
                    $output .= 'phone' . $strnext;
                    $output .= $strclose . $strnl;

                    $output .= $strstart;

                    $output .= $data['click2buy_csv_store_id'] . $strnext;
                    $output .= $this->config->get('config_name') . $strnext;
                    $output .= $this->config->get('config_address') . $strnext;
                    $output .= $data['click2buy_csv_location_zip'] . $strnext;
                    $output .= $this->config->get('config_town') . $strnext;
                    $output .= 'IE' . $strnext;
                    $output .= $this->config->get('config_telephone') . $strnext;
                    $output .= $strclose . $strnl;

                    $this->response->addHeader('Content-Type: text/plain; charset=utf-8');
                    $this->response->setOutput($output);
                }
            }
        }

        public function index()
        {
            set_time_limit(1800);
            $start_time = time();

            $i = 0;
            $setting = 0;
            if ($this->config->get('click2buy_csv_status')) {
                $this->load->model('feed/click2buy_csv');
                $data = $this->model_feed_click2buy_csv->getSetting('click2buy_csv');

                $strstart   = $data['click2buy_csv_data_feed_seperator'];
                $strnext    = $data['click2buy_csv_data_feed_seperator'] . $data['click2buy_csv_data_feed_seperator_2'] . $data['click2buy_csv_data_feed_seperator'];
                $strnextinf = "$";
                $strclose   = $data['click2buy_csv_data_feed_seperator'];
                $strnl      = "\n";
                $output     = "";

                if ($data['click2buy_csv_language_id']) {
                    $this->config->set('click2buy_csv_language_id', $data['click2buy_csv_language_id']);
                }

                if (!isset($data['click2buy_csv_status'])) {
                    die($data['error']);
                }

                $this->load->model('catalog/product');

                $this->load->language('product/product');
                //$data['text_instock'] = $this->language->get('text_instock');

                $this->load->model('tool/image');

                $output .= $strstart;

                $output .= 'product_id' . $strnext;
                $output .= 'ean' . $strnext;
                $output .= 'product_name' . $strnext;
                $output .= 'price' . $strnext;
                $output .= 'currency' . $strnext;
                $output .= 'image' . $strnext;
                $output .= 'url' . $strnext;
                $output .= 'description' . $strnext;
                $output .= 'brand' . $strnext;
                $output .= 'weight' . $strnext;
                $output .= 'model' . $strnext;
                $output .= 'quantity' . $strnext;
                $output .= 'availability' . $strnext;
                $output .= 'updated' . $strnext;
                $output .= $strclose . $strnl;

                $products = array();
                $products = $this->model_feed_click2buy_csv->getProducts();

                $total_products = count($products);

                foreach ($products as $product) {
                    if ($product['description']) {
                        $i = ($i + 1);

                        $output .= $strstart;

                        $output .= $product['product_id'] . $strnext;
                        $output .= $product['ean'] . $strnext;
                        $output .= html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8') . $strnext;

                        // Price
                        $output .= $this->currency->format($product['price'], '', '', false) . $strnext;

                        $currencies = array(
                            'USD',
                            'EUR',
                            'GBP',
                            'RUB',
                            'INR'
                        );
                        if (in_array($this->currency->getCode(), $currencies)) {
                            $currency_code = $this->currency->getCode();
                            $currency_value = $this->currency->getValue();
                            $output .= $currency_code . $strnext;
                        } else {
                            $currency_code = 'USD';
                            $currency_value = $this->currency->getValue('USD');
                            $output .=  $currency_code . $strnext;
                        }
                        if ($product['image']) {
                            $output .=  $this->model_tool_image->resize($product['image'], 500, 500) . $strnext;
                        } else {
                            $output .=  $this->model_tool_image->resize('no_image.jpg', 500, 500) . $strnext;
                        }

                        $output .= html_entity_decode($this->url->link('product/product', 'product_id=' . $product['product_id']), ENT_QUOTES, 'UTF-8') . $strnext;
                        //$output .= $product['description'] . $strnext;
                        //$output .= strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')) . $strnext;
			$output .= trim(preg_replace(['/\s+/','/\|/'], ' ', $product['description'])). $strnext;
                        $output .= html_entity_decode($product['manufacturer'], ENT_QUOTES, 'UTF-8') . $strnext;

                        $output .= $this->weight->format($product['weight'], $product['weight_class_id']) . $strnext;
                        $output .= html_entity_decode($product['model'], ENT_QUOTES, 'UTF-8') . $strnext;

                        $output .= $product['quantity'] . $strnext;
                        //$output .= ($product['quantity'] ? $data['text_instock'] : $product['stock_status']) . $strnext;
                        $output .= ($product['quantity'] ? 1 : 0) . $strnext;

                        $output .= $product['date_modified'] . $strnext;

                        $output .= $strclose . $strnl;
                    }
                }
                $this->response->addHeader('Content-Type: text/plain; charset=utf-8');
                $this->response->setOutput($output);
            }
        }
    }
    ?>
