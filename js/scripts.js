$( document ).ready(function() {
	var searchForm = $('form#search-form');
	var searchBox = searchForm.find('input[name=query]');
	var visible = false;

	function submitSearchForm() {
		if(searchBox.val() != '')
			searchForm.submit();
		else
	    	searchBox.focus();
	}
	searchBox.on('keypress', function(e){
		var code = e.charCode || e.keyCode || e.which;
		if (code  == 13) {
			e.preventDefault();
			submitSearchForm();
			return false;
		}
	});
	searchForm.find('a.search-button').click(function( event ) {
		if(visible) {
			submitSearchForm();
		} else {
		    searchForm.find('.search-slide').show();
		    searchBox.focus();
		    visible = true;
		}
		return false;
	});
	searchForm.find('ul.search-categories a').click(function(){
		var value = $(this).attr('data-category');
		searchForm.find('input[name=category]').val(value);
		searchForm.find('ul.search-categories li').removeClass('active');
		$(this).closest('li').addClass('active');
		return false;
	});

	$('.top-links li.slide a').click(function(){
		var shortcuts = $('header > .shortcuts');
		var links = $('.top-links');
		var item = $(this).closest('li');
		var target = shortcuts.find($(this).attr('href'));

		if(item.hasClass('active')) {
			target.slideUp(function(){
				item.removeClass('active');
			});
		} else {
			var toHide = shortcuts.find('div.slide:visible');
			toHide.slideUp('fast', function(){
				links.find('li').removeClass('active');
			});
			toHide.promise().done(function(){
				item.addClass('active');
				target.slideDown();
			});
		}
		return false;
	});

	// Slideshows
	var $features = $('.features');
	if($features.length > 0) {
		var $dots = $features.find('.dots');
		var $links = $dots.find('a');
		var $navLinks = $features.find('.feature-nav');
		var $slides = $features.find('.slide');
		var slideCount = $slides.length;
		if(slideCount < 2) {
			$navLinks.hide();
			$dots.hide();
		}
		var activeIndex = -1;
		var $activeLink = $links.first();
		var $activeSlide = $slides.first();
		// Call periodically
		var nextSlide = function(){ $features.find('.feature-nav.next').click(); }
		var intervalID;
		$links.click(function(){
			var newIndex = $(this).parent().children().index(this);
			if(activeIndex != newIndex) {
				activeIndex = newIndex;
				// Set classes for links
				$activeLink.removeClass('active');
				$activeLink = $(this);
				$activeLink.addClass('active');

				// Change the slides
				$activeSlide.addClass('last-active');
				$slides.removeClass('active'); // lower z-index
				var $next = $slides.eq(activeIndex);

				var $hideLink = $activeSlide.find('a.click');
				$hideLink.animate({'left': '2000px'}, 500, function(){
					$hideLink.css({'left': '-1000px'});
				});

				// Animate links
				$next.css({opacity: 0.0})
			        .addClass('active')
			        .animate({opacity: 1.0}, 1000, function() {
		            	$slides.removeClass('last-active');
					var $showLink = $next.find('a.click');
					$showLink.animate({'left': '100px'}, 700);
		        });

				$activeSlide = $next;
				clearInterval(intervalID);
				intervalID = setInterval(nextSlide, 10000);
			}
	        return false;
		});
		$features.find('.feature-nav').click(function(){
			var nextIndex = $(this).hasClass('next')
				? (activeIndex + 1) % slideCount
				: (activeIndex - 1 + slideCount) % slideCount;
			$dots.children().eq(nextIndex).click();
			return false;
		});
		// Start the animation
		$activeLink.click();
	}

	// Rotating news
	$('.rotate-links').each(function(){
		var $newsLinks = $(this).find('a').hide();
		var $active = $newsLinks.first().fadeIn('slow');
		var rotating = setInterval(function(){
			$active.fadeOut('slow', function(){
				$active = $active.next();
				if($active.length == 0)
					$active = $newsLinks.first();
				$active.fadeIn('slow');
			});
		}, 5000);
	});
});
