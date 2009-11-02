<?php

echo heading("Tag Directory", 2);
echo anchor("tags/index", "my tags");
echo " | ";
echo anchor("tags/all_alpha", "see all tags (alpha)");

echo form_open('tags/update');
$input = array('name' => 'tag', 'id' => 'tag', 'size'=> 20, 'class' => ':required :only_on_submit');
echo form_input($input);
echo form_submit('follow tag','follow tag');
echo form_close();


$maximum = 20;

// start the output to the page
echo "<div id=\"tagcloud\">\n<div>\n";
foreach ($results as $k) // start looping through the tags
{
	// determine the popularity of this term as a percentage
	$percent = floor(($k['counter'] / $maximum) * 100);
	// determine the class for this term based on the percentage
	if ($percent <20)
	{
		$class = 'smallest';
	} elseif ($percent>= 20 and $percent <40) {
		$class = 'small';
	} elseif ($percent>= 40 and $percent <60) {
		$class = 'medium';
	} elseif ($percent>= 60 and $percent <80) {
		$class = 'large';
	} else {
		$class = 'largest';
	}
	// output this tag
	echo "<span class='$class'>";
	echo anchor('tags/objects/'.$k['tag'], $k['tag']);
	echo "</span>";
	//echo "<span class=\"$class\"><a href=\"search.php?search=" . urlencode($k['term']) . "\">" . $k['term'] . "</a></span>\n ";
}
// close the output
echo "</div></div>";

?>