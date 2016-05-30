<?php
namespace App\Trait;

trait ModelTrait {
    static public function headerTable(){
		$modelObject = new static;
		return array_merge($modelObject->fillable,$modelObject->appends);
	}

	static public function listPanel(){
		$modelObject = new static;

		return $modelObject->select($modelObject->selectItem);
	}

}