<?php 




	$fieldname = !empty($fieldname)? $fieldname : 'blank';
	$placeholder = !empty($placeholder)? $placeholder : '';
	
	$placeholderMax = !empty($placeholderMax)? $placeholderMax : $placeholder;
	$placeholderMin = !empty($placeholderMin)? $placeholderMin : $placeholder;
	
	$label = !empty($label)? $label : Inflector::humanize($fieldname) . 'Between';
/*
		will create two inputs for a range search. appends a '_min' and '_max' to the fieldname for each input
 */
?>
<div class='form-group range-inputs' style="padding: 10px 0 0 0">
	<?php echo $this->Form->label($label, null, array('class' => 'pull-left control-label', 'for' =>$fieldname.'Min')); ?>
	<div class='col-md-2'>
		<?php echo $this->Form->input($fieldname.'_min',array(
			'class' => 'form-control', 
			'placeholder' => $placeholderMin, 
			'label' => false,
			'div' => false
		)); ?>
	</div>
	<div class='col-md-1 range-and-div'>
		And
	</div>
	<div class='col-md-2'>
		<?php echo $this->Form->input($fieldname.'_max',array(
			'class' => 'form-control', 
			'placeholder' => '0.00', 
			'label' => false,
			'div' => false
		)); ?>
	</div>	
	<div class="clearfix"></div>
</div>