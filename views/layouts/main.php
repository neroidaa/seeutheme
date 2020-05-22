<?php
$bg = array(
    '1.jpg',
    '2.jpg',
    '3.jpg',
    '4.jpg',
    '5.jpg'
); // array of filenames

$i          = rand(0, count($bg) - 1); // generate random number size of the array
$selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
?>

<!DOCTYPE html>
<html lang="<?php
echo Yii::app()->language;
?>">
<?php
$prefixes = '';
if (isset($this->openData['prefixes']) && count($this->openData['prefixes'])) {
    $pfxs = array();
    foreach ($this->openData['prefixes'] as $key => $val) {
        $pfxs[] = $key . ':';
        $pfxs[] = $val . '#';
    }
    $pfxs = implode(' ', $pfxs);
    if (!empty($pfxs))
        $prefixes = ' prefixes="' . $pfxs . '"';
}
?>
<head<?php
echo $prefixes;
?>>
	<?php
header('Content-type: text/html; charset=utf-8');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title><?php
echo $this->title;
?></title>

	<?php
Yii::app()->bootstrap->register();
?>
	<link rel="stylesheet" type="text/css" href="<?php
echo Yii::app()->theme->baseUrl;
?>/css/style.css">

	<meta name="description" content="<?php
echo $this->description;
?>" />

	<!--script type="text/javascript" src="js/jquery-1.9.1.min.js"></script-->
	<script src="<?php
echo Yii::app()->theme->baseUrl;
?>/js/scripts.js"></script>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <?php
foreach ($this->openData['properties'] as $prefix => $properties):
?>
    	<?php
    foreach ($properties as $property => $cont):
?>
			<meta property="<?php
        echo $prefix;
?>:<?php
        echo $property;
?>" content="<?php
        echo $cont;
?>">
    	<?php
    endforeach;
?>
	<?php
