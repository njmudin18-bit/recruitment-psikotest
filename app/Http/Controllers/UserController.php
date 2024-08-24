<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\UserProfile;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
      $this->middleware('can:read users');
      $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $Title    = "Users";
      $SubTitle = "Daftar user";
      if ($request->ajax()) {
        return $this->userService->datatable();
      }

      return view('users.index', compact('Title', 'SubTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $Title    = "Users";
      $SubTitle = "Tambah user";

      return view('users.create', compact('Title', 'SubTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $result = $this->userService->create($request->all());

        if ($result['success']) {
            return redirect()->route('users.index')->with('success', $result['message']);
        } else {
            return back()->withInput()->with('error', $result['message']);
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
      $Title        = "Users";
      $SubTitle     = "Edit user";
      $user         = $this->userService->getById($id);
      $UserProfile  = UserProfile::where('user_id', $user->id)->first();
      //dd($UserProfile); exit;
      //dd($user, $UserProfile);

      return view('users.edit', compact('Title', 'SubTitle', 'user', 'UserProfile'));
    }

    // public function edit(string $id)
    // {
    //   $title = 'Edit User';
    //   $user = $this->userService->getById($id);

    //   return view('users.edit', compact('title', 'user'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      //dd("aaaah");
      $result = $this->userService->update($request->all(), $id);

      if ($result['success']) {
        return redirect()->route('users.index')->with('success', $result['message']);
      } else {
        return back()->withInput()->with('error', $result['message']);
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $result = $this->userService->delete($id);

      return response()->json($result);
    }

    public function activated(Request $request) 
    {
      $result = $this->userService->activated($request->all());

      return $result;
    }
}
