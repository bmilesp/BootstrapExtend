<?php

/**
 * 
 * Requirements:
 * 
 * For any auto modal population elements, add a block called echo $this->fetch('boostCakeExt'); just before 
 * the </body> tag of your layout.
 * 
 * Requres bootstrap.js (and css) and typeahead.bundle.js (and css from ) in app/webroot folders:
 * 
 * http://getbootstrap.com/
 * http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js
 * 
 * 
 */
 
App::uses('FormHelper', 'View/Helper');
class BootstrapExtFormHelper extends FormHelper {

	//tracks auto-added css and js files
	protected $assetsAdded = array();
	
	
	/* mixed cake oop input defaults and boostCakeExt only defaults
	 * 
	 */
	protected $boostCakeDefaults = array(
			'inputDefaults' => array(
				'error' => array(
					'attributes' => array(
						'wrap' => 'span',
						'class' => 'help-block text-danger'
					)
				),
				'div' => 'form-group',
				'wrapInput' => false,
				'label' => array(
                       'class' => ''
               	),
               	'wrapInput' => '',
				'class' => 'form-control',
				'errorClass' => 'has-error'
			),
			'class' => 'well',
			'defaultButton' => 'btn btn-default',
			'defaultButtonToggle' => 'btn btn-default btn-sm',
			
		);

	public function create($model = null, $options = array()) {
		//set boostcake defaults	
		
		$options = array_merge($this->boostCakeDefaults,$options);
		return parent::create($model, $options);	
	}


