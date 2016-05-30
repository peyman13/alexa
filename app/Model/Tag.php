<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
     use ModelTrait;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xxtag';
    protected $primaryKey ='xtagid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['xtagid', 'xcategoryid', 'xtag_title'];

    // protected $selectItem = ['xcustomer_name', 'xcustomer_family', 'xcustomer_cellphone','xcustomerid as xid'];

}
