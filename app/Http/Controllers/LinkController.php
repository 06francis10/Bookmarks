<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search="";
        $sortBy="";
        if(request()->has("search") && request("search")!=null){
            $search=request("search");
            if(request()->has("sortBy") && request("sortBy")!=null){
                $sortBy=request("sortBy");
                $links=Link::where("user_id",Auth::user()->id)->where("title","LIKE","%".$search."%")->orderBy($sortBy,"asc")->paginate(15)->appends(request()->except("page"));
            }
            $links=Link::where("user_id",Auth::user()->id)->where("title","LIKE","%".$search."%")->orderBy("id","desc")->paginate(15)->appends(request()->except("page"));
        }else{
            if(request()->has("sortBy") && request("sortBy")!=null){
                $sortBy=request("sortBy");
                $links=Link::where("user_id",Auth::user()->id)->orderBy($sortBy,"asc")->paginate(15)->appends(request()->except("page"));
            }else{
                $links=Link::where("user_id",Auth::user()->id)->orderBy("id","desc")->paginate(15)->appends(request()->except("page"));
            }
        }
        return Inertia::render("Links/Index",[
            "links"=>$links,
            "buscar"=>$search,
            "sortBy"=>$sortBy,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $link=new Link([
            "title"=>$request->name,
            "url"=>$request->address,
            "user_id"=>Auth::user()->id,
        ]);
        $link->save();
        if($link){
            return back();
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // return Inertia::render("Links/Edit",["link"=>$id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $link=Link::findOrFail($id);
        $link->title=$request->name;
        $link->url=$request->url;
        $link->save();
        return back();
        // return $request->id.", ".$request->title.", ".$request->url;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $id)
    {
        // Tu lógica para eliminar el recurso
        if($id->delete()){
            return back();
        }
    }
}
