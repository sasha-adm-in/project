<?php
class ControllerProductCategory extends Controller {
	public function index() {

	$this->document->setCurrent('category');
		$this->language->load('product/category');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$this->data['page'] = $this->request->get['page'];

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}


		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}


		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
       		'separator' => false
   		);

		if (isset($this->request->get['path'])) {
			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
	       			$this->data['breadcrumbs'][] = array(
   	    				'text'      => $category_info['name'],
						'href'      => $this->url->link('product/category', 'path=' . $path . $url),
        				'separator' => $this->language->get('text_separator')
        			);
				}

			}

		} else {
			$category_id = 0;
		}

		$category_info = $this->model_catalog_category->getCategory($category_id);

		if ($category_info) {
			if ($category_info['seo_title'] && !(isset($this->request->get['page']))) {
		  	$this->document->setTitle(array($category_info['seo_title'],$category_info['name']));
		    $GLOBALS["seotitle25"] = 'ON';
			} else {
		  	$this->document->setTitle($category_info['name']);
		    $GLOBALS["seotitle25"] = '';
			}

			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);

			//$this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path']), 'canonical');
			$this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');
            $this->document->addScript('catalog/view/javascript/jquery.selectbox-0.2.js');
            $this->document->addStyle('catalog/view/theme/res_final/stylesheet/jquery.selectbox.css');

			if ($category_info['seo_h1']) {
				$this->data['heading_title'] = $category_info['seo_h1'];
			} else {
				$this->data['heading_title'] = $category_info['name'];
			}

		//add-----------------------

		$this->data['text_cat_vuvod'] = $this->language->get('text_cat_vuvod');
		$this->data['text_available'] = $this->language->get('text_available');
		$this->data['text_dostavka'] = $this->language->get('text_dostavka');
		$this->data['text_podzak'] = $this->language->get('text_podzak');
		$this->data['text_cenyyto4'] = $this->language->get('text_cenyyto4');
		$this->data['text_akcimg'] = $this->language->get('text_akcimg');
		$this->data['text_buy'] = $this->language->get('text_buy');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');

		//add-----------------------


			$this->data['text_refine'] = $this->language->get('text_refine');
			$this->data['text_empty'] = $this->language->get('text_empty');
			$this->data['text_quantity'] = $this->language->get('text_quantity');
			$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$this->data['text_model'] = $this->language->get('text_model');
			$this->data['text_price'] = $this->language->get('text_price');
			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['text_points'] = $this->language->get('text_points');
			$this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$this->data['text_display'] = $this->language->get('text_display');
			$this->data['text_list'] = $this->language->get('text_list');
			$this->data['text_grid'] = $this->language->get('text_grid');
			$this->data['text_sort'] = $this->language->get('text_sort');
			$this->data['text_limit'] = $this->language->get('text_limit');

			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_wishlist'] = $this->language->get('button_wishlist');
			$this->data['button_compare'] = $this->language->get('button_compare');
			$this->data['button_continue'] = $this->language->get('button_continue');

			// Set the last category breadcrumb
			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$this->data['breadcrumbs'][] = array(
				'text'      => $category_info['name'],
				'href'      => $this->url->link('product/category', 'path=' . $this->request->get['path']),
				'separator' => $this->language->get('text_separator')
			);


			if ($category_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
				$this->document->setOgImage($this->data['thumb']);
			} else {
				$this->data['thumb'] = '';
			}

			$this->data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			$this->data['compare'] = $this->url->link('product/compare');

			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}


				$fmSettings = $this->config->get('mega_filter_settings');
				
				if( ! empty( $fmSettings['not_remember_filter_for_subcategories'] ) && false !== ( $mfpPos = strpos( $url, '&mfp=' ) ) ) {
					$mfUrlBeforeChange = $url;
					$mfSt = mb_strpos( $url, '&', $mfpPos+1, 'utf-8');
					$url = $mfSt === false ? '' : mb_substr($url, $mfSt, mb_strlen( $url, 'utf-8' ), 'utf-8');
				}
			
			$this->data['categories'] = array();

			$results = $this->model_catalog_category->getCategories($category_id);

			foreach ($results as $result) {
				$data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true
				);


				$fmSettings = $this->config->get('mega_filter_settings');
		
				if( ! empty( $fmSettings['show_products_from_subcategories'] ) ) {
					if( ! empty( $fmSettings['level_products_from_subcategories'] ) ) {
						$fmLevel = (int) $fmSettings['level_products_from_subcategories'];
						$fmPath = explode( '_', empty( $this->request->get['path'] ) ? '' : $this->request->get['path'] );

						if( $fmPath && count( $fmPath ) >= $fmLevel ) {
							$data['filter_sub_category'] = '1';
						}
					} else {
						$data['filter_sub_category'] = '1';
					}
				}
				
				if( ! empty( $this->request->get['manufacturer_id'] ) ) {
					$data['filter_manufacturer_id'] = (int) $this->request->get['manufacturer_id'];
				}
				
				if( ! empty( $fmSettings['in_stock_default_selected'] ) ) {
					$this->data['column_left'] = $this->getChild('common/column_left');
					$this->data['column_right'] = $this->getChild('common/column_right');
					$this->data['content_top'] = $this->getChild('common/content_top');
					$this->data['mfp_column_left'] = true;
					$this->data['mfp_column_right'] = true;
					$this->data['mfp_content_top'] = true;
				}
			
				$product_total = $this->model_catalog_product->getTotalProducts($data);


				if($product_total>0){
					$this->data['categories'][] = array(
						'name'  => $result['name'],// . ' (' . $product_total . ')',
						'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] . $url),
						'thumb' => $this->model_tool_image->resize(($result['image']=='' ? 'no_image.jpg' : $result['image']), $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'))
					);
				}

			}


				if( isset( $mfUrlBeforeChange ) ) {
					$url = $mfUrlBeforeChange;
					unset( $mfUrlBeforeChange );
				}
			
			$this->data['products'] = array();

			$data = array(
				'filter_category_id' => $category_id,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$results = $this->model_catalog_product->getProducts($data);
			//Вызов метода getFoundProducts должен проводится сразу же после getProducts
			//только тогда он выдает правильное значения количества товаров
			$product_total = $this->model_catalog_product->getFoundProducts();

			foreach ($results as $result) {
				if ($result['image'] && file_exists(DIR_IMAGE.$result['image'])) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}

                $attribute_groups = $this->model_catalog_product->getShortProductAttributes($result['product_id']);

                if ($result['quantity'] <= 0) {
                    $attribute_groups2 = $this->model_catalog_product->getProductAttributes($result['product_id']);
                    foreach ($attribute_groups2 as $attribute_group) {
                        foreach ($attribute_group as $prop) {
                            foreach ($prop as $key => $attribute) {
                                if ($attribute['name'] == $this->language->get('text_term')) {
                                 $days = $attribute['text'];
                                }
                             }
                         }
                    }
                }

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					//$price = $this->tax->calculate(round($result['price']), $result['tax_class_id'], $this->config->get('config_tax'));
    				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

                $compare_link = '<a href="javascript:;" onclick="addToCompare(\''.$result['product_id'].'\', this);">' . $this->language->get('text_addtocompare') . '</a>';

                if (isset($this->session->data['compare'])) {
                    foreach ($this->session->data['compare'] as $prod_id) {
                        if ($prod_id == $result['product_id']) {
                            $compare_link = '<a href="' . $pref_lang . '/compare-products/">' . $this->language->get('text_intocompare') . '</a>';
                            break;
                        }
                    }
                }


				$this->data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 300) . '..',
					'price'       => $price,
					'special'     => $special,
					'compare_link'=> $compare_link,
					'quantity'    => $result['quantity'],
					'days'        => $days,
					'unit'        => $result['unit'],
					'tax'         => $tax,
					'rating'      => $result['rating'],
					'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
                    'attribute_groups' => $attribute_groups,
					'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url)
				);


			}

			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}


			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$this->data['sorts'] = array();

			//$this->data['sorts'][] = array(
