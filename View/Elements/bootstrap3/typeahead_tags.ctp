<?php  

//selected value
if(empty($args['name']['value'])){
	$value = !empty($this->request->data[$fieldNameParts['model']][$fieldNameParts['field']])? $this->request->data[$fieldNameParts['model']][$fieldNameParts['field']] : null;
}else{
	$value = $args['name']['value'];
}

//optional tooltip help
$tooltipHelp = !empty($options['tooltipHelp'])? $options['tooltipHelp'] : null;

//the use datumTokenizerkey can be set as an option, or it will use the itemText option otherwize, or 'tokens' by default
$datumTokenizerKey = !empty($options['datumTokenizerKey'])? $options['datumTokenizerKey'] : !empty($options['itemText'])? $options['itemText'] : 'tokens';
 
//if using an areray of objects instead of an array of values in bloodhound, the selected values need to be added via javascipt instead of the input
// will need to pass in json objects, so that may be more confusing in the controller than changing the search filter to lookup ids first. more research 
// and testing needs to be done to implement default behavior 


//get id for dom element
$typeaheadFieldId = !empty($args['id']['id'])? $args['id']['id'] : null;

// handlebars template
$handlebarsSuggestionTemplate = !empty($options['handlebarsSuggestionTemplate'])? $options['handlebarsSuggestionTemplate'] : '<p><strong>{{tokens}}</strong></p>';



//convert php options to array:



$prefetchOptions[] = isset($options['ttl'])? "ttl: ".(string)$options['ttl'] : null;
$prefetchOptions[] = !empty($options['prefetchPath'])? "url: '{$options['prefetchPath']}'" : null;


$bloodhoundOptions[] = !empty($options['remote'])? "remote: '".$options['remote']."'" : null;
$bloodhoundOptions[] = !empty($options['local'])? "local: ".json_encode($options['local']) : null;
$bloodhoundOptions[] = !empty($options['limit'])? "limit: ".$$options['limit'] : "limit: 10";
$bloodhoundOptions[] = !empty($options['remotePath'])? "remote: ".$options['remotePath'] : null;
$bloodhoundOptions = implode(",\n", array_filter($bloodhoundOptions));

$prefetchOptions = array_filter($prefetchOptions);
if(!empty($prefetchOptions)){

	$prefetchOptions = "prefetch: {\n\t" . implode(",\n\t", $prefetchOptions)."\n}\n";
	$bloodhoundOptions = $bloodhoundOptions.",\n".$prefetchOptions;
}else{
	$prefetchOptions = null;
}


$typeaheadOptions[] = !empty($options['itemValue'])? "itemValue: '{$options['itemValue']}'" : null;
$typeaheadOptions[] = !empty($options['itemText'])? "itemText: '{$options['itemText']}'" : null;
$typeaheadOptions = implode(",\n\t", array_filter($typeaheadOptions))."\n\t";

//add search type class
$wrapperClass = null;
$initialTypeaheadOptions = array();
if(!empty($options['searchCondition'])){
	switch ($options['searchCondition']) {
		case 'And':
			$wrapperClass = 'typeahead-danger';
			$initialTypeaheadOptions[] = 'tagClass: function(item) {return "label label-danger label-important";}';
			break;
	}
}

$initialTypeaheadOptions = implode(",\n\t", array_filter($initialTypeaheadOptions))."\n\t";

?>
<div class="input-group form-group typahead-tags-wrapper <?php echo $wrapperClass?>">
	<input id='<?php echo $typeaheadFieldId ?>TagsInput' class='typahead-tags' type="text" value="<?php echo $value ?>"  name='<?php echo $args['name']['name'] ?>' />
	<?php if (!empty($tooltipHelp)){ ?>
		<span class='glyphicon glyphicon-question-sign help-icon' rel='tooltip' data-original-title="<?php echo $tooltipHelp ?>"></span>
	<?php } ?>
</div>


<?php $this->append('bootstrapExt');?>

<script>
function <?php echo $args['id']['id']; ?>initializeTags(){
	
<?php if(isset($options['ttl']) && $options['ttl'] < 1800000){ ?>
	localStorage.clear();
<?php } ?>

var tagsInput = '<?php echo $args['id']['id']; ?>TagsInput';
$('#'+tagsInput).tagsinput({
	confirmKeys: [13, 44],
	<?php echo $initialTypeaheadOptions ?>
});


var <?php echo $args['id']['id']; ?>datum = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('<?php echo $datumTokenizerKey ?>'), //Bloodhound.tokenizers.obj.whitespace('tokens'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,

  <?php echo $bloodhoundOptions ?>
});

<?php echo $args['id']['id']; ?>datum.initialize();
 
// Adding custom typeahead support using http://twitter.github.io/typeahead.js
$('#'+tagsInput).tagsinput('input').typeahead(null, {
  	source: <?php echo $args['id']['id']; ?>datum.ttAdapter(),
  	templates: {
	    suggestion: Handlebars.compile('<?php echo $handlebarsSuggestionTemplate ?>')
	 },
	<?php echo $typeaheadOptions ?>
}).bind('typeahead:selected', $.proxy(function (obj, <?php echo $args['id']['id']; ?>datum) {
  this.tagsinput('add', <?php echo $args['id']['id']; ?>datum.<?php echo $datumTokenizerKey ?>);
  //this.tagsinput('input').typeahead('setQuery', '');
}, $('#'+tagsInput)));
}
$(document).ready(function(){
	<?php echo $args['id']['id']; ?>initializeTags();
});
</script>

<?php $this->end(); ?>


