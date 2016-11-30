CakePHP 3.x Helpers for SearchBox
=================================

CakePHP 3.0 Component and Helper to implement search function.  

The SearchBoxHelper's main objective is to output an 
HTML form (using method = GET) with a text input for a filter pattern: a text for matching 1 or more text columns.  
There is an option for a checkbox giving a second filter criteria based on a boolean.  

The SearchFilterComponent Component lets you: 
1) setViewVars to populate the search form; 
2) read the filter conditions that the user has input

How to... ?
===========

**Installation**

Pre-requisite: Jquery

```php
// in config/bootstrap.php
Plugin::load('SearchBox', ['autoload' => true]);
```

```php
// in your layout or template
<head>
<?= $this->Html->css('SearchBox.styles') ?>
</head>

// in your Controller
public $helpers = [
    'SearchBox.SearchBox',
] ;

public function index() {
	$this->loadComponent('SearchBox.SearchFilter');
    	$models = $this->paginate($this->Holders->find()->where(
    		$this->SearchFilter->conditions(['name'])
    		/* ['name',..] is an array of columns for filter
    		that gives you ['name LIKE'=>"%filter%", 'col2 LIKE'=> ...
    		*/
		));
		// Set the values to populate the search form according to prevailing filter conditions
		$this->SearchFilter->setViewVars();
}

// in your Template, 
    <?= $this->SearchBox->create(null, [
    	'input'=>['value'=>$value, 'label'=>'name contains'],
    	'filter_button'=>['class'=>'filter'],
    	'reset_button'=>['class'=>'reset']
	])?>


// button have pre-defined classes if using Bootstrap FormHelper, use bootstrap-type instead of class
    <?= $this->SearchBox->create(null, [
    	'input'=>['value'=>$value, 'label'=>'name contains'],
    	'filter_button'=>['bootstrap-type'=>'primary'],
    	'reset_button'=>['bootstrap-type'=>'default']
	])?>

```
---

**Documentation**

The full plugin documentation is available at https://example.com