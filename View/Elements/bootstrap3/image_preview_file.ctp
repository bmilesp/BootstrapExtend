<?php 
	$holder = isset($options['holder']) && $options['holder'] === false? null :  Configure::read('BootstrapExtend.assets.holder').$options['holder'];
?>

<div class="fileinput fileinput-new" data-provides="fileinput">
  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
  	<?php //if(!empty($holder)){ ?>
    	<img data-src="<?php echo $holder ?>" />
    <?php //} ?>
  </div>
  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
  <div>
    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
  </div>
</div>