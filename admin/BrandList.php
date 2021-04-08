<!-- hiện danh sách thương hiệu sản phẩm -->

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php' ?>

<?php 
	$brand = new brand();

	if (isset($_GET['del_brand_id'])) {
		$id = $_GET['del_brand_id'];
		$deletebrand = $brand->deleteBrand($id);
	}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh Sách Thương Hiệu</h2>
		<div class="block">
	

			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Id</th>
						<th>Tên Danh Mục</th>
						<th>Hành Động</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$show_brand = $brand->show_brand();
						if ($show_brand) {
							$i = 0;
							while ($result = $show_brand->fetch_assoc()) {
								$i++;
					?>
					<tr class="odd gradeX">
						<td><?php echo $i; ?></td>
						<td><?php echo $result['brandId'] ?></td>
						<td><?php echo $result['brandName'] ?></td>
						<td><a href="BrandEdit.php?brand_id=<?php echo $result['brandId'] ?>">Sửa</a> || <a onclick="return confirm('Bạn có muốn xóa thương hiệu?')" href="?del_brand_id=<?php echo $result['brandId'] ?>">Xóa</a></td>
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