	public function input($fieldName, $options = array()) {
		$input = null;
		// setup defaults in label guts
		if(!empty($options['label']) && is_string($options['label'])){
			$labelText = $options['label'];
			$options['label'] = array();
			$options['label']['text'] = $labelText;
		}
		
		if(!empty($options['label'])){
			$options['label'] = array_merge($this->boostCakeDefaults['inputDefaults']['label'],$options['label']);
		}
		
		//TODO: force append modelname to fieldname if it doesn't exist here
		if(!strstr($fieldName,'.')){
			$fieldName = $this->defaultModel .'.'. $fieldName;
		}
		
		$div_options = isset($options['wrapInput']) ? $options['wrapInput'] : $this->boostCakeDefaults['inputDefaults']['wrapInput'];
		$options['between'] = !empty($options['between'])? $options['between'] : "<div class='{$div_options}'>";
		$options['after'] = !empty($options['after'])? $options['after'] :'</div>'; 

		if(isset($options['div']) &&  $options['div'] === false){
			unset($options['between']);
			unset($options['after']);
		}

		

		if(!empty($options['type'])){
			if($options['type'] == 'multiToggle'){
				if(empty($this->assetsAdded['bootstrap-multitoggle'])
				){
					$this->Html->css(Configure::read('BootstrapExtend.autoAssets.css.multitoggle'),null, array('inline' => false));
					$this->assetsAdded['bootstrap-multitoggle'] = true;
				}
				
				$options['type'] ='select';
				
				$options['class'] = !empty($options['class']) && $options['class'] != $this->boostCakeDefaults['inputDefaults']['class']? $options['class'] : $this->boostCakeDefaults['defaultButtonToggle'];
				
				$options = $this->_name($options, $fieldName, $key = 'name');
				$options['fieldName'] = $fieldName;
				$options = $this->domId($options, 'id');
				//$opts = $this->_optionsOptions($options);
				//$options['options']['options'] = !empty($opts['options'])? $opts['options'] : array();
				$labelSplit = explode('.',$fieldName);
				$options['label'] = array_pop($labelSplit);
				return $this->_View->element('BootstrapExtend.bootstrap3/multi_toggle_form', array('args' => $options));
			
			}else if($options['type'] == 'typeahead-add'){
				if(!empty($options['options']['options'])){
					$options['options'] = $options['options']['options'];
				} 
				$options['options']['class'] = !empty($options['options']['class']) && $options['options']['class'] != $this->boostCakeDefaults['inputDefaults']['class']? $options['options']['class'] : $this->boostCakeDefaults['inputDefaults']['wrapInput'];
				$options['name'] = $this->_name($options['options'], $options['fieldName'], $key = 'name');
				$options['id'] = $this->domId($options['options'], 'id');
				$options['options']['options'] = !empty($opts['options'])? $opts['options'] : array();
				$fieldName = $this->_splitFieldName($options['fieldName']);

				$returnData = $this->_View->element('BootstrapExtend.bootstrap3/type_ahead_add_form', array(
					'args' => $options,
					'fieldName' => $fieldName,
				));
				$this->defaultModel = $fieldName['model'];
				$input = $returnData;
			}else if ($options['type'] == 'typeahead-tags'){
				if(empty($this->assetsAdded['bootstrap-typeahead-tags'])
				){
					$this->Html->css(Configure::read('BootstrapExtend.autoAssets.css.tagsinput'), null, array('inline' => false));
					$this->Html->css(Configure::read('BootstrapExtend.autoAssets.css.tagsinput-extend'), null, array('inline' => false));
					$this->Html->script(Configure::read('BootstrapExtend.autoAssets.js.tagsinput'), array('inline' => false));
					$this->assetsAdded['bootstrap-typeahead-tags'] = true;
				}
				$options['class'] = !empty($options['class']) && $options['class'] != $this->boostCakeDefaults['inputDefaults']['class']? $options['options']['class'] : $this->boostCakeDefaults['inputDefaults']['wrapInput'];
				$args['name'] = $this->_name($options, $fieldName, $key = 'name');
				$args['id'] = $this->domId($options, 'id');
				$fieldNameParts = $this->_splitFieldName($fieldName);
				

				$input  = $this->_View->element('BootstrapExtend.bootstrap3/typeahead_tags', array(
					'options' => $options,
					'args' => $args,
					'fieldNameParts' =>$fieldNameParts,
					'fieldName' => $fieldName
				));
			} elseif ($options['type'] == 'typeahead-style-numbers'){
				if(empty($this->assetsAdded['bootstrap-typeahead-tags'])
				){
					$this->Html->css(Configure::read('BootstrapExtend.autoAssets.css.tagsinput'), null, array('inline' => false));
					$this->Html->css(Configure::read('BootstrapExtend.autoAssets.css.tagsinput-extend'), null, array('inline' => false));
					$this->Html->script(Configure::read('BootstrapExtend.autoAssets.js.tagsinput'), array('inline' => false));
					$this->assetsAdded['bootstrap-typeahead-tags'] = true;
				}
				$options['class'] = !empty($options['class']) && $options['class'] != $this->boostCakeDefaults['inputDefaults']['class']? $options['options']['class'] : $this->boostCakeDefaults['inputDefaults']['wrapInput'];
				$args['name'] = $this->_name($options, $fieldName, $key = 'name');
				$args['id'] = $this->domId($options, 'id');
				$fieldNameParts = $this->_splitFieldName($fieldName);
				
				$input  = $this->_View->element('BootstrapExtend.bootstrap3/typeahead_tags', array(
					'options' => $options,
					'args' => $args,
					'fieldNameParts' =>$fieldNameParts,
					'fieldName' => $fieldName	
				));
			} elseif($options['type'] == 'typeahead'){

				$options['class'] = !empty($options['class']) && $options['class'] != $this->boostCakeDefaults['inputDefaults']['class']? $options['options']['class'] : $this->boostCakeDefaults['inputDefaults']['wrapInput'];
				$args['name'] = $this->_name($options, $fieldName, $key = 'name');
				$args['id'] = $this->domId($options, 'id');
				$fieldNameParts = $this->_splitFieldName($fieldName);
				
				$uuid = 'hellsdfasfsdo';
				$input  = $this->_View->element('BootstrapExtend.bootstrap3/typeahead', array(
					'options' => $options,
					'args' => $args,
					'fieldNameParts' =>$fieldNameParts,
					'fieldName' => $fieldName,
					'uuid' => $uuid,

				));
			}
		}
		return $this->formInput($fieldName, $options, $input);
	}



