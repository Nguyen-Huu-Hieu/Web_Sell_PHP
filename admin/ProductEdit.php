<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Brand.php';
    include '../classes/category.php';
    include '../classes/Product.php';

?>
<?php
    $product = new product();
    // dùng cho hiển thị thông tin product lên form
    if (!isset($_GET['product_id']) || $_GET['product_id'] == NULL) {
        echo "<script>window.location = 'ProductList.php'</script>";
    } else {
        $id = $_GET['product_id'];
    }

    // cập nhật 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_name = $_POST['productName'];
        $update_product = $product->updateProduct($_POST, $_FILES, $id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Mới Sản Phẩm</h2>
        <div class="block">
           
        <?php 
            $get_product = $product->getProductById($id);
            if($get_product) {
                while($result_product = $get_product->fetch_assoc()) {

        ?>
         <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result_product['productName'] ?>"  class="medium" />
                    </td>
                </tr>
		 		<tr>
                    <td>
                        <label>Danh Mục</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Chọn danh mục</option>
                            <?php
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if ($catlist) {
                                    while ($result = $catlist->fetch_assoc()) {
                                    
                            ?>
                            <option
                            <?php
                                if($result['catId'] == $result_product['catId']) { echo 'selected';} 
                            ?>
                            value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?>
                            </option>

                            <?php 
                                } }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>Chọn thương hiệu</option>
                            <?php 
                                $brand = new brand();
                                $brand_list = $brand->show_brand();
                                if ($brand_list) {
                                    while ($result = $brand_list->fetch_assoc()) {
                                
                            ?>
                            <option
                            <?php
                                if($result['brandId'] == $result_product['brandId']) { echo 'selected' ;} 
                            ?>
                             value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?>
                             </option>
                           <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea name="product_desc"  class="tinymce"><?php echo $result_product['product_desc'] ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result_product['price'] ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Ảnh</label>
                    </td>
                    <td>
                        <img src="upload/<?php echo $result_product['image'] ?>" width="100px">
                        <input type="file" name="image" />
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Lưu thay đổi" />
                    </td>
                </tr>
            </table>
            </form>

            <?php } } ?>
        </div>
    </div>
</div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


