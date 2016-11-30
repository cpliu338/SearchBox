<?php
namespace SearchBox\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

class SearchFilterComponent extends Component {
	
	protected $input;
	protected $controller;
	
	public function __construct(ComponentRegistry $registry, array $config = []) {
		parent::__construct($registry, $config);
		$this->input = trim($this->request->query('filter'));
		$this->controller = $registry->getController();
	}
	
	/**
	Populate the search form with prevailing search criteria
	*/
	public function setViewVars() {
		$obj = ['filter'=>$this->input,
		'only'=>$this->onlyChecked()];
		return $this->controller->set('SearchFilterViewVars',$obj);
	}
	
	/**
	Check whether the "only" box was checked
	*/
	public function onlyChecked() {
		return array_key_exists('only',$this->request->query) && $this->request->query('only');
	}
	
	/**
	Get the conditions for filtering
	@param $fields an array of column names for building filter ['name LIKE'=>"%filter%", 'col2 LIKE'=> ...
	@return an array of conditions for use in $model->find->where($our_returned_array)
	*/
	public function conditions(array $fields) {
		$filter = [];
		foreach ($fields as $field) {
			$filter["$field LIKE"] = "%$this->input%";
		}
		return [ 'OR'=> $filter
		];
	}
	
}