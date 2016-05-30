<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerCellphone extends Model
{
     use ModelTrait;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xxcustomer_cellphone';
    protected $primaryKey ='xcustomer_cellphoneid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['xcustomer_cellphoneid', 'xcustomerid', 'xcustomer_cellphone'];

    // protected $selectItem = ['xcustomer_name', 'xcustomer_family', 'xcustomer_cellphone','xcustomerid as xid'];

}
