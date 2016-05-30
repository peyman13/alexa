<?php
namespace App\Model;

use DB;

trait ModelTrait {
    static public function headerTable(){
		$modelObject = new static;
		
		return array_merge($modelObject->fillable,$modelObject->appends);
	}

	static public function listPanel(){
		$modelObject = new static;

		return $modelObject->select($modelObject->selectItem);
	}

	static public function tableObject(){
		$modelObject = new static;

		return DB::table($modelObject->table);
	}

	static public function getEnum($enumName ,$translate){
		$modelObject = new static;

		$arraySchema = json_decode(json_encode((DB::select("DESCRIBE ".$modelObject->table))), TRUE);
		foreach ($arraySchema as $key => $value) {
			$enum[$value['Field']] = $value['Type'];
		}
		$enumString = str_replace(["enum(",")","'"], ["","",""], $enum[$enumName]);
		$enumArray = explode(",", $enumString);
		foreach ($enumArray as $key => $value){
			$k = $value;
			if($translate){
				$value = trans($translate.".".$value);
			}
			$list[$k] = $value;
		} 

		return $list;
	}
}