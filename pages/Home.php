
<div class="double-col">

	<img src="Assets/images/Screenshots/Mountains.jpg"
		class="clear right image" />

	<h3>Try The Game</h3>

	<br /> The pre-alpha version of the game can be downloaded <a
		href="http://www.seedofandromeda.com/Downloads.php">here</a>!

</div>

<br />

<div class="tri-col-3">

	<h3>About the Game</h3>

	Seed of Andromeda is a voxel based sandbox RPG. Set in the near future,
	the player crash lands on a planet with a harsh environment. In the
	desire to have a way to return to their mission, the player may be able
	to build up technologically and regain space flight, with the help of
	other survivors! The game focusses on modability and customisation,
	many tools will come packaged with the game, including world, tree,
	biome and block editors! <br />
	<br />
	<a href="http://www.seedofandromeda.com/The%20Game.php"
		style="float: right;">Read more here!</a>

</div>

<div class="tri-double-col">

	<h3>Featured Video</h3>
<?php

// set feed URL
$feedURL = 'https://gdata.youtube.com/feeds/api/videos?author=UCMlW2qG20hcFYo06rcit4CQ&max-results=1&orderby=published';

// read feed into SimpleXML object

$sxml = simplexml_load_file ( $feedURL );

$i = 0;

foreach ( $sxml->entry as $entry ) {
	
	$i ++;
	
	if ($i < 2) 

	{
		
		// get nodes in media: namespace for media information
		
		$media = $entry->children ( 'http://search.yahoo.com/mrss/' );
		
		// get video player URL
		
		$attrs = $media->group->player->attributes ();
		
		$watch = $attrs ['url'];
		
		$vars;
		
		parse_str ( parse_url ( $watch, PHP_URL_QUERY ), $vars );
		
		$id = $vars ['v'];
		
		?>
                    <iframe width="580" height="326"
		src="https://www.youtube.com/embed/<?php echo $id ?>?wmode=transparent"
		frameborder="0" allowfullscreen></iframe>
		<?php
	}
}

?>
                </div>

<div class="double-col">

	<h3>Latest Dev News</h3>

	<br /> The long awaited public release of Seed of Andromeda came near
	the end of 2013. Serving to the players a main of realistic physics and
	a side of bugs. Straight after this release, Ben began work on solving
	reported bugs and bringing performance up to an even more incredible
	standard than the initial pre-alpha release. <br /> <br /> <img
		src="Assets/images/Screenshots/Blossoms.jpg" class="clear left image" />

	Meanwhile, the Seed of Andromeda website got an overhaul thanks to the
	new Website Designer, Matthew, with the assistance of Sebastian's
	PhotoShop skills. The initial result was a huge increase in cat images
	and a reduction in useful information. Though that has been quickly
	changing over the last few days. <br /> <br /> Keep an eye on this
	space, as within the next few weeks you will be seeing updates on the
	game. In the mean time, have a good new year and if you haven't
	already, drop in to the IRC and say hi to fellow SoA supporters and the
	dev team! Also don't forget the Steam group where we occasionally
	organise games of Civilization V and Planetside 2!

</div>
