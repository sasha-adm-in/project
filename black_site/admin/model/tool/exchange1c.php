<?php

class ModelToolExchange1c extends Model {

	private $CATEGORIES = array();
	private $PROPERTIES = array();


	/**
	 * Генерирует xml с заказами
	 *
	 * @param	int	статус выгружаемых заказов
	 * @param	int	новый статус заказов
	 * @param	bool	уведомлять пользователя
	 * @return	string
	 */
	public function queryOrders($params) {

		$this->load->model('sale/order');

		if ($params['exchange_status'] != 0) {
			$query = $this->db->query("SELECT order_id FROM `" . DB_PREFIX . "order` WHERE `order_status_id` = " . $params['exchange_status'] . "");
		} else {
			$query = $this->db->query("SELECT order_id FROM `" . DB_PREFIX . "order` WHERE `date_added` >= '" . $params['from_date'] . "'");
		}

		$document = array();
		$document_counter = 0;

		if ($query->num_rows) {

			foreach ($query->rows as $orders_data) {

				$order = $this->model_sale_order->getOrder($orders_data['order_id']);

				$date = date('Y-m-d', strtotime($order['date_added']));
				$time = date('H:i:s', strtotime($order['date_added']));

				$document['Документ' . $document_counter] = array(
					'Ид'          => $order['order_id']
					,'Номер'       => $order['order_id']
					,'Дата'        => $date
					,'Время'       => $time
					,'Валюта'      => $params['currency']
					,'Курс'        => 1
					,'ХозОперация' => 'Заказ товара'
					,'Роль'        => 'Продавец'
					,'Сумма'       => $order['total']
					,'Комментарий' => $order['comment']
				);

				$document['Документ' . $document_counter]['Контрагенты']['Контрагент'] = array(
					'Ид'                 => $order['customer_id'] . '#' . $order['email']
					,'Наименование'		    => $order['payment_lastname'] . ' ' . $order['payment_firstname']
					,'Роль'               => 'Покупатель'
					,'ПолноеНаименование'	=> $order['payment_lastname'] . ' ' . $order['payment_firstname']
					,'Фамилия'            => $order['payment_lastname']
					,'Имя'			          => $order['payment_firstname']
					,'Адрес' => array(
						'Представление'	=> $order['shipping_address_1'].', '.$order['shipping_city'].', '.$order['shipping_postcode'].', '.$order['shipping_country']
					)
					,'Контакты' => array(
						'Контакт1' => array(
							'Тип' => 'ТелефонРабочий'
							,'Значение'	=> $order['telephone']
						)
						,'Контакт2'	=> array(
							'Тип' => 'Почта'
							,'Значение'	=> $order['email']
						)
					)
				);

				// Товары
				$products = $this->model_sale_order->getOrderProducts($orders_data['order_id']);

				$product_counter = 0;
				foreach ($products as $product) {
					$id = $this->get1CProductIdByProductId($product['product_id']);

					$document['Документ' . $document_counter]['Товары']['Товар' . $product_counter] = array(
						'Ид'             => $id
						,'Наименование'   => $product['name']
						,'ЦенаЗаЕдиницу'  => $product['price']
						,'Количество'     => $product['quantity']
						,'Сумма'          => $product['total']
					);

					if ($this->config->get('exchange1c_relatedoptions')) {
						$this->load->model('module/related_options');
						if ($this->model_module_related_options->get_product_related_options_use($product['product_id'])) {
							$order_options = $this->model_sale_order->getOrderOptions($orders_data['order_id'], $product['order_product_id']);
							$options = array();
							foreach ($order_options as $order_option) {
								$options[$order_option['product_option_id']] = $order_option['product_option_value_id'];
							}
							if (count($options) > 0) {
								$ro = $this->model_module_related_options->get_related_options_set_by_poids($product['product_id'], $options);
								if ($ro != FALSE) {
									$char_id = $this->model_module_related_options->get_char_id($ro['relatedoptions_id']);
									if ($char_id != FALSE) {
										$document['Документ' . $document_counter]['Товары']['Товар' . $product_counter]['Ид'] .= "#".$char_id;
									}
								}
							}

						}

					}

					$product_counter++;
				}

				$data = $order;

				$this->model_sale_order->addOrderHistory($orders_data['order_id'], array(
					'order_status_id' => $params['new_status'],
					'comment'         => '',
					'notify'          => $params['notify']
				));

				$document_counter++;
			}
		}

		$root = '<?xml version="1.0" encoding="utf-8"?><КоммерческаяИнформация ВерсияСхемы="2.04" ДатаФормирования="' . date('Y-m-d', time()) . '" />';
		$xml = $this->array_to_xml($document, new SimpleXMLElement($root));

		return $xml->asXML();
	}


	function array_to_xml($data, &$xml) {

		foreach($data as $key => $value) {
			if (is_array($value)) {
				if (!is_numeric($key)) {
					$subnode = $xml->addChild(preg_replace('/\d/', '', $key));
					$this->array_to_xml($value, $subnode);
				}
			}
			else {
				$xml->addChild($key, $value);
			}
		}

		return $xml;
	}

	function format($var){
		return preg_replace_callback(
			'/\\\u([0-9a-fA-F]{4})/',
			create_function('$match', 'return mb_convert_encoding("&#" . intval($match[1], 16) . ";", "UTF-8", "HTML-ENTITIES");'),
			json_encode($var)
		);
	}

	/**
	 * Парсит цены и количество
	 *
	 * @param    string    наименование типа цены
	 */
	public function parseOffers($filename, $config_price_type, $language_id) {

		$importFile = DIR_CACHE . 'exchange1c/' . $filename;
		$xml = simplexml_load_file($importFile);

		$price_types = array();

		$enable_log = $this->config->get('exchange1c_full_log');
		$exchange1c_relatedoptions = $this->config->get('exchange1c_relatedoptions');

		$this->load->model('catalog/option');

		if ($enable_log)
			$this->log->write("Начат разбор файла: " . $filename);

		if ($xml->ПакетПредложений->ТипыЦен->ТипЦены) {
			foreach ($xml->ПакетПредложений->ТипыЦен->ТипЦены as $type) {
				$price_types[(string)$type->Ид] = (string)$type->Наименование;
			}
		}

		if (!empty($config_price_type) && count($config_price_type) > 0) {
			$config_price_type_main = array_shift($config_price_type);
		}

		// Инициализация массива скидок для оптимизации алгоритма
		if (!empty($config_price_type) && count($config_price_type) > 0) {
			$discount_price_type = array();
			foreach ($config_price_type as $obj) {
				$discount_price_type[$obj['keyword']] = array(
					'customer_group_id' => $obj['customer_group_id'],
					'quantity' => $obj['quantity'],
					'priority' => $obj['priority']
				);
			}
		}

		$offer_cnt = 0;

		if ($xml->ПакетПредложений->Предложения->Предложение) {
			foreach ($xml->ПакетПредложений->Предложения->Предложение as $offer) {

				$new_product = (!isset($data));

				$offer_cnt++;

				if (!$exchange1c_relatedoptions || $new_product) {

					$data = array();
					$data['price'] = 0;

					//UUID без номера после #
					$uuid = explode("#", $offer->Ид);
					$data['1c_id'] = $uuid[0];
					if ($enable_log)
						$this->log->write("Товар: [UUID]:" . $data['1c_id']);

					$product_id = $this->getProductIdBy1CProductId ($uuid[0]);

					//Цена за единицу
					if ($offer->Цены) {

						// Первая цена по умолчанию - $config_price_type_main
						if (!$config_price_type_main['keyword']) {
							$data['price'] = (float)$offer->Цены->Цена->ЦенаЗаЕдиницу;
						}
						else {
							if ($offer->Цены->Цена->ИдТипаЦены) {
								foreach ($offer->Цены->Цена as $price) {
									if ($price_types[(string)$price->ИдТипаЦены] == $config_price_type_main['keyword']) {
										$data['price'] = (float)$price->ЦенаЗаЕдиницу;
										if ($enable_log)
											$this->log->write(" найдена цена  > " . $data['price']);

									}
								}
							}
						}

						// Вторая цена и тд - $discount_price_type
						if (!empty($discount_price_type) && $offer->Цены->Цена->ИдТипаЦены) {
							foreach ($offer->Цены->Цена as $price) {
								$key = $price_types[(string)$price->ИдТипаЦены];
								if (isset($discount_price_type[$key])) {
									$value = array(
										'customer_group_id'	=> $discount_price_type[$key]['customer_group_id'],
										'quantity'      => $discount_price_type[$key]['quantity'],
										'priority'      => $discount_price_type[$key]['priority'],
										'price'         => (float)$price->ЦенаЗаЕдиницу,
										'date_start'    => '0000-00-00',
										'date_end'      => '0000-00-00'
									);
									$data['product_discount'][] = $value;
									unset($value);
								}
							}
						}
					}

					//Количество
					$data['quantity'] = isset($offer->Количество) ? (int)$offer->Количество : 0;
				}

				//Характеристики
				if ($offer->ХарактеристикиТовара->ХарактеристикаТовара) {

					$product_option_value_data = array();
					$product_option_data = array();

					$lang_id = (int)$this->config->get('config_language_id');
					$count = count($offer->ХарактеристикиТовара->ХарактеристикаТовара);

					foreach ($offer->ХарактеристикиТовара->ХарактеристикаТовара as $i => $opt) {
						$name_1c = (string)$opt->Наименование;
						$value_1c = (string)$opt->Значение;

						if (!empty($name_1c) && !empty($value_1c)) {

							if ($exchange1c_relatedoptions) {
								$uuid = explode("#", $offer->Ид);
								if (!isset($char_id) || $char_id != $uuid[1]) {
									$char_id = $uuid[1];
									if ($enable_log) $this->log->write("Характеристика: ".$char_id);
								}
							}

							if ($enable_log) $this->log->write(" Найдены характеристики: " . $name_1c . " -> " . $value_1c);

							$option_id = $this->setOption($name_1c);

							$option_value_id = $this->setOptionValue($option_id, $value_1c);

							$product_option_value_data[] = array(
								'option_value_id'         => (int) $option_value_id,
								'product_option_value_id' => '',
								'quantity'                => isset($data['quantity']) ? (int)$data['quantity'] : 0,
								'subtract'                => 0,
								'price'                   => isset($data['price']) ? (int)$data['price'] : 0,
								'price_prefix'            => '+',
								'points'                  => 0,
								'points_prefix'           => '+',
								'weight'                  => 0,
								'weight_prefix'           => '+'
							);

							$product_option_data[] = array(
								'product_option_id'    => '',
								'name'                 => (string)$name_1c,
								'option_id'            => (int) $option_id,
								'type'                 => 'select',
								'required'             => 1,
								'product_option_value' => $product_option_value_data
							);

							if ($exchange1c_relatedoptions) {

								if ( !isset($data['relatedoptions'])) {
									$data['relatedoptions'] = array();
									$data['related_options_variant_search'] = TRUE;
									$data['related_options_use'] = TRUE;
								}

								$ro_found = FALSE;
								foreach ($data['relatedoptions'] as $ro_num => $relatedoptions) {
									if ($relatedoptions['char_id'] == $char_id) {
										$data['relatedoptions'][$ro_num]['options'][$option_id] = $option_value_id;
										$ro_found = TRUE;
										break;
									}
								}
								if (!$ro_found) {
									$data['relatedoptions'][] = array('char_id' => $char_id, 'quantity' => (isset($offer->Количество) ? (int)$offer->Количество : 0), 'options' => array($option_id => $option_value_id));
								}

							} else {
								$data['product_option'] = $product_option_data;
							}
						}
					}
				}

				if (!$exchange1c_relatedoptions || $new_product) {

					if ($offer->СкидкиНаценки) {
						$value = array();
						foreach ($offer->СкидкиНаценки->СкидкаНаценка as $discount) {
							$value = array(
								'customer_group_id'	=> 1
								,'priority'     => isset($discount->Приоритет) ? (int)$discount->Приоритет : 0
								,'price'        => (int)(($data['price'] * (100 - (float)str_replace(',', '.', (string)$discount->Процент))) / 100)
								,'date_start'   => isset($discount->ДатаНачала) ? (string)$discount->ДатаНачала : ''
								,'date_end'     => isset($discount->ДатаОкончания) ? (string)$discount->ДатаОкончания : ''
								,'quantity'     => 0
							);

							$data['product_discount'][] = $value;

							if ($discount->ЗначениеУсловия) {
								$value['quantity'] = (int)$discount->ЗначениеУсловия;
							}

							unset($value);
						}
					}

					$data['status'] = 1;
				}

				if (!$exchange1c_relatedoptions || $offer_cnt == count($xml->ПакетПредложений->Предложения->Предложение)
				    || $data['1c_id'] != substr($xml->ПакетПредложений->Предложения->Предложение[$offer_cnt]->Ид, 0, strlen($data['1c_id'])) ) {

					$this->updateProduct($data, $product_id, $language_id);
					unset($data);
				}



			}
		}

		$this->cache->delete('product');

		if ($enable_log)
			$this->log->write("Окончен разбор файла: " . $filename );

	}

