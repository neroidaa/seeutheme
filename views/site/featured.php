<?php

	$cs = Yii::app()->getClientScript();

	$cs->registerScript("Frontpage.Featured", <<<EOT

	var activeTab = 0;
	var rotationTime = 5000;
	var classes = ['first left','second left','third left', 'fourth right', 'fifth right', 'sixth right last'];
	$("div#featured").append('<div id="navigation"></div>');
	var menu = $("div#featured > div");

	$("div#featured > dl > dt").each(function(i){
		var dt = $(this);
		var dd = dt.next('dd');
		dd.addClass(classes[i]).attr('id','navdd'+i);
		var a = dt.find('a');
		a.attr('id','nav'+i);
		a.attr('href','#navdd'+i);
		a.attr('index',i);
		a.click(function(){
			activateTabFunction($(this));
			if(periodicFunction != null) clearInterval(periodicFunction);
			return false;
		});
		menu.append(a);
		$("div#featured > dl > dt, div#featured > dl > dd").hide();
	});

	var activateTabFunction = function(sthis){
		$("div#featured > dl > dd").fadeOut();
		activeTab = parseInt(sthis.attr('index'));

		var target = $(sthis.attr('href'));
		var animDiv = target.find('> div').height(target.height()-2).hide();
		target.fadeIn(function(){
			animDiv.slideDown();
		});
		$('div#featured > div#navigation > a').removeClass('active');
		sthis.addClass('active');
	};
	var periodicFunction = setInterval(
		function(){
			activeTab = (activeTab+1) % 6;
			activateTabFunction($('div#featured a#nav'+activeTab));
		}, rotationTime
	);

	activateTabFunction($('div#featured a#nav0'));



EOT
);

?>
<div id="featured">
	<dl>
		<?php
			$criteria = new CDbCriteria;
			$criteria->condition = 'published = 1';
			$criteria->order = '`order` ASC';
			$criteria->limit = 6;
			$features = Feature::model()->localized()->findAll($criteria);
		?>
		<?php foreach($features as $i => $feature): ?>
		<dt><a href="#"><?php echo $feature->name ?></a></dt>
		<dd class="<?php echo $feature->widget?>" style="background: url('/images/featured/<?php echo $feature->background ?>') top left no-repeat;">
			<?php
			if(!empty($feature->widget)) {
				$this->widget("ext.pageviews.{$feature->widget}", array(
					'page_id' => $feature->page_id,
					'limit' => $feature->limit,
				));
			} else {
				echo $feature->content;
			}
			?>
		</dd>
		<?php endforeach; ?>
	</dl>
</div>
<div style="clear:both"></div>