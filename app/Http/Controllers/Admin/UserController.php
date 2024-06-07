<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeUserRequest;
use App\Http\Requests\updateUserRequest;
use App\Repositories\Admin\UserManageRepositoryInterface;

class UserController extends Controller
{
    public function __construct(UserManageRepositoryInterface $userManage)
    {
        $this->userManage =  $userManage;
    }

    public  $roles = [
        'User',
        'Admin',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userManage->allUsers(7);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roles;
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeUserRequest $request)

    {
        $data = $request->all();

        $this->userManage->storeUser($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = $this->userManage->getUserById($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = $this->roles;
        $user = $this->userManage->getUserById($id);

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateUserRequest $request,  $id)
    {
        $data = $request->all();
        $user = $this->userManage->getUserById($id);
        $this->userManage->updateUser($user, $data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = $this->userManage->getUserById($id);
        $this->userManage->userDelete($user);

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}
