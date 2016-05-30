<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Rank extends Model
{
     use ModelTrait;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xxrank';
    protected $primaryKey ='xrankid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['xsite_url', 'xsite_description'];

    protected $selectItem = ['xsite_url', 'xsite_description', 'xsiteid as xid'];

    static public function listPanel(){
        $modelObject = new static;

        return $modelObject->select($modelObject->selectItem)/*->groupBy(DB::raw(''));*/;   
    }


}
