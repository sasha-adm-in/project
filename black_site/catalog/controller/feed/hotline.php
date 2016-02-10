<?php

class ControllerFeedHotLine extends Controller {

    public function index() {

        $this->load->model('catalog/category');
        $this->load->model('catalog/product');
        $this->load->model('catalog/manufacturer');
        $this->load->model('feed/hotline');
        $this->load->model('tool/image');

        $this->language->load('feed/hotline');

        if ($this->config->get('hotline_status') && in_array($this->currency->getCode(), array('USD', 'UAH'))) {

            $output  = '<?xml version="1.0" encoding="UTF-8" ?>';
            $output .= '<price>';
            $output .= '<date>' . date('Y-m-d H:i', time()) . '</date>';
            $output .= '<firmName>' . $this->config->get('config_name') . '</firmName>';
            $output .= '<firmId>' . $this->config->get('config_hotline_firm_id') . '</firmId>';

            // Currency rate
            if ('USD' == $this->currency->getCode()) {
                $output .= '<rate>' . number_format(1/$this->currency->getValue(), 2) . '</rate>';
            }

            // Categories
            $categories = $this->model_feed_hotline->getCategories();

            if ($categories) {
                $output .= '<categories>';
                foreach ($categories as $category) {
                    $output .= '<category>';
                    $output .= '<id>' . $category['category_id'] . '</id>';
                    if ($category['parent_id']) {
                        $output .= '<parentId>' . $category['parent_id'] . '</parentId>';
                    }
                    $output .= '<name>' . $category['name'] . '</name>';
                    $output .= '</category>';
                }
                $output .= '</categories>';
            }

            // Products
            //$products = $this->model_catalog_product->getProducts(array('start' => 0, 'limit' => 1000000));
			$products = $this->model_catalog_product->getProducts(array('start' => 0, 'available' => 1, 'limit' => 1000000));
			
            if ($products) {

                $output .= '<items>';
                foreach ($products as $product) {
                    $output .= '<item>';
                    $output .= '<id>' . $product['product_id'] . '</id>';


                    // Get Product Category
                    $category_id = false;
                    $product_categories = $this->model_catalog_product->getCategories($product['product_id']);

                    foreach ($product_categories as $product_category) {
                        $category_id = $product_category['category_id'];

                        // SEO PRO Main Category Support
                        if (isset($product_category['main_category_id']) && $product_category['main_category_id'] == 1) {
                            break;
                        }
                    }

                    if ($category_id) {
                        $output .= '<categoryId>' . $category_id . '</categoryId>';
                    }


                    $output .= '<code>' . $product['model'] . '</code>';

                    if ($product['manufacturer']) {
                        $output .= '<vendor>' . $product['manufacturer'] . '</vendor>';
                    }

                    $output .= '<name>' . $product['name'] . '</name>';

                    if ($product['description']) {
						$product['description']=str_replace('"', '&quot;', $product['description']);
						$product['description']=str_replace("'", "&apos;", $product['description']);
						$product['description']=str_replace("&", "&amp;", $product['description']);
						$product['description']=str_replace(">", "&gt;", $product['description']);
						$product['description']=str_replace("<", "&lt;", $product['description']);
                        $output .= '<description>' . trim(str_replace(array('&lt;p&gt;', '&lt;/p&gt;'), '', strip_tags($product['description']))) . '</description>';
                    }

                    $output .= '<url>' . $this->url->link('product/product', 'product_id=' . (int) $product['product_id']) . '</url>';

                    if ($product['image']) {
                        $output .= '<image>' . 'http://' . $_SERVER['HTTP_HOST'] . '/image/' . $product['image'] . '</image>';
                    }

                    // Prepare Price
                    if ('USD' == $this->currency->getCode()) {
                        $special = $this->currency->convert($product['special'], 'USD', 'UAH');
                        $price = $this->currency->convert($product['price'], 'USD', 'UAH');
                        $special_usd = false;
                        $price_usd = false;
                    } else {
                        $special = $product['special'];
                        $price = $product['price'];
                        $special_usd = $this->currency->convert($product['special'], 'UAH', 'USD');
                        $price_usd = $this->currency->convert($product['price'], 'UAH', 'USD');
                    }

                    if ($special && $special < $price) {
                        $output .= '<priceRUAH>' . number_format($special, 2, '.', '') . '</priceRUAH>';
                        $output .= '<oldprice>' . number_format($price, 2, '.', '') . '</oldprice>';
                        if ($special_usd) {
                            $output .= '<priceRUSD>' . number_format($special_usd, 2, '.', '') . '</priceRUSD>';
                        }
                    } else {
                        $output .= '<priceRUAH>' . number_format($price, 2, '.', '') . '</priceRUAH>';
                        if ($price_usd) {
                            $output .= '<priceRUSD>' .  number_format($price_usd, 2, '.', '') . '</priceRUSD>';
                        }
                    }

                    if ($product['quantity']) {
                        $output .= '<stock>' . $this->language->get('text_in_stock') . '</stock>';
                    } else {
                        $output .= '<stock>' . $this->language->get('text_out_of_stock') . '</stock>';
                    }

                    if ($this->config->get('config_hotline_guarantee')) {
                        $output .= '<guarantee>' . $this->config->get('config_hotline_guarantee') . '</guarantee>';
                    }

                    $output .= '</item>';
                }
                $output .= '</items>';
            }

            $output .= '</price>';

            $this->response->addHeader('Content-Type: application/xml');
            $this->response->setOutput($output);
        }
    }
}
