<?php
class ControllerProductSearchAjax extends Controller {
	public function index() {
		$products = FALSE;
		
		if (isset ($this->request->get['filter_name']) && $this->request->get['filter_name']) {
			$this->load->model('catalog/search_ajax');
			$this->load->model('tool/image');
			
			$filter_name = utf8_strtolower(trim ($this->request->get['filter_name']));
			
			$setting = $this->config->get('search_ajax_setting');
			
			$search_array = array (
				'name'  => 'pd.name',
				'model' => 'p.model',
				'sku'   => 'p.sku'
			);
			
			$key = 'name';
			$search = 'pd.name';
			
			if (isset ($this->request->get['key']) && isset ($search_array[$this->request->get['key']])) {
				$key = $this->request->get['key'];
				$search = $search_array[$key];
			}
			
			$page = (isset ($this->request->get['page'])) ? (int) $this->request->get['page'] : 1;
			
			$page = ($page < 1) ? 1 : $page;
			
			$data = array (
				'filter_name' => $filter_name,
				'page'        => ($page - 1) * (int) $setting['limit'],
				'limit'       => (int) $setting['limit'],
				'search'      => $search
			);
			
			$product_total = $this->model_catalog_search_ajax->getTotalProducts($data);
			
			$results = $this->model_catalog_search_ajax->getProducts($data);
			
			//$products .= '<div class="search_ajax_total">' . $setting['label_search'] . $product_total . '</div>';
			
			$prevPage = $page - 1;
			$nextPage = $page + 1;
			$totalPages = ceil ($product_total / (int) $setting['limit']);
			
			if ($product_total > (int) $setting['limit']) {
				$products .= '<table class="search_ajax_pagination">';
				$products .= ' <tr>';
				
				$products .=  ($prevPage > 0) ? '  <td class="prevPage">' . $prevPage . '</td>' : '  <td></td>';
				
				$products .= '  <td class="curPage" >' . $page . '</td>';
				
				$products .= ($page < $totalPages) ? '  <td class="nextPage">' . $nextPage . '</td>' : '  <td></td>';
				
				$products .= ' </tr>';
				$products .= '</table>';
			}
			
			$products .= '<table class="search_ajax_products">';
			
			foreach ($results as $result) {
				$price = $special = $rating = $image = $description = FALSE;
				
				$href = $this->url->link('product/product', '&product_id=' . $result['product_id']);
				
				// Image
				if ($setting['status_image']) {
					
					if ($result['image']) {
						$image = '<a target="' . $setting['link_target'] . '" href="' . $href . '"><img src="' . $this->model_tool_image->resize($result['image'], (int) $setting['image_width'], (int) $setting['image_height']) . '" /></a>';
					} else {
						$image = '<a target="' . $setting['link_target'] . '" href="' . $href . '"><img src="' . $this->model_tool_image->resize('no_image.jpg', (int) $setting['image_width'], (int) $setting['image_height']) . '" /></a>';
					}
				}
				// Price
				if ($setting['status_price']) {
					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = '<span class="price">' . $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax'))) . '</span>';
					}
				}
				// Special price
				if ($setting['status_special'] && (float) $result['special']) {
					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$special = '&nbsp;<span class="special">' . $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax'))) . '</span>';
					}
				}
				// Rating
				$rating = ($setting['status_rating']) ? '<img src="catalog/view/theme/default/image/stars-'.(int) $result['rating'] . '.png" /><br />' : FALSE;
				// Description
				if ($setting['status_description']) {
					if ($result['description']) {
						$description = utf8_substr(strip_tags (html_entity_decode ($result['description'], ENT_QUOTES, 'UTF-8')), 0, (int) $setting['status_description']) . '..';
					}
				}
				// Replace
				$result[$key] = str_ireplace ($filter_name, '<b>' . $filter_name . '</b>', utf8_strtolower($result[$key]));
				
				$products .= '<tr><td class="separator" width="50">' . $image . '</td>';
				$products .= '<td class="separator">' . $rating . '<a class="dscr" target="' . $setting['link_target'] . '" href="' . $href . '">' . $result['name'] . '<br />';
				//$products .= $result['model'] ? $result['model'] . '<br />' : FALSE;
				//$products .= $result['sku'  ] ? $result['sku'  ] . '<br />' : FALSE;
				$products .= $price . $special;
				$products .= '</a></td></tr>';
				
				$products .=  ($setting['status_description']) ? '<tr><td colspan="2">' . $description . '</td></tr>' : FALSE;
			}
			
			$products .= '</table>';

//--------ADD		

    	$this->language->load('product/search');

//--------ADD		
			
			
            $products .= '<a href="javascript:;" class="all_search">' . $this->language->get('text_searchaj_rez') . ' &rarr;</a>';
		}
		
		$this->response->setOutput(json_encode (array ('products' => $products)), $this->config->get('config_compression'));
	}
}
?>