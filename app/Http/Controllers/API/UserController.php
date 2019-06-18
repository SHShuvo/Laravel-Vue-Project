<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    
    public function __construct()
    {
       
        $this->middleware('auth:api');
       
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {   
       if(\Gate::allows('isAdmin') || \Gate::allows('isAuthor')){
          return User::orderBy('id','asc')->paginate(4);
       }
       
    }
     
    public function search(){
        if($search=\Request::get('q')){
            $users=User::where(function($query) use($search){
                $query->where('name','LIKE',"%$search%")
                ->Orwhere('email','LIKE',"%$search%")
                ->Orwhere('type','LIKE',"%$search%");
               
            })->paginate(10);
        }else{
            $users=User::orderBy('id','asc')->paginate(4);
        }
        return $users;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required | max:191',
            'email'=>'required|email|max:191 |unique:users',
            'type'=>'required',
            'password'=>'required|max:191|min:8'
            ]);
        return User::create([
            'name'     =>$request['name'],
            'email'    =>$request['email'],
            'type'     =>$request['type'],
            'bio'      =>$request['bio'],
            'photo'    =>$request['photo'],
            'password' =>Hash::make($request['password'])
            
        ]);
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

    public function updateProfile(Request $request)
    {
        $user= auth('api')->user();
        
        if(!empty($request->password)){
            $this->validate($request,[
                'name'=>'required | max:191',
                'email'=>'required|email|max:191 |unique:users,email,'.$user->id,
                'type'=>'required',
                'password' => 'sometimes|required|min:8'
            ]);
    
        } else{
            $this->validate($request,[
                'name'=>'required | max:191',
                'email'=>'required|email|max:191 |unique:users,email,'.$user->id,
                'type'=>'required'
            ]);
        }
        
        if($request->photo!=$user->photo){
            $ext=explode('/',explode(';',$request->photo)[0])[1];
            $name=time().'.'.$ext;
           \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo'=> $name]);

            $userPhoto=public_path('img/profile/').$user->photo;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
      
        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }else{
            $request->merge(['password' => $user->password]);
        }
         
        
        
        $user->update($request->all());
        return ['message'=>'Updated Successfully'];
    
    }
    public function profile()
    {
        return auth('api')->user();
        //return['message'=>'Updated Successfully'];
       // return User::findOrFail(10);
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

      //  $this->authorize('isAdmin');

        $user=User::findOrFail($id);
        $this->validate($request,[
            'name'=>'required | max:191',
            'email'=>'required|email|max:191 |unique:users,email,'.$user->id,
            'type'=>'required',
        ]);


        $user->update($request->all());
        return['message'=>'Updated Successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $this->authorize('isAdmin');
        $user=User::findOrFail($id);

        $user->delete();

        return['message'=>'Deleted Successfully'];
    }
}