//				'text'  => $this->language->get('text_default'),
//				'value' => 'p.sort_order-ASC',
//				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url)
//			);

			if ($this->config->get('config_review_status')) {
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url)
				);

				//$this->data['sorts'][] = array(
//					'text'  => $this->language->get('text_rating_asc'),
//					'value' => 'rating-ASC',
//					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=ASC' . $url)
//				);
			}

//			$this->data['sorts'][] = array(
//				'text'  => $this->language->get('text_name_asc'),
//				'value' => 'pd.name-ASC',
//				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url)
//			);

//			$this->data['sorts'][] = array(
//				'text'  => $this->language->get('text_name_desc'),
//				'value' => 'pd.name-DESC',
//				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url)
//			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)
			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url)
			);

            //print_r($this->data['sorts']);
//
//			$this->data['sorts'][] = array(
//				'text'  => $this->language->get('text_model_asc'),
//				'value' => 'p.model-ASC',
//				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=ASC' . $url)
//			);
//
//			$this->data['sorts'][] = array(
//				'text'  => $this->language->get('text_model_desc'),
//				'value' => 'p.model-DESC',
//				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=DESC' . $url)
//			);

			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$this->data['limits'] = array();

			$limits = array_unique(array($this->config->get('config_catalog_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value){
				$this->data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)
				);
			}

			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			


			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page={page}');

			//$this->data['pag'] = $product_total . $page . $limit;
			$this->data['pagination'] = $pagination->render();

            $this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page='. $pagination->page), 'canonical'); if($pagination->limit && ceil($pagination->total / $pagination->limit) > $pagination->page) { $this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page='. ($pagination->page + 1)), 'next'); } if($pagination->page > 1) { $this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page='. ($pagination->page - 1)), 'prev'); }

			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
			$this->data['limit'] = $limit;

			$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/category.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/category.tpl';
			} else {
				$this->template = 'default/template/product/category.tpl';
			}

			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);


				if( isset( $this->request->get['mfilterAjax'] ) ) {
					$settings	= $this->config->get('mega_filter_settings');
					$baseTypes	= array( 'stock_status', 'manufacturers', 'rating', 'attributes', 'price', 'options', 'filters' );
		
					if( isset( $this->request->get['mfilterBTypes'] ) ) {
						$baseTypes = explode( ',', $this->request->get['mfilterBTypes'] );
					}
					
					if( ! empty( $settings['calculate_number_of_products'] ) || in_array( 'categories:tree', $baseTypes ) ) {
						if( empty( $settings['calculate_number_of_products'] ) ) {
							$baseTypes = array( 'categories:tree' );
						}
				
						$this->load->model( 'module/mega_filter' );

						$idx = 0;
		
						if( isset( $this->request->get['mfilterIdx'] ) )
							$idx = (int) $this->request->get['mfilterIdx'];
						
						$this->data['mfilter_json'] = json_encode( MegaFilterCore::newInstance( $this, NULL )->getJsonData($baseTypes, $idx) );
					}
				
					foreach( $this->children as $mf_child ) {
						$mf_child = explode( '/', $mf_child );
						$mf_child = array_pop( $mf_child );
						$this->data[$mf_child] = '';
					}
						
					$this->children=array();
					$this->data['header'] = $this->data['column_left'] = $this->data['column_right'] = $this->data['content_top'] = $this->data['content_bottom'] = $this->data['footer'] = '';
				}
				
				if( ! empty( $this->data['breadcrumbs'] ) && ! empty( $this->request->get['mfp'] ) ) {
					
					foreach( $this->data['breadcrumbs'] as $mfK => $mfBreadcrumb ) {
						$mfReplace = preg_replace( '/path\[[^\]]+\],?/', '', $this->request->get['mfp'] );
						$mfFind = ( mb_strpos( $mfBreadcrumb['href'], '?mfp=', 0, 'utf-8' ) !== false ? '?mfp=' : '&mfp=' );
						
						$this->data['breadcrumbs'][$mfK]['href'] = str_replace(array(
							$mfFind . $this->request->get['mfp'],
							'&amp;mfp=' . $this->request->get['mfp'],
							$mfFind . urlencode( $this->request->get['mfp'] ),
							'&amp;mfp=' . urlencode( $this->request->get['mfp'] )
						), $mfReplace ? $mfFind . $mfReplace : '', $mfBreadcrumb['href'] );
					}
				}
			
			$this->response->setOutput($this->render());
    	} else {
			$url = '';

				if( ! empty( $this->request->get['mfp'] ) ) {
					$url .= '&mfp=' . $this->request->get['mfp'];
				}
			

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}


			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('product/category', $url),
				'separator' => $this->language->get('text_separator')
			);

			$this->document->setTitle($this->language->get('text_error'));

      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}

			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);


				if( isset( $this->request->get['mfilterAjax'] ) ) {
					$settings	= $this->config->get('mega_filter_settings');
					$baseTypes	= array( 'stock_status', 'manufacturers', 'rating', 'attributes', 'price', 'options', 'filters' );
		
					if( isset( $this->request->get['mfilterBTypes'] ) ) {
						$baseTypes = explode( ',', $this->request->get['mfilterBTypes'] );
					}
					
					if( ! empty( $settings['calculate_number_of_products'] ) || in_array( 'categories:tree', $baseTypes ) ) {
						if( empty( $settings['calculate_number_of_products'] ) ) {
							$baseTypes = array( 'categories:tree' );
						}
				
						$this->load->model( 'module/mega_filter' );

						$idx = 0;
		
						if( isset( $this->request->get['mfilterIdx'] ) )
							$idx = (int) $this->request->get['mfilterIdx'];
						
						$this->data['mfilter_json'] = json_encode( MegaFilterCore::newInstance( $this, NULL )->getJsonData($baseTypes, $idx) );
					}
				
					foreach( $this->children as $mf_child ) {
						$mf_child = explode( '/', $mf_child );
						$mf_child = array_pop( $mf_child );
						$this->data[$mf_child] = '';
					}
						
					$this->children=array();
					$this->data['header'] = $this->data['column_left'] = $this->data['column_right'] = $this->data['content_top'] = $this->data['content_bottom'] = $this->data['footer'] = '';
				}
				
				if( ! empty( $this->data['breadcrumbs'] ) && ! empty( $this->request->get['mfp'] ) ) {
					
					foreach( $this->data['breadcrumbs'] as $mfK => $mfBreadcrumb ) {
						$mfReplace = preg_replace( '/path\[[^\]]+\],?/', '', $this->request->get['mfp'] );
						$mfFind = ( mb_strpos( $mfBreadcrumb['href'], '?mfp=', 0, 'utf-8' ) !== false ? '?mfp=' : '&mfp=' );
						
						$this->data['breadcrumbs'][$mfK]['href'] = str_replace(array(
							$mfFind . $this->request->get['mfp'],
							'&amp;mfp=' . $this->request->get['mfp'],
							$mfFind . urlencode( $this->request->get['mfp'] ),
							'&amp;mfp=' . urlencode( $this->request->get['mfp'] )
						), $mfReplace ? $mfFind . $mfReplace : '', $mfBreadcrumb['href'] );
					}
				}
			
			$this->response->setOutput($this->render());
		}
  	}
}
?>