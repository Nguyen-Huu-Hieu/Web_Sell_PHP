<!-- thêm mới thương hiệu sản phẩm -->

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php' ?>

<?php 
    $brand = new brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];

        $insertBrand = $brand->insert_brand($brandName);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Thương Hiệu</h2>

        <div class="block copyblock">
            <?php
                if (isset($insertBrand))
                echo $insertBrand; 
            ?>
            <form action="brandadd.php" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="brandName" placeholder="Nhập tên thương hiệu sản phẩm cần thêm" class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Lưu" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>