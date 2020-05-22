<?php
	if($this->page !== null && count($this->page->testimonials)){
		echo '<div class="module right-module">';
		echo '<h4>Testimonials</h4>';
		foreach($this->page->testimonials as $tst){
			$testimonial = Testimonial::model()->localized()->findByPk($tst->id);
			echo '<div class="testimonial"><img width="75" hspace="4" vspace="4" align="left" src="/images/testimonials/'.$testimonial->pictureName.'" />';
			echo '<strong>'.$testimonial->name.'</strong><br />';
			echo '<em>'.$testimonial->profession.'</em><br />';
			echo '<div class="quote"><div>'.$testimonial->short_text.'</div></div>';
			if(!empty($testimonial->full_text))
				echo '<a class="read-more" href="'.Yii::app()->createUrl('/testimonial/view', array('id'=>$testimonial->id)).'">'.Yii::t('layout','Full text').'</a>';
			echo '<div style="clear:both;"></div></div>';
		}
		echo '</div>';
	}
?>

<div class="module right-module">
	<h4><?php echo Yii::t('app','Recommendations')?></h4>
	<fb:recommendations site="seeu.edu.mk" data-action="like" width="220" height="300" header="false" font="trebuchet ms" border_color="#ffffff"></fb:recommendations>
</div>
