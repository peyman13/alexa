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


class ReportController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $title = 'report';

    public function index()
    {

        $dataArray = explode(",", Input::get('date'));

        foreach ($dataArray as $key => $value) {
            $siteAna = DB::table('xxlayer_site')
                            ->select(["*" ,DB::raw("count(xxlayer_site.xlayerid) as xcount")])
                            ->leftJoin("xxlayer","xxlayer.xlayerid" ,"=" ,"xxlayer_site.xlayerid")
                            ->leftJoin("xxsite","xxsite.xsiteid" ,"=" ,"xxlayer_site.xsiteid")
                            ->leftJoin("xxrank","xxsite.xsiteid" ,"=", "xxrank.xsiteid")
                            ->leftJoin("xxdate_rank","xxrank.xdate_rankid" ,"=", "xxdate_rank.xdate_rankid")
                            ->where("xxdate_rank.xdate_rankid" ,$value)
                            ->groupBy("xxlayer_site.xlayerid")
                            ->orderBy("xxlayer.xlayerid")
                            ->get();

            $data[$value] = json_decode(json_encode($siteAna),true);
            $label[$value] = \Morilog\Jalali\Facades\jDate::forge($data[$value][0]['xdate_rank_timestamp'])->format('%B %Y');
        }
        
        return view('admin_panel.component.custom',['title' => $this->title,
                                                    'titleSmall' => "list",
                                                    'siteAna' => $data,
                                                    'label' => $label
                                                    ]);
    }

    // service chart
    public function service(){

        // service chart
        $service = DB::table("zzservice_con")->get();

        $chartService = [];
        foreach ($service as $key => $value) {
            $chartService[] =['label' => $value->xlayer_title, 'data' => DB::table('xxlayer_site')->whereIn("xlayerid", explode(',', $value->xfamily))->count()];
        }

        return view('admin_panel.component.service',['title' => $this->title,
                                                    'titleSmall' => "service",
                                                    'pie_data' => json_encode($chartService)
                                                    ]);

    }

    // connction chart
    public function connection(){

        $content = DB::table("zzconnection_con")->get();

        $chartConnection = [];
        foreach ($content as $key => $value) {
            $chartConnection[] =['label' => $value->xlayer_title, 'data' => DB::table('xxlayer_site')->whereIn("xlayerid", explode(',', $value->xfamily))->count()];
        }

        return view('admin_panel.component.service',['title' => $this->title,
                                                'titleSmall' => "connection",
                                                'pie_data' => json_encode($chartConnection)
                                                ]);

    }

    // content chart
    public function content(){

        $content = DB::table("zzcontent_con")->get();

        $chartContent = [];
        foreach ($content as $key => $value) {
            $chartContent[] =['label' => $value->xlayer_title, 'data' => DB::table('xxlayer_site')->whereIn("xlayerid", explode(',', $value->xfamily))->count()];
        }        


        return view('admin_panel.component.service',['title' => $this->title,
                                                'titleSmall' => "content",
                                                'pie_data' => json_encode($chartContent)
                                                ]);

    }

    // all pie chart
    public function all_category(){

        // contact
        $content = DB::select(DB::raw('select GetFamilyTree(3) as count'));

        $table = DB::table('xxlayer_site')
                ->select([DB::raw('"محتوا محور" AS label'), DB::raw('count(`xxlayer_site`.`xlayerid`) AS `data`')])
                ->whereIn("xlayerid" ,explode(',',$content[0]->count))
                ->get();
                
        $allPie[] = ['label' => $table[0]->label ,'data' => $table[0]->data];       

        $content = DB::select(DB::raw('select GetFamilyTree(26) as count'));

        $table = DB::table('xxlayer_site')
                ->select([DB::raw('"ارتباط محور" AS label'), DB::raw('count(`xxlayer_site`.`xlayerid`) AS `data`')])
                ->whereIn("xlayerid" ,explode(',',$content[0]->count))
                ->get();

        $allPie[] = ['label' => $table[0]->label ,'data' => $table[0]->data];       


        $content = DB::select(DB::raw('select GetFamilyTree(30) as count'));

        $table = DB::table('xxlayer_site')
                ->select([DB::raw('"خدمات محور" AS label'), DB::raw('count(`xxlayer_site`.`xlayerid`) AS `data`')])
                ->whereIn("xlayerid" ,explode(',',$content[0]->count))
                ->get();

        $allPie[] = ['label' => $table[0]->label ,'data' => $table[0]->data];

        return view('admin_panel.component.service',['title' => $this->title,
                                                    'titleSmall' => "all chart",
                                                    'pie_data' => json_encode($allPie)
                                                    ]);

    }

}
