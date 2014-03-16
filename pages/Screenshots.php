
<div class="double-col">

	<h3 style="text-align: center; font-size: 1.6em;">Screenshots</h3>

	<div class="img-prev">
		<img src="/Assets/images/arrowLeft.png" />
	</div>

	<div id="image-frame-inner">

		<a href="#" id="screenshotlink" data-lightbox="screenshot" title="Screenshot"><img src="#" class="temp-image" /> <img src="#" class="enlarged-image" /></a>

	</div>

	<div class="img-next">
		<img src="/Assets/images/arrowRight.png" />
	</div>

	<br />

</div>

<?php
$i = 0;

foreach ( glob ( "Assets/images/Screenshots/*.jpg" ) as $image ) {
	if (substr_count ( $image, "_thumb_" ) == 0) {
		$i ++;
		echo '<div class="image-col quad-col-' . $i . ' empty"><img src="/' . substr ( $image, 0, strlen ( $image ) - 4 ) . '_thumb_202x162.jpg" class="image"/></div>';
		if ($i == 4) {
			$i = 0;
		}
	}
}

?>