	private function setOption($name){
		$lang_id = (int)$this->config->get('config_language_id');

		$query = $this->db->query("SELECT option_id FROM ". DB_PREFIX ."option_description WHERE name='". $this->db->escape($name) ."'");

		if ($query->num_rows > 0) {
			$option_id = $query->row['option_id'];
		}
		else {
			//Нет такой опции
			$this->db->query("INSERT INTO `" . DB_PREFIX . "option` SET type = 'select', sort_order = '0'");
			$option_id = $this->db->getLastId();
			$this->db->query("INSERT INTO " . DB_PREFIX . "option_description SET option_id = '" . $option_id . "', language_id = '" . $lang_id . "', name = '" . $this->db->escape($name) . "'");
		}
		return $option_id;
	}

	private function setOptionValue($option_id, $value) {
		$lang_id = (int)$this->config->get('config_language_id');

		$query = $this->db->query("SELECT option_value_id FROM ". DB_PREFIX ."option_value_description WHERE name='". $this->db->escape($value) ."' AND option_id='". $option_id ."'");

		if ($query->num_rows > 0) {
			$option_value_id = $query->row['option_value_id'];
		}
		else {
			//Добавляем значение опции, только если нет в базе
			$this->db->query("INSERT INTO " . DB_PREFIX . "option_value SET option_id = '" . $option_id . "', image = '', sort_order = '0'");
			$option_value_id = $this->db->getLastId();
			$this->db->query("INSERT INTO " . DB_PREFIX . "option_value_description SET option_value_id = '".$option_value_id."', language_id = '" . $lang_id . "', option_id = '" . $option_id . "', name = '" . $this->db->escape($value) . "'");
		}
		return $option_value_id;
	}

