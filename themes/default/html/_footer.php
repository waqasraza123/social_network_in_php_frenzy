<script>$("abbr.timeago").timeago();</script>
<script>
$(document).ready(function(){

	if ($(window).height()>=400) {
		heightTopInside = $('#top-inside').height();
		$('#generalspace').css("margin-top", heightTopInside + 1 + "px");
	}

	<?php if (!(isset($D->is_home)&&$D->is_home==TRUE)) { ?>

	rightSearch = $('#boxsearch').position();
	$('#search-container').css('left',rightSearch.left);	

	<?php } ?>
});
</script>
</div>
<!--[if (lt IE 9) & (!IEMobile)]>
<script src="<?php echo $C->SITE_URL ?>themes/<?php echo $C->THEME; ?>/js/selectivizr-min.js"></script>
<![endif]-->
    
    <?php
        @include( $C->INCPATH.'../themes/include_in_footer.php' );
    ?> 
</body>
</html>