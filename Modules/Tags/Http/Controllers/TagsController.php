<?php

namespace Modules\Tags\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Tags\Entities\Tag;
use Modules\Tags\Form\TagsForm;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:tags.view');
        $this->middleware('role_or_permission:tags.create')->only(['create', 'store']);
        $this->middleware('role_or_permission:tags.update')->only(['edit', 'update']);
        $this->middleware('role_or_permission:tags.delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $tags = Tag::all();;

        return view('tags::index', compact(['tags']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(FormBuilder $formBuilder)
    {
        $tag = new Tag();

        $form = $formBuilder->create(TagsForm::class, [
            'method' => 'POST',
            'url' => url('admin/tags/store'),
            'model' => $tag
        ]);

        return view('tags::create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:50|unique:tag,name',
        ]);

        DB::beginTransaction();

        try {
            DB::commit();

            $tags = $this->save( new Tag, $request );

            Session::flash('type', 'success');
            Session::flash('message', 'Tag added successfully');

            return redirect()->route('Admin.Tags');

        } catch (\Throwable $th) {
            DB::rollBack();

            Session::flash('type', 'error');
            Session::flash('message', $th->getMessage());

            return redirect()->route('Admin.Tags');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(FormBuilder $formBuilder, Tag $tag)
    {
        $form = $formBuilder->create(TagsForm::class, [
            'method' => 'POST',
            'url' => url('admin/tags/update/'.$tag->id),
            'model' => $tag
        ]);

        return view('tags::edit', compact('form', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Tag $tag)
    {
        $validate = $request->validate([
            'name' => 'required|max:50|unique:tag,name',
        ]);

        DB::beginTransaction();

        try {
            DB::commit();

            $tag = $this->save( $tag, $request );

            Session::flash('type', 'success');
            Session::flash('message', 'Tag edited successfully');

            return redirect()->route('Admin.Tags');
        } catch (\Throwable $th) {

            DB::rollBack();

            Session::flash('type', 'error');
            Session::flash('message', $th->getMessage());

            return redirect()->route('Admin.Tags');
        }
    }

    public function save(Tag $tag, Request $request){

        foreach($tag->getFillable() as $fillable){
           $tag->$fillable = $request->input($fillable);
        }

        $tag->save();

        return $tag;

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->back();
    }
}
