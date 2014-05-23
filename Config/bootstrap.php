<?php

//layout_requirement assets js
Configure::write('BootstrapExtend.assets.jquery', 'https://code.jquery.com/jquery-2.1.0.min.js');
Configure::write('BootstrapExtend.assets.bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js');
Configure::write('BootstrapExtend.assets.typeahead_bundle', 'BootstrapExtend.typeahead.bundle');
Configure::write('BootstrapExtend.assets.handlebars', '//cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.3.0/handlebars.min.js');
Configure::write('BootstrapExtend.assets.bootstrap-multiselect', 'BootstrapExtend.bootstrap-multiselect');
Configure::write('BootstrapExtend.assets.script', 'BootstrapExtend.script');
Configure::write('BootstrapExtend.assets.jansy-bootstrap', '//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js');
Configure::write('BootstrapExtend.assets.holder','//cdnjs.cloudflare.com/ajax/libs/holder/2.3.1/holder.js');

//layout_requirement assets css
Configure::write('BootstrapExtend.assets.css.pre-bootstrap', 'BootstrapExtend.pre-bootstrap');
Configure::write('BootstrapExtend.assets.css.bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.css');
Configure::write('BootstrapExtend.assets.css.typeahead', 'BootstrapExtend.typeahead');
Configure::write('BootstrapExtend.assets.css.jansy-bootstrap', '//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css');

//default multitoggle assets
Configure::write('BootstrapExtend.autoAssets.css.multitoggle', 'BootstrapExtend.bootstrap-multitoggle');

//default datepicker auto assets	
Configure::write('BootstrapExtend.autoAssets.css.datepicker', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/2.1.20/css/bootstrap-datetimepicker.min.css');
Configure::write('BootstrapExtend.autoAssets.js.moment', '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.0/moment.min.js');
Configure::write('BootstrapExtend.autoAssets.js.datepicker', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/2.1.20/js/bootstrap-datetimepicker.min.js');

//default select auto assets	
Configure::write('BootstrapExtend.autoAssets.css.bootstrap-select', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.css');
Configure::write('BootstrapExtend.autoAssets.js.bootstrap-select', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.js');

//default tagsinput assets	
Configure::write('BootstrapExtend.autoAssets.css.tagsinput', 'BootstrapExtend.bootstrap-tagsinput');
Configure::write('BootstrapExtend.autoAssets.css.tagsinput-extend', 'BootstrapExtend.bootstrap-tagsinput-extend');
Configure::write('BootstrapExtend.autoAssets.js.tagsinput', 'BootstrapExtend.bootstrap-tagsinput.min');