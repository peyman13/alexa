<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Panel\MainController as MainController;

use App\Model\Customer;
use App\Model\CustomerCellphone;
use Input;
use Route;
use Redirect;
use Session;
use Cookie;


class CustomerController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public $title = 'customer';

    public function index()
    {

        $list = Customer::listPanel();

        if (!Input::get('o')['col']){
            $list->orderBy("xcustomerid","DESC");
        }
        else{
            $list->orderBy(Input::get('o')['col'],Input::get('o')['order']);
        }

        // search panel
        $list = parent::search($list);
  
        $list = $list->paginate(Cookie::get('chunk'));

        Session::forget('cellphone');
        return view('admin_panel.component.list',['title' => $this->title,
                                                    'titleSmall' => "list",
                                                    'list'=> $list ,
                                                    'head'=>Customer::headerTable(),
                                                    'section' =>Route::getCurrentRoute()->getPath(),
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
        Session::put('cellphone', Input::get('frm1'));
        
        $validator = $this->validate($request, [
            'frm.xcustomer_name' => 'required|min:3',
        ]);

        if (!$id){
            $res = Customer::create(Input::get('frm'));
            $id = $res->xcustomerid;
        }
        else{
            Customer::where('xcustomerid', $id)->update(Input::get('frm'));
        }

        foreach (Input::get('frm1') as $key => $value) {
            if(!$value['xcustomer_cellphoneid']){
                $value['xcustomerid'] = $id;
                CustomerCellphone::create($value);
            }else{
                CustomerCellphone::where('xcustomer_cellphoneid', $value['xcustomer_cellphoneid'])->update($value);
            }
        }

        Session::forget('cellphone');
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
        $value = Customer::where("xcustomerid", $id)->first();
        $cellphone = CustomerCellphone::where("xcustomerid", $id)->get();

        return view('admin_panel.form.'.$this->title ,['title' => $this->title,
                                                       'titleSmall' => "Add",
                                                       'id'=> $id,
                                                       'value' => $value,
                                                       'cellphone' => $cellphone]);
    }

    public function tree(){
       return view('admin_panel.Customer.tree'); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return Redirect::back();
    }
}
