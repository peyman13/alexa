<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     use ModelTrait;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xxcategory';
    protected $primaryKey ='xcategoryid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['xcategory_title', 'xcategory_description'];

    protected $selectItem = ['xcategory_title', 'xcategory_description','xcategoryid as xid'];

}
