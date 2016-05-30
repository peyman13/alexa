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


class RankAlexaController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $title = 'RankAlexa';

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

        Excel:: load($url."/siteList.xlsx", function($reader) {

            // Getting all results
            $results = $reader->toArray();
            foreach ($results as $key => $value) {
               $site[]=  strtolower($value['site']);
            }

            $arrayData = array_chunk($site,100);

            foreach ($arrayData as $key => $value) {
                $siteStr[] = implode("," ,$value);
            }
            
            self::export($siteStr);
        
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function export($site)
    {
        $final = array();
        $ch = curl_init();
        // get token
        curl_setopt($ch, CURLOPT_URL,"http://apilifeweb.com/public/api/v1/sessions");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"email=admin@admin.com&password=@dm!n333");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        $server_output = curl_exec ($ch);

        curl_close ($ch);
        $tokenData = json_decode($server_output,true);
        foreach ($site as $key => $value) {
            // check address
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://apilifeweb.com/public/api/v1/alexa/multisite?token='.$tokenData['token'].'&site='.$value);
            // curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
            curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
         
         
            $output = curl_exec($ch);
            curl_close($ch);
            
            $data = json_decode(($output), true);
            // print_r($data);die;
            if(is_array($data)){
                $final = array_merge($final ,$data['data']);
            }

        }       
        self::download($final);
    }

    public function download($data){
       
        Excel::create('Filename', function($excel) use($data) {
                $excel->sheet('Sheetname', function($sheet) use($data) {
                    $sheet->fromArray($data);
                });
        })->download('xls');
    }
}
