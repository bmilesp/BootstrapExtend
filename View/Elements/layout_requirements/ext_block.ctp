<?php echo $this->element('BootstrapExtend.Modals/loading'); ?>
<?php echo $this->element('BootstrapExtend.Modals/alert'); ?>
<?php echo $this->element('BootstrapExtend.Modals/blank'); ?>
<!-- Bootstrap core JavaScript -->
<!-- Placed at the end of the document so the pages load faster -->
<?php echo $this->fetch('bootstrapExt');?>
<script>


function modalBlank($html){
    $('#modal-blank-template').html($html);
    $('#modal-blank-template').modal('show');
}
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

    //Modal Edit
    $('body').on('click', '.modal-link',function(e){
        
        //Vars
        var $url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: $url
        }).done(function( $html ) {
            modalBlank($html);
        });

        e.preventDefault();
        return false;
    });

    $('body').on('submit', '.modal-submit',function(e){

        //Vars 
        var $url = $(this).attr('action');
        var $method = $(this).attr('method');

        var $data = $(this).serialize();
        console.log($data);
        //modalBlank('');
        //loading('show');
        $.ajax({
            type: $method.toUpperCase(),
            url: $url,
            data: $data
        }).done(function($html) {
            
            //loading('hide');
            modalBlank($html);
        });

        e.preventDefault();
        return false;
    });
});
</script>