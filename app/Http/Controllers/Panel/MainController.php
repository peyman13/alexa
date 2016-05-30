<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Model\DateRank;

use Input;
use Auth;
use DB;
use View;


class MainController extends Controller
{
    /**
     * auth base 
     * @return void
    */
    public function __construct()
    {
        // dd(self::sideBar());
        // share
        return View::share("dataShare" , self::sideBar());
        // check auth
        // if (!Auth::check()){
        //     return redirect('auth/login');
        // }
        // share
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
    */
    public function search($list)
    {
        if(Input::get('q')){            
            foreach (Input::get('q') as $key => $value) {
                $list->where($key,array_keys($value)[0],"%".array_values($value)[0]."%");   
            }
        }
        return $list;  
    }

    /**
     * set dynamic sitebar
     *
     * @param int $id
     * @return Response
    */
    public function sideBar()
    {
        // sort by date
        $DateRank = DateRank::select([DB::raw("GROUP_CONCAT(xdate_rankid,':',pmonthname(xdate_rank_timestamp)) as xmonth,pyear(xdate_rank_timestamp) as xyear")])
                ->groupBy(DB::raw('pyear(xdate_rank_timestamp)'))
                ->get()
                ->toArray();
        return $DateRank;         
    }
}
