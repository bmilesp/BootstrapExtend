<?php echo $this->element('BootstrapExtend.Modals/loading'); ?>
<?php echo $this->element('BootstrapExtend.Modals/alert'); ?>
<?php echo $this->element('BootstrapExtend.Modals/blank'); ?>
<!-- Bootstrap core JavaScript -->
<!-- Placed at the end of the document so the pages load faster -->
<?php echo $this->fetch('bootstrapExt');?>
<script>
$(document).ready(function(){
    $("[rel=tooltip]").tooltip();
    $('.popover-trigger').popover({
    	html : true
    });
    $('.bootstrap-multiselect').multiselect({
    	numberDisplayed: 100,
    	includeSelectAllOption: true,
    	includeSelectAllDivider: true,
    	enableFiltering: true,
    	enableCaseInsensitiveFiltering: true
    });

});
</script>