<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Khill\Lavacharts\Lavacharts;

use App\Http\Controllers\Panel\MainController as MainController;

use App\Model\Site;
use App\Model\Layer;
use Input;
use Route;
use Redirect;
use Session;
use Cookie;
use DB;


class SiteListController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $title = 'site';

    public function index($id =null)
    {


        $list = Site::listPanel()->leftJoin("xxrank", "xxrank.xsiteid","=" ,"xxsite.xsiteid");
        if($id){
            $list->leftJoin("xxdate_rank", "xxdate_rank.xdate_rankid","=" ,"xxrank.xdate_rankid")
                 ->where('xxdate_rank.xdate_rankid' ,$id);
        }

        if (!Input::get('o')['col']){
            $list->orderBy("xxrank.xrank_number","asc");
        }
        else{
            $list->orderBy(Input::get('o')['col'] ,Input::get('o')['order']);
        }

        // search panel
        $list = parent::search($list);
  
        $list = $list->paginate(Cookie::get('chunk'));

        return view('admin_panel.component.list',['title' => $this->title,
                                                    'titleSmall' => "list",
                                                    'list'=> $list ,
                                                    'head'=>Site::headerTable(),
                                                    'section' =>Route::getCurrentRoute()->getPath(),
                                                    'listView' => $this->title,
                                                    'q' => Input::get('q')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return self::edit(0);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($id, Request $request)
    {

        $validator = $this->validate($request, [
            'frm.xsite_title' => 'required|min:3',
        ]);

        // check mikone item jadidde ya ghidamimi 
        // age jadid bashe yani $id nadare
        if (!$id){
            $res = Site::create(Input::get('frm'));
            $id = $res->xsiteid;
        }

        // age ghadimi bashe va update beshe hatman id dare
        else{
            Site::where('xsiteid', $id)->update(Input::get('frm'));
        }

        /*
            add data to link table 
        */        
        DB::table("xxlayer_site")->where("xsiteid", $id)->delete();
        foreach (Input::get('frm1')['xlayerid'] as $key => $value) {
            $data[] = ['xsiteid' => $id, 'xlayerid' => $value];
        }
        DB::table("xxlayer_site")->insert($data);

        return redirect(Route::getCurrentRoute()->getPrefix());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $value = Site::where("xsiteid", $id)->first();

        $parent = Layer::lists("xlayer_title", "xlayerid");

        // foreach get family 
        foreach ($parent as $key => $val) {
            $parent[$key] = Layer::getLayer($key);
        }

        return view('admin_panel.form.'.$this->title ,['title' => $this->title,
                                                       'titleSmall' => "Add",
                                                       'id'=> $id,
                                                       'value' => $value,
                                                       'parent' => $parent]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Site::destroy($id);
        return Redirect::back();
    }

    public function chart(){ 
        // create chart 
        $lava = new Lavacharts; // See note below for Laravel

        $population = $lava->DataTable();

        $population->addDateColumn('Year')
                   ->addNumberColumn('Number of People')
                   ->addRow(['2006', 623452])
                   ->addRow(['2007', 685034])
                   ->addRow(['2008', 716845])
                   ->addRow(['2009', 757254])
                   ->addRow(['2010', 778034])
                   ->addRow(['2011', 792353])
                   ->addRow(['2012', 839657])
                   ->addRow(['2013', 842367])
                   ->addRow(['2014', 873490]);

        $lava->AreaChart('Population', $population, [
            'title' => 'Population Growth',
            'legend' => [
                'position' => 'in'
            ]
        ]);

        return view('admin_panel.custom.chart',['lava' => $lava]);
    }

    public function word(){

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();

        $section = $phpWord->addSection();
        $section->addImage('1.jpg');
        $section->addTextBreak(2);



        // New Word Document
        $html = '<h1>Adding element via HTML</h1>';
        $html .= '<p>Some well formed HTML snippet needs to be used</p>';
        $html .= '<p>With for example <strong>some<sup>1</sup> <em>inline</em> formatting</strong><sub>1</sub></p>';
        $html .= '<p>Unordered (bulleted) list:</p>';
        $html .= '<ul><li>Item 1</li><li>Item 2</li><ul><li>Item 2.1</li><li>Item 2.1</li></ul></ul>';
        $html .= '<p>Ordered (numbered) list:</p>';
        $html .= '<ol><li>Item 1</li><li>Item 2</li></ol>';

        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('helloWorld.docx');
    }

    public function tree(){
        Layer::where('xlayer_parentid' ,0)->first()
    }
}