	/**
	 * Creates file input widget.
	 *
	 * @param string $fieldName Name of a field, in the form "Modelname.fieldname"
	 * @param array $options Array of HTML attributes.
	 * @return string A generated file input.
	 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#FormHelper::file
	 */
	public function file($fieldName, $options = array()) {

		if($options['type'] == 'imagePreview'){
			if(empty($this->assetsAdded['jasny-bootstrap'])
			){
				$this->Html->css(Configure::read('BootstrapExtend.assets.css.jasny-bootstrap'), null, array('inline' => false));
				$this->Html->script(Configure::read('BootstrapExtend.assets.jasny-bootstrap'), array('inline' => false));
				$this->Html->script(Configure::read('BootstrapExtend.assets.holder'), array('inline' => false));
				
				$this->assetsAdded['jasny-bootstrap'] = true;
			}

			$options += array('secure' => true);
			$secure = $options['secure'];
			$options['secure'] = self::SECURE_SKIP;

			$options = $this->_initInputField($fieldName, $options);
			$field = $this->entity();

			foreach (array('name', 'type', 'tmp_name', 'error', 'size') as $suffix) {
				$this->_secure($secure, array_merge($field, array($suffix)));
			}

			//return $this->Html->useTag('file', $options['name'], array_diff_key($options, array('name' => '')));
			return $this->_View->element('BootstrapExtend.bootstrap3/image_preview_file', array('options' => $options));
		}
			
		return parent::file($fieldname, $options);
	}



