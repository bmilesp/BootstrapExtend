<!DOCTYPE html>
<html>
  <head>
  	<?php echo $this->Html->charset(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->element('BootstrapExtend.layout_requirements/external_resources');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->element('BootstrapExtend.layout_requirements/external_resources_overrides');

	?>
   <title>
		<?php echo $this->fetch('title'); ?>
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
  	<div id='wrap'>
	    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
	    	
	    
	    <div class="pull-right">
	    	
	    </div>
	      <div class="container-full">
	        
	      </div>

	    </div>
		<div style='clear:both'></div>
	    <div class="container-full">
	      <!-- Main component for a primary marketing message or call to action -->
	      <div>
				<div id="content">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
	      </div>
	    </div> <!-- /container -->
	</div>
	<div class="footer">
		
	</div>
	<?php echo $this->element('BootstrapExtend.layout_requirements/ext_block'); ?>
  </body>
</html>