	/**
	 * Парсит товары и категории
	 */
	public function parseImport($filename, $language) {

		$importFile = DIR_CACHE . 'exchange1c/' . $filename;

		$enable_log = $this->config->get('exchange1c_full_log');
		$apply_watermark = $this->config->get('exchange1c_apply_watermark');

		$xml = simplexml_load_file($importFile);
		$data = array();

		$dic = array('rus'=>'RU', 'ru'=>'UA');
        $language_id = $language['language_id'];
        //if($language_id == 3) return;
        $langNode = $dic[$language['code']];

		// Группы
        //if($language_id == 3) return;
        if($xml->Классификатор->Группы) $this->insertCategory($xml->Классификатор->Группы->Группа, 0, $language_id, $langNode);

		// Свойства
		if ($xml->Классификатор->Свойства) $this->insertAttribute($xml->Классификатор->Свойства->Свойство, $language_id, $langNode);

		$this->load->model('catalog/manufacturer');

		// Товары
		if ($xml->Каталог->Товары->Товар) {
			foreach ($xml->Каталог->Товары->Товар as $product) {

				$uuid = explode('#', (string)$product->Ид);
				$data['1c_id'] = $uuid[0];
				if (!empty($product->Артикул)) {
					$data['model'] = $product->Артикул? (string)$product->Артикул : 'не задана';
					$data['name'] = $product->Наименование->$langNode ? (string)$product->Наименование->$langNode : 'не задано';
					$data['weight'] = $product->Вес? (float)$product->Вес : 0;
					$data['sku'] = $product->Артикул? (string)$product->Артикул : '';
					if ($enable_log)
						$this->log->write("Найден товар:" . $data['name'] . " арт: " . $data['sku'] . "1C UUID: " . $data['1c_id']);
					/*if ($product->Картинка) {
                        $data['image'] = $apply_watermark ? $this->applyWatermark((string)$product->Картинка[0]) : (string)$product->Картинка[0];
                        unset($product->Картинка[0]);
                        foreach ($product->Картинка as $image) {
                          $data['product_image'][] =array(
                                'image' => $apply_watermark ? $this->applyWatermark((string)$image) : (string)$image,
                                'sort_order' => 0
                            );
                        }
                    }*/
					if ($product->Картинки->Картинка) {
						/*сортировка картинок*/
						$newarray=array();
						$pics=$product->Картинки->Картинка;
						foreach ($pics as $imageg) {
							$parts=explode("_",$imageg);
							$lastpart=array_pop($parts);
							$nomer=preg_replace("([^0-9])", "", $lastpart);
							if($nomer==''){$nomer=0;}
							$newarray[]=array($imageg,$nomer);
						}
						usort($newarray, create_function('$a,$b', ' return ($a[1] < $b[1]) ? -1 : ($a[1] == $b[1] ? 0 : 1); '));
						/*сортировка картинок*/
						$data['image'] = $newarray[0][0] ? ($apply_watermark ? $this->applyWatermark('data/photo/'.(string)$newarray[0][0]) : 'data/photo/'.(string)$newarray[0][0]) : '';
						unset($newarray[0]);
						foreach ($newarray as $image) {
							$data['product_image'][] = array(
								'image' => $apply_watermark ? $this->applyWatermark('data/photo/'.(string)$image[0]) : 'data/photo/'.(string)$image[0],
								'sort_order' => $image[1]
							);
						}
					}
					$data['unit'] = $product->БазоваяЕдиница ? (string)$product->БазоваяЕдиница : '';
					$data['model'] = (string)$product->Артикул;
					$data['sku']   = (string)$product->Артикул;
					if($product->ХарактеристикиТовара){
						$option_desc = '';
						$count_options = count($product->ХарактеристикиТовара->ХарактеристикаТовара);
						foreach($product->ХарактеристикиТовара->ХарактеристикаТовара as $option ) {
							$option_desc .= (string)$option->Наименование->$langNode . ': ' . (string)$option->Значение . ';';
						}
						$option_desc .= ";\n";
					}

					if ($product->Группы) $data['category_1c_id'] = (string)$product->Группы->Ид;
					if ($product->Описание) $data['description'] = (string)$product->Описание->$langNode;
					if ($product->Статус) $data['status'] = (string)$product->Статус;

					// Свойства продукта
					if ($product->ЗначенияСвойств) {
						if ($enable_log)
							$this->log->write("   загружаются свойства... ");
						foreach ($product->ЗначенияСвойств->ЗначенияСвойства as $property) {
							if (isset($this->PROPERTIES[(string)$property->Ид]['name'])) {
								$attribute = $this->PROPERTIES[(string)$property->Ид];
								if (isset($attribute['values'][(string)$property->Значение->$langNode])) {
									$attribute_value = str_replace("'", "&apos;", (string)$attribute['values'][(string)$property->Значение->$langNode]);
								}
								else if ((string)$property->Значение != '') {
									$attribute_value = str_replace("'", "&apos;", (string)$property->Значение->$langNode);
								}
								else {
									continue;
								}
								if ($enable_log)
									$this->log->write("   > " . $attribute_value);
								switch ($attribute['name']) {
									case 'oc.seo_h1':
										$data['seo_h1'] = $attribute_value;
										break;
									case 'oc.seo_title':
										$data['seo_title'] = $attribute_value;
										break;
									case 'oc.sort_order':
										$data['sort_order'] = $attribute_value;
										break;
									default:
										$data['product_attribute'][] = array(
											'attribute_id'			=> $attribute['id'],
											'product_attribute_description'	=> array(
												$language_id => array(
													'text' => $attribute_value
												)
											)
										);

								}
								//TODO-Bad code to set manufacturer
								if (in_array($attribute['name'], array('Виробник', 'Производитель'))) {
										$manufacturer_name = $attribute_value;
										$query = $this->db->query("SELECT manufacturer_id FROM ". DB_PREFIX ."manufacturer WHERE name='". $manufacturer_name ."'");
										if ($query->num_rows) {
											$data['manufacturer_id'] = $query->row['manufacturer_id'];
										}
										else {
											$data_manufacturer = array(
												'name' => $manufacturer_name,
												'keyword' => '',
												'sort_order' => 0,
												'manufacturer_store' => array(0 => 0)
											);
											$data_manufacturer['manufacturer_description'] = array(
												$language_id => array(
													'meta_keyword' => '',
													'meta_description' => '',
													'description' => '',
													'seo_title' => '',
													'seo_h1' => ''
												),
											);
											$manufacturer_id = $this->model_catalog_manufacturer->addManufacturer($data_manufacturer);
											$data['manufacturer_id'] = $manufacturer_id;
											//только если тип 'translit'
											if ($this->config->get('exchange1c_seo_url') == 2) {
												$man_name = "brand-" . $manufacturer_name;
												$this->setSeoURL('manufacturer_id', $manufacturer_id, $man_name);
											}
										}
								}
							}
						}
						if ($enable_log)
							$this->log->write("   свойства загружены... ");
					}

					// Реквизиты продукта
					if($product->ЗначенияРеквизитов) {
						foreach ($product->ЗначенияРеквизитов->ЗначениеРеквизита as $requisite){
							switch ($requisite->Наименование){
								case 'Полное наименование':
									$data['name'] = $requisite->Значение ? (string)$requisite->Значение->$langNode : '';
									break;
								case 'Вес':
									$data['weight'] = $requisite->Значение ? (float)$requisite->Значение : 0;
									break;
								case 'Длина':
									$data['length'] = $requisite->Значение ? (float)$requisite->Значение : 0;
									break;
								case 'Толщина':
									$data['width'] = $requisite->Значение ? (float)$requisite->Значение : 0;
									break;
								case 'Высота':
									$data['height'] = $requisite->Значение ? (float)$requisite->Значение : 0;
									break;
								case 'ОписаниеВФорматеHTML':
									$data['description'] = $requisite->Значение ? (string)$requisite->Значение : '';
									break;
							}
						}
					}
					$this->setProduct($data, $language_id);
					unset($data);
				} else {
					$this->load->model('catalog/product');
					$product_id = $this->model_catalog_product->getProductIdBy1C($uuid[0]);
					if (!empty($product_id)) {
						$this->model_catalog_product->deleteProduct($product_id);
					}
					unset($data);
					continue;
				}




			}
		}

		unset($xml);
		if ($enable_log)
			$this->log->write("Окончен разбор файла: " . $filename );
	}


	/**
	 * Инициализируем данные для категории дабы обновлять данные, а не затирать
	 *
	 * @param	array	старые данные
	 * @param	int	id родительской категории
	 * @param	array	новые данные
	 * @return	array
	 */
	public function initCategory($category, $parent, $data = array(), $language_id, $langNode) {

		$result = array(
			'status'         => isset($data['status']) ? $data['status'] : 1
			,'top'            => isset($data['top']) ? $data['top'] : 1
			,'parent_id'      => $parent
			,'category_store' => isset($data['category_store']) ? $data['category_store'] : array(0)
			,'keyword'        => isset($data['keyword']) ? $data['keyword'] : ''
			,'image'          => (isset($category->Картинка)) ? (string)$category->Картинка : ((isset($data['image'])) ? $data['image'] : '')
			,'sort_order'     => (isset($category->Сортировка)) ? (int)$category->Сортировка : ((isset($data['sort_order'])) ? $data['sort_order'] : 0)
			,'column'         => 1
		);

		$result['category_description'] = array(
			$language_id => array(
				'name'             => (string)$category->Наименование->$langNode
				,'meta_keyword'     => (isset($data['category_description'][$language_id]['meta_keyword'])) ? $data['category_description'][$language_id]['meta_keyword'] : ''
				,'meta_description'	=> (isset($data['category_description'][$language_id]['meta_description'])) ? $data['category_description'][$language_id]['meta_description'] : ''
				,'description'		  => (isset($category->Описание)) ? (string)$category->Описание : ((isset($data['category_description'][$language_id]['description'])) ? $data['category_description'][$language_id]['description'] : '')
				,'seo_title'        => (isset($data['category_description'][$language_id]['seo_title'])) ? $data['category_description'][$language_id]['seo_title'] : ''
				,'seo_h1'           => (isset($data['category_description'][$language_id]['seo_h1'])) ? $data['category_description'][$language_id]['seo_h1'] : ''
			),
		);

		return $result;
	}


	/**
	 * Функция добавляет корневую категорию и всех детей
	 *
	 * @param	SimpleXMLElement
	 * @param	int
	 */
	private function insertCategory($xml, $parent = 0, $language_id, $langNode) {

		$this->load->model('catalog/category');

		foreach ($xml as $category){

			if (isset($category->Ид) && isset($category->Наименование) ){
				$id =  (string)$category->Ид;

				$data = array();

				$query = $this->db->query('SELECT * FROM `' . DB_PREFIX . 'category_to_1c` WHERE `1c_category_id` = "' . $this->db->escape($id) . '"');

				if ($query->num_rows) {
					$category_id = (int)$query->row['category_id'];
					$data = $this->model_catalog_category->getCategory($category_id);
					$data['category_description'] = $this->model_catalog_category->getCategoryDescriptions($category_id);
                    $data = $this->initCategory($category, $parent, $data, $language_id, $langNode);
					$this->editCategory($category_id, $data);
				}
				else {
					$data = $this->initCategory($category, $parent, array(), $language_id, $langNode);
					//$category_id = $this->getCategoryIdByName($data['category_description'][1]['name']) ? $this->getCategoryIdByName($data['category_description'][1]['name']) : $this->model_catalog_category->addCategory($data);
					$category_id = $this->model_catalog_category->addCategory($data);
					$this->db->query('INSERT INTO `' . DB_PREFIX . 'category_to_1c` SET category_id = ' . (int)$category_id . ', `1c_category_id` = "' . $this->db->escape($id) . '"');
				}

				$this->CATEGORIES[$id] = $category_id;
			}

			//только если тип 'translit'
			if ($this->config->get('exchange1c_seo_url') == 2) {
				$cat_name = "category-" . $data['parent_id'] . "-" . $data['category_description'][$language_id]['name'];
				$this->setSeoURL('category_id', $category_id, $cat_name);
			}

			if ($category->Группы) $this->insertCategory($category->Группы->Группа, $category_id, $language_id, $langNode);
		}

		unset($xml);
	}


