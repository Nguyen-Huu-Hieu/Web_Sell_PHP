<!-- sửa danh mục sản phẩm -->

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php' ?>

<?php
    $brand = new brand();
    if (!isset($_GET['brand_id']) || $_GET['brand_id'] == NULL) {
        echo "<script>window.location = 'BrandList.php'</script>";
    } else {
        $id = $_GET['brand_id'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        $updateBrand = $brand->update_brand($brandName, $id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa Thương Hiệu</h2>

        <div class="block copyblock">
        	<!-- thông báo -->
            <?php
                if (isset($updateBrand)) {
                    echo $updateBrand;
                } 
            ?>
     
            <!-- hiện sản phẩm ở trang sửa -->
            <?php
                 $get_brand_name = $brand->getbrandbyId($id);
                //  if ($get_brand_name) {
                //     while ($result = $get_brand_name->fetch_assoc()) {
                foreach($get_brand_name as $result) {
            ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $result['brandName'] ?>" name="brandName" placeholder="Nhập tên danh mục sản phẩm cần sửa" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Lưu" />
                        </td>
                    </tr>
                </table>
            </form>
    
            <?php } ?>

        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>