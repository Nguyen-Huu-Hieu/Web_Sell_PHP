<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php 

	class cart
	{
	    private $db;
	    private $fm;
	    public function __construct()
	    {
	        $this->db = new Database();
	        $this->fm = new Format();
	    }

		public function addToCart($quantity, $id) {
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$id = mysqli_real_escape_string($this->db->link, $id);
			$sessionId = session_id();

			$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
			$result = $this->db->select($query)->fetch_assoc();
			
			// $query_insert = "INSERT INTO tbl_cart(productId, quantity, sessionId, image, price, productName) VALUES ('$id', '$quantity', '$sessionId', '$result['image']', '$result['price']', '$result['productName']') ";
				// $insert_cart = $this->db->insert($query_insert);
				
	    	
		}
	    
	}
?>

