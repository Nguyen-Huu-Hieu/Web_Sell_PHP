<?php 
	include 'inc/header.php';
	include 'inc/slider.php'
?>

<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    			<h3>Điện Thoại Nổi Bật</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
			<?php 
				$getproduct = $product->get_product();
				if($getproduct) {
					while($result = $getproduct->fetch_assoc()) {

			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?product_id=<?php echo $result['productId'] ?>"><img src="admin/upload/<?php echo $result['image'] ?>" alt="" /></a>
					<h2><?php echo $result['productName'] ?></h2>
					<p><?php echo $fm->textShorten($result['product_desc'], 30) ?></p>
					<p><span class="price"><?php echo $result['price'] . " đ" ?></span></p>
				    <div class="button"><span><a href="details.php?product_id=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
		</div>

		<div class="content_bottom">
			<div class="heading">
				<h3>Máy Tính Nổi Bật</h3>
			</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
			<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php"><img src="images/new-pic1.jpg" alt="" /></a>
				<h2>Lorem Ipsum is simply </h2>
				<p><span class="price">$403.66</span></p>
				<div class="button"><span><a href="details.php" class="details">Details</a></span></div>
			</div>
		</div>
    </div>
</div>

<?php 
	include 'inc/footer.php';
?>