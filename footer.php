	</div></div></div></div></div></div></div>
	</div>

</div>

<div id="footer">Copyright &copy; <?php echo date(Y); ?> SeedofAndromeda.com</div>

<!-- AddThis Smart Layers BEGIN -->

<!-- Go to http://www.addthis.com/get/smart-layers to customize -->

<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52ad9c1a1c64f85f"></script>
<script type="text/javascript">
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'right',
      'numPreferredServices' : 5
    }   
  });
</script>-->

<!-- AddThis Smart Layers END -->



<!-- Google Analytics BEGIN-->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46451794-1', 'seedofandromeda.com');
  ga('send', 'pageview');

</script>

<!-- Google Analytics END-->



<!-- Downloads Tracking -->

<script type="text/javascript">
if (typeof jQuery != 'undefined') {
  jQuery(document).ready(function($) {
    var filetypes = /\.(zip|exe|dmg|pdf|doc.*|xls.*|ppt.*|mp3|txt|rar|wma|mov|avi|wmv|flv|wav)$/i;
    var baseHref = '';
    if (jQuery('base').attr('href') != undefined) baseHref = jQuery('base').attr('href');
 
    jQuery('a').on('click', function(event) {
      var el = jQuery(this);
      var track = true;
      var href = (typeof(el.attr('href')) != 'undefined' ) ? el.attr('href') :"";
      var isThisDomain = href.match(document.domain.split('.').reverse()[1] + '.' + document.domain.split('.').reverse()[0]);
      if (!href.match(/^javascript:/i)) {
        var elEv = []; elEv.value=0, elEv.non_i=false;
        if (href.match(/^mailto\:/i)) {
          elEv.category = "Email";
          elEv.action = "click";
          elEv.label = href.replace(/^mailto\:/i, '');
          elEv.loc = href;
        }
        else if (href.match(filetypes)) {
          var extension = (/[.]/.exec(href)) ? /[^.]+$/.exec(href) : undefined;
          elEv.category = "Download";
          elEv.action = "click-" + extension[0];
          elEv.label = href.replace(/ /g,"-");
          elEv.loc = baseHref + href;
        }
        else if (href.match(/^https?\:/i) && !isThisDomain) {
          elEv.category = "External";
          elEv.action = "click";
          elEv.label = href.replace(/^https?\:\/\//i, '');
          elEv.non_i = true;
          elEv.loc = href;
        }
        else if (href.match(/^tel\:/i)) {
          elEv.category = "Telephone";
          elEv.action = "click";
          elEv.label = href.replace(/^tel\:/i, '');
          elEv.loc = href;
        }
        else track = false;
 
        if (track) {
          _gaq.push(['_trackEvent', elEv.category.toLowerCase(), elEv.action.toLowerCase(), elEv.label.toLowerCase(), elEv.value, elEv.non_i]);
          if ( el.attr('target') == undefined || el.attr('target').toLowerCase() != '_blank') {
            setTimeout(function() { location.href = elEv.loc; }, 400);
            return false;
      }
    }
      }
    });
  });
}
</script>

<!-- Downloads Tracking END -->

</body>
</html>