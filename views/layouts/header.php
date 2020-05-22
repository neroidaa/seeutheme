<header><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
	<?php if(!Yii::app()->user->isGuest): ?>
		<div class="userinfo">
			<div class="container">
				<div class="center" style="text-align: right">
					<?php echo Yii::t('navigation','Logged in as') ?>
					<strong><?php echo Yii::app()->user->name?></strong>.
					Go to
					<a href="<?php echo Yii::app()->createUrl('/admin')?>"><?php echo Yii::t('navigation','your account')?></a>
					or
					<a href="<?php echo Yii::app()->createUrl('/site/logout')?>"><?php echo Yii::t('navigation','logout')?></a>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="shortcuts">
		<div class="container">
			<?php if(Yii::app()->user->isGuest): ?>
			<div class="slide" id="slide-login">
				<div class="row-fluid">
					<div class="offset3 span6">
						<h3><?php echo Yii::t('navigation','Login')?></h3>
						<p><?php echo Yii::t('navigation','University staff members should use their webmail account to login')?>.</p>
						<a class="btn btn-success goog-login" href="<?php echo Yii::app()->createUrl('/login')?>"><?php echo Yii::t('navigation','Click here to login')?></a>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<div class="slide" id="slide-services">
				<div class="center container-fluid">
					<h3><?php echo Yii::t('navigation','Online services')?></h3>
					<div class="row-fluid">
						<div class="service span3">
							<a class="btn btn-success" href="https://my.seeu.edu.mk">mySEEU<br><span>https://my.seeu.edu.mk</span></a>
						</div>
						<div class="service span3">
							<a class="btn btn-success" href="http://webmail.seeu.edu.mk">Webmail<br><span>https://webmail.seeu.edu.mk</span></a>
						</div>
						<div class="service span3">
							<a class="btn btn-success" href="https://classroom.google.com/u/0/">Classroom<br><span>https://classroom.google.com</span></a>
						</div>
						<div class="service span3">
							<a class="btn btn-success" href="https://library.seeu.edu.mk">Library<br><span>https://library.seeu.edu.mk/</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="container">
		<div class="row-fluid top">
			<div class="span8">
				<div class="leftlang">
				<div class="languages">
						<ul>
							<?php
								$ca = $this->id.'/'.$this->action->id;
								if($ca == 'site/index') $url = '';
								else $url = isset($_GET['nav']) ? ':'.$_GET['nav'] : $ca;
								$getParams = $_GET;
								unset($getParams['nav']);
							?>
							<?php foreach(Yii::app()->params['languages'] as $lang => $name): ?>
								<?php $getParams['lang'] = $lang; ?>
								<?php if($lang == Yii::app()->language): ?>
									<li class="active"><span lang="<?php echo $lang?>"><?php echo $name?></span></li>
								<?php else: ?>
									<li class="inactive"><a lang="<?php echo $lang?>" href="<?php echo Yii::app()->createUrl($url, $getParams)?>"><?php echo $name?></a></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="left logo">
					<a href="<?php echo Yii::app()->createUrl('')?>" title="<?php echo Yii::t('app','South East European University')?>">
						<img src="<?php echo Yii::app()->theme->baseUrl?>/img/logo.png" alt="SEEU Logo">
					</a>
				</div>
				<div class="left">
					<div class="name"><?php echo Yii::t('app','South East European University')?></div>
					<div class="moto"><?php echo Yii::t('app','bringing knowledge to life!')?></div>
				</div>
			</div>
			<div class="span4 hidden-phone">
				<div class="right">
					<ul class="font-resize">
						<li><a id="font-decrease" href="#" onclick="fontSmaller();">a<sup>-</sup></a></li>
						<li><a id="font-increase" href="#" onclick="fontBigger();">A<sup>+</sup></a></li>
					</ul>
					<ul class="top-links">
					<li class="slide campus"><a href="http://www.seeu.edu.mk/Seeu_Virtual/Seeu_Virtual-Tour_Tetova/index.html" target="_blank" style="
    background-color: #002042;
    font-weight: bold;
"><img src="<?php echo Yii::app()->theme->baseUrl?>/images/icons/explore.png" width="18px"/> Explore Campus 360°</a></li>
						<?php if(Yii::app()->user->isGuest): ?>
							<li class="slide login"><a href="#slide-login"><?php echo Yii::t('navigation','Login')?></a></li>
						<?php endif; ?>
						<li class="slide services"><a href="#slide-services"><?php echo Yii::t('navigation','Online services')?></a></li>
					</ul>
				</div>
				<div class="search right">
					<form method="GET" action="<?php echo Yii::app()->createUrl('/search/index')?>" id="search-form">
						<a href="#" title="Click to search" class="search-button"><i class="icon-search icon-white"></i></a>
						<div class="search-slide">
							<input type="text" name="query" value="" placeholder="<?php echo Yii::t('app','Enter search terms')?>"><br>
							<input type="hidden" name="category" value="all">
							<ul class="search-categories" style="display: none;">
								<li><span><?php echo Yii::t('app','Search:')?></a></li>
								<li class="active"><a href="#" data-category="all"><?php echo Yii::t('app','All')?></a></li>
								<li><a href="#" data-category="people"><?php echo Yii::t('app','People')?></a></li>
								<li><a href="#" data-category="news"><?php echo Yii::t('app','News')?></a></li>
							</ul>
						</div>
					</form>
				</div>
			</div>
				<?php
if ($this->id == 'site' && $this->action->id == 'index'):
?>
			<?php echo Yii::app()->settings->get('frontpage','promotions_'.Yii::app()->language); ?>
<?php endif; ?>

		</div>
	</div>
</header>