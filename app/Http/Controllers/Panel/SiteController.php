<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Khill\Lavacharts\Lavacharts;

use App\Http\Controllers\Panel\MainController as MainController;

use App\Model\Site;
use App\Model\Layer;
use App\Model\DateRank;
use Input;
use Route;
use Redirect;
use Session;
use Cookie;
use DB;
use Excel;


class SiteController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $title = 'site';

    public function index($id =null)
    {
        // set subguery 
        if(@Input::get('q')['xlayerid']){
            $layerId = Input::get('q')['xlayerid']; 
            $getFamily = DB::select(DB::raw('select GetFamilyTree('.$layerId.') as xchartid'));
            $chartid = (array) $getFamily[0];

            if(strlen($chartid['xchartid']) == 0){
                $chartid['xchartid'] = "1";
            }

        } 
            
        $subQuery = "(SELECT group_concat(xlayerid) as layerid,xsiteid FROM xxlayer_site left join xxlayer using (xlayerid)";
        if (@Input::get('q')['xlayerid']){
            $subQuery .= " where xxlayer_site.xlayerid In (".$chartid['xchartid'].",".$layerId .")";
        }
        else{
            $subQuery .=" where 1";
        }

        $subQuery .= " group by xsiteid)q1";

        $list = Site::listPanel()
                    ->addSelect([DB::raw("group_concat(xxrank.xrank_number,'::',xxdate_rank.xdate_rank_timestamp) as rank_number"),"layerid"])
                    ->leftJoin("xxrank" ,"xxrank.xsiteid" ,"=" ,"xxsite.xsiteid")
                    ->leftJoin("xxdate_rank","xxrank.xdate_rankid" ,"=" ,"xxdate_rank.xdate_rankid")
                    ->groupBy('xxsite.xsiteid')
                    ->orderBy("xxrank.xrank_number","asc");

        if(@Input::get('q')['xlayerid']){
            $list->rightJoin(DB::raw($subQuery),"q1.xsiteid" ,"=" ,"xxsite.xsiteid");
        }
        else{
            $list->leftJoin(DB::raw($subQuery),"q1.xsiteid" ,"=" ,"xxsite.xsiteid");
        }              
        // search panel
        $list = self::search($list);


        if (Input::get('export') == "excel"){
            self::export($list);
        }

        $maket = $list->first()['rank_number']; 

        
        $list = $list->paginate(Cookie::get('chunk'));
        
        $btn['hidden_add'] = true;
        $btn['excel'] = true;
        $btn['chart'] = true;
        
        $chart = Input::get('q')['xdate_rankid'];
        $chart = implode(',', $chart);

        return view('admin_panel.component.list',['title' => $this->title,
                                                    'titleSmall' => "list",
                                                    'list'=> $list ,
                                                    'head'=> $maket,
                                                    'section' => Route::getCurrentRoute()->getPath(),
                                                    'listView' => $this->title,
                                                    'tree' => self::tree(),
                                                    'q' => Input::get('q'),
                                                    'btn' => $btn,
                                                    'chart' => $chart]);
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
            'frm1.xlayerid' => 'required',
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
        $layer = explode(",", Input::get('frm1')['xlayerid']);
        foreach ($layer as $key => $value) {
            $data[] = ['xsiteid' => $id, 'xlayerid' => $value];
        }
        
        DB::table("xxlayer_site")->insert($data);
        $xlayerid = DateRank::orderBy("xdate_rankid","DESC")->first()->xdate_rankid;

        return redirect(Route::getCurrentRoute()->getPrefix()."/index?q[xdate_rankid][".$xlayerid."]=".$xlayerid);
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
                                                       'tree' => self::tree(),
                                                       'parent' => $parent,
                                                       'site_status' => Site::getEnum('xsite_status','enum'),
                                                       'site_location' => Site::getEnum('xsite_location','enum')]);
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
        $section->addImage('1.jpg');
        $section->addTextBreak(2);

        $subsequent = $section->addHeader();
        $subsequent->addText(htmlspecialchars('Subsequent pages in Section 1 will Have this!', ENT_COMPAT, 'UTF-8'));

        $footer = $section->addFooter();
        $footer->addPreserveText(htmlspecialchars('Page {PAGE} of {NUMPAGES}.', ENT_COMPAT, 'UTF-8'), null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $footer->addLink('https://github.com/PHPOffice/PHPWord', htmlspecialchars('PHPWord on GitHub', ENT_COMPAT, 'UTF-8'));

        // New Word Document
        $html = '<h1>Adding element via HTML</h1>';
        $html .= '<p>Some well formed HTML snippet needs to be used</p>';
        $html .= '<p>With for example <strong>some<sup>1</sup> <em>inline</em> formatting</strong><sub>1</sub></p>';
        $html .= '<p>Unordered (bulleted) list:</p>';
        $html .= '<ul><li>Item 1</li><li>Item 2</li><ul><li>Item 2.1</li><li>Item 2.1</li></ul></ul>';
        $html .= '<p>Ordered (numbered) list:</p>';
        $html .= '<ol><li>Item 1</li><li>Item 2</li></ol>';

        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);

        $section = $phpWord->addSection();
        $section->addTitle(htmlspecialchars('2D charts', ENT_COMPAT, 'UTF-8'), 1);
        // $section = $phpWord->addSection(array('colsNum' => 2, 'breakType' => 'continuous'));

        $categories = array('A', 'فارسی', 'C', 'D', 'E');
        $series2 = array(1, 1, 1, 1, 6);
        $chart = $section->addChart("column", $categories, $series2);
        


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('helloWorld.docx');
    }

    public function tree(){
        $res = Layer::get()->toArray();
        return self::convertToHierarchy($res, "xlayerid", "xlayer_parentid");
    }

    public function convertToHierarchy($results, $idField='id', $parentIdField='parent', $childrenField='children') {
        $hierarchy = array(); // -- Stores the final data

        $itemReferences = array(); // -- temporary array, storing references to all items in a single-dimention

        foreach ( $results as $item ) {
            $id       = $item[$idField];
            $parentId = $item[$parentIdField];

            if (isset($itemReferences[$parentId])) { // parent exists
                $itemReferences[$parentId][$childrenField][$id] = $item; // assign item to parent
                $itemReferences[$id] =& $itemReferences[$parentId][$childrenField][$id]; // reference parent's item in single-dimentional array
            } elseif (!$parentId || !isset($hierarchy[$parentId])) { // -- parent Id empty or does not exist. Add it to the root
                $hierarchy[$id] = $item;
                $itemReferences[$id] =& $hierarchy[$id];
            }
        }

        unset($results, $item, $id, $parentId);

        // -- Run through the root one more time. If any child got added before it's parent, fix it.
        foreach ( $hierarchy as $id => &$item ) {
            $parentId = $item[$parentIdField];

            if ( isset($itemReferences[$parentId] ) ) { // -- parent DOES exist
                $itemReferences[$parentId][$childrenField][$id] = $item; // -- assign it to the parent's list of children
                unset($hierarchy[$id]); // -- remove it from the root of the hierarchy
            }
        }

        unset($itemReferences, $id, $item, $parentId);

        return $hierarchy;
    }

    public function search($list){
        $search = Input::get('q');
        if (@$search['xsite_status']){
            $list->whereIn("xsite_status", $search['xsite_status']);
        }        

        if (@$search['xsite_location']){
            $list->whereIn("xsite_location", $search['xsite_location']);
        }

        if (@$search['xdate_rankid']){
            $list->whereIn("xxdate_rank.xdate_rankid", $search['xdate_rankid']);
        }        
        return $list;
    }

    // export excel
    public function export($list){

        $data = $list->get();
        $maket = $list->first()['rank_number'];

        Excel::create('New file', function($excel) use ($data ,$maket){
            $excel->sheet('New sheet', function($sheet) use ($data,$maket){
                $sheet->loadView('admin_panel.export.excel',['list' => $data, 'head' =>$maket])->setRightToLeft(true);
            });
        })->download('xls');

    }
}
