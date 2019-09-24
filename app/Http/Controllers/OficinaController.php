<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use sisjtic\Http\Requests;
use sisjtic\Oficina;
use Illuminate\Support\Facades\Redirect;
use sisjtic\Http\Requests\OficinaFormRequest;
use DB;

class OficinaController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
            if($request)
            {
                $query=trim($request->get('SearchText'));
                $oficinas=DB::table('oficina')->where('nombre','LIKE','%'.$query.'%')
                ->where('estado','=','1')
                ->orderBy('id_oficina','desc')
                ->paginate(7);
                return view('estudio.oficina.index',["oficinas"=>$oficinas,"searchText"=>$query]);
            }
    }
    public function create(){
            return view("estudio.oficina.create");
    }
    public function store(OficinaFormRequest $request){
        $oficina=new Oficina;
        $oficina->nombre=$request->get('nombre');
        $oficina->direccion=$request->get('direccion');
        $oficina->estado='1';
        $oficina->save();
        return Redirect::to('estudio/oficina');
    }
    public function show($id){
        return view("estudio.oficina.show",["oficina"=>Oficina::findOrFail($id)]);
    }
    public function edit($id){
        return view("estudio.oficina.edit",["oficina"=>Oficina::findOrFail($id)]);
    }
    public function update(OficinaFormRequest $request,$id){
        $oficina=Oficina::findOrFail($id);
        $oficina->nombre=$request->get('nombre');
        $oficina->direccion=$request->get('direccion');
        $oficina->update();
        return Redirect::to('estudio/oficina');
    }
    public function destroy($id){
        $oficina=Oficina::findOrFail($id);
        $oficina->estado='0';
        $oficina->update;
        return Redirect::to('estudio/oficina');
    }
}
