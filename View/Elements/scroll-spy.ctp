<script type="text/javascript">
	$(document).ready(function(){
		var $offset = <?php echo json_encode($padding_top); ?>;
	    $('body').scrollspy({target: "#scroll-spy-nav", offset:$offset});
	    $('body').on('click', '.hash-link', function(e){
	    	e.preventDefault();
			var $id = $(this).attr('href');
			$('html, body').animate({
		        scrollTop: $($id).offset().top - ($offset - 1)
		    }, 500);
			return false;
	    });
	});
</script>
<div class="navbar navbar-fixed-top" style="top: 50px; background: rgba(255,255,255,0.95); border-bottom: 1px solid #d9d9d9; padding: 5px 0; z-index: 1 " role="navigation">
	<div class="container-fluid">
    	<div class="row">
			<div class="col-md-12" >
				<div id="scroll-spy-nav" class="pull-left">
		    		<ul class="nav nav-pills">
		    			<?php foreach ($scroll_links as $link => $text) { ?>
		    				<li><?php echo $this->Html->link($text, $link, array('class' => 'hash-link')); ?></li>
		    			<?php } ?>
		    		</ul>
		  		</div>
		  		<div class="pull-right">

		  			<?php if(!empty($show_pagination)){?>
			  		<ul class="pagination" style="margin: 0; padding: 2px 0 0 0">
			  			<?php
			  				$prev_link = $_SERVER['REQUEST_URI'];
			  				if(strstr($prev_link, 'offset')){
			  					$prev_link = preg_replace('/\&offset=\d{1,5}/', '&offset=' . ($offset - $limit), $prev_link);
			  				} else {
			  					$prev_link = $_SERVER['REQUEST_URI'] . '&offset=' . ($offset - $limit);
			  				}
			  			?>	
			  			<?php if(($offset - $limit) >= 0){ ?>
			  				<li><a href="<?php echo $prev_link; ?>"><i class="glyphicon glyphicon-chevron-left"></i></a></li>
			  			<?php } ?>	
			  			
			  			<?php
			  				$next_link = $_SERVER['REQUEST_URI'];
			  				if(strstr($next_link, 'offset')){
			  					$next_link = preg_replace('/\&offset=\d{1,5}/', '&offset=' . ($offset + $limit), $next_link);
			  				} else {
			  					$next_link = $_SERVER['REQUEST_URI'] . '&offset=' . ($offset + $limit);
			  				}
			  				
			  			?>	
			  			<?php if($show_next){ ?>
			  			<li><a>More Results</a></li>
					  	<li><a href="<?php echo $next_link; ?>"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
					  	<?php } ?>
					</ul>
					<?php } ?>
				</div>	
			</div>
		</div>
	</div>	
</div>