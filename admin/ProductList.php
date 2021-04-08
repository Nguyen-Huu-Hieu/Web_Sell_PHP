<?php
	include 'inc/header.php';
	include 'inc/sidebar.php';
	include '../classes/Product.php';
?>

<?php 
	$product = new product();

	if (isset($_GET['del_product_id'])) {
		$id = $_GET['del_product_id'];
		$delete_product = $product->deleteProduct($id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh Sách Sản Phẩm</h2>
        <div class="block">  
		<?php
			if(isset($delete_product)) {
				echo $delete_product;
			}
		?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên</th>
					<th>Giá</th>
					<!-- <th>Mô tả</th> -->
					<th>Danh mục</th>
					<th>Thương hiệu</th>
					<th>Ảnh</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$show_product = $product->show_product();
					if($show_product) {
						$i = 0;
						while ($result = $show_product->fetch_assoc()) {
							$i++;
							
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $result['price'] ?></td>
					<!-- <td><?php echo $result['product_desc'] ?></td> -->
					<td class="center"><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><img src="upload/<?php echo $result['image'] ?>" width ="80px"></td>
					<td><a href="ProductEdit.php?product_id=<?php echo $result['productId'] ?>">Sửa</a> || <a onclick="return confirm('Bạn có muốn xóa sản phẩm?')" href="?del_product_id=<?php echo $result['productId'] ?>">Xóa</a></td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
