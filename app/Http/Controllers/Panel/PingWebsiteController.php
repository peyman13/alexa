<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Panel\MainController as MainController;

use App\Model\Layer;
use Input;
use Route;
use Redirect;
use Session;
use Cookie;
use Excel;
use DB;


class PingWebsiteController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $title = 'PingWebsite';

    public function index()
    {
        /* return main view*/
        return view('admin_panel.custom.import');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function import(Request $request)
    {
        $url = base_path() . '/public/777/_tmp';
        
        if (Input::file('excel')->isValid())
        {
            Input::file('excel')->move($url ,"siteList.xlsx");
        }
        DB::table("yysite")->delete();
        Excel:: load($url."/siteList.xlsx", function($reader) {

            // Getting all results
            $results = $reader->select(array('site'))->get();
            foreach ($results as $key => $value) {
                foreach ($value as $k => $val) {
                    DB::table("yysite")->insert(['yysite_url' => $val]);
                }
            }
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function export(Request $request)
    {
        $data = DB::table("yysite")->get();

        $data = json_decode(json_encode($data), true);

        Excel::create('Filename', function($excel) use($data) {
            $excel->sheet('Sheetname', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->download('xls');
    }

}
