<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
$brand = new brand();
if (isset($_GET['branddel'])) {
    $brand_id = $_GET['branddel'];
    $branddel = $brand->deleteBrandById($brand_id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Brand List</h2>
		<div class="block">
                <?php
                if (isset($branddel)) {
                    echo $branddel;
                }

                ?>
                    <table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Brand Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$getBrand = $brand->getAllBrands();
					if ($getBrand) {
        $i = 0;

        while ($result = $getBrand->fetch_assoc()) {
            $i ++;
            ?>
						<tr class="odd gradeX">
						<td><?php echo $i;?></td>
						<td><?php echo $result['brand_name'];?></td>
						<td><a
							href="brandedit.php?brand_id =<?php echo $result['brand_id']?>">Edit</a>
							|| <a onclick="return confirm('Are you sure to delete')"
							href="?branddel=<?php echo $result['brand_id']?>">Delete</a></td>
					</tr>
					<?php }}?>
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