endforeach;
?>

	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-22870914-1']);
	  _gaq.push(['_setDomainName', 'seeu.edu.mk']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
	<style type="text/css">
		<!--
		.main{
		background: url(<?php
echo Yii::app()->theme->baseUrl;
?>/backgroundimg/<?php
echo $selectedBg;
?>) no-repeat;
		background-color: #F4F4F4;
		}
		-->
		</style>
	
<!-- Chatra {literal} -->
<script>
    (function(d, w, c) {
        w.ChatraID = 'sBLS3yp6ezFY4y4rq';
        var s = d.createElement('script');
        w[c] = w[c] || function() {
            (w[c].q = w[c].q || []).push(arguments);
        };
        s.async = true;
        s.src = (d.location.protocol === 'https:' ? 'https:': 'http:')
        + '//call.chatra.io/chatra.js';
        if (d.head) d.head.appendChild(s);
    })(document, window, 'Chatra');
</script>
<!-- /Chatra {/literal} -->
</head>
<body>

	<?php
$this->renderPartial('//layouts/header');
?>

	<?php
$root       = Page::model()->findByPk(1);
$activeMenu = $this->page;
if ($activeMenu != null) {
    if ($activeMenu->level < 2)
        $activeMenu = null;
    else
        while ($activeMenu != null && $activeMenu->level > 2)
            $activeMenu = $activeMenu->parent();
}

$this->renderPartial('//layouts/mainmenu', array(
    'root' => $root,
    'activeMenu' => $activeMenu
));
?>
	<?php
if ($this->id == 'site' && $this->action->id == 'index'):
?>
		<?php
    $criteria            = new CDbCriteria;
    $criteria->condition = 'state = 1';
    $criteria->limit     = 5;
    $criteria->order     = 'rand()';
    $featured            = Featured::model()->localized()->findAll($criteria);
?>
		<div class="row-fluid" style="background: #f8f8f8;">
		
			<div class="features">

				<a class="feature-nav prev" title="Previous feature" href="#left"><span></span></a>
				<a class="feature-nav next" title="Next feature" href="#right"><span></span></a>
				<div class="dots bottom-over">
					<?php
    for ($i = count($featured); $i > 0; $i--):
?>
						<a href="#"></a>
					<?php
    endfor;
?>
				</div>
				<div class="slides">

					<?php
    foreach ($featured as $i => $feature):
?>

<?php
        if ($feature->url != '') {
?>
<a class="click" href="<?= $feature->url; ?>" title="<?= $feature->url; ?>">
<?php
        }
?>
	<div class="slide" style="background-image: url('<?php echo Yii::app()->baseUrl;?>/images/featured/<?php echo $feature->picture; ?>')">
 
 						<!--img alt="Slide" src="<?php
        echo Yii::app()->baseUrl;
?>/images/featured/<?php
        echo $feature->picture;
?>"-->
						<?php
        if ($feature->title != '') { ?>
 						<a class="click" href="<?php
            echo Yii::app()->createUrl('/featured/view', array(
                'id' => $feature->id  )); ?>">
 							<h3><?php echo $feature->title; ?></h3>
 							<?php
 							if (!empty($feature->subtitle)): 
 								?>
	 							<p><?php echo $feature->subtitle; ?></p>
 							<?php endif; ?>
 						</a> <?php  } ?>
					</div><?php if ($feature->url != '') { ?> </a> 
				<?php  
					} 
				?>
		
				<?php
		    		endforeach;
				?>

				</div>

			</div>

			<!-- ADD QUICK LINKS FOR EASY ACCESS FROM STUDENTS -->
			<div class="container">
			
				<div class="row-fluid" id="blockhome">
						<div class="span4 block1-image">
							<div class="block1">
							<a href="<?php echo Yii::app()->language; ?>/future-students/academics">
								<h2>
								<?php echo Yii::t('app', 'Study Programmes'); ?>
								</h2>
							</a>
								<ul class="unstyled">
									<li>
										<i class="icon-ok icon-white"></i> 
										<a href="<?php echo Yii::app()->language; ?>/future-students/academics/undergraduate"><?php echo Yii::t('app', 'UNDERGRADUATE STUDIES'); ?></a>
									</li>
									<li>
										<i class="icon-ok icon-white"></i> 
										<a href="<?php echo Yii::app()->language; ?>/future-students/academics/postgraduate"><?php echo Yii::t('app', 'MASTER STUDIES'); ?></a>
									</li>
									<li>
										<i class="icon-ok icon-white"></i> 
										<a href="<?php echo Yii::app()->language; ?>/future-students/academics/phd"><?php echo Yii::t('app', 'DOCTORAL STUDIES'); ?></a>
									</li>
								</ul>
							</div>
						</div>

						<div class="span4 block2-image">
							<div class="block2">
							<a href="<?php echo Yii::app()->language; ?>/future-students/financial-aid">
								<h2><?php echo Yii::t('app', 'Scholarships'); ?></h2>
								</a>
								<ul class="unstyled">
									<li>
									<i class="icon-ok icon-white"></i> 
										<a href="<?php echo Yii::app()->language; ?>/future-students/financial-aid#scholar"><?php echo Yii::t('app', 'Merit - based Scholarship'); ?></a>
									</li>
									<li>
									<i class="icon-ok icon-white"></i> 
										<a href="<?php echo Yii::app()->language; ?>/future-students/financial-aid#work"><?php echo Yii::t('app', '"Work and Study" programme'); ?></a>
									</li>
									<li>
									<i class="icon-ok icon-white"></i> 
										<a href="<?php echo Yii::app()->language; ?>/future-students/financial-aid#finance"><?php echo Yii::t('app', 'Discount for siblings'); ?></a>
									</li>
								</ul>
							</div>
						</div>

						<div class="span4 block3-image">
							<div class="block3">
								<a href="<?php echo Yii::app()->language; ?>/future-students/application"><h2><?php echo Yii::t('app', 'Apply'); ?></h2></a>
								<ul class="unstyled">
									<li>
										<i class="icon-ok icon-white"></i> 
										<a href="<?php echo Yii::app()->language; ?>/future-students/application"><?php echo Yii::t('app', 'Online Application'); ?></a>
									</li>
									<li>
										<i class="icon-ok icon-white"></i> 
										<a href="<?php echo Yii::app()->language; ?>/future-students/application"><?php echo Yii::t('app', 'Documentation for submission'); ?></a>
									</li>
									<li>
										<i class="icon-ok icon-white"></i> 
										<a href="<?php echo Yii::app()->language; ?>/future-students/application" ><?php echo Yii::t('app', 'Admission Timeline'); ?></a>
									</li>
									
								</ul>
							</div>
						</div>
					
					</div>
				</div>
			</div>

		</div>


		<?php
    
    
    $countShort = Yii::app()->settings->get('frontpage', 'countShortNews', 2);
    $countLinks = Yii::app()->settings->get('frontpage', 'countLinkNews', 5);
    
    $criteria            = new CDbCriteria;
    $criteria->condition = 'category_id = 1 AND published=1';
    $criteria->order     = 'date DESC';
    $criteria->limit     = 1 + $countShort + $countLinks;
    $news                = News::model()->localized()->findAll($criteria);
    
    $mainArticle = null;
    $shortNews   = array();
    $linkNews    = array();
    
    foreach ($news as $i => $article) {
        if ($mainArticle == null && !empty($article->picture)) {
            $mainArticle = $article;
        } elseif (count($shortNews) < $countShort) {
            $shortNews[] = $article;
        } else {
            $linkNews[] = $article;
        }
    }
    
    $countEvents         = 4;
    $yesterday           = date("Y-m-d 00:00:00", time());
    $criteria->condition = 'category_id = 8 AND published=1';
    $criteria->order     = 'date DESC';
    $criteria->limit     = $countEvents;
    $events              = array();
    foreach (News::model()->localized()->findAll($criteria) as $e) {
        $time   = strtotime($e->date);
        $isPast = $time < time() - 3600 * 8;
        $event  = array(
            'past' => $isPast,
            'time' => $time,
            'title' => $e->title,
            'link' => Yii::app()->createUrl('/information/events') . '?id=' . $e->id
        );
        
        if ($isPast) {
            array_push($events, $event);
        } else {
            array_unshift($events, $event);
        }
    }
?>

<div class="frontpagesite">
			<div class="grey">
				<div class="container">
					<div class="row-fluid">

						<section class="content span12">
							<div class="row-fluid">
								<div class="span7" style="margin-bottom: 10px;">
								<h2>
							<?php echo Yii::t('app', 'Latest News'); ?>
						<?php
    if (count($linkNews)):
?>
						<a href="<?php
        echo Yii::app()->createUrl('/information/news-events');
?>" class="morelink"><?php
        echo Yii::t('app', 'More');
?> &#10097;</a>

					<?php
    endif;
?>
							</h2>
								<div class="row-fluid mainnews">
										<div class="span4">
											<a href="<?php
    echo Yii::app()->createUrl('/information/news-events') . '?id=' . $mainArticle->id;
?>">
												<img 
												src="<?php
    echo Yii::app()->baseUrl;
?>/images/news/<?php
    echo $mainArticle->picture;
?>">
											</a>
										</div>
									<div class="span8">
			
			<a class="mainnews-link" href="<?php
    echo Yii::app()->createUrl('/information/news-events') . '?id=' . $mainArticle->id;
?>"><?php   echo $mainArticle->title;?>
					</a>
				<p><?php  echo $mainArticle->subtitle;?></p>
				
				<small><?php  echo $this->formatMysqlDate($mainArticle->date);?></small>
			</div>
									</div>


									<?php foreach ($shortNews as $i => $article): ?>
									<div class="row-fluid newslist">
										<div class="span2" style="padding: 5px;">
											<a href="<?php
									        echo Yii::app()->createUrl('/information/news-events') . '?id=' . $article->id;
									?>">
												<img src="<?php
											        echo Yii::app()->baseUrl;
											?>/images/news/<?php
											        echo $article->picture;
											?>">
											</a>
										</div>
										<div class="span10">
											<a class="newslist-link" href="<?php
        echo Yii::app()->createUrl('/information/news-events') . '?id=' . $article->id;
?>">
												<?php
        echo $article->title;
?>
											</a>
											<small><?php
        echo $this->formatMysqlDate($article->date);
?></small>
										</div>
									</div>
									<?php
    endforeach;
?>
								</div>
							

		<div class="span5" style="border: 1px solid #187AA1; min-height: 376px;">
			<div class="tabbable">
			  <ul class="nav nav-tabs" id="socialpanel">
			    <li class="active tabjustify" style="float:none">
			    	<a href="#facebook" data-toggle="tab">
			    	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" title="Facebook" alt="Facebook" class="at-icon at-icon-facebook" style="width: 32px; height: 32px;"><g><path d="M21 6.144C20.656 6.096 19.472 6 18.097 6c-2.877 0-4.85 1.66-4.85 4.7v2.62H10v3.557h3.247V26h3.895v-9.123h3.234l.497-3.557h-3.73v-2.272c0-1.022.292-1.73 1.858-1.73h2V6.143z" fill-rule="evenodd"></path></g></svg><br /><small>Facebook</small></a>
			    </li>
			    <li class="tabjustify" style="float:none">
			    	<a href="#twitter" data-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" title="Twitter" alt="Twitter" class="at-icon at-icon-twitter" style="width: 32px; height: 32px;"><g><path d="M26.67 9.38c-.78.35-1.63.58-2.51.69.9-.54 1.6-1.4 1.92-2.42-.85.5-1.78.87-2.78 1.06a4.38 4.38 0 0 0-7.57 3c0 .34.04.68.11 1-3.64-.18-6.86-1.93-9.02-4.57-.38.65-.59 1.4-.59 2.2 0 1.52.77 2.86 1.95 3.64-.72-.02-1.39-.22-1.98-.55v.06c0 2.12 1.51 3.89 3.51 4.29a4.37 4.37 0 0 1-1.97.07c.56 1.74 2.17 3 4.09 3.04a8.82 8.82 0 0 1-5.44 1.87c-.35 0-.7-.02-1.04-.06a12.43 12.43 0 0 0 6.71 1.97c8.05 0 12.45-6.67 12.45-12.45 0-.19-.01-.38-.01-.57.84-.62 1.58-1.39 2.17-2.27z"></path></g></svg><br /><small>Twitter</small></a>
			    </li>
			    <li class="tabjustify" style="float:none">
			    	<a href="#youtube" data-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" title="YouTube" alt="YouTube" class="at-icon at-icon-youtube" style="width: 32px; height: 32px;"><g><path d="M13.73 18.974V12.57l5.945 3.212-5.944 3.192zm12.18-9.778c-.837-.908-1.775-.912-2.205-.965C20.625 8 16.007 8 16.007 8c-.01 0-4.628 0-7.708.23-.43.054-1.368.058-2.205.966-.66.692-.875 2.263-.875 2.263S5 13.303 5 15.15v1.728c0 1.845.22 3.69.22 3.69s.215 1.57.875 2.262c.837.908 1.936.88 2.426.975 1.76.175 7.482.23 7.482.15 0 .08 4.624.072 7.703-.16.43-.052 1.368-.057 2.205-.965.66-.69.875-2.262.875-2.262s.22-1.845.22-3.69v-1.73c0-1.844-.22-3.69-.22-3.69s-.215-1.57-.875-2.262z" fill-rule="evenodd"></path></g></svg><br /><small>Youtube</small></a>
			    </li>
			    <li class="tabjustify" style="float:none">
			    	<a href="#instagram" data-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" title="Instagram" alt="Instagram" class="at-icon at-icon-instagram" style="width: 32px; height: 32px;"><g><path d="M22.96 22.21a.71.71 0 0 1-.714.716H9.72a.71.71 0 0 1-.716-.715v-7.593h1.652a5.127 5.127 0 0 0-.234 1.535c0 3 2.508 5.426 5.59 5.426 3.093 0 5.6-2.426 5.6-5.426 0-.527-.08-1.054-.233-1.535h1.58v7.594zm-3.327-6.245c0 1.933-1.617 3.504-3.62 3.504-1.993 0-3.61-1.572-3.61-3.505 0-1.934 1.617-3.504 3.61-3.504 2.003 0 3.62 1.57 3.62 3.505zm3.328-4.22a.81.81 0 0 1-.808.81h-2.04a.81.81 0 0 1-.807-.81V9.814a.81.81 0 0 1 .808-.81h2.04a.81.81 0 0 1 .808.81v1.933zM25 9.31A2.32 2.32 0 0 0 22.69 7H9.31A2.32 2.32 0 0 0 7 9.31v13.38A2.32 2.32 0 0 0 9.31 25h13.38A2.32 2.32 0 0 0 25 22.69V9.31z" fill-rule="evenodd"></path></g></svg><br /><small>Instagram</small></a>
			    </li>
			  </ul>
			  <div class="tab-content" style="height: 276px; padding: 5px;">
			    <div class="tab-pane active" id="facebook">
<div id="fb-root"></div>
<script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>

<?php
    require 'socialssdk/facebook-php-sdk-master/src/facebook.php';
    
    function make_links($text, $class = '', $target = '_blank')
    {
        return preg_replace('!((http\:\/\/|ftp\:\/\/|https\:\/\/)|www\.)([-a-zA-Zа-яА-Я0-9\~\!\@\#\$\%\^\&\*\(\)_\-\=\+\\\/\?\.\:\;\'\,]*)?!ism', '<a class="' . $class . '" href="//$3" target="' . $target . '">$1$3</a>', $text);
    }
    define("APP_ID", '529262527247443');
    define("APP_SECRET", '04e684eb0dc7e528a2bdb5a4ced22a71');
    define("PAGE_ID", 'SEEUniversity');
    $config = array(
        'appId' => APP_ID,
        'secret' => APP_SECRET
    );
    
    $api   = new Facebook($config);
    $posts = $api->api("/" . PAGE_ID . "/posts?limit=5");
    
    $i = 0;
    foreach ($posts['data'] as $post) {
        
        if (isset($post['id']) && $post['id'])
            $link = make_links($post['id']);
        $link = preg_replace("/^[^_]*_\s*/", "", $link);
        //echo $link.'<br />';
        
        echo '<div class="fb-post" data-href="https://www.facebook.com/SEEUniversity/posts/' . $link . '"></div>';
        
        if ($i !== count($posts['data']) - 1) {
            //echo '</a>';
        }
        $i++;
    }
?>      
			    </div>
			    <div class="tab-pane" id="twitter">
			      
				<?php 
					require_once('socialssdk/tweet-php-master/TweetPHP.php');
					$TweetPHP = new TweetPHP();
					echo $TweetPHP->get_tweet_list();
				?>

			    </div>
			    <div class="tab-pane" id="youtube">
			    
<?php 

$cacheYoutube = 'seeufeeds/youtube.xml.cache';
// generate the cache version if it doesn't exist or it's too old!
$ageInSeconds = 3600; // one hour
if(!file_exists($cacheYoutube) || filemtime($cacheYoutube) > time() + $ageInSeconds) {
  $contents = file_get_contents('https://www.youtube.com/feeds/videos.xml?channel_id=UC8ofdf3rSdY4vhNq2foNleg');
  file_put_contents($cacheYoutube, $contents);
}

$dom = simplexml_load_file($cacheYoutube);

$url = 'seeufeeds/youtube.xml.cache';
$xml = simplexml_load_file($url);
$ns = $xml->getDocNamespaces(true);
$xml->registerXPathNamespace('a', 'http://www.w3.org/2005/Atom');
$elements = $xml->xpath('//a:entry');
$content = $elements[0];

$yt = $content->children('http://www.youtube.com/xml/schemas/2015');
?>
<iframe width="100%" height="270px" src="https://www.youtube.com/embed/<?=$yt->videoId?>" frameborder="0" allowfullscreen></iframe>

			    </div>
			    <div class="tab-pane" id="instagram">
			      <!-- SnapWidget -->
			      
			      <div class="container instacontainer">
<div class="row-fluid">
<?php

$cacheInsta = 'seeufeeds/insta.json.cache';
// generate the cache version if it doesn't exist or it's too old!
$ageInSeconds = 3600; // one hour
if(!file_exists($cacheInsta) || filemtime($cacheInsta) > time() + $ageInSeconds) {
  $contents = file_get_contents('https://api.instagram.com/v1/users/self/media/recent/?access_token=2666614834.fc33f6a.d846b5594c964d439cbc3769e1e57065');
  file_put_contents($cacheInsta, $contents);
}

//$dom = simplexml_load_file($cacheYoutube);

    $json_link = 'seeufeeds/insta.json.cache';
    
    $json = file_get_contents($json_link);
    $obj  = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
    
    
    foreach (array_slice($obj['data'], 0, 15) as $post) {
        
        $pic_text = $post['caption']['text'];
        $pic_link = $post['link'];
        //$pic_like_count=$post['likes']['count'];
        //$pic_comment_count=$post['comments']['count'];
        $pic_src  = str_replace("http://", "https://", $post['images']['standard_resolution']['url']);
        //$pic_created_time=date("F j, Y", $post['caption']['created_time']);
        //$pic_created_time=date("F j, Y", strtotime($pic_created_time . " +1 days"));
        
        echo "<div class='span2 instagramphoto'><a href='{$pic_link}' target='_blank'>";
        echo "<img src='{$pic_src}' class='img-polaroid' alt='{$pic_text}'>";
        echo "</a></div>";
    }

    ?>
	</div>
	</div>
	
			    </div>
			  </div>
			</div>
		</div>


						</div>	
						</section>
					</div>
				</div>
			</div>
</div>


<div class="frontpageevent">
			<div class="grey">
				<div class="container">
					<h2><?php echo Yii::t('app', 'Upcoming Events'); ?>  <a href="<?php echo Yii::app()->language; ?>/information/events" class="morelink"><?php echo Yii::t('app', 'More'); ?> &#10097;</a></h2>
					<div class="row-fluid">
						<?php
    foreach ($events as $i => $event):?>
							<div class="span3">
					
							<?php
        $day   = date('d', $event['time']);
        $month = $this->_mylocale->dateFormatter->format('MMMM', $event['time']);?>
							<div class="row-fluid">
								<div class="calendar-date <?php echo $event['past'] ? 'past' : 'upcoming'; ?>">
									<p>
									<?php echo $day;?> <span>
									<?php echo $month;?></span>
									</p>
								
								</div>
								<a href="<?php echo $event['link']; ?>">
                                    <?php echo $event['title']; ?>
                                </a>
							</div>
				
						</div>
					<?php endforeach; ?>
			</div>
					
				</div>
			</div>
		</div>
<div id="footer-blog">
		<div id="footer-actions-blog">
			<div class="container">
			<div class="row-fluid">
<?php

$cacheBlog = 'seeufeeds/blog.xml.cache';
// generate the cache version if it doesn't exist or it's too old!
$ageInSeconds = 3600; // one hour
if(!file_exists($cacheBlog) || filemtime($cacheBlog) > time() + $ageInSeconds) {
  $contentsBlog = file_get_contents('http://blog.seeu.edu.mk/feed/?fsk=56efc53c0b829');
  file_put_contents($cacheBlog, $contentsBlog);
}

$domBlog = simplexml_load_file($cacheBlog);

$url = "seeufeeds/blog.xml.cache";

$rss = simplexml_load_file($url);
	if($rss)
	{
		$i = 1;
		$items = $rss->channel->item;
		foreach($items as $item)
		{
			$title = $item->title;
			$link = $item->link;
			$published_on = $item->pubDate;
			$description = $item->description;
			$thumbAttr = $item->children('media', true)->content->attributes();

			echo '<div class="span3 korniza">
			<a href="'.$link.'"><div style="background-image:url('.$thumbAttr['url'].'); background-repeat:no-repeat; background-size:cover; height: 200px;"></div></a>';
			echo '<h3 style="margin-top: 10px;"><a href="'.$link.'">'.$title.'</a></h3></div>';
			if ($i++ == 4) break;
		}
	}
?>
			
			</div>
			</div>
		</div>
	</div>

	<div>
				<div class="container">
					<div class="row-fluid">
						<section class="content intro span12">
							<div class="row-fluid intro featured" style="margin-top: 30px;">
								<div class="span6">
									<p class="introduction">
										<?php echo Yii::app()->settings->get('frontpage','introtext_'.Yii::app()->language); ?>
									</p>
									<a href="http://cvip.seeu.edu.mk/web/frontpage-2/" target="_blank">
									<img style="margin-top: 20px; margin-bottom: 20px;" src="<?php echo Yii::app()->theme->baseUrl?>/img/usaid-lcif-project-<?php echo Yii::app()->language; ?>.jpg">
									</a>
								</div>
								<div class="span2">
									<p class="introduction">
										Certified quality management
									</p>
									<img src="<?php echo Yii::app()->theme->baseUrl?>/img/ISO_9001-2008.png">
								</div>
								<div class="span2 projecthoverimage">
									<p class="introduction">
										HR Excellence in Research
									</p>
									<a href="<?php echo Yii::app()->baseUrl?>/<?php echo Yii::app()->language; ?>/research/seeu-hrexcellence"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/hr-excellence.jpg"></a>
								</div>
								
								<div class="span2 projecthoverimage">
									<p class="introduction">
										Erasmus+
									</p><br />
									<a href="<?php echo Yii::app()->baseUrl?>/<?php echo Yii::app()->language; ?>/current-students/international-relation/erasmus"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/logo-erasmus.jpg"></a>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		<?php
		else:
		?>

			<div class="main">
				<div class="container">
				<div class="breadcrumbhide span12" style="margin: 0;">
					<div class="span9" style="margin: 0; padding: 0; text-align:left;">
						<?php
			    $this->widget('ext.bcms.widgets.BBreadcrumbs', array(
				        'currentNavigationId' => isset($_GET['nav']) ? $_GET['nav'] : 0,
				        'additionalItems' => $this->breadcrumbs
				    ));
				?>
					</div>
					<div class="span3" style="margin: 0; padding: 0; text-align:right;">
						<?php
				    	$this->renderPartial('//layouts/addthis');
						?>
					</div>

				</div>
					<div class="row-fluid">
						<?php if ($activeMenu != null): ?>
							<section class="span3">
								<nav class="sectionmenu">
									<?php
					        $this->widget('ext.pageviews.BSubmenu', array(
					            'root' => $activeMenu->id,
					            'currentNavigationId' => isset($_GET['nav']) ? $_GET['nav'] : 0
					        ));
							?>
								</nav>
							

							</section>
							<section class="content span9" style="background-color: #fff; padding: 15px; box-shadow: 1px 1px 1px #ccc">
								<?php echo $content; ?>
							</section>

						<?php else: ?>
							<section class="content span12" style="background-color: #fff; padding: 15px; box-shadow: 1px 1px 1px #ccc">
								<?php echo $content; ?>
                        </section>
                        <?php endif; ?>
					</div>
				</div>
			</div>
		<?php
		endif;
		?>

		<?php
echo $this->renderPartial('//layouts/footer', null, true);
?>
		<?php
Yii::app()->getClientScript()->registerScript('$', '');
?>
		<div style="display:none"><a href="https://plus.google.com/113145618836451883455" rel="publisher">Google+</a></div>
	</body>
</html>