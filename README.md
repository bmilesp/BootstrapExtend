# Bootstrap Extend Plugin

A Simple Yet Configurable Drop-In Solution to Add Twitter Bootstrap to Your Project

---

# Installation


_[Using [Composer](http://getcomposer.org/)]_

[View on Packagist](https://packagist.org/packages/bmilesp/bootstrap_extend), and copy the json snippet for the latest version into your project's `composer.json`. Eg, v. 1.0.0 would look like this:

```javascript
{
	"require": {
		"bmilesp/bootstrap_extend": ""2.1.x-dev"
	}
}
```

_[Manual]_
* Download this: [https://github.com/bmilesp/BootstrapExtend/archive/master.zip](https://github.com/bmilesp/BootstrapExtend/archive/master)
* Unzip that download.
* Copy the resulting folder to `app/Plugin`
* Rename the folder you just copied to `BootstrapExtend


_[GIT Clone]_

In your `Plugin` directory type:

```shell
git clone -b master git://github.com/bmilesp/BootstrapExtend.git Upload
```

# Enable plugin

Add following lines in yout app/Config/bootstrap.php file

	CakePlugin::load('BootstrapExtend', array('bootstrap' => true));

# Usage

Add the following elements into your layout somewhere within the <head></head> tags:

```php
	<?php 
		echo $this->element('BootstrapExtend.layout_requirements/external_resources');
		echo $this->element('BootstrapExtend.layout_requirements/external_resources_overrides'); 
	?>
```

Add the following to the end of the layout before the </body> closing tag:

```php
	<?php echo $this->element('BootstrapExtend.layout_requirements/ext_block'); ?>

```

In your AppController, overload the Form Helper with the following:

```php
	public $helpers = array(
		'Form' => array('className' => 'BootstrapExtend.BootstrapExtForm'),
	);
```
