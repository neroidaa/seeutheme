<?php $this->layout = 'right-column'; ?>

<h1><?php echo $model->name?></h1>
<div class="testimonial-view">
<div class="picture">
<img hspace="4" vspace="4" style="float: left" src="/images/testimonials/<?php echo $model->picture?>" />
</div>
<div class="name">
<em><?php echo $model->profession?></em><br />
</div>
<div class="short_text">
<?php echo $model->short_text?>
</div>
<div class="full_text">
<p><?php echo preg_replace("/[\r\n]+/", "</p><p>", $model->full_text) ?></p>
</div>
</div>