	/**
	 * Создает атрибуты из свойств
	 *
	 * @param 	SimpleXMLElement
	 */
	private function insertAttribute($xml, $language_id, $langNode) {
		$this->load->model('catalog/attribute');
		$this->load->model('catalog/attribute_group');

		$attribute_group = $this->model_catalog_attribute_group->getAttributeGroup(1);

		if (!$attribute_group) {

			$attribute_group_description[$language_id] = array (
				'name' => 'Свойства'
			);

			$attribute_group_description[3] = array (
				'name' => 'Свойства'
			);

			$data = array (
				'sort_order'			=> 0,
				'attribute_group_description'	=> $attribute_group_description
			);

			$this->model_catalog_attribute_group->addAttributeGroup($data);
		}

		foreach ($xml as $attribute) {
			$id	= (string)$attribute->Ид;
			$name = (string)$attribute->Наименование->$langNode;
			$values	= array();

			if ((string)$attribute->ВариантыЗначений) {
				if ((string)$attribute->ТипЗначений == 'Справочник') {
					foreach($attribute->ВариантыЗначений->Справочник as $option_value){
						if ((string)$option_value->Значение != '') {
							$values[(string)$option_value->ИдЗначения] = (string)$option_value->Значение;
						}
					}
				}
			}

			$data = array (
				'attribute_group_id'    => 1,
				'sort_order'            => 0,
			);

			$data['attribute_description'][$language_id]['name'] = (string)$name;

			$data_new=$data;

			// Если атрибут уже был добавлен, то возвращаем старый id, если атрибута нет, то создаем его и возвращаем его id
			$current_attribute = $this->db->query('SELECT attribute_id FROM ' . DB_PREFIX . 'attribute_to_1c WHERE 1c_attribute_id = "' . $id . '"');
			if (!$current_attribute->num_rows) {
				$attribute_id = $this->model_catalog_attribute->addAttribute($data);
				$this->db->query('INSERT INTO `' .  DB_PREFIX . 'attribute_to_1c` SET attribute_id = ' . (int)$attribute_id . ', `1c_attribute_id` = "' . $id . '"');
			}
			else {
				$data = $current_attribute->row;
				$attribute_id = $data['attribute_id'];

				$this->editAttrib($attribute_id, $data_new);
			}

			$this->PROPERTIES[$id] = array(
				'id'     => $attribute_id,
				'name'   => $name,
				'values' => $values
			);

		}

		unset($xml);
	}


	/**
	 * Функция работы с продуктом
	 * @param	int
	 * @return	array
	 */

	private function getProductWithAllData($product_id, $language_id) {
		$this->load->model('catalog/product');
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$language_id . "'");

		$data = array();

		if ($query->num_rows) {

			$data = $query->row;

			$data = array_merge($data, array('product_description' => $this->model_catalog_product->getProductDescriptions($product_id)));
			$data = array_merge($data, array('product_option' => $this->model_catalog_product->getProductOptions($product_id)));

			$data['product_image'] = array();

			$results = $this->model_catalog_product->getProductImages($product_id);

			foreach ($results as $result) {
				$data['product_image'][] = array(
					'image' => $result['image'],
					'sort_order' => $result['sort_order']
				);
			}

			if (method_exists($this->model_catalog_product, 'getProductMainCategoryId')) {
				$data = array_merge($data, array('main_category_id' => $this->model_catalog_product->getProductMainCategoryId($product_id)));
			}

			$data = array_merge($data, array('product_discount' => $this->model_catalog_product->getProductDiscounts($product_id)));
			$data = array_merge($data, array('product_special' => $this->model_catalog_product->getProductSpecials($product_id)));
			$data = array_merge($data, array('product_download' => $this->model_catalog_product->getProductDownloads($product_id)));
			$data = array_merge($data, array('product_category' => $this->model_catalog_product->getProductCategories($product_id)));
			$data = array_merge($data, array('product_store' => $this->model_catalog_product->getProductStores($product_id)));
			$data = array_merge($data, array('product_related' => $this->model_catalog_product->getProductRelated($product_id)));
			$data = array_merge($data, array('product_attribute' => $this->model_catalog_product->getProductAttributes($product_id)));

			if (VERSION == '1.5.3.1') {
				$data = array_merge($data, array('product_tag' => $this->model_catalog_product->getProductTags($product_id)));
			}
		}

		$query = $this->db->query('SELECT * FROM ' . DB_PREFIX . 'url_alias WHERE query LIKE "product_id='.$product_id.'"');
		if ($query->num_rows) $data['keyword'] = $query->row['keyword'];

