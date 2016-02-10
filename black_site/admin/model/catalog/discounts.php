<?php
class ModelCatalogDiscounts extends Model 
{	
	public function editDiscounts($data) {		
	    $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "discounts");
		
		if (isset($data['discounts'])) {
			foreach ($data['discounts'] as $discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "discounts SET discount_from = '" . (double)$discount['discount_from'] . "', discount_to = '" . (double)$discount['discount_to'] . "', percent = '" . (int)$discount['percent'] . "'");
			}
		}
	}
	
	public function getDiscounts() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "discounts");
		
		return $query->rows;
	}		
}
?>