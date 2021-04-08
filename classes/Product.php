<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php 
	
	class product
	{
	    private $db;
	    private $fm;
	    public function __construct()
	    {
	        $this->db = new Database();
	        $this->fm = new Format();
	    }

	    public function insertProduct($data, $files) {
	    	$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
	    	$category = mysqli_real_escape_string($this->db->link, $data['category']);
	    	$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
	    	$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
	    	$price = mysqli_real_escape_string($this->db->link, $data['price']);
	    	// $image = mysqli_real_escape_string($this->db->link, $data['image']);

	    	$permited = array('jpg', 'jpeg', 'png', 'gif');
	    	$file_name = $_FILES['image']['name'];
	    	$file_size = $_FILES['image']['size'];
	    	$file_temp = $_FILES['image']['tmp_name'];

	    	$div = explode('.', $file_name);  //string -> array
	    	$file_ext = strtolower(end($div));
	    	$unique_image = substr(md5(time()), 0, 10). '.'.$file_ext;
	    	$uploaded_image = "upload/" .$unique_image;

	    	if ($productName == "" || $category == "" || $brand == "" || $product_desc == "" ||$price == "" || $file_name == "") {
	    		$alert = "<span class='error'>Không được để trống</span>";
	    		
	    	} else {
	    		move_uploaded_file($file_temp, $uploaded_image);
	    		$query = "INSERT INTO tbl_product(productName, brandId, catId, product_desc, price, image) VALUES ('$productName', '$brand', '$category', '$product_desc', '$price', '$unique_image') ";
	    		$result = $this->db->insert($query);
	    		if($result) {
	    			$alert = "<span class='success'>Thêm sản phẩm thành công</span>";
	    			return $alert;
	    		} else {
	    			$alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
	    			return $alert;
	    		}
	    	}

	    }

	    public function show_product() {
	    	$query = "SELECT product.*, category.catName, brand.brandName
			FROM tbl_product as product, tbl_category as category, tbl_brand as brand 
			WHERE product.catId = category.catId and product.brandId = brand.brandId
			 ORDER BY product.productId DESC";
	    	$result = $this->db->select($query);
	    	return $result;
		}
		
		public function get_product() {
			$query = "SELECT * FROM tbl_product";
			$result = $this->db->select($query);
			return $result;
		}

		public function getProductById($id) {
			$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		// public function updateProduct($data, $files, $id) {
		// 	$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
	    // 	$category = mysqli_real_escape_string($this->db->link, $data['category']);
	    // 	$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
	    // 	$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
	    // 	$price = mysqli_real_escape_string($this->db->link, $data['price']);

	    // 	$permited = array('jpg', 'jpeg', 'png', 'gif');
	    // 	$file_name = $_FILES['image']['name'];
	    // 	$file_size = $_FILES['image']['size'];
	    // 	$file_temp = $_FILES['image']['tmp_name'];

	    // 	$div = explode('.', $file_name);  //string -> array, phân tách bởi dấu .
		// 	$file_ext = strtolower(end($div)); // lấy cụm định dạng file jpg, png ...
		// 	// $file_current = strtolower(current($div));
	    // 	$unique_image = substr(md5(time()), 0, 10). '.'.$file_ext;
	    // 	$uploaded_image = "upload/" .$unique_image;

	    // 	if ($productName == "" || $category == "" || $brand == "" || $product_desc == "" ||$price == "") {
	    // 		$alert = "<span class='error'>Không được để trống</span>";
	    // 		return $alert;
	    // 	} else {
		// 		if(!empty($file_name)) {
		// 			//neu nguoi dung cho anh
		// 			if($file_size > 2048) {
		// 				echo "<span class='error'>Ảnh phải nhỏ hơn 2M</span>";
		// 				$alert = "<span class='success'>Sửa sản phẩm thành công</span>";
		// 				return $alert;
		// 			}
		// 		}



	    // 		move_uploaded_file($file_temp, $uploaded_image);
	    // 		$query = "INSERT INTO tbl_product(productName, brandId, catId, product_desc, price, image) VALUES ('$productName', '$brand', '$category', '$product_desc', '$price', '$unique_image') ";
	    // 		$result = $this->db->insert($query);
	    // 		if($result) {
	    // 			$alert = "<span class='success'>Thêm sản phẩm thành công</span>";
	    // 			return $alert;
	    // 		} else {
	    // 			$alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
	    // 			return $alert;
	    // 		}
	    // 	}
		// }

		public function deleteProduct($id) {
			$query = "DELETE FROM tbl_product WHERE productId = '$id'";
			$result = $this->db->delete($query);
			if ($result) {
	    		$alert = "<span class='success'>Xóa sản phẩm thành công</span>";
	    		return $alert;
	    	} else {
	    		$alert = "<span class='error'>Xóa sản phẩm không thành công</span>";
	    		return $alert;
	    	}
		}

		 public function getDetail($id) {
		 	$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
		 	FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
			 INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'";
	     	$result = $this->db->select($query);
	     	return $result;
		 }
	}
?>

