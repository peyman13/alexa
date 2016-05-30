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
use DB;


class ApiClientController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $title = 'ApiClient';

    public function api(){
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

        
        // get site
        // http://apilifeweb.com/public/api/v1/alexa/rankAlexa?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvYXBpXC9wdWJsaWNcL2FwaVwvdjFcL3Nlc3Npb25zIiwiaWF0IjoiMTQ2MzU0NDkxNyIsImV4cCI6IjE0NjM1NzQ5MTciLCJuYmYiOiIxNDYzNTQ0OTE3IiwianRpIjoiMzY1MDY1ZGQ3ZDMxZDY5NTY1NzY3ZjY4MTAyMGUxOTQifQ.2O-5v33ikH0gPam79LYVXanqIDN0LGAw2D0myJ6M6ps&join=yes&where_value=2016-02&count=500&page=1&sort=rank&sort_type=asc
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://apilifeweb.com/public/api/v1/alexa/rankAlexa?token='.$tokenData['token'].'&join=yes&count=500&page=1&sort=rank&where_value=2016-04&sort_type=asc&field');
        curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
     
     
        $output = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($output,true)['data'];

        foreach ($data as $key => $value) {
            $res = DB::table('xxsite')->where("website_id",$value['website_id'])->first();
            $in = ["xsiteid" => $res->xsiteid ,"xdate_rankid" => 17 ,"xrank_number" => $value['rank']];
            DB::table('xxrank')->insert($in);
        }
        die;

        // get rank
// select * from website_ranks where DATE_FORMAT(request_time,"%Y-%m-%d") = "2014-01-28" order by rank asc limit 500
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, 'http://apilifeweb.com/public/api/v1/alexa/rankAlexa?token='.$tokenData['token'].'&count=500&page=1&sort=id&sort_type=asc&field');
        // curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
        // curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        // curl_setopt($ch, CURLOPT_HEADER, 0);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 10);
     
     
        // $output = curl_exec($ch);
        // curl_close($ch);
        // $data = json_decode($output,true);
        // var_dump($data);die;

     
    } 
}
