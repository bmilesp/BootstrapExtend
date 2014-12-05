<?php

$selectedClass = !empty($selectedClass)? $selectedClass : 'label-info';
$glyphiconSelectedClass = !empty($glyphiconSelectedClass)? $glyphiconSelectedClass : 'text-info';

//parse string lists into arrays
$delimiter = !empty($delimiter)? $delimiter : ';';
$tags = is_array($tagsList)? $tagsList : explode($delimiter,$tagsList);

$selectedDelimiter = !empty($selectedDelimiter)? $selectedDelimiter : ',';

$selected = empty($selected)? array() : $selected; 
$selected = is_array($selected)? $selected : explode($selectedDelimiter,$selected);

// set up classes
$class= !empty($class)? $class : 'label-default';
$labelClass = !empty($labelClass)? $labelClass : 'label';
$glyphiconList = !empty($glyphiconList)? $glyphiconList : array();


foreach ($tags as $tag) { 
    $glyphiconClass = null;
    $tooltip = null;
	$addSelectedClass = (in_array($tag, $selected))? $class.' '.$selectedClass : $class;
	$displayTag = $tag;
	//check glyphiconlist
	if(!empty($glyphiconList)){
		$glyphiconClass = !empty($glyphiconList[$tag])? 'glyphicon '.$glyphiconList[$tag] : null;
		$tooltip = "rel='tooltip' data-original-title=".$tag ." ";
		$displayTag = null;
		$labelClass = null;
		
		$addSelectedClass = (in_array($tag, $selected))? $glyphiconSelectedClass : null;
	}

?>
	<span class='<?php echo $labelClass.' '.$addSelectedClass.' '.$glyphiconClass ?>' <?php echo $tooltip ?> ><?php echo $displayTag ?></span>
<?php } 



/*

if using a glyphicon list- will have to loop through glyphicons. may be better to make a new element

	//check glyphiconlist- use it to create a 
	if(!empty($glyphiconList)){
		$glyphiconClass = !empty($glyphiconList[$tag])? 'glyphicon '.$glyphiconList[$tag] : null;
		$tooltip = "rel='tooltip' data-original-title=".$tag ." ";
		$displayTag = null;
		$labelClass = null;
		$selectedClass = (in_array($tag, $selected))? $glyphiconSelectedClass : null;
		if(!empty($selectedClass)){?>
			 <span class='<?php echo $labelClass.' '.$selectedClass.' '.$glyphiconClass ?>' <?php echo $tooltip ?> ><?php echo $displayTag ?></span>
		<? }else{ 
			$tooltip = "rel='tooltip' data-original-title='".$tag ." Not Available' "; ?>
			<span class='<?php echo $labelClass.' '.$selectedClass.' '.$glyphiconClass?> text-default' <?php echo $tooltip ?> ><?php echo $displayTag ?></span>
		<?php }
	}else{ // just apply regulat tags ?>
		<span class='<?php echo $labelClass.' '.$selectedClass.' '.$glyphiconClass ?>' <?php echo $tooltip ?> ><?php echo $displayTag ?></span>
	<?php }
 } ?>

 */