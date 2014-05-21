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
<div class='form-group'>
	<?php echo $this->Form->label($label, null, array('class' => 'col col-md-3 control-label', 'for' =>$fieldname.'Min')); ?>
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
			'placeholder' => $placeholderMax, 
			'label' => false,
			'div' => false
		)); ?>
	</div>	
</div>