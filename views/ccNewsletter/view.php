<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<?php if(!isset($email)): ?>
    <title><?php echo $this->title ?></title>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-22870914-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
	<?php endif; ?>
</head>

<body style="background-color: #fff;">

<?php $this->renderPartial('//admin/newsletter/preview',array(
	'model'=>$model,
	'email'=>isset($email),
));?>

</body></html>