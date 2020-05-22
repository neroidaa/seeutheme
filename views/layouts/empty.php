<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <title><?php echo $this->title ?></title>
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl?>/css/reset.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl?>/css/text.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl?>/css/960.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl?>/css/main.css" />
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
</head>
<body>
	<?php echo $content ?>
</body>
</html>