	public function tagIsInvalid() {
		$entity = $this->entity();
		$model = array_shift($entity);

		// 0.Model.field. Fudge entity path
		if (empty($model) || is_numeric($model)) {
			array_splice($entity, 1, 0, $model);
			$model = array_shift($entity);
		}

		$errors = array();
		if (!empty($entity) && isset($this->validationErrors[$model])) {
			$errors = $this->validationErrors[$model];
		}
		if (!empty($entity) && empty($errors)) {
			$errors = $this->_introspectModel($model, 'errors');
		}
		if (empty($errors)) {
			return false;
		}

		$return = null;
		if(array_key_exists(implode('.', $entity), $errors)){
			$return = $errors[implode('.', $entity)];
		}
		
		
		return $return === null ? false : $return;
	}

/**
 * completely override form input to inject a few lines. can see why they added _getInput in 2.2 now to more easily override and switch types
 * 
 */
	public function formInput($fieldName, $options = array(), $input = null){

		$this->setEntity($fieldName);

		$options = array_merge(
			array('before' => null, 'between' => null, 'after' => null, 'format' => null),
			$this->_inputDefaults,
			$options
		);

		$modelKey = $this->model();
		$fieldKey = $this->field();

		if (!isset($options['type'])) {
			$magicType = true;
			$options['type'] = 'text';
			if (isset($options['options'])) {
				$options['type'] = 'select';
			} elseif (in_array($fieldKey, array('psword', 'passwd', 'password'))) {
				$options['type'] = 'password';
			} elseif (isset($options['checked'])) {
				$options['type'] = 'checkbox';
			} elseif ($fieldDef = $this->_introspectModel($modelKey, 'fields', $fieldKey)) {
				$type = $fieldDef['type'];
				$primaryKey = $this->fieldset[$modelKey]['key'];
			}

			if (isset($type)) {
				$map = array(
					'string' => 'text', 'datetime' => 'datetime',
					'boolean' => 'checkbox', 'timestamp' => 'datetime',
					'text' => 'textarea', 'time' => 'time',
					'date' => 'date', 'float' => 'number',
					'integer' => 'number'
				);

				if (isset($this->map[$type])) {
					$options['type'] = $this->map[$type];
				} elseif (isset($map[$type])) {
					$options['type'] = $map[$type];
				}
				if ($fieldKey == $primaryKey) {
					$options['type'] = 'hidden';
				}
				if (
					$options['type'] === 'number' &&
					$type === 'float' &&
					!isset($options['step'])
				) {
					$options['step'] = 'any';
				}
			}
			if (preg_match('/_id$/', $fieldKey) && $options['type'] !== 'hidden') {
				$options['type'] = 'select';
			}

			if ($modelKey === $fieldKey) {
				$options['type'] = 'select';
				if (!isset($options['multiple'])) {
					$options['multiple'] = 'multiple';
				}
			}
		}
		$types = array('checkbox', 'radio', 'select');

		if (
			(!isset($options['options']) && in_array($options['type'], $types)) ||
			(isset($magicType) && $options['type'] == 'text')
		) {
			$varName = Inflector::variable(
				Inflector::pluralize(preg_replace('/_id$/', '', $fieldKey))
			);
			$varOptions = $this->_View->getVar($varName);
			if (is_array($varOptions)) {
				if ($options['type'] !== 'radio') {
					$options['type'] = 'select';
				}
				$options['options'] = $varOptions;
			}
		}

		$autoLength = (!array_key_exists('maxlength', $options) && isset($fieldDef['length']));
		if ($autoLength && $options['type'] == 'text') {
			$options['maxlength'] = $fieldDef['length'];
		}
		if ($autoLength && $fieldDef['type'] == 'float') {
			$options['maxlength'] = array_sum(explode(',', $fieldDef['length'])) + 1;
		}

		$divOptions = array();
		$div = $this->_extractOption('div', $options, true);

		unset($options['div']);

		if (!empty($div)) {
			$divOptions['class'] = 'input';
			$divOptions = $this->addClass($divOptions, $options['type']);
			if (is_string($div)) {
				$divOptions['class'] = $div;
			} elseif (is_array($div)) {
				$divOptions = array_merge($divOptions, $div);
			}
			if ($this->_introspectModel($modelKey, 'validates', $fieldKey)) {
				$divOptions = $this->addClass($divOptions, 'required');
			}
			if (!isset($divOptions['tag'])) {
				$divOptions['tag'] = 'div';
			}
		}

		$label = null;
		if (isset($options['label']) && $options['type'] !== 'radio') {
			$label = $options['label'];
			unset($options['label']);
		}

		if ($options['type'] === 'radio') {
			$label = false;
			if (isset($options['options'])) {
				$radioOptions = (array)$options['options'];
				unset($options['options']);
			}
		}

		if ($label !== false) {
			$label = $this->_inputLabel($fieldName, $label, $options);
		}


		$error = $this->_extractOption('error', $options, null);
		unset($options['error']);

		$selected = $this->_extractOption('selected', $options, null);
		unset($options['selected']);

		if (isset($options['rows']) || isset($options['cols'])) {
			$options['type'] = 'textarea';
		}

		if ($options['type'] === 'datetime' || $options['type'] === 'date' || $options['type'] === 'time' || $options['type'] === 'select') {
			$options += array('empty' => false);
		}
		if ($options['type'] === 'datetime' || $options['type'] === 'date' || $options['type'] === 'time') {
			$dateFormat = $this->_extractOption('dateFormat', $options, 'MDY');
			$timeFormat = $this->_extractOption('timeFormat', $options, 12);
			unset($options['dateFormat'], $options['timeFormat']);
		}

		$type = $options['type'];
		$out = array_merge(
			array('before' => null, 'label' => null, 'between' => null, 'input' => null, 'after' => null, 'error' => null),
			array('before' => $options['before'], 'label' => $label, 'between' => $options['between'], 'after' => $options['after'])
		);
		$format = null;
		if (is_array($options['format']) && in_array('input', $options['format'])) {
			$format = $options['format'];
		}

		unset($options['type'], $options['before'], $options['between'], $options['after'], $options['format']);
		if(empty($input)){
			switch ($type) {

				case 'hidden':
					$input = $this->hidden($fieldName, $options);
					$format = array('input');
					unset($divOptions);
				break;
				case 'checkbox':
					$input = $this->checkbox($fieldName, $options);
					$format = $format ? $format : array('before', 'input', 'between', 'label', 'after', 'error');
				break;
				case 'radio':
					if (isset($out['between'])) {
						$options['between'] = $out['between'];
						$out['between'] = null;
					}
					$input = $this->radio($fieldName, $radioOptions, $options);
				break;
				case 'file':
					$input = $this->file($fieldName, $options);
				break;
				case 'select':
					$options += array('options' => array(), 'value' => $selected);
					$list = $options['options'];
					unset($options['options']);
					if(!empty($options['multiple'])){
						$divOptions['class'] .= ' bootstrap-multiselect-wrap';
					}
					$input = $this->select($fieldName, $list, $options);
				break;
				case 'time':
					$options['value'] = $selected;
					$input = $this->dateTime($fieldName, null, $timeFormat, $options);
				break;
				case 'date':
					$options['value'] = $selected;
					$input = $this->dateTime($fieldName, $dateFormat, null, $options);
				break;
				case 'datetime':
					$options['value'] = $selected;
					$input = $this->dateTime($fieldName, $dateFormat, $timeFormat, $options);
				break;
				case 'textarea':
					$input = $this->textarea($fieldName, $options + array('cols' => '30', 'rows' => '6'));
				break;
				case 'url':
					$input = $this->text($fieldName, array('type' => 'url') + $options);
				break;
				case 'button_group':
					$input = $this->buttonGroup($fieldName, $options, $label);
					
				break;
				default:
					$input = $this->{$type}($fieldName, $options);
			}
		}

		
		if ($type != 'hidden' && $error !== false) {
			$errMsg = $this->error($fieldName, $error);

			if ($errMsg) {
				$divOptions = $this->addClass($divOptions, $this->_inputDefaults['errorClass']);
				$out['error'] = $errMsg;
				
			}
		}

		$out['input'] = $input;
		$format = $format ? $format : array('before', 'label', 'between', 'input', 'after', 'error');
		$output = '';
		foreach ($format as $element) {
			$output .= $out[$element];
			unset($out[$element]);
		}

		if (!empty($divOptions['tag'])) {
			$tag = $divOptions['tag'];
			unset($divOptions['tag']);
			$output = $this->Html->tag($tag, $output, $divOptions);
		}
		return $output;
	}

	public function buttonGroup($fieldName, $options = array(), $label = null){
		$input_data = $this->_initInputField($fieldName);

		$type = 'radio';
		if(isset($options['multiple']) && $options['multiple'] === true){
			$type = 'checkbox';
		}
		if(sizeof($options['options']) > 0 && sizeof($options['options']) <= 5){
			$orientation = 'btn-group btn-group-justified';
		} elseif(sizeof($options['options']) > 5 && sizeof($options['options']) <= 8){
			$orientation = 'btn-group-vertical btn-block';
		}
		$html = '<div class="form-group">';
			$html .= $label;
			$html .= '<div class="' . $orientation . '" data-toggle="buttons">';
				foreach ($options['options'] as $key => $option) {
					$active = false;
					$fieldCheck = str_replace($this->model(), '', $fieldName);
					$fieldCheck = str_replace('.', '', $fieldCheck);
					$active = false;
					if(isset($this->request->data[$this->model()][$fieldCheck]) && $this->request->data[$this->model()][$fieldCheck] == $key){
						$active = true;
					}
					//debug($this->request->data[$this->model()]);
					/*
					if(isset($this->request->data[$this->model()][$fieldName])){
						$check_options = array();
						foreach ($this->request->data[$this->model()][$fieldName] as $field_key => $field_name) {
							$check_options[] = trim($field_name);;
						}
						$active = in_array($key, $check_options) ? true : false;
					} elseif(isset($this->request->query[$fieldName])){
						$check_options = array();
						foreach ($this->request->query[$fieldName] as $field_key => $field_name) {
							$check_options[] = trim($field_name);;
						}
						$active = in_array($key, $check_options) ? true : false;
					}
					*/
					$active_class = $active ? 'active' : null;
					$active_checked = $active ? 'checked' : null;
					$html .= '<label class="btn btn-default ' . $active_class .'">';
						$name_array = $this->_name();
						//debug(array_shift($name_array));
						$html .= '<input id="' . $input_data['id'] .'" name="' . array_shift($name_array) . '" type="' . $type . '" value="' . $key . '" ' . $active_checked . '> ' . $option;
						$html .= '<span class="pull-right glyphicons ok_2 checkmark"></span>';
					$html .= '</label>';
				}
			$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}


	/*
	 * 
	 * default uses http://eonasdan.github.io/bootstrap-datetimepicker/
	 * which is included in BootstrapExtend.webroot css/js/less folders
	 * 
	 */
	public function dateTime($fieldName, $dateFormat = 'DMY', $timeFormat = '12', $attributes = array()) {
		
		//auto add assets	
		$autoSetAssets = ($this->useAutoAssets === false)? false : true;
		$autoSetAssets = !empty($attributes['useAutoAssets'])? $attributes['useAutoAssets'] : $autoSetAssets;

		if(empty($this->assetsAdded['bootstrap-datepicker'])
			&& $autoSetAssets !== false
		){
			$this->Html->css(Configure::read('BootstrapExtend.autoAssets.css.datepicker'), null, array('inline' => false));
			$this->Html->script(Configure::read('BootstrapExtend.autoAssets.js.moment'), array('inline' => false));
			$this->Html->script(Configure::read('BootstrapExtend.autoAssets.js.datepicker'), array('inline' => false));
			$this->assetsAdded['bootstrap-datepicker'] = true;
		}	
		
		$attributes += array('empty' => true, 'value' => null);
		$year = $month = $day = $hour = $min = $meridian = null;
		
		if (empty($attributes['value'])) {
			$attributes = $this->value($attributes, $fieldName);
		}
		
		if ($attributes['value'] === null && $attributes['empty'] != true) {
			$attributes['value'] = time();
			if (!empty($attributes['maxYear']) && $attributes['maxYear'] < date('Y')) {
				$attributes['value'] = strtotime(date($attributes['maxYear'] . '-m-d'));
			}
		}

		if (!empty($attributes['value'])) {
			list($year, $month, $day, $hour, $min, $meridian) = $this->_getDateTimeValue(
				$attributes['value'],
				$timeFormat
			);
		}

		$defaults = array(
			'minYear' => null, 'maxYear' => null, 'separator' => '-',
			'interval' => 1, 'monthNames' => true, 'round' => null
		);
		$attributes = array_merge($defaults, (array)$attributes);
		
		if (isset($attributes['minuteInterval'])) {
			$attributes['interval'] = $attributes['minuteInterval'];
			unset($attributes['minuteInterval']);
		}
		$minYear = $attributes['minYear'];
		$maxYear = $attributes['maxYear'];
		$separator = $attributes['separator'];
		$interval = $attributes['interval'];
		$monthNames = $attributes['monthNames'];
		$round = $attributes['round'];
		
		$attributes = array_diff_key($attributes, $defaults);
		
		
		if (!empty($interval) && $interval > 1 && !empty($min)) {
			$current = new DateTime();
			if ($year !== null) {
				$current->setDate($year, $month, $day);
			}
			if ($hour !== null) {
				$current->setTime($hour, $min);
			}
			$changeValue = $min * (1 / $interval);
			switch ($round) {
				case 'up':
					$changeValue = ceil($changeValue);
					break;
				case 'down':
					$changeValue = floor($changeValue);
					break;
				default:
					$changeValue = round($changeValue);
			}
			$change = ($changeValue * $interval) - $min;
			$current->modify($change > 0 ? "+$change minutes" : "$change minutes");
			$format = ($timeFormat == 12) ? 'Y m d h i a' : 'Y m d H i a';
			$newTime = explode(' ', $current->format($format));
			list($year, $month, $day, $hour, $min, $meridian) = $newTime;
		}
		
		$keys = array('Day', 'Month', 'Year', 'Hour', 'Minute', 'Meridian');
		$attrs = array_fill_keys($keys, $attributes);

		$hasId = isset($attributes['id']);
		if ($hasId && is_array($attributes['id'])) {
			// check for missing ones and build selectAttr for each element
			$attributes['id'] += array(
				'month' => '',
				'year' => '',
				'day' => '',
				'hour' => '',
				'minute' => '',
				'meridian' => ''
			);
			foreach ($keys as $key) {
				$attrs[$key]['id'] = $attributes['id'][strtolower($key)];
			}
		}
		if ($hasId && is_string($attributes['id'])) {
			// build out an array version
			foreach ($keys as $key) {
				$attrs[$key]['id'] = $attributes['id'] . $key;
			}
		}

		if (is_array($attributes['empty'])) {
			$attributes['empty'] += array(
				'month' => true,
				'year' => true,
				'day' => true,
				'hour' => true,
				'minute' => true,
				'meridian' => true
			);
			foreach ($keys as $key) {
				$attrs[$key]['empty'] = $attributes['empty'][strtolower($key)];
			}
		}
		
		
		$selects = array();
		foreach (preg_split('//', $dateFormat, -1, PREG_SPLIT_NO_EMPTY) as $char) {
			switch ($char) {
				case 'Y':
					$attrs['Year']['value'] = $year;
					$selects[] = $this->year(
						$fieldName, $minYear, $maxYear, $attrs['Year']
					);
					break;
				case 'M':
					$attrs['Month']['value'] = $month;
					$attrs['Month']['monthNames'] = $monthNames;
					$selects[] = $this->month($fieldName, $attrs['Month']);
					break;
				case 'D':
					$attrs['Day']['value'] = $day;
					$selects[] = $this->day($fieldName, $attrs['Day']);
					break;
			}
		}
		$opt = '';
		$attrs['Minute']['interval'] = $interval;
		switch ($timeFormat) {
			case '24':
				$attrs['Hour']['value'] = $hour;
				$attrs['Minute']['value'] = $min;
				$opt .= $this->hour($fieldName, true, $attrs['Hour']) . ':' .
				$this->minute($fieldName, $attrs['Minute']);
				break;
			case '12':
				$attrs['Hour']['value'] = $hour;
				$attrs['Minute']['value'] = $min;
				$attrs['Meridian']['value'] = $meridian;
				$opt .= $this->hour($fieldName, false, $attrs['Hour']) . ':' .
				$this->minute($fieldName, $attrs['Minute']) . ' ' .
				$this->meridian($fieldName, $attrs['Meridian']);
				break;
		}
		
		$inputVals = $this->_initInputField($fieldName, array_merge(
			(array)$attributes, array('secure' => self::SECURE_SKIP)
		));
		$model = $this->defaultModel;
		$fieldName = $this->_splitFieldName($fieldName);
		$opt = $this->_View->element('BootstrapExtend.bootstrap3/datepicker_form', array(
			'attrs' => $attrs,
			'inputVals' => $inputVals,
			'options' => $attributes,
			'model' => $model,
			'fieldName' => $fieldName
		));
		return $opt;
	}



