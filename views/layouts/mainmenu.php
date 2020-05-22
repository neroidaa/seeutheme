<?php

//Build the menu
/*$data = array();
foreach($root->children()->localized()->findAll() as $i => $child)
{
	$active = $activeMenu != null && $activeMenu->id == $child->id;

	$children = array();
	$subchildren = $child->children()->localized()->findAll();
	if(count($subchildren))
	{
		foreach ($subchildren as $subchild)
		{
			$children[] = array(
				'title' => $subchild->title,
				'url' => Yii::app()->createUrl(':'.$subchild->id),
			);
		}
	}

	$data[] = array(
		'active' => $active,
		'title' => $child->title,
		'url' => Yii::app()->createUrl(':'.$child->id),
		'children' => $children,
	);
}
*/
?>

<?php

Yii::app()->clientScript->registerScript('mobile-menu', <<<EOSCRIPT

	$('nav.mainmenu').prepend('<a id="mobile-menu"><span class="bar"></span><span class="bar"></span><span class="bar"></span></a>');

	/* toggle nav */
	$("#mobile-menu").on("click", function(){
		$("nav.mainmenu .mainmenu-inner").slideToggle();
		$(this).toggleClass("active");
	});

EOSCRIPT
);
?>


<nav class="mainmenu">
	<div class="container mainmenu-inner">
		<ul>
			<?php
			$data = array();
			foreach($root->children()->localized()->findAll() as $i => $child)
			{
				if($i < 8) {
					$active = $activeMenu != null && $activeMenu->id == $child->id;
					echo '<li class="'.($active? 'active' : 'inactive').'">';
					echo '<a href="'.Yii::app()->createUrl(':'.$child->id).'">';
					echo $child->title;
					echo '</a>';
					if(!$active) {
						$subchildren = $child->children()->localized()->findAll();
						if(count($subchildren)) {
							echo '<ul class="submenu">';
							foreach ($subchildren as $subchild) {
								if ($subchild->published) {
									echo '<li>';
									echo '<a href="'.Yii::app()->createUrl(':'.$subchild->id).'">';
									echo $subchild->title;
									echo '</a>';
								}
							}
							echo '</ul>';
						}
					}
					echo '</li>';
				}
			}

			if($activeMenu != null) $activeMenu = Page::model()->localized()->findByPk($activeMenu->id);
		?>
		</ul>
	</div>
</nav>

