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


class LayerController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $title = 'layer';

    public function index()
    {

        $list = Layer::listPanel();

        if (!Input::get('o')['col']){
            $list->orderBy("xlayerid","asc");
        }
        else{
            $list->orderBy(Input::get('o')['col'] ,Input::get('o')['order']);
        }

        // search panel
        // $list = parent::search($list);
  
        $list = $list->paginate(Cookie::get('chunk'));

        return view('admin_panel.component.list',['title' => $this->title,
                                                    'titleSmall' => "list",
                                                    'list'=> $list ,
                                                    'head'=>Layer::headerTable(),
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
            'frm.xlayer_title' => 'required|min:3',
        ]);

        // check mikone item jadidde ya ghidamimi 
        // age jadid bashe yani $id nadare

        if (!$id){
            $res = Layer::create(Input::get('frm'));
            $id = $res->xlayerid;
        }
        // age ghadimi bashe va update beshe hatman id dare
        else{
            Layer::where('xlayerid', $id)->update(Input::get('frm'));
        }

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
        $value = Layer::where("xlayerid", $id)->first();

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
        $getFamily = DB::select(DB::raw("select GetFamilyTree($id) as family"));
        $site = DB::table("xxlayer_site")->where("xlayerid",$id)->count();

        // check mikone bebine chand ta saite be in tag vaslan age bishtar az 0 bod yani site vasle pas nemishe hazfesh kard
        if($site > 0){
           return Redirect::back()->withErrors(["panel.site_exist"]); 
        }

        // check mikone bebine tagi ke gharare pak she zir majmoe dare ya na
        if ($getFamily[0]->family == ""){
            Layer::destroy($id);   
            return Redirect::back();
        }
        else{
            return Redirect::back()->withErrors(["panel.child_exist"]);
        }
    }
}
