<?php
	require_once('db/dbhelper.php');
	require_once('utils/utility.php');
	include_once('layouts/header.php');

	$id = getGet('id');
	$product = executeResult('select * from products where id = '.$id, true);
	// echo $product[0]['title'];
	if($product == null) {
		header('Location: products.php');
		die();
	}
?>
<!-- body -->
<div class="container">
	<div class="row">
		<div class="col-md-5">
			<img style="width: 100%" src="<?=$product[0]['thumbnail']?>">
		</div>
		<div class="col-md-7">
			<h4><?=$product[0]['title']?></h4>
			<p style="font-size: 36px; mau: red"><?=number_format($product[0]['price'], 0, ',', '.')?></p>
			<button class="btn btn-success" style="width: 100%; font-size: 30px;" onclick="addToCart(<?=$id?>)">Add to cart</button>
		</div>
		<div class="col-md-12">
			<?=$product[0]['content']?>
		</div>
	</div>
</div>
<script type="text/javascript">
	function addToCart(id) {
		$.post('api/cookie.php', {
			'action': 'add',
			'id': id,
			'num': 1
		}, function(data) {
			location.reload()
		})
	}
</script>
<?php
	include_once('layouts/footer.php');
?>