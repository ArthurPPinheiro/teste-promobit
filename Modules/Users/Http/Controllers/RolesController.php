<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Users\Entities\User;
use Modules\Users\Entities\Role as Roles;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:roles.view');
        $this->middleware('role_or_permission:roles.create')->only(['create', 'store']);
        $this->middleware('role_or_permission:roles.update')->only(['edit', 'update']);
        $this->middleware('role_or_permission:roles.delete')->only('delete');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $roles = Roles::all();;

        return view('users::roles.index', compact(['roles']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(FormBuilder $formBuilder)
    {
        $role = new Roles();

        $form = $formBuilder->create('Modules\Users\Form\UsersForm', [
            'method' => 'POST',
            'url' => url('admin/users/store'),
            'model' => $role
        ]);

        return view('users::roles.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            $role = new Roles;

            $role = Role::create(['name' => $request->input('name')]);

            foreach ($request->input('permissions') as $role_item) {
                $role->givePermissionTo($role_item);
            }

            Session::flash('type', 'success');
            Session::flash('message', 'Item adicionado com sucesso');

            return redirect()->route('Admin.Roles');
        } catch (\Throwable $th) {
            DB::rollBack();

            Session::flash('type', 'error');
            Session::flash('message', $th->getMessage());

            return redirect()->route('Admin.Roles');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Roles $role)
    {
        return view('users::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Roles $role)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            DB::table('role_has_permissions')->where('role_id', $role->id)->delete();

            foreach ($request->input('permissions') as $role_item) {
                $role->givePermissionTo($role_item);
            }

            Session::flash('type', 'success');
            Session::flash('message', 'Item editado com sucesso');

            return redirect()->route('Admin.Roles');
        } catch (\Throwable $th) {
            DB::rollBack();

            Session::flash('type', 'error');
            Session::flash('message', $th->getMessage());

            return redirect()->route('Admin.Roles');
        }
    }

    public function save(Roles $role, Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Roles $role)
    {
        $role->delete();

        return redirect()->back();
    }
}
