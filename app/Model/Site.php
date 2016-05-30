<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model; 

class Site extends Model
{
     use ModelTrait;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xxsite';
    protected $primaryKey ='xsiteid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['xsite_url', 'xsite_description', 'xsite_title' , 'xsite_location' ,'xsite_status'];

    protected $selectItem = ['xsite_url', 'xsite_description', 'xsite_title' , 'xsite_location','xsite_status' ,'xxsite.xsiteid as xid', 'xrank_number'];


}
