<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = "";
        $sortBy = "";
        $orderBy = "desc";
        if(request()->has("orderBy") && request("orderBy") != null){
            $orderBy = request("orderBy");
        }
        if ((request()->has("search") && request("search") != null) && (request()->has("sortBy") && request("sortBy") != null)) {
            $search = request("search");
            $sortBy = request("sortBy");
            $links = Link::where("user_id", Auth::user()->id)->where("title", "LIKE", "%" . $search . "%")->orWhere("url", "LIKE", "%" . $search . "%")->orderBy($sortBy, $orderBy)->paginate(15)->appends(request()->except("page"));
        } else if ((request()->has("search") && request("search") != null)) {
            $search = request("search");
            $links = Link::where("user_id", Auth::user()->id)->where("title", "LIKE", "%" . $search . "%")->orWhere("url", "LIKE", "%" . $search . "%")->orderBy("id", $orderBy)->paginate(15)->appends(request()->except("page"));
        } else if (request()->has("sortBy") && request("sortBy") != null) {
            $sortBy = request("sortBy");
            $links = Link::where("user_id", Auth::user()->id)->orderBy($sortBy, $orderBy)->paginate(15)->appends(request()->except("page"));
        } else {
            $links = Link::where("user_id", Auth::user()->id)->paginate(15)->appends(request()->except("page"));
        }
        return Inertia::render("Links/Index", [
            "links" => $links,
            "buscar" => $search,
            "sortBy" => $sortBy,
            "orderBy"=>$orderBy,
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
    public function store(SaveLinkRequest $request)
    {
        //
        $link = new Link([
            "title" => $request->name,
            "url" => $request->address,
            "user_id" => Auth::user()->id,
        ]);
        $link->save();
        if ($link) {
            return back();
        } else {
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
    public function update(UpdateLinkRequest $request, string $id)
    {
        $link = Link::findOrFail($id);
        $link->title = $request->name;
        $link->url = $request->address;
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
        if ($id->delete()) {
            return back();
        }
    }
    public function export(Request $request){
        
    }
}
