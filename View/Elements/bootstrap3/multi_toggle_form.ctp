<?php 
	 $args['selected'] = !empty( $args['selected'])?  $args['selected'] : array();
 ?> 

<input type="hidden" name="<?php echo $args['name']['name'] ?>" value="" id="<?php echo $args['id']['id'] ?>">
<div class="btn-group col col-md-9 multitoggle-input pull-right" data-toggle="buttons">
	<?php foreach(array_flip($args['options']) as $key => $option){
		$checked = null;	
		$class = $args['class'];
		if(in_array($option, $args['selected'])){
			$class = $args['class'] . ' active';
			$checked = 'checked="checked" ';
		} ?>
		<label class="<?php echo $class ?>" for="<?php echo $args['id']['id'].$option ?>">
			 <input class='form-control' type="checkbox" name='<?php echo $args['name']['name'].'[]' ?>' <?php echo $checked ?> value='<?php echo $option?>' id='<?php echo $args['id']['id'].$option ?> '>
			 <?php echo $key ?> 
		</label>
	<?php } 
		echo $this->Form->error($args['fieldName'], null, array('class' => 'help-block text-danger', 'style' => 'clear:both' )); ?>
	&nbsp;
</div>
	