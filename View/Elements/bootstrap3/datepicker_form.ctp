<?php 
	
	
	// add read opnly if set in input options
	$options['readonly'] = !empty($options['readonly'])? 'readonly="readonly"' : null; 

	//add styles to calendar button if read only
	$styles = !empty($options['readonly'])? 'cursor:not-allowed' : null;
	$value = !empty($options['value'])  ? date('Y-m-d h:i:s.u',$options['value']) : 0;
	//debug($options);
	if(!empty($value)){
		$date = new DateTime($value);
		$value = $date->format('m/d/Y');
	}
?>
<div class="form-group">
    <div class='input-group date' id='datetimepicker_<?php echo $inputVals['id'] ?>'>
        <input data-date-format="mm/dd/yyyy" type='text' <?php echo $options['readonly']; ?> class="<?php echo $options['class'] ?>" name="<?php echo $inputVals['name'] ?>" value='<?php echo $value ?>'/>
        <span class="input-group-addon" style='<?php echo $styles?>'><span class="glyphicon glyphicon-calendar" style='<?php echo $styles?>'></span>
        </span>
    </div>
</div>
<script type="text/javascript">
	<?php if (empty($options['readonly'])){ ?>
	   
	   
	    $(function () {
	        $('#datetimepicker_<?php echo $inputVals['id'] ?>').datetimepicker({
	        	'startDate' : <?php echo date('m/d/Y') ?>,
	        	'pickTime' : false,
	        });
	    });
	
	
	<?php } ?>  
</script>