/*
	Any site-specific scripts you might have.
	Note that <html> innately gets a class of "no-js".
	This is to allow you to react to non-JS users.
	Recommend removing that and adding "js" as one of the first things your script does.
	Note that if you are using Modernizr, it already does this for you. :-)
*/

jQuery(function() {

  jQuery('form.validate').validate();
  
	jQuery('.map').css({'height':'0'});
   jQuery('.slideshow').smallSlideshow();
	jQuery('ul.smallSlide').smallSlideshow();

	jQuery('.scheduleVisit').click(function(e) {
		e.preventDefault();
		jQuery('#scheduleVisit').modal();
	});
	
	jQuery('#refer').click(function(e) {
		e.preventDefault();
		jQuery('#referFriend').modal();
	});
	
	jQuery('.callUs').click(function(e) {
		e.preventDefault();
		num = jQuery('#callUs h3').length;
	    theHeight = num*130+'px';
	    jQuery('#callUs').modal({ dataCss: { height:theHeight }, containerCss: { height:theHeight } });
	});

  jQuery('#watch').click(function(e) {
    e.preventDefault();
    jQuery('#youTube').modal({ dataCss: { width:'474px', height:'272px' }, containerCss: { width:'474px', height:'272px' } });
  });

  jQuery('#contact').click(function(e) {
    e.preventDefault();
    num = jQuery('#locations .location').length;
    theWidth = num*275+'px';
    jQuery('#locations').modal({ dataCss: { width:theWidth, height:'225px' }, containerCss: { width:theWidth, height:'225px' } });
  });

  jQuery('#tabs').tabs();

  jQuery('.ques').click(function(e) {
    e.preventDefault();
    jQuery(this).parent().siblings().children('.answer').hide();
    jQuery(this).next('.answer').toggle();
  })

	jQuery('ul.sub-nav li a').hover(function() {
		jQuery(this).animate({ top : "-=15px", opacity: .85 }, 150); 
      }, function() {
		jQuery(this).animate({ top : "0", opacity: .7 }, 1200);  
     });

	jQuery('.location a.moreLink').click(function(e) {
		e.preventDefault();
		if(jQuery(this).text() == 'View Map')
		jQuery(this).text('Hide Map').toggleClass('open').parent().siblings('.map').css({'height':'550px'});
		else
		jQuery(this).text('View Map').toggleClass('open').parent().siblings('.map').css({'height':'0'});
	});

  jQuery('.tools').click(function() {
      jQuery('#dropDown').css('display', 'inline');
      jQuery('#dropDown').animate({ height: 'auto'}, 500);
  });

  jQuery('.call').click(function() {
      jQuery('#dropDownPhone').css('display', 'inline');
      jQuery('#dropDownPhone').animate({ height: 'auto'}, 500);
  });

  jQuery('.payNow').click(function() {
      jQuery('#dropDownPay').css('display', 'inline');
      jQuery('#dropDownPay').animate({ height: 'auto'}, 500);
  });

  jQuery('a.close-tooltip').click(function() { 
    jQuery(this).parent().hide();
  });

  jQuery('.our-team .moreLink').click(function() {
   if(jQuery(this).text() == "Read more"){
      jQuery(this).text('Read less');
      jQuery(this).css('background-position', '0 -24px');
      jQuery(this).prev().css({height: 'auto' });
   } else {
    
    jQuery(this).prev().animate({
      height: '68px'
    }, 250, 'linear', function() {
        jQuery(this).next().text('Read more');
        jQuery(this).next().css('background-position', '0 0');
    });

   }
  });

  jQuery('a.cal').click(function() {
	console.log(jQuery(this).siblings('.calFrame'));
 	jQuery(this).siblings('.calFrame').animate({'height': 'toggle'}, 100);
  });

  jQuery('.google article a').attr('target', '_blank');
})

function twitterCallback2(twitters) {
  var statusHTML = [];
  for (var i=0; i<twitters.length; i++){
    var username = twitters[i].user.screen_name;
    var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
      return '<a href="'+url+'">'+url+'</a>';
    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
    });
    statusHTML.push('<li><span>'+status+'</span> <br /> <a style="font-size:85%" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id_str+'">'+relative_time(twitters[i].created_at)+'</a></li>');
  }
  document.getElementById('twitter_update_list').innerHTML = statusHTML.join('');
}

