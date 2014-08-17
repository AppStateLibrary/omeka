    </div><!-- end content -->
    <div id="footer">
        <p id="footnav">- <a href="http://www.web.appstate.edu/disclaimer.html">Disclaimer</a> - <a href="http://transcoder.usablenet.com/tt/referrer" title="View page as text-only" rel="nofollow">Text Only</a></p>
        <address>
            <a href="http://www.appstate.edu/"><img style="float:right;" src="/themes/appstate2/images/foot_logo.gif" alt="Appalachian State University Logo" width="116" height="33" class="logo" /></a>&#169; 2008 Appalachian State University Boone, NC 28608 | 828-262-2000
        </address>
	<p style="font-size:smaller">Proudly powered by <a href="http://omeka.org">Omeka</a>.</p>

	<ul class="navigation" style="font-size: smaller;">
            <?php
               $navArray = array();
               $navArray[] = array('label'=>'Browse Items', 'uri'=>url('items'));
               $navArray[] = array('label'=>'Browse Collections', 'uri'=>url('collections?sort_field=Dublin+Core%2CTitle'));
               $navArray[] = array('label'=>'Contact Us', 'uri'=>url('contact'));
               $navArray[] = array('label'=>'Contribute', 'uri'=>url('contribution'));
            ?>
            <?php echo nav($navArray); ?>
	</ul>
	</div><!-- end footer -->
</div><!-- end wrap -->
	<br/><br/>
	<br/><br/>


<?php fire_plugin_hook('public_footer', array('view' => $this)); ?>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-33238995-1");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
</html>
