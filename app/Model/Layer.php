<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Layer extends Model
{
     use ModelTrait;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xxlayer';
    protected $primaryKey ='xlayerid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['xlayer_title', 'xlayer_parentid'];

    protected $selectItem = ['xlayer_title', 'xlayer_parentid', 'xlayerid as xid'];

    // laye haye bala dasti ro bar migardone xxx/xxx/xxx
    static public function getLayer($id){

        $thisClass = new static;
        $family = []; 
        // get path 
        if ($id){
            do{
                $item = DB::table("xxlayer")->where("xlayerid" ,$id)->first();
                $id = $item->xlayer_parentid;
                $family[]= $item->xlayer_title;
            }while(!empty($id));            
        }


        $family = array_reverse($family);
        
        return implode($family, "/");
    }

}
