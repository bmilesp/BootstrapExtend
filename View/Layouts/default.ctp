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

	    	<div class="container">
	    		<div class="navbar-header">
			    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			       		<span class="sr-only">Toggle navigation</span>
			        		<span class="icon-bar"></span>
			        		<span class="icon-bar"></span>
			        		<span class="icon-bar"></span>
			      	</button>
			      	<a class="navbar-brand" href="#">UGP</a>
			    </div>
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    	<ul class="nav navbar-nav navbar-right">
			    		<?php if(!empty($auth)){ ?>
			    			<li>
			    				<?php 
			    					echo $this->Html->link('Logout', array(
			    							'admin' => true,
			    							'plugin' => false,
			    							'controller' => 'accounts',
			    							'action' => 'logout'
			    						)
			    					);
			    				?>
			    			</li>
			    		<?php } ?>
			    	</ul>
			    </div>	
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
