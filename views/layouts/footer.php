
		<div id="footer-top">
		<div id="footer-actions">
			<ul>
				<li class="info"><a href="/<?php echo Yii::app()->language; ?>/future-students/student-info"><span class="circle"></span><span class="text"><?php echo Yii::t('app', 'Request info'); ?></span></a></li>
				<li class="visit"><a href="/<?php echo Yii::app()->language; ?>/about/location"><span class="circle"></span><span class="text"><?php echo Yii::t('app', 'Visit'); ?></span></a></li>
				<li class="apply"><a href="/<?php echo Yii::app()->language; ?>/future-students/application"><span class="circle"></span><span class="text"><?php echo Yii::t('app', 'Apply'); ?></span></a></li>
				<li class="contact"><a href="/<?php echo Yii::app()->language; ?>/contact/"><span class="circle"></span><span class="text"><?php echo Yii::t('app', 'Contact Us'); ?></span></a></li>
			</ul>
		</div>
	</div>


<footer>
	<div class="container">
		<div class="row">
			<div style="min-height: 50px; float: right;">
				<!-- AddThis Follow BEGIN -->
				<div class="addthis_toolbox addthis_32x32_style addthis_default_style" style="float: left;">
					<a class="addthis_button_facebook_follow" addthis:userid="SEEUniversity"></a>
					<a class="addthis_button_instagram_follow" addthis:userid="southeasteuropeanuniversity"></a>
					<a class="addthis_button_twitter_follow" addthis:userid="SEEUniversity"></a>
					<a class="addthis_button_linkedin_follow" addthis:userid="see-university" addthis:usertype="company"></a>
					<a class="addthis_button_youtube_follow" addthis:userid="SeeuWeb"></a>
					<a class="addthis_button_google_follow" addthis:userid="113145618836451883455"></a>
				</div>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-512d436577c2a560"></script>
				<!-- AddThis Follow END -->
			</div>
		</div>
		<div class="separator row">
			<div class="copyright">
				© 2001-<?php echo date('Y')?> <?php echo Yii::t('app','South East European University')?>.<br>
				<?//=Yii::t('app','All rights reserved.')?>
			</div>
			<address class="address">
				<strong><?php echo Yii::t('app','Tetovo')?></strong><br>
				<?php echo Yii::t('app','Ilindenska n.335')?><br>
				1200 <?php echo Yii::t('app','Tetovo')?><br>
				<?php echo Yii::t('app','Tel')?>: +389 44 356 000<br>
				<?php echo Yii::t('app','Fax')?>: +389 44 356 001<br>
			</address>
			<address class="address">
				<strong><?php echo Yii::t('app','Skopje')?></strong><br>
				<?php echo Yii::t('app','Arhiepiskop Angelarij, nr.1')?><br>
				1000 <?php echo Yii::t('app','Skopje')?><br>
				<?php echo Yii::t('app','Tel')?>: +389 44 356 396<br>
				<?php echo Yii::t('app','Tel')?>: +389 44 356 397<br>
			</address>
			<address class="address">
				<a href="<?php echo Yii::app()->createUrl('/sitemap')?>"><?php echo Yii::t('navigation','Sitemap')?></a><br>
				<a href="<?php echo Yii::app()->createUrl('/contact').'?id=55'?>"><?php echo Yii::t('navigation','Feedback')?></a><br>
				<a href="<?php echo Yii::app()->createUrl('/contact')?>"><?php echo Yii::t('navigation','Contact')?></a><br>
				<?php echo Yii::t('app', 'Email')?>: <a href="mailto:web@seeu.edu.mk" target="_blank">web@seeu.edu.mk</a><br>
			</address>
		</div>
	</div>
</footer>
