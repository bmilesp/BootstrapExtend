<?php echo $this->element('BootstrapExtend.Modals/loading'); ?>
<?php echo $this->element('BootstrapExtend.Modals/alert'); ?>
<?php echo $this->element('BootstrapExtend.Modals/blank'); ?>
<!-- Bootstrap core JavaScript -->
<!-- Placed at the end of the document so the pages load faster -->
<?php echo $this->fetch('bootstrapExt');?>
<script>
$(function(){

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

$(function(){
  var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
  });
});
</script>