	public function select($fieldName, $options = array(), $attributes = array()) {
		//auto add assets
		$autoSetAssets = ($this->useAutoAssets === false)? false : true;
		$autoSetAssets = !empty($attributes['useAutoAssets'])? $attributes['useAutoAssets'] : $autoSetAssets;
			
		if(	empty($this->assetsAdded['bootstrap-select'])
			&& $autoSetAssets !== false
		){
			$this->Html->css(Configure::read('BootstrapExtend.autoAssets.css.bootstrap-select'), null, array('inline' => false));
			$this->Html->script(Configure::read('BootstrapExtend.autoAssets.js.bootstrap-select'), array('inline' => false));
			
			$init = '$(function () {'."\n";
			$init .= '$(".selectpicker").selectpicker();'."\n";
			$init .= '});'."\n";
			
			$this->Html->scriptBlock(
			    $init,
			    array('inline' => false)
			);

			$this->assetsAdded['bootstrap-select'] = true;
		}	
		
		$select = array();
		$style = null;
		$tag = null;
		
		if(!empty($attributes['class']) && empty($attributes['multiple']) && $attributes['class'] == $this->boostCakeDefaults['inputDefaults']['class']){
			$attributes['class'] = 'selectpicker form-control';
		}
		//debug($attributes);
		$attributes += array(
			'class' => null,
			'escape' => true,
			'secure' => true,
			'empty' => '',
			'showParents' => false,
			'hiddenField' => true,
			'disabled' => false
		);
		
		$escapeOptions = $this->_extractOption('escape', $attributes);
		$secure = $this->_extractOption('secure', $attributes);
		$showEmpty = $this->_extractOption('empty', $attributes);
		$showParents = $this->_extractOption('showParents', $attributes);
		$hiddenField = $this->_extractOption('hiddenField', $attributes);
		unset($attributes['escape'], $attributes['secure'], $attributes['empty'], $attributes['showParents'], $attributes['hiddenField']);
		$id = $this->_extractOption('id', $attributes);

		$attributes = $this->_initInputField($fieldName, array_merge(
			(array)$attributes, array('secure' => self::SECURE_SKIP)
		));

		if (is_string($options) && isset($this->_options[$options])) {
			$options = $this->_generateOptions($options);
		} elseif (!is_array($options)) {
			$options = array();
		}
		if (isset($attributes['type'])) {
			unset($attributes['type']);
		}

		//remove required attribute so html5 doesn't try to focus on hidden input
		if(!empty($attributes['required'])){
			unset($attributes['required']);
		}
		
		if (!empty($attributes['multiple'])) {
			$style = ($attributes['multiple'] === 'checkbox') ? 'checkbox' : null;
			$template = ($style) ? 'checkboxmultiplestart' : 'selectmultiplestart';
			$tag = $template;
			if ($hiddenField) {
				$hiddenAttributes = array(
					'value' => '',
					'id' => $attributes['id'] . ($style ? '' : '_'),
					'secure' => false,
					'name' => $attributes['name']
				);
				$select[] = $this->hidden(null, $hiddenAttributes);
			}
			$attributes['class'] .= ' bootstrap-multiselect';
			$this->boostCakeDefaults['inputDefaults']['div'] .= ' bootstrap-multiselect-wrap';
			

		} else {
			$tag = 'selectstart';
		}

		if ($tag === 'checkboxmultiplestart') {
			unset($attributes['required']);
		}

		if (!empty($tag) || isset($template)) {
			$hasOptions = (count($options) > 0 || $showEmpty);
			// Secure the field if there are options, or its a multi select.
			// Single selects with no options don't submit, but multiselects do.
			if (
				(!isset($secure) || $secure) &&
				empty($attributes['disabled']) &&
				(!empty($attributes['multiple']) || $hasOptions)
			) {
				$this->_secure(true, $this->_secureFieldName($fieldName));
			}
			$select[] = $this->Html->useTag($tag, $attributes['name'], array_diff_key($attributes, array('name' => null, 'value' => null)));
		}
		$emptyMulti = (
			$showEmpty !== null && $showEmpty !== false && !(
				empty($showEmpty) && (isset($attributes) &&
				array_key_exists('multiple', $attributes))
			)
		);

		if ($emptyMulti) {
			$showEmpty = ($showEmpty === true) ? '' : $showEmpty;
			$options = array('' => $showEmpty) + $options;
		}

		if (!$id) {
			$attributes['id'] = Inflector::camelize($attributes['id']);
		}
		
		$select = array_merge($select, $this->_selectOptions(
			array_reverse($options, true),
			array(),
			$showParents,
			array(
				'escape' => $escapeOptions,
				'style' => $style,
				'name' => $attributes['name'],
				'value' => $attributes['value'],
				'class' => $attributes['class'],
				'id' => $attributes['id'],
				'disabled' => $attributes['disabled'],
			)
		));
		$template = ($style === 'checkbox') ? 'checkboxmultipleend' : 'selectend';
		$select[] = $this->Html->useTag($template);
		return implode("\n", $select);
	}


	public function submit($caption = null, $options = array()) {
		$options['class'] = !empty($attributes['class'])? $attributes['class'].' '. $this->defaultStypeGroups['defaultButton'] : $this->defaultStypeGroups['defaultButton'];
	
		return parent::submit($caption, $options);
	}
	
	public function _splitFieldName($fieldName){
		$fieldSplit = explode('.',$fieldName);
		$fieldName = array_pop($fieldSplit);
		$modelName = array_shift($fieldSplit);
		$modelName = !empty($modelName)? $modelName : $this->defaultModel;
		$fieldName = array('field' => $fieldName, 'model' => $modelName);
		return $fieldName;
	}

}
