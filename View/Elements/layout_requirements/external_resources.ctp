<?php
echo $this->Html->script(array(
	Configure::read('BootstrapExtend.assets.jquery'),
	Configure::read('BootstrapExtend.assets.bootstrap'),
	Configure::read('BootstrapExtend.assets.typeahead_bundle'),
	Configure::read('BootstrapExtend.assets.handlebars'),
	Configure::read('BootstrapExtend.assets.bootstrap-multiselect'),
	Configure::read('BootstrapExtend.assets.script'),
	Configure::read('BootstrapExtend.assets.jansy-bootstrap')
));

echo $this->Html->css(array(
	Configure::read('BootstrapExtend.assets.css.pre-bootstrap'),
	Configure::read('BootstrapExtend.assets.css.bootstrap'),
	Configure::read('BootstrapExtend.assets.css.typeahead'),
	Configure::read('BootstrapExtend.assets.css.jansy-bootstrap')
));
