<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model; 

class DateRank extends Model
{
    use ModelTrait;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xxdate_rank';
    protected $primaryKey ='xdate_rankid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['xdate_rank_timestamp'];

    protected $selectItem = ['xdate_rank_timestamp', 'xxdate_rank.xdate_rankid as xid'];


}
