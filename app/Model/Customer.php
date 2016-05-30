<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
     use ModelTrait;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xxcustomer';
    protected $primaryKey ='xcustomerid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['xcustomer_name', 'xcustomer_family', 'xcustomer_cellphone'];

    protected $selectItem = ['xcustomer_name', 'xcustomer_family', 'xcustomer_cellphone','xcustomerid as xid'];

}
