<?php
namespace SearchBox\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

class SearchBoxHelper extends Helper {

	public $helpers = ['Form', 'Html'];
	protected $_defaultConfig = [];
	
	public function __construct(View $View, array $config = []) {
		parent::__construct($View, $config);
	}

	public function create($model, array $options = []) {
$script=<<<SCRIPT
<script>
//<![CDATA[
    $(function() {
		$( "#reset" ).click(function() {
			$("#filter").val('');
		});
    });
//]]>
</script>
SCRIPT;
		if (!array_key_exists('filter',$options))
			$options['filter'] = [];
		$only = '';
		if (!isset($options['filter_button'])) $options['filter_button']=[];
		if (!isset($options['reset_button'])) $options['reset_button']=[];
		if (array_key_exists('only',$model) && array_key_exists('only',$options) && isset($options['only']['label']))
			$only = $this->Form->input('only', array_merge(['type'=>'checkbox','checked'=>$model['only']],$options['only'])); 
		return $this->Form->create(null, ['type'=>'get','class'=>'search']) .
		$this->Form->input('filter', array_merge(['id'=>'filter','value'=>$model['filter']],$options['filter'])) .
		$only .
		$this->Form->button($this->Html->icon('filter'), array_merge(['escape'=>false], $options['filter_button'])) .
		$this->Form->button($this->Html->icon('remove'), array_merge(['id'=>'reset'],array_merge(['escape'=>false], $options['reset_button']))) .
		$this->Form->end() . 
		$script;
	}
}