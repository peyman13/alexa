<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Panel\MainController as MainController;

use App\Model\Role;
use Input;
use Route;
use Redirect;
use Session;
use Cookie;


class RoleController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $title = 'role';

    public function index()
    {

        $list = Role::listPanel();

        if (!Input::get('o')['col']){
            $list->orderBy("id","asc");
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
                                                    'head'=>Role::headerTable(),
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
        Layer::destroy($id);
        return Redirect::back();
    }
}
