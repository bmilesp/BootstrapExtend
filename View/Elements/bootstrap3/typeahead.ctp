
<?php 
	$value = !empty($this->request->data[$fieldNameParts['model']][$fieldNameParts['field']])? $this->request->data[$fieldNameParts['model']][$fieldNameParts['field']] : null;
	$typeaheadFieldId = !empty($args['id']['id'])? $args['id']['id'] : null;
	
	$typeahead_options = array(
		'limit' => !empty($options['typeahead']['options']['limit']) ? $options['typeahead']['options']['limit'] : 10,
		'key_term' => !empty($options['typeahead']['options']['key_term']) ? $options['typeahead']['options']['key_term'] : 'key',
		'value_term' => !empty($options['typeahead']['options']['value_term']) ? $options['typeahead']['options']['value_term'] : 'value'
	);
?>
<div id="<?php echo $uuid; ?>">
	<input id='<?php echo $typeaheadFieldId ?>TagsInput' class='form-control twitter-typeahead' type="text" value="<?php echo $value ?>"  name='<?php echo $args['name']['name'] ?>' />
</div>
<script type="text/javascript">

	$(document).ready(function() {
  		$('.twitter-typeahead').keydown(function(event){
    		if(event.keyCode == 13) {
      			event.preventDefault();
      			return false;
    		}
  		});
	});

	<?php if(!empty($options['typeahead']['data']['local'])){ ?>
		var <?php echo $uuid; ?>_local = <?php echo json_encode($options['typeahead']['data']['local']['data']); ?>;
	<?php } ?>
	
	var <?php echo $uuid; ?>_bloodhound_data = new Bloodhound({
	  		datumTokenizer: Bloodhound.tokenizers.obj.whitespace("<?php echo $typeahead_options['value_term']; ?>"),
	  		queryTokenizer: Bloodhound.tokenizers.whitespace,
	  		limit: <?php echo $typeahead_options['limit']; ?>,
	  		<?php if(!empty($options['typeahead']['data']['local']) && $options['typeahead']['data']['local']['type'] == 'array'){ ?>
	  			local: $.map(<?php echo $uuid; ?>_local, function(one_data) { return { <?php echo $typeahead_options['value_term']; ?>: one_data }; }),
	  		<?php } ?>
	  		<?php if(!empty($options['typeahead']['data']['local']) && $options['typeahead']['data']['local']['type'] == 'key_value'){ ?>
	  			local: <?php echo $uuid; ?>_local,
	  		<?php } ?>
	  		<?php if(!empty($options['typeahead']['data']['prefetch'])){ ?>
	  			prefetch: {
	  				url: "<?php echo $options['typeahead']['data']['prefetch']['url']; ?>",
	  				<?php if($options['typeahead']['data']['prefetch']['type'] == 'array'){ ?>
		  				filter: function(list) {
					      return $.map(list, function(one_data) { return { <?php echo $typeahead_options['value_term']; ?>: one_data }; });
					    }
					<?php } ?>    
	  			},	
	  		<?php } ?>
	  		<?php if(!empty($options['typeahead']['data']['remote'])){ ?>
	  			remote: {
	  				url: "<?php echo $options['typeahead']['data']['remote']['url']; ?>",
	  				<?php if($options['typeahead']['data']['remote']['type'] == 'array'){ ?>
		  				filter: function(list) {
					      return $.map(list, function(one_data) { return { <?php echo $typeahead_options['value_term']; ?>: one_data }; });
					    }
					<?php } ?>    
	  			},	
	  		<?php } ?>

	});
	<?php echo $uuid; ?>_bloodhound_data.initialize();
	
	$('#<?php echo $uuid; ?> .twitter-typeahead').typeahead(null, {
  		name: '<?php echo $uuid; ?>',
  		displayKey: "<?php echo $typeahead_options['value_term']; ?>",
  		source: <?php echo $uuid; ?>_bloodhound_data.ttAdapter()
	})
	<?php if(!empty($options['typeahead']['events'])){ ?>
		<?php foreach ($options['typeahead']['events'] as $key => $event) { ?>
			.on("typeahead:<?php echo $event['type']; ?>", function(object, suggestion){
				<?php echo $event['function']; ?>(object, suggestion);
			})
		<?php } ?>
		
	<?php } ?>	

	;
</script>
