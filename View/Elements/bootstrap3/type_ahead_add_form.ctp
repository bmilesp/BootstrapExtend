<?php

/**
 * set useDataKey = false in input options if you want to use the straight input value, else a hidden input 
 * will be added in that will use the key and overwrite the post value of the display input
 * 
 * 
 * typeahead values to be returned fron the server are typeahead_name and id only.  
 * 
 * 
 */
$useDataKey = isset($args['options']['useDataKey']) && $args['options']['useDataKey'] === false? false : true;

/** 
 * value of the input
 * 
 * label here is the split 
 */
$value = !empty($this->request->data[$fieldName['model']][$fieldName['field']])? $this->request->data[$fieldName['model']][$fieldName['field']] : null;

/*
 * set the display value of the input. if useDataKey is set to false,will be the same as $value
 */
$displayValue = ($useDataKey == true && !empty($args['options']['displayValue']))? $args['options']['displayValue'] :  $value;

/*
* Handlebars suggestion template
 */

$handlebarsSuggestionTemplate = !empty($args['options']['handlebarsSuggestionTemplate'])? $args['options']['handlebarsSuggestionTemplate'] : '<p><strong>{{typeahead_label}}</strong></p>';

//$underscored_id = Inflector::underscore($args['id']['id']);
$prefetchPath = !empty($args['options']['prefetchPath'])? $args['options']['prefetchPath'] : null;
$remotePath = !empty($args['options']['remotePath'])? $args['options']['remotePath'] : null;
$prefetch = isset($prefetch)? $prefetch : true;


//form_id used to post data within modal:
$formId = !empty($args['options']['modelContentFormId'])? $args['options']['modelContentFormId'] : null;

//get the field id for use
$typeaheadFieldId = !empty($args['id']['id'])? $args['id']['id'] : null;

//element used for within modal window:
$modalElement = !empty($args['options']['modalContentElement'])? $args['options']['modalContentElement'] : null; 
?>

<div class="<?php echo $args['options']['class'] ?>">
	<div class="input-group form-group">
	  <input type="text" class="form-control typeahead" id="type_ahead_add_<?php echo $args['id']['id'] ?>" name="<?php echo $args['name']['name'] ?>" value="<?php echo $displayValue ?>">
	  
	  <?php if ($useDataKey){ ?>
	  <input type='hidden' id='type_ahead_add_hidden_<?php echo $args['id']['id'] ?>' value="<?php echo $value ?>" name="<?php echo $args['name']['name'] ?>" ?>
	  <?php } ?>
	  
	  <span class="input-group-btn">
	    <button data-toggle="modal"  autocomplete="off" data-target="#type_ahead_add_modal_<?php echo $args['id']['id'] ?>" id="type_ahead_add_button_<?php echo $args['id']['id'] ?>" class="btn btn-success" type="button">New...</button>
	  </span>
	</div><!-- /input-group -->
</div><!-- /.col-lg-6 -->


<?php 

/**
 *  need to create a block in your layout called 'boostCakeExt'
 */

$this->append('boostCakeExt');?>

<div class="modal fade" id="type_ahead_add_modal_<?php echo $args['id']['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

		<div class="form modal-body">
		<?php echo $this->element($modalElement); ?>
		</div>
    </div>
  </div>
</div>


<?php
	/*
	 * for add form modal, if a form id exists, adds the necessary js;
	 */
 if(!empty($formId)){ ?>	


	<script>
	$(document).ready(function(){
	$(document).on('submit', '#<?php echo $formId ?>', function(e){
		field_id = '<?php echo $typeaheadFieldId ?>';
		e.preventDefault(); //STOP default action
		e.stopPropagation();
		var postData = $('#'+e.target.id).serializeArray();
	    var formURL = e.target.action;
	    $.ajax({
	        url : formURL,
	        type: "POST",
	        data : postData,
	        dataType: "json",
	        success:function(data, textStatus, jqXHR){
	        	$('#type_ahead_add_modal_'+field_id).modal('hide');
	        	var displayVal = data['typeahead_label'];
	        	var hiddenVal = data['id'];
	        	$('#type_ahead_add_'+field_id).val(displayVal);
	        	$('#type_ahead_add_hidden_'+field_id).val(hiddenVal);
	        },
	        error: function(data, textStatus, errorThrown) {
	        	$('#'+e.target.id).replaceWith(data.responseText);
	        }
	    });
		return false;	
	});
	
});
</script>

<?php } // end if !empty formId

	/*
	 * for autocomplete:
	 */

if (empty($args['options']['readonly'])){ ?>
	
<script>		
	var bloodhound_<?php echo $typeaheadFieldId ?> = new Bloodhound({
	  datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace('tokens'); },
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  remote: '<?php echo $remotePath ?>'
	  <?php echo !empty($prefetchPath)? ",prefetch: '{$prefetchPath}'" : null; ?>
	});
	 
	bloodhound_<?php echo $typeaheadFieldId ?>.initialize();
	 
	$('#type_ahead_add_<?php echo $typeaheadFieldId ?>').typeahead(null, {
	  displayKey: 'typeahead_label',
	  valueKey: 'id',
	  source: bloodhound_<?php echo $typeaheadFieldId ?>.ttAdapter(),
	  templates: {
	    suggestion: Handlebars.compile('<?php echo $handlebarsSuggestionTemplate ?>')
	  }
	});
	
	<?php if ($useDataKey){ ?>
		
		$('#type_ahead_add_<?php echo $typeaheadFieldId ?>').on("typeahead:selected typeahead:autocompleted", function(e,datum) { 
			console.log(datum);
			$('#type_ahead_add_hidden_<?php echo $typeaheadFieldId ?>').val(datum.id);
		})
		
	<?php } ?>
</script>		
	<?php } ?>  	

<?php $this->end();?>