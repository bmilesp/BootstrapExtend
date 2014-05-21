<?php
echo $this->Html->script(array(
	'https://code.jquery.com/jquery-2.1.0.min.js',
	//'https://code.jquery.com/ui/1.10.4/jquery-ui.js',
	'BootstrapExtend.bootstrap.min',
	'BootstrapExtend.typeahead.bundle',
	'BootstrapExtend.handlebars-v1.3.0',
	'jquery.tablesorter.min',
	'BootstrapExtend.bootstrap-multiselect',
	'BootstrapExtend.script',
	'script'
));

echo $this->Html->css(array(
	'BootstrapExtend.pre-bootstrap',
	'BootstrapExtend.bootstrap',
	'BootstrapExtend.typeahead',
	'styles'
));
