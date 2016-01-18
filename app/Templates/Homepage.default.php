<?php if(!$appId || !$searchOnlyApiKey) { ?>
	Please, specify you Algolia crentials in app/config.inc.php file.
<?php return; } ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>App Store | Algolia Test</title>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/3.3.5/css/bootstrap.min.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
	<link href="//fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/instantsearch.js/1/instantsearch.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css" />

	<!--[if lte IE 9]>
	<script src="//cdn.polyfill.io/v2/polyfill.min.js"></script>
	<![endif]-->
</head>
<body>
	<header class="row">
		<div>
			<a href="./" class="logo">
				App Store
				<i class="fa fa-cart-arrow-down"></i>
			</a>
		</div>

		<div class="searchbox-container">
			<div class="input-group">
				<input type="text" class="form-control" id="q" />
				<span class="input-group-btn">
					<button class="btn btn-default"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</div>

	</header>

	<section class="">
		<aside>
			<h5>
				<i class="fa fa-chevron-right"></i> Search through
			</h5>
			<div id="best-apps"></div>

			<h5>
				<i class="fa fa-chevron-right"></i> Categories
			</h5>
			<div id="categories"></div>
		</aside>
		<article>
			<div class="clearfix">
				<div class="sort-by pull-left">Sort by: <span id="sort-by-container"></span></div>
				<div id="stats" class="text-right text-muted pull-right"></div>
			</div>

			<hr />

			<div id="hits"></div>

			<div id="pagination" class="text-center"></div>
		</article>
	</section>

	<script type="text/javascript">
		var appId = "<?php echo $appId; ?>",
			apiKey = "<?php echo $searchOnlyApiKey; ?>";
	</script>

	<script src="//cdn.jsdelivr.net/instantsearch.js/1/instantsearch.min.js"></script>
	<script src="js/search.js"></script>
</body>
</html>