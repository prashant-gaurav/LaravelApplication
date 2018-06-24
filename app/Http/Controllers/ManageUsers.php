<?php
/**
 * Created by PhpStorm.
 * User: Prashant Gaurav
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use DB;
use Illuminate\Http\Request;
use Session;
use Validator;
use App\User;
use Auth;
use App\VerifyUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;


class ManageUsers extends Controller
{

    public function index()
    {
        $perPage = 10;
        $all_users = User::paginate($perPage);
        return view('view_user', compact('all_users'));
    }

    public function create()
    {
        return view('create_user');
    }

    /*
     * store User
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|min:10|numeric',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (Input::file()) {
            $image = $request->file('profile_picture');
            $imageName = time() . $image->getClientOriginalName();
            $image->move(public_path('UserImage'), $imageName);
        }

        try {
            DB::beginTransaction();
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'profile_picture' => $imageName,
            ]);

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => str_random(40)
            ]);

            Mail::to($user->email)->send(new VerifyMail($user));
            DB::commit();
            Session::flash('success', 'user Added!');
        } catch (\PDOException $e) {
            DB::rollback();
            Session::flash('error', 'Error while Adding!');
        }

        return redirect('/user/crud');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('edit_user', compact('user'));
    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|min:10|numeric',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (Input::file()) {
            $image = $request->file('profile_picture');
            $imageName = time() . $image->getClientOriginalName();
            $image->move(public_path('UserImage'), $imageName);
        } else {
            $old_image = DB::table('users')->select('profile_picture')->where('id', $id)->first();
            $imageName = $old_image->profile_picture;
        }
        try {
            DB::beginTransaction();
            DB::table('users')->where('id', $id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'profile_picture' => $imageName,
            ]);
            DB::commit();
            Session::flash('info', 'user updated!');
        } catch (\PDOException $e) {
            DB::rollback();
            Session::flash('error', 'Error while updating!');
        }
        return redirect('/home');
    }

//delete
    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('error', 'User deleted!');
        return redirect('/user/crud');
    }

//ajax
    public function ajaxUploadImage(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $image = $request->file('file');
        $imageName = time() . $image->getClientOriginalName();
        $image->move(public_path('UserImage'), $imageName);

        try {
            DB::beginTransaction();
            DB::table('users')->where('id', Auth::id())->update([
                'profile_picture' => $imageName,
            ]);
            DB::commit();
            $status = $imageName;
        } catch (\PDOException $e) {
            DB::rollback();
            $status = "";
        }
        return response()->json(['success' => $status]);
    }

}