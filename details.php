
<?php 
	include 'inc/header.php';
	// include 'inc/slider.php'
	// include 'classes/Product.php';
?>
<?php 
    if (!isset($_GET['product_id']) || $_GET['product_id'] == NULL) {
        echo "<script>window.location = '404.php'</script>";
    } else {
        $id = $_GET['product_id'];
    }

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$quantity = $_POST['quantity'];
		$add_to_cart = $cart->addToCart($quantity, $id);
	}
?>

<div class="main">
    <div class="content">
    	<div class="section group">
			<?php
				$get_product_details = $product->getDetail($id); 
				if($get_product_details) {
					while($result_detail = $get_product_details->fetch_assoc()) {

			?>
				<div class="cont-desc span_1_of_2">
					<div class="grid images_3_of_2">
						<img src="admin/upload/<?php echo $result_detail['image'] ?>" alt="" />
					</div>
					<div class="desc span_3_of_2">
						<h2><?php echo $result_detail['productName'] ?></h2>
						<p><?php echo $result_detail['product_desc'] ?></p>					
						<div class="price">
							<p>Giá: <span><?php echo $result_detail['price'] ?></span></p>
							<p>Danh mục: <span><?php echo $result_detail['catName'] ?></span></p>
							<p>Thương hiệu:<span><?php echo $result_detail['brandName'] ?></span></p>
						</div>
						<div class="add-cart">
							<form action="" method="post">
								<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
								<input type="submit" class="buysubmit" name="submit" value="MUA NGAY"/>
							</form>				
						</div>
					</div>
					<div class="product-desc">
						<h2>Chi tiết sản phẩm</h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
				        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
			    	</div>
						
				</div>
				<?php } } ?>

				<!-- <div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
				      <li><a href="productbycat.php">Mobile Phones</a></li>
			
    				</ul>
 				</div> -->
 		</div>
 	</div>
</div>

 <?php 
	include 'inc/footer.php';
?>