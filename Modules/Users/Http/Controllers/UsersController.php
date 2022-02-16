<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Users\Entities\User;
use Modules\Users\Entities\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role_or_permission:users.view');
        // $this->middleware('role_or_permission:users.create')->only(['create', 'store']);
        // $this->middleware('role_or_permission:users.update')->only(['edit', 'update']);
        // $this->middleware('role_or_permission:users.delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $users = User::all();;

        return view('users::users.index', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(FormBuilder $formBuilder)
    {
        $user = new User();

        $roles = Role::all();

        $form = $formBuilder->create('Modules\Users\Form\UsersForm', [
            'method' => 'POST',
            'url' => url('admin/users/store'),
            'model' => $user
        ]);

        return view('users::users.create', compact('form', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'email',
            'password' => 'required|confirmed|min:6'
        ]);

        DB::beginTransaction();

        try {
            DB::commit();

            $users = $this->save( new User, $request );

            Session::flash('type', 'success');
            Session::flash('message', 'Item adicionado com sucesso');

            return redirect()->route('Admin.Users');

        } catch (\Throwable $th) {
            DB::rollBack();

            Session::flash('type', 'error');
            Session::flash('message', $th->getMessage());

            return redirect()->route('Admin.Users');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(FormBuilder $formBuilder, User $user)
    {
        $roles = Role::all();

        $form = $formBuilder->create('Modules\Users\Form\UsersForm', [
            'method' => 'POST',
            'url' => url('admin/users/update/'.$user->id),
            'model' => $user
        ]);

        return view('users::users.edit', compact('form', 'roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, User $user)
    {
        if($request->input('new_password') && !Hash::check($request->input('old_password'), $user->password)){

            Session::flash('type', 'error');
            Session::flash('message', 'Senha antiga incorreta.');

            return redirect()->back();
        }
        if($request->input('password') != null){
            $validate = $request->validate([
                'old_password' => 'required',
                'new_password' => 'confirmed|min:6|different:old_password'
            ]);
        }

        DB::beginTransaction();

        try {
            DB::commit();

            $user = $this->save( $user, $request );

            Session::flash('type', 'success');
            Session::flash('message', 'Item editado com sucesso');

            return redirect()->route('Admin.Users');
        } catch (\Throwable $th) {
             DB::rollBack();

            Session::flash('type', 'error');
            Session::flash('message', $th->getMessage());

            return redirect()->route('Admin.Users');
        }
    }

    public function save(User $user, Request $request){

        foreach($user->getFillable() as $fillable){
           $user->$fillable = $request->input($fillable);
        }

        if($request->input('password')){
            $user->password = Hash::make($request->input('password'));
        } else if ($request->input('new_password')){
            $user->password = Hash::make($request->input('new_password'));
        }

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();


        // $user->syncRoles($request->input('permissions'));
        foreach($request->input('permissions') as $role){
            $user->assignRole($role);
        }

        $user->save();

        return $user;

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back();
    }
}