		return $data;
	}

	/**
	 * Обновляет массив с информацией о продукте
	 *
	 * @param	array	новые данные
	 * @param	array	обновляемые данные
	 * @return	array
	 */
	private function initProduct($product, $data = array(), $language_id) {

		$this->load->model('tool/image');

		$result = array(
			'product_description' => array()
			,'model'    => (isset($product['model'])) ? $product['model'] : (isset($data['model']) ? $data['model']: '')
			,'sku'      => (isset($product['sku'])) ? $product['sku'] : (isset($data['sku']) ? $data['sku']: '')
			,'upc'      => (isset($product['upc'])) ? $product['upc'] : (isset($data['upc']) ? $data['upc']: '')
			,'ean'      => (isset($product['ean'])) ? $product['ean'] : (isset($data['ean']) ? $data['ean']: '')
			,'jan'      => (isset($product['jan'])) ? $product['jan'] : (isset($data['jan']) ? $data['jan']: '')
			,'isbn'     => (isset($product['isbn'])) ? $product['isbn'] : (isset($data['isbn']) ? $data['isbn']: '')
			,'mpn'      => (isset($product['mpn'])) ? $product['mpn'] : (isset($data['mpn']) ? $data['mpn']: '')

			,'location'     => (isset($product['location'])) ? $product['location'] : (isset($data['location']) ? $data['location']: '')
			,'price'        => (isset($product['price'])) ? $product['price'] : (isset($data['price']) ? $data['price']: 0)
			,'tax_class_id' => (isset($product['tax_class_id'])) ? $product['tax_class_id'] : (isset($data['tax_class_id']) ? $data['tax_class_id']: 0)
			,'quantity'     => (isset($product['quantity'])) ? $product['quantity'] : (isset($data['quantity']) ? $data['quantity']: 0)
			,'unit'		=> (isset($product['unit'])) ? $product['unit'] : (isset($data['unit']) ? $data['unit']: 'шт.')
			,'minimum'      => (isset($product['minimum'])) ? $product['minimum'] : (isset($data['minimum']) ? $data['minimum']: 1)
			,'subtract'     => (isset($product['subtract'])) ? $product['subtract'] : (isset($data['subtract']) ? $data['subtract']: 1)
			,'stock_status_id'  => $this->config->get('config_stock_status_id')
			,'shipping'         => (isset($product['shipping'])) ? $product['shipping'] : (isset($data['shipping']) ? $data['shipping']: 1)
			,'keyword'          => (isset($product['keyword'])) ? $product['keyword'] : (isset($data['keyword']) ? $data['keyword']: '')
			,'image'            => (isset($product['image'])) ? $product['image'] : (isset($data['image']) ? $data['image']: '')
			,'date_available'   => date('Y-m-d', time() - 86400)
			,'length'           => (isset($product['length'])) ? $product['length'] : (isset($data['length']) ? $data['length']: '')
			,'width'            => (isset($product['width'])) ? $product['width'] : (isset($data['width']) ? $data['width']: '')
			,'height'           => (isset($product['height'])) ? $product['height'] : (isset($data['height']) ? $data['height']: '')
			,'length_class_id'  => (isset($product['length_class_id'])) ? $product['length_class_id'] : (isset($data['length_class_id']) ? $data['length_class_id']: 1)
			,'weight'           => (isset($product['weight'])) ? $product['weight'] : (isset($data['weight']) ? $data['weight']: 0)
			,'weight_class_id'  => (isset($product['weight_class_id'])) ? $product['weight_class_id'] : (isset($data['weight_class_id']) ? $data['weight_class_id']: 1)
			,'status'           => (isset($product['status'])) ? $product['status'] : (isset($data['status']) ? $data['status']: 1)
			,'sort_order'       => (isset($product['sort_order'])) ? $product['sort_order'] : (isset($data['sort_order']) ? $data['sort_order']: 1)
			,'manufacturer_id'  => (isset($product['manufacturer_id'])) ? $product['manufacturer_id'] : (isset($data['manufacturer_id']) ? $data['manufacturer_id']: 0)
			,'main_category_id' => 0
			,'product_store'    => array(0)
			,'product_option'   => array()
			,'points'           => (isset($product['points'])) ? $product['points'] : (isset($data['points']) ? $data['points']: 0)
			,'product_image'    => (isset($product['product_image'])) ? $product['product_image'] : (isset($data['product_image']) ? $data['product_image']: array())
			,'preview'          => $this->model_tool_image->resize('no_image.jpg', 100, 100)
			,'cost'             => (isset($product['cost'])) ? $product['cost'] : (isset($data['cost']) ? $data['cost']: 0)
			,'product_discount' => (isset($product['product_discount'])) ? $product['product_discount'] : (isset($data['product_discount']) ? $data['product_discount']: array())
			,'product_special'  => (isset($product['product_special'])) ? $product['product_special'] : (isset($data['product_special']) ? $data['product_special']: array())
			,'product_download' => (isset($product['product_download'])) ? $product['product_download'] : (isset($data['product_download']) ? $data['product_download']: array())
			,'product_related'  => (isset($product['product_related'])) ? $product['product_related'] : (isset($data['product_related']) ? $data['product_related']: array())
			,'product_attribute'    => (isset($product['product_attribute'])) ? $product['product_attribute'] : (isset($data['product_attribute']) ? $data['product_attribute']: array())
		);

		if (VERSION == '1.5.3.1') {
			$result['product_tag'] = (isset($product['product_tag'])) ? $product['product_tag'] : (isset($data['product_tag']) ? $data['product_tag']: array());
		}

		$result['product_description'] = array(
			$language_id => array(
				'name'              => isset($product['name']) ? $product['name'] : (isset($data['product_description'][$language_id]['name']) ? $data['product_description'][$language_id]['name']: 'Имя не задано')
				,'seo_h1'           => isset($product['seo_h1']) ? $product['seo_h1']: (isset($data['product_description'][$language_id]['seo_h1']) ? $data['product_description'][$language_id]['seo_h1']: '')
				,'seo_title'        => isset($product['seo_title']) ? $product['seo_title']: (isset($data['product_description'][$language_id]['seo_title']) ? $data['product_description'][$language_id]['seo_title']: '')
				,'meta_keyword'     => isset($product['meta_keyword']) ? trim($product['meta_keyword']): (isset($data['product_description'][$language_id]['meta_keyword']) ? $data['product_description'][$language_id]['meta_keyword']: '')
				,'meta_description' => isset($product['meta_description']) ? trim($product['meta_description']): (isset($data['product_description'][$language_id]['meta_description']) ? $data['product_description'][$language_id]['meta_description']: '')
				,'description'      => isset($product['description']) ? nl2br($product['description']): (isset($data['product_description'][$language_id]['description']) ? $data['product_description'][$language_id]['description']: '')
				,'tag'              => isset($product['tag']) ? $product['tag']: (isset($data['product_description'][$language_id]['tag']) ? $data['product_description'][$language_id]['tag']: '')
			),
		);

		if (isset($product['product_option'])) {
			$product['product_option_id'] = '';
			$product['name'] = '';
			if(!empty($product['product_option']) && isset($product['product_option'][0]['type'])){
				$result['product_option'] = $product['product_option'];
				if(!empty($data['product_option'])){
					$result['product_option'][0]['product_option_value'] = array_merge($product['product_option'][0]['product_option_value'],$data['product_option'][0]['product_option_value']);
				}
			}
			else {
				$result['product_option'] = $data['product_option'];
			}
		}
		else {
			$product['product_option'] = array();
		}

		if (isset($product['category_1c_id']) && isset($this->CATEGORIES[$product['category_1c_id']])) {
			$result['product_category'] = array((int)$this->CATEGORIES[$product['category_1c_id']]);
			$result['main_category_id'] = (int)$this->CATEGORIES[$product['category_1c_id']];
		}
		else {
			$result['product_category'] = isset($data['product_category']) ? $data['product_category']: array(0);
			$result['main_category_id'] = isset($data['main_category_id']) ? $data['main_category_id']: 0;
		}

		if (isset($product['related_options_use'])) {
			$result['related_options_use'] = $product['related_options_use'];
		}
		if (isset($product['related_options_variant_search'])) {
			$result['related_options_variant_search'] = $product['related_options_variant_search'];
		}
		if (isset($product['relatedoptions'])) {
			$result['relatedoptions'] = $product['relatedoptions'];
		}

		return $result;
	}



	/**
	 * Функция работы с продуктом
	 *
	 * @param array
	 */
	private function setProduct($product, $language_id) {

		if (!$product) return;

		// Проверяем, связан ли 1c_id с product_id
		$product_id = $this->getProductIdBy1CProductId($product['1c_id']);
		$data = $this->initProduct($product, array(), $language_id);

		if ($product_id) {
			//удаляем дубликаты (НОВОЕ)
			$this->db->query('DELETE FROM `' .  DB_PREFIX . 'product_to_1c` WHERE product_id = ' . (int)$product_id . ' AND `1c_id` != "' . $this->db->escape($product['1c_id']) . '"');
			$this->updateProduct($product, $product_id, $language_id);
		}
		else {
			if ($this->config->get('exchange1c_dont_use_artsync')) {
				$this->load->model('catalog/product');
				$product_id =	$this->model_catalog_product->addProduct($data);
			} else {
				// Проверяем, существует ли товар с тем-же артикулом
				// Если есть, то обновляем его
				$product_id = $this->getProductBySKU($data['sku']);
				if ($product_id !== false) {
					$this->updateProduct($product, $product_id, $language_id);
				}
				// Если нет, то создаем новый
				else {
					$this->load->model('catalog/product');
					$this->model_catalog_product->addProduct($data);
					$product_id = $this->getProductBySKU($data['sku']);
				}
			}
			// Добавляем линк
			if ($product_id){
				//удаляем дубликаты (НОВОЕ)
				$this->db->query('DELETE FROM `' .  DB_PREFIX . 'product_to_1c` WHERE product_id = ' . (int)$product_id . ' AND `1c_id` != "' . $this->db->escape($product['1c_id']) . '"');
				//добавляем запись
				$this->db->query('INSERT INTO `' .  DB_PREFIX . 'product_to_1c` SET product_id = ' . (int)$product_id . ', `1c_id` = "' . $this->db->escape($product['1c_id']) . '"');
			}
		}

		// Устанавливаем SEO URL
		if ($product_id){
			//только если тип 'translit'
			if ($this->config->get('exchange1c_seo_url') == 2) {
				$this->setSeoURL('product_id', $product_id, $product['name']);
			}
		}
	}

	/**
	 * Обновляет продукт
	 *
	 * @param      $product
	 * @param bool $product_id
	 * @param      $language_id
	 *
	 * @internal param $array
	 * @internal param $int
	 */
	private function updateProduct($product, $product_id = false, $language_id) {
		// Проверяем что обновлять?
		if ($this->config->get('exchange1c_relatedoptions')) {
			if ($product_id == false) {
				$this->setProduct($product, $language_id);
				return;
			}
		} else {
			if ($product_id !== false) {
				$product_id = $this->getProductIdBy1CProductId($product['1c_id']);
			}
		}
		// Обновляем описание продукта
		$product_old = $this->getProductWithAllData($product_id, $language_id);
		// Работаем с ценой на разные варианты товаров.
		if(!empty($product['product_option'][0])){
			if(isset($product_old['price']) && (float) $product_old['price'] > 0){
				$price = (float) $product_old['price'] - (float) $product['product_option'][0]['product_option_value'][0]['price'];
				$product['product_option'][0]['product_option_value'][0]['price_prefix'] = ($price > 0) ? '-':'+';
				$product['product_option'][0]['product_option_value'][0]['price'] = abs($price);
				$product['price'] = (float) $product_old['price'];
			}
			else{
				$product['product_option'][0]['product_option_value'][0]['price'] = 0;
			}
		}
		$this->load->model('catalog/product');
		$product_old = $this->initProduct($product, $product_old, $language_id);
		//Редактируем продукт
		$this->editProduct($product_id, $product_old);
	}

	/**
	 * Устанавливает SEO URL (ЧПУ) для заданного товара
	 *
	 * @param 	inf
	 * @param 	string
	 */
	private function setSeoURL($url_type, $element_id, $element_name) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` = '" . $url_type . "=" . $element_id . "'");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "url_alias` SET `query` = '" . $url_type . "=" . $element_id ."', `keyword`='" . $this->transString($element_name) . "'");
	}

	/**
	 * Транслиетрирует RUS->ENG
	 * @param string $aString
	 * @return string type
	 */
	private function transString($aString) {
		$rus = array(" ", "/", "*", "-", "+", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+", "[", "]", "{", "}", "~", ";", ":", "'", "\"", "<", ">", ",", ".", "?", "А", "Б", "В", "Г", "Д", "Е", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ъ", "Ы", "Ь", "Э", "а", "б", "в", "г", "д", "е", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ъ", "ы", "ь", "э", "ё",  "ж",  "ц",  "ч",  "ш",  "щ",   "ю",  "я",  "Ё",  "Ж",  "Ц",  "Ч",  "Ш",  "Щ",   "Ю",  "Я");
		$lat = array("-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-",  "-", "-", "-", "-", "-", "-", "a", "b", "v", "g", "d", "e", "z", "i", "y", "k", "l", "m", "n", "o", "p", "r", "s", "t", "u", "f", "h", "",  "i", "",  "e", "a", "b", "v", "g", "d", "e", "z", "i", "j", "k", "l", "m", "n", "o", "p", "r", "s", "t", "u", "f", "h", "",  "i", "",  "e", "yo", "zh", "ts", "ch", "sh", "sch", "yu", "ya", "yo", "zh", "ts", "ch", "sh", "sch", "yu", "ya");

		$string = str_replace($rus, $lat, $aString);

		while (mb_strpos($string, '--')) {
			$string = str_replace('--', '-', $string);
		}

		$string = strtolower(trim($string));

		return $string;
	}

	/**
	 * Получает product_id по артикулу
	 *
	 * @param 	string
	 * @return 	int|bool
	 */
	private function getProductBySKU($sku) {

		$query = $this->db->query("SELECT product_id FROM `" . DB_PREFIX . "product` WHERE `sku` = '" . $this->db->escape($sku) . "'");

		if ($query->num_rows) {
			return $query->row['product_id'];
		}
		else {
			return false;
		}
	}

	/**
	 * Получает 1c_id из product_id
	 *
	 * @param	int
	 * @return	string|bool
	 */
	private function get1CProductIdByProductId($product_id) {
		$query = $this->db->query('SELECT 1c_id FROM ' . DB_PREFIX . 'product_to_1c WHERE `product_id` = ' . $product_id);

		if ($query->num_rows) {
			return $query->row['1c_id'];
		}
		else {
			return false;
		}
	}

	/**
	 * Получает product_id из 1c_id
	 *
	 * @param	string
	 * @return	int|bool
	 */
	private function getProductIdBy1CProductId($product_id) {

		$query = $this->db->query('SELECT product_id FROM ' . DB_PREFIX . 'product_to_1c WHERE `1c_id` = "' . $product_id . '"');

		if ($query->num_rows) {
			return $query->row['product_id'];
		}
		else {
			return false;
		}
	}

	private function getCategoryIdByName($name) {
		$query = $this->db->query("SELECT category_id FROM `" . DB_PREFIX . "category_description` WHERE `name` = '" . $name . "'");
		if ($query->num_rows) {
			return $query->row['category_id'];
		}
		else {
			return false;
		}
	}

	/**
	 * Получает путь к картинке и накладывает водяные знаки
	 *
	 * @param	string
	 * @return	string
	 */
	private function applyWatermark($filename) {
		if (!empty($filename)) {
			$info = pathinfo($filename);
			$wmfile = DIR_IMAGE . $this->config->get('exchange1c_watermark');
			if (is_file($wmfile)) {
				$extension = $info['extension'];
				$minfo = getimagesize($wmfile);
				$image = new Image(DIR_IMAGE . $filename);
				$image->watermark($wmfile, 'center', $minfo['mime']);
				$new_image = utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '_watermark.' . $extension;
				$image->save(DIR_IMAGE . $new_image);
				return $new_image;
			}
			else {
				return $filename;
			}
		}
		else {
			return 'no_image.jpg';
		}
	}

	/**
	 * Заполняет продуктами родительские категории
	 */
	public function fillParentsCategories() {
		$this->db->query('DELETE FROM `' .DB_PREFIX . 'product_to_category` WHERE `main_category` = 0');
		$query = $this->db->query('SELECT * FROM `' . DB_PREFIX . 'product_to_category` WHERE `main_category` = 1');

		if ($query->num_rows) {
			foreach ($query->rows as $row) {
				$parents = $this->findParentsCategories($row['category_id']);
				foreach ($parents as $parent) {
					if ($row['category_id'] != $parent && $parent != 0) {
						$this->db->query('INSERT INTO `' .DB_PREFIX . 'product_to_category` SET `product_id` = ' . $row['product_id'] . ', `category_id` = ' . $parent . ', `main_category` = 0');
					}
				}
			}
		}
	}

	/**
	 * Ищет все родительские категории
	 *
	 * @param	int
	 * @return	array
	 */
	private function findParentsCategories($category_id) {
		$query = $this->db->query('SELECT * FROM `'.DB_PREFIX.'category` WHERE `category_id` = "'.$category_id.'"');
		if (isset($query->row['parent_id'])) {
			$result = $this->findParentsCategories($query->row['parent_id']);
		}
		$result[] = $category_id;
		return $result;
	}

	/**
	 * Получает language_id из code (ru, en, etc)
	 * Как ни странно, подходящей функции в API не нашлось
	 *
	 * @param	string
	 * @return	int
	 */
	public function getLanguageId($lang) {
		$query = $this->db->query('SELECT `language_id` FROM `' . DB_PREFIX . 'language` WHERE `code` = "'.$lang.'"');
		return $query->row['language_id'];
	}


	/**
	 * Очищает таблицы магазина
	 */
	public function flushDb($params) {

		$enable_log = $this->config->get('exchange1c_full_log');
		// Удаляем товары
		if ($params['product']) {
			if ($enable_log)
				$this->log->write("Очистка таблиц товаров: ");
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_attribute`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_attribute`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_description`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_description`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_discount`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_discount`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_image`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_image`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_option`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_option`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_option_value`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_option_value`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_related`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_related`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_reward`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_reward`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_special`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_special`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_to_1c`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_to_1c`');

			if ($this->config->get('exchange1c_relatedoptions'))	{
				$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions_to_char`');
				if ($enable_log) $this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions_to_char`');

				$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions`');
				if ($enable_log) $this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions`');

				$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions_option`');
				if ($enable_log) $this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions_option`');

				$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions_variant`');
				if ($enable_log) $this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions_variant`');

				$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions_variant_option`');
				if ($enable_log) $this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions_variant_option`');

				$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions_variant_product`');
				if ($enable_log) $this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'relatedoptions_variant_product`');
			}
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_to_category`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_to_category`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_to_download`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_to_download`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_to_layout`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_to_layout`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'product_to_store`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'product_to_store`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'option_value_description`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'option_value_description`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'option_description`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'option_description`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'option_value`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'option_value`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'order_option`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'order_option`');
			$this->db->query('TRUNCATE TABLE `' . DB_PREFIX . 'option`');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE `' . DB_PREFIX . 'option`');
			$this->db->query('DELETE FROM ' . DB_PREFIX . 'url_alias WHERE query LIKE "%product_id=%"');
			if ($enable_log)
				$this->log->write('DELETE FROM ' . DB_PREFIX . 'url_alias WHERE query LIKE "%product_id=%"');
		}

		// Очищает таблицы категорий
		if ($params['category']) {
			if ($enable_log)
				$this->log->write("Очистка таблиц категорий:");
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'category');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'category');
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'category_description');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'category_description');
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'category_to_store');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'category_to_store');
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'category_to_layout');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'category_path');
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'category_path');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'category_to_layout');
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'category_to_1c');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'category_to_1c');
			$this->db->query('DELETE FROM ' . DB_PREFIX . 'url_alias WHERE query LIKE "%category_id=%"');
			if ($enable_log)
				$this->log->write('DELETE FROM ' . DB_PREFIX . 'url_alias WHERE query LIKE "%category_id=%"');
		}

		// Очищает таблицы от всех производителей
		if ($params['manufacturer']) {
			if ($enable_log)
				$this->log->write("Очистка таблиц производителей:");
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'manufacturer');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'manufacturer');
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'manufacturer_description');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'manufacturer_description');
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'manufacturer_to_store');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'manufacturer_to_store');
			$this->db->query('DELETE FROM ' . DB_PREFIX . 'url_alias WHERE query LIKE "%manufacturer_id=%"');
			if ($enable_log)
				$this->log->write('DELETE FROM ' . DB_PREFIX . 'url_alias WHERE query LIKE "%manufacturer_id=%"');
		}

		// Очищает атрибуты
		if ($params['attribute']) {
			if ($enable_log)
				$this->log->write("Очистка таблиц атрибутов:");
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'attribute');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'attribute');
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'attribute_description');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'attribute_description');
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'attribute_to_1c');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'attribute_to_1c');
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'attribute_group');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'attribute_group');
			$this->db->query('TRUNCATE TABLE ' . DB_PREFIX . 'attribute_group_description');
			if ($enable_log)
				$this->log->write('TRUNCATE TABLE ' . DB_PREFIX . 'attribute_group_description');
		}

		// Выставляем кол-во товаров в 0
		if($params['quantity']) {
			$this->db->query('UPDATE ' . DB_PREFIX . 'product ' . 'SET quantity = 0');
		}

	}

	/**
	 * Создает таблицы, нужные для работы
	 */
	public function checkDbSheme() {

		$query = $this->db->query('SHOW TABLES LIKE "' . DB_PREFIX . 'product_to_1c"');

		if(!$query->num_rows) {
			$this->db->query(
				'CREATE TABLE
						`' . DB_PREFIX . 'product_to_1c` (
							`product_id` int(11) NOT NULL,
							`1c_id` varchar(255) NOT NULL,
							KEY (`product_id`),
							KEY `1c_id` (`1c_id`),
							FOREIGN KEY (product_id) REFERENCES '. DB_PREFIX .'product(product_id) ON DELETE CASCADE
						) ENGINE=MyISAM DEFAULT CHARSET=utf8'
			);
		}

		$query = $this->db->query('SHOW TABLES LIKE "' . DB_PREFIX . 'category_to_1c"');

		if(!$query->num_rows) {
			$this->db->query(
				'CREATE TABLE
						`' . DB_PREFIX . 'category_to_1c` (
							`category_id` int(11) NOT NULL,
							`1c_category_id` varchar(255) NOT NULL,
							KEY (`category_id`),
							KEY `1c_id` (`1c_category_id`),
							FOREIGN KEY (category_id) REFERENCES '. DB_PREFIX .'category(category_id) ON DELETE CASCADE
						) ENGINE=MyISAM DEFAULT CHARSET=utf8'
			);
		}

		$query = $this->db->query('SHOW TABLES LIKE "' . DB_PREFIX . 'attribute_to_1c"');

		if(!$query->num_rows) {
			$this->db->query(
				'CREATE TABLE
						`' . DB_PREFIX . 'attribute_to_1c` (
							`attribute_id` int(11) NOT NULL,
							`1c_attribute_id` varchar(255) NOT NULL,
							KEY (`attribute_id`),
							KEY `1c_id` (`1c_attribute_id`),
							FOREIGN KEY (attribute_id) REFERENCES '. DB_PREFIX .'attribute(attribute_id) ON DELETE CASCADE
						) ENGINE=MyISAM DEFAULT CHARSET=utf8'
			);
		}
	}

    /**
     * Get languages dictionary
     *
     * @return array
     */
    public function getLanguages()
    {
        $query = $this->db->query('SELECT `language_id`, `code` FROM `' . DB_PREFIX . 'language`');

        return $query->rows;
    }

    /**
     * Edit product
     *
     * @param int   $product_id
     * @param array $data
     */
    public function editProduct($product_id, array $data)
    {

        $this->db->query("UPDATE " . DB_PREFIX . "product SET model = '"
                         . $this->db->escape($data['model']) . "', sku = '"
                         . $this->db->escape($data['sku']) . "', upc = '"
                         . $this->db->escape($data['upc']) . "', ean = '"
                         . $this->db->escape($data['ean']) . "', jan = '"
                         . $this->db->escape($data['jan']) . "', isbn = '"
                         . $this->db->escape($data['isbn']) . "', mpn = '"
                         . $this->db->escape($data['mpn']) . "', location = '"
                         . $this->db->escape($data['location']) . "', unit = '"
                         . $this->db->escape($data['unit']) . "', quantity = '"
                         . (int) $data['quantity'] . "', minimum = '"
                         . (int) $data['minimum'] . "', subtract = '"
                         . (int) $data['subtract'] . "', stock_status_id = '"
                         . (int) $data['stock_status_id']
                         . "', date_available = '"
                         . $this->db->escape($data['date_available'])
                         . "', manufacturer_id = '"
                         . (int) $data['manufacturer_id'] . "', shipping = '"
                         . (int) $data['shipping'] . "', price = '"
                         . (float) $data['price'] . "', points = '"
                         . (int) $data['points'] . "', weight = '"
                         . (float) $data['weight'] . "', weight_class_id = '"
                         . (int) $data['weight_class_id'] . "', length = '"
                         . (float) $data['length'] . "', width = '"
                         . (float) $data['width'] . "', height = '"
                         . (float) $data['height'] . "', length_class_id = '"
                         . (int) $data['length_class_id'] . "', status = '"
                         . (int) $data['status'] . "', tax_class_id = '"
                         . $this->db->escape($data['tax_class_id'])
                         . "', sort_order = '" . (int) $data['sort_order']
                         . "', date_modified = NOW() WHERE product_id = '"
                         . (int) $product_id . "'");

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '"
                             . $this->db->escape(html_entity_decode($data['image'],
                    ENT_QUOTES, 'UTF-8')) . "' WHERE product_id = '"
                             . (int) $product_id . "'");
        }

        foreach ($data['product_description'] as $language_id => $value) {
            $this->db->query("DELETE FROM " . DB_PREFIX
                             . "product_description WHERE product_id = '"
                             . (int) $product_id . "' AND language_id ='"
                             . (int) $language_id . "'");
            $this->db->query("INSERT INTO " . DB_PREFIX
                             . "product_description SET product_id = '"
                             . (int) $product_id . "', language_id = '"
                             . (int) $language_id . "', name = '"
                             . $this->db->escape($value['name'])
                             . "', meta_keyword = '"
                             . $this->db->escape($value['meta_keyword'])
                             . "', meta_description = '"
                             . $this->db->escape($value['meta_description'])
                             . "', description = '"
                             . $this->db->escape($value['description'])
                             . "', tag = '" . $this->db->escape($value['tag'])
                             . "', seo_title = '"
                             . $this->db->escape($value['seo_title'])
                             . "', seo_h1 = '"
                             . $this->db->escape($value['seo_h1']) . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_to_store WHERE product_id = '"
                         . (int) $product_id . "'");

        if (isset($data['product_store'])) {
            foreach ($data['product_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "product_to_store SET product_id = '"
                                 . (int) $product_id . "', store_id = '"
                                 . (int) $store_id . "'");
            }
        }

        if ( ! empty($data['product_attribute'])) {
            foreach ($data['product_attribute'] as $product_attribute) {
                if ($product_attribute['attribute_id']) {
                    foreach (
                        $product_attribute['product_attribute_description'] as
                        $language_id => $product_attribute_description
                    ) {
                        $this->db->query("DELETE FROM " . DB_PREFIX
                                         . "product_attribute WHERE product_id = '"
                                         . (int) $product_id
                                         . "' AND attribute_id = '"
                                         . (int) $product_attribute['attribute_id']
                                         . "' AND language_id ='"
                                         . (int) $language_id . "'");
                        //$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND language_id ='". (int)$language_id."'");
                        $this->db->query("INSERT INTO " . DB_PREFIX
                                         . "product_attribute SET product_id = '"
                                         . (int) $product_id
                                         . "', attribute_id = '"
                                         . (int) $product_attribute['attribute_id']
                                         . "', language_id = '"
                                         . (int) $language_id . "', text = '"
                                         . $this->db->escape($product_attribute_description['text'])
                                         . "'");
                    }
                }
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_option WHERE product_id = '"
                         . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_option_value WHERE product_id = '"
                         . (int) $product_id . "'");

        if (isset($data['product_option'])) {
            foreach ($data['product_option'] as $product_option) {
                if ($product_option['type'] == 'select'
                    || $product_option['type'] == 'radio'
                    || $product_option['type'] == 'checkbox'
                    || $product_option['type'] == 'image'
                ) {
                    $this->db->query("INSERT INTO " . DB_PREFIX
                                     . "product_option SET product_option_id = '"
                                     . (int) $product_option['product_option_id']
                                     . "', product_id = '" . (int) $product_id
                                     . "', option_id = '"
                                     . (int) $product_option['option_id']
                                     . "', required = '"
                                     . (int) $product_option['required'] . "'");

                    $product_option_id = $this->db->getLastId();

                    if (isset($product_option['product_option_value'])
                        && count($product_option['product_option_value']) > 0
                    ) {
                        foreach (
                            $product_option['product_option_value'] as
                            $product_option_value
                        ) {
                            $this->db->query("INSERT INTO " . DB_PREFIX
                                             . "product_option_value SET product_option_value_id = '"
                                             . (int) $product_option_value['product_option_value_id']
                                             . "', product_option_id = '"
                                             . (int) $product_option_id
                                             . "', product_id = '"
                                             . (int) $product_id
                                             . "', option_id = '"
                                             . (int) $product_option['option_id']
                                             . "', option_value_id = '"
                                             . (int) $product_option_value['option_value_id']
                                             . "', quantity = '"
                                             . (int) $product_option_value['quantity']
                                             . "', subtract = '"
                                             . (int) $product_option_value['subtract']
                                             . "', price = '"
                                             . (float) $product_option_value['price']
                                             . "', price_prefix = '"
                                             . $this->db->escape($product_option_value['price_prefix'])
                                             . "', points = '"
                                             . (int) $product_option_value['points']
                                             . "', points_prefix = '"
                                             . $this->db->escape($product_option_value['points_prefix'])
                                             . "', weight = '"
                                             . (float) $product_option_value['weight']
                                             . "', weight_prefix = '"
                                             . $this->db->escape($product_option_value['weight_prefix'])
                                             . "'");
                        }
                    } else {
                        $this->db->query("DELETE FROM " . DB_PREFIX
                                         . "product_option WHERE product_option_id = '"
                                         . $product_option_id . "'");
                    }
                } else {
                    $this->db->query("INSERT INTO " . DB_PREFIX
                                     . "product_option SET product_option_id = '"
                                     . (int) $product_option['product_option_id']
                                     . "', product_id = '" . (int) $product_id
                                     . "', option_id = '"
                                     . (int) $product_option['option_id']
                                     . "', option_value = '"
                                     . $this->db->escape($product_option['option_value'])
                                     . "', required = '"
                                     . (int) $product_option['required'] . "'");
                }
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_discount WHERE product_id = '"
                         . (int) $product_id . "'");

        if (isset($data['product_discount'])) {
            foreach ($data['product_discount'] as $product_discount) {
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "product_discount SET product_id = '"
                                 . (int) $product_id
                                 . "', customer_group_id = '"
                                 . (int) $product_discount['customer_group_id']
                                 . "', quantity = '"
                                 . (int) $product_discount['quantity']
                                 . "', priority = '"
                                 . (int) $product_discount['priority']
                                 . "', price = '"
                                 . (float) $product_discount['price']
                                 . "', date_start = '"
                                 . $this->db->escape($product_discount['date_start'])
                                 . "', date_end = '"
                                 . $this->db->escape($product_discount['date_end'])
                                 . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_special WHERE product_id = '"
                         . (int) $product_id . "'");

        if (isset($data['product_special'])) {
            foreach ($data['product_special'] as $product_special) {
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "product_special SET product_id = '"
                                 . (int) $product_id
                                 . "', customer_group_id = '"
                                 . (int) $product_special['customer_group_id']
                                 . "', priority = '"
                                 . (int) $product_special['priority']
                                 . "', price = '"
                                 . (float) $product_special['price']
                                 . "', date_start = '"
                                 . $this->db->escape($product_special['date_start'])
                                 . "', date_end = '"
                                 . $this->db->escape($product_special['date_end'])
                                 . "'");
                //$this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "' 12:00:00");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_image WHERE product_id = '"
                         . (int) $product_id . "'");

        if (isset($data['product_image'])) {
            foreach ($data['product_image'] as $product_image) {
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "product_image SET product_id = '"
                                 . (int) $product_id . "', image = '"
                                 . $this->db->escape(html_entity_decode($product_image['image'],
                        ENT_QUOTES, 'UTF-8')) . "', sort_order = '"
                                 . (int) $product_image['sort_order'] . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_to_download WHERE product_id = '"
                         . (int) $product_id . "'");

        if (isset($data['product_download'])) {
            foreach ($data['product_download'] as $download_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "product_to_download SET product_id = '"
                                 . (int) $product_id . "', download_id = '"
                                 . (int) $download_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_to_category WHERE product_id = '"
                         . (int) $product_id . "'");

        if (isset($data['product_category'])) {
            foreach ($data['product_category'] as $category_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "product_to_category SET product_id = '"
                                 . (int) $product_id . "', category_id = '"
                                 . (int) $category_id . "'");
            }
        }

        if (isset($data['main_category_id']) && $data['main_category_id'] > 0) {
            $this->db->query("DELETE FROM " . DB_PREFIX
                             . "product_to_category WHERE product_id = '"
                             . (int) $product_id . "' AND category_id = '"
                             . (int) $data['main_category_id'] . "'");
            $this->db->query("INSERT INTO " . DB_PREFIX
                             . "product_to_category SET product_id = '"
                             . (int) $product_id . "', category_id = '"
                             . (int) $data['main_category_id']
                             . "', main_category = 1");
        } elseif (isset($data['product_category'])) {
            $this->db->query("UPDATE " . DB_PREFIX
                             . "product_to_category SET main_category = 1 WHERE product_id = '"
                             . (int) $product_id . "' AND category_id = '"
                             . (int) $data['product_category'][0] . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_filter WHERE product_id = '"
                         . (int) $product_id . "'");

        if (isset($data['product_filter'])) {
            foreach ($data['product_filter'] as $filter_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "product_filter SET product_id = '"
                                 . (int) $product_id . "', filter_id = '"
                                 . (int) $filter_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_related WHERE product_id = '"
                         . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_related WHERE related_id = '"
                         . (int) $product_id . "'");

        if (isset($data['product_related'])) {
            foreach ($data['product_related'] as $related_id) {
                $this->db->query("DELETE FROM " . DB_PREFIX
                                 . "product_related WHERE product_id = '"
                                 . (int) $product_id . "' AND related_id = '"
                                 . (int) $related_id . "'");
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "product_related SET product_id = '"
                                 . (int) $product_id . "', related_id = '"
                                 . (int) $related_id . "'");
                $this->db->query("DELETE FROM " . DB_PREFIX
                                 . "product_related WHERE product_id = '"
                                 . (int) $related_id . "' AND related_id = '"
                                 . (int) $product_id . "'");
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "product_related SET product_id = '"
                                 . (int) $related_id . "', related_id = '"
                                 . (int) $product_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_reward WHERE product_id = '"
                         . (int) $product_id . "'");

        if (isset($data['product_reward'])) {
            foreach ($data['product_reward'] as $customer_group_id => $value) {
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "product_reward SET product_id = '"
                                 . (int) $product_id
                                 . "', customer_group_id = '"
                                 . (int) $customer_group_id . "', points = '"
                                 . (int) $value['points'] . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "product_to_layout WHERE product_id = '"
                         . (int) $product_id . "'");

        if (isset($data['product_layout'])) {
            foreach ($data['product_layout'] as $store_id => $layout) {
                if ($layout['layout_id']) {
                    $this->db->query("INSERT INTO " . DB_PREFIX
                                     . "product_to_layout SET product_id = '"
                                     . (int) $product_id . "', store_id = '"
                                     . (int) $store_id . "', layout_id = '"
                                     . (int) $layout['layout_id'] . "'");
                }
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "url_alias WHERE query = 'product_id="
                         . (int) $product_id . "'");

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX
                             . "url_alias SET query = 'product_id="
                             . (int) $product_id . "', keyword = '"
                             . $this->db->escape($data['keyword']) . "'");
        }

        $this->cache->delete('product');
    }

    /** Edit product category
     *
     * @param int   $category_id
     * @param array $data
     */
    public function editCategory($category_id, array $data)
    {
        $this->db->query("UPDATE " . DB_PREFIX . "category SET parent_id = '"
                         . (int) $data['parent_id'] . "', `top` = '"
                         . (isset($data['top']) ? (int) $data['top'] : 0)
                         . "', `column` = '" . (int) $data['column']
                         . "', sort_order = '" . (int) $data['sort_order']
                         . "', status = '" . (int) $data['status']
                         . "', date_modified = NOW() WHERE category_id = '"
                         . (int) $category_id . "'");

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "category SET image = '"
                             . $this->db->escape(html_entity_decode($data['image'],
                    ENT_QUOTES, 'UTF-8')) . "' WHERE category_id = '"
                             . (int) $category_id . "'");
        }

        foreach ($data['category_description'] as $language_id => $value) {
            $this->db->query("DELETE FROM " . DB_PREFIX
                             . "category_description WHERE category_id = '"
                             . (int) $category_id . "' AND language_id ='"
                             . (int) $language_id . "'");
            $this->db->query("INSERT INTO " . DB_PREFIX
                             . "category_description SET category_id = '"
                             . (int) $category_id . "', language_id = '"
                             . (int) $language_id . "', name = '"
                             . $this->db->escape($value['name'])
                             . "', meta_keyword = '"
                             . $this->db->escape($value['meta_keyword'])
                             . "', meta_description = '"
                             . $this->db->escape($value['meta_description'])
                             . "', description = '"
                             . $this->db->escape($value['description'])
                             . "', seo_title = '"
                             . $this->db->escape($value['seo_title'])
                             . "', seo_h1 = '"
                             . $this->db->escape($value['seo_h1']) . "'");
        }

        // MySQL Hierarchical Data Closure Table Pattern
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX
                                  . "category_path` WHERE path_id = '"
                                  . (int) $category_id
                                  . "' ORDER BY level ASC");

        if ($query->rows) {
            foreach ($query->rows as $category_path) {
                // Delete the path below the current one
                $this->db->query("DELETE FROM `" . DB_PREFIX
                                 . "category_path` WHERE category_id = '"
                                 . (int) $category_path['category_id']
                                 . "' AND level < '"
                                 . (int) $category_path['level'] . "'");

                $path = array();

                // Get the nodes new parents
                $query = $this->db->query("SELECT * FROM `" . DB_PREFIX
                                          . "category_path` WHERE category_id = '"
                                          . (int) $data['parent_id']
                                          . "' ORDER BY level ASC");

                foreach ($query->rows as $result) {
                    $path[] = $result['path_id'];
                }

                // Get whats left of the nodes current path
                $query = $this->db->query("SELECT * FROM `" . DB_PREFIX
                                          . "category_path` WHERE category_id = '"
                                          . (int) $category_path['category_id']
                                          . "' ORDER BY level ASC");

                foreach ($query->rows as $result) {
                    $path[] = $result['path_id'];
                }

                // Combine the paths with a new level
                $level = 0;

                foreach ($path as $path_id) {
                    $this->db->query("REPLACE INTO `" . DB_PREFIX
                                     . "category_path` SET category_id = '"
                                     . (int) $category_path['category_id']
                                     . "', `path_id` = '" . (int) $path_id
                                     . "', level = '" . (int) $level . "'");

                    $level ++;
                }
            }
        } else {
            // Delete the path below the current one
            $this->db->query("DELETE FROM `" . DB_PREFIX
                             . "category_path` WHERE category_id = '"
                             . (int) $category_id . "'");

            // Fix for records with no paths
            $level = 0;

            $query = $this->db->query("SELECT * FROM `" . DB_PREFIX
                                      . "category_path` WHERE category_id = '"
                                      . (int) $data['parent_id']
                                      . "' ORDER BY level ASC");

            foreach ($query->rows as $result) {
                $this->db->query("INSERT INTO `" . DB_PREFIX
                                 . "category_path` SET category_id = '"
                                 . (int) $category_id . "', `path_id` = '"
                                 . (int) $result['path_id'] . "', level = '"
                                 . (int) $level . "'");

                $level ++;
            }

            $this->db->query("REPLACE INTO `" . DB_PREFIX
                             . "category_path` SET category_id = '"
                             . (int) $category_id . "', `path_id` = '"
                             . (int) $category_id . "', level = '"
                             . (int) $level . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "category_filter WHERE category_id = '"
                         . (int) $category_id . "'");

        if (isset($data['category_filter'])) {
            foreach ($data['category_filter'] as $filter_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "category_filter SET category_id = '"
                                 . (int) $category_id . "', filter_id = '"
                                 . (int) $filter_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "category_to_store WHERE category_id = '"
                         . (int) $category_id . "'");

        if (isset($data['category_store'])) {
            foreach ($data['category_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX
                                 . "category_to_store SET category_id = '"
                                 . (int) $category_id . "', store_id = '"
                                 . (int) $store_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "category_to_layout WHERE category_id = '"
                         . (int) $category_id . "'");

        if (isset($data['category_layout'])) {
            foreach ($data['category_layout'] as $store_id => $layout) {
                if ($layout['layout_id']) {
                    $this->db->query("INSERT INTO " . DB_PREFIX
                                     . "category_to_layout SET category_id = '"
                                     . (int) $category_id . "', store_id = '"
                                     . (int) $store_id . "', layout_id = '"
                                     . (int) $layout['layout_id'] . "'");
                }
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX
                         . "url_alias WHERE query = 'category_id="
                         . (int) $category_id . "'");

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX
                             . "url_alias SET query = 'category_id="
                             . (int) $category_id . "', keyword = '"
                             . $this->db->escape($data['keyword']) . "'");
        }

        $this->cache->delete('category');
    }

    /**
     * Edit product attrubute
     *
     * @param       $attribute_id
     * @param array $data
     */
    public function editAttrib($attribute_id, array $data)
    {
        foreach ($data['attribute_description'] as $language_id => $value) {
            if ( ! isset($value['description'])) {
                $value['description'] = '';
            }
            $this->db->query("DELETE FROM " . DB_PREFIX
                             . "attribute_description WHERE attribute_id = '"
                             . (int) $attribute_id . "' AND language_id ='"
                             . (int) $language_id . "'");
            $this->db->query("INSERT INTO " . DB_PREFIX
                             . "attribute_description SET attribute_id = '"
                             . (int) $attribute_id . "', language_id = '"
                             . (int) $language_id . "', name = '"
                             . $this->db->escape($value['name'])
                             . "', description = '"
                             . $this->db->escape($value['description']) . "'");
        }
    }
}