function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  if (delta < 60) {
    return 'less than a minute ago';
  } else if(delta < 120) {
    return 'about a minute ago';
  } else if(delta < (60*60)) {
    return (parseInt(delta / 60)).toString() + ' minutes ago';
  } else if(delta < (120*60)) {
    return 'about an hour ago';
  } else if(delta < (24*60*60)) {
    return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
  } else if(delta < (48*60*60)) {
    return '1 day ago';
  } else {
    return (parseInt(delta / 86400)).toString() + ' days ago';
  }
}

function loadVideo3(playerUrl, autoplay) { 
  swfobject.embedSWF(playerUrl + '&rel=0&border=0&fs=1&wmode=opaque&autoplay=' + 
      (autoplay?1:0), 'player3', '896', '444', '9.0.0', false, 
      false, {wmode:"transparent",allowfullscreen: 'true'}); 
} 

function showMyVideos3(data) { 
  var feed = data.feed; 
  var entries = feed.entry || []; 
  var vidPerPage = 8;
  var vidCount = 1;
  var html = []; 
  var ulHeader = '<div class="page2">';
  var ulFooter = '</div>';
  if(entries.length == 0)
     html.push(ulHeader, ulFooter );
  for (var i = 0; i < entries.length; i++) { 
    if(vidCount == 1)
    html.push(ulHeader);
    var entry = entries[i]; 
    var title = entry.title.$t.substr(0, 80); 
    var thumbnailUrl = entries[i].media$group.media$thumbnail[0].url; 
    var playerUrl = entries[i].media$group.media$content[0].url; 
    html.push('<a onclick="javascript: loadVideo3(\'', playerUrl, '\', true)" title="', title, '">', 
               '<img src="', thumbnailUrl, '" />', '</a>'); 
  if(vidCount == vidPerPage){
    html.push(ulFooter);
    vidCount = 0;
  }
  vidCount++;
  } 
  if(vidCount != 1)
     html.push(ulFooter); 
  
  //document.getElementById('videos2').innerHTML = html.join(''); 
  jQuery(".entriesVid2").html(html.join(''));
  if (entries.length > 0) { 
    loadVideo3(entries[0].media$group.media$content[0].url, false); 
  } 
} 

function playVideo(sourceId, targetId) {
   if (typeof(sourceId)=='string') {sourceId=document.getElementById(sourceId);}
   if (typeof(targetId)=='string') {targetId=document.getElementById(targetId);}
   targetId.innerHTML=sourceId.innerHTML;
   return false;
}

(function(jQuery) {
	jQuery.fn.smallSlideshow = function(options) {
		options = jQuery.extend({ 'timeout': 7000, 'speed': 300 }, options);
		return this.each(function() {
			var jQueryelem = jQuery(this);
			jQueryelem.children().hide();
			jQueryelem.children().eq(0).show();
			setInterval(function() {
				jQueryelem.children().eq(0).fadeOut().appendTo(jQueryelem);
				jQueryelem.children().eq(0).fadeIn(options.speed);
			}, options.timeout);
		});
	};
}(jQuery));

(function(jQuery) {
  jQuery.fn.slideshow = function(options) {
    options = jQuery.extend({ 'timeout': 7000, 'speed': 300 }, options);
    return this.each(function() {
      var jQueryelem = jQuery(this);
      jQueryelem.wrap('<div class="slideshowWrapper" />').clone().removeClass('slideshow').addClass('navigation').appendTo('.slideshowWrapper').children().each(function() {
        jQuery(this).children().text('');
      }).eq(0).addClass('current');
      jQueryelem.children().eq(0).addClass('current');
      jQuery('.navigation li a').click(function(e) {
        e.preventDefault();
        //get the index of the clicked element
        theIndex = jQuery(this).parent().index();
        //fadeOut current slide and remove class current
        jQuery('.slideshow .current').fadeOut().removeClass('current');
        //fade in new slide and add class current
        jQuery('.slideshow').children().eq(theIndex).fadeIn().addClass('current');
        //remove class current from navigation
        jQuery('.navigation .current').removeClass('current');
        //add class current to new current navigation
        jQuery('.navigation').children().eq(theIndex).addClass('current');
      });
      setInterval(function() {
        theIndex = jQuery('.slideshow .current').index();
        jQueryelem.children('.current').fadeOut().removeClass('current');
        jQuery('.navigation .current').removeClass('current');
        if(jQuery('.navigation li').length > (theIndex + 1)) {
          jQueryelem.children().eq(theIndex+1).fadeIn(options.speed).addClass('current');
          jQuery('.navigation li').eq(theIndex+1).addClass('current');
        } else {
          jQueryelem.children().eq(0).fadeIn(options.speed).addClass('current');
          jQuery('.navigation li').eq(0).addClass('current');
        }
      }, options.timeout);
    });
  };
}(jQuery));