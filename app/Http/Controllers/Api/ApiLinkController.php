<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiLinkController extends Controller{
    public function index(){
        try {
            return response()->json(Link::where("user_id", Auth::user()->id)->paginate(30),200);
        } catch (\Throwable $th) {
            return response()->json(["message"=>$th->getMessage()],500);
        }
    }
    public function store(Request $request){
        try {
            $link = new Link([
                "title" => $request->name,
                "url" => $request->address,
                "user_id" => Auth::user()->id,
            ]);
            $link->save();
            return response()->json(["message"=>"Se ha creado un nuevo recurso."],201);
        } catch (\Throwable $th) {
            return response()->json(["message"=>$th->getMessage()],500);
        }
    }
    public function show(string $id){
        try {
            return response()->json(Link::findOrFail($id));
        } catch (\Throwable $th) {
            return response()->json(["message"=>$th->getMessage()],500);
        }
    }
    public function update(Request $request, string $id){
        try {
            $link = Link::findOrFail($id);
            $link->title = $request->name;
            $link->url = $request->address;
            $link->save();
            return response()->json(["message"=>"Se ha actualizado correctamente los datos del registro."]);
        } catch (\Throwable $th) {
            return response()->json(["message"=>$th->getMessage()],500);
        }
    }
    public function destroy(Link $link){
        try {
            $link->delete();
            return response()->json(["message"=>"Se ha Eliminado correctamente el registro."]);
        } catch (\Throwable $th) {
            return response()->json(["message"=>$th->getMessage()],500);
        }
    }
}
