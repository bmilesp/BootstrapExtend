<?php 
	
	
	// add read opnly if set in input options
	$options['readonly'] = !empty($options['readonly'])? 'readonly="readonly"' : null; 

	//add styles to calendar button if read only
	$styles = !empty($options['readonly'])? 'cursor:not-allowed' : null;
	$value = !empty($options['value'])? $options['value'] : 0;
	if(!empty($options['empty']) && empty($value)){
		$value = null;
	}else if(!empty($value)){
		$value = !is_numeric($value) ? strtotime($value) : $value;
		$date = new DateTime(date('Y-m-d h:i:s.u',$value));
		$value = $date->format('m/d/Y');
	}
?>
<div class="form-group">
    <div class='input-group date <?php echo $inputVals['input_wrapper_class'] ?>' id='datetimepicker_<?php echo $inputVals['id'] ?>'>
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