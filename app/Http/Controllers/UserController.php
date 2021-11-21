<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect,Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function userManagement()
    {
        $actives = DB::table('users')
            ->select('FirstName', 'LastName', 'userType')
            ->where('userType', '=' ,'admin')
            ->orWhere('userType', '=', 'user')
            ->get();
        $restricteds = DB::table('users')
            ->select('FirstName', 'LastName', 'userType')
            ->where('userType', '=' ,'restricted')
            ->get();
        return view('admin.userManagement', compact('actives','restricteds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function archive($id)
    {
        //
        $user = User::find($id);
        if($user){
            return response()->json([
                'status'=>200,
                'user'=>$user,
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'User Not Found',
            ]);
        }
    }

    public function archiveUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'UserType' =>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator,
            ]);
        }
        else
        {
            $user = User::find($id);
            if($user)
            {
                $user->UserType = $request->input('UserType');
                $user->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Pizza Not Found',
                ]);
            }
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'FirstName' =>'required',
            'LastName' =>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator,
            ]);
        }
        else
        {
            $user = User::find($id);
            if($user)
            {
                $user->FirstName = $request->input('FirstName');
                $user->LastName = $request->input('LastName');
                $user->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'User Not Found',
                ]);
            }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
