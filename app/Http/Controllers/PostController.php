<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::latest()->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'title'=>'required | max:191',
            'body'=>'required|max:1500',
            ]);
         
        if($request->picture){
            $ext=explode('/',explode(';',$request->picture)[0])[1];
            $name=time().'.'.$ext;
            \Image::make($request->picture)->save(public_path('img/post/').$name);
        }    

        return Post::create([
            'title'    =>$request['title'],
            'body'     =>$request['body'],
            'user_id'  =>auth()->user()->id,
            'photo'    =>$name,
            
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
        return Post::findOrFail($id);
    
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=Post::findOrFail($id);
        $this->validate($request,[
            'title'=>'required | max:191',
            'body'=>'required|max:1500',
        ]);

        if($request->picture!=null){
            $ext=explode('/',explode(';',$request->picture)[0])[1];
            $name=time().'.'.$ext;
            \Image::make($request->picture)->save(public_path('img/post/').$name);
            
            $request->merge(['photo'=> $name]);

            $postPhoto=public_path('img/post/').$post->photo;
            if(file_exists($postPhoto)){
                @unlink($postPhoto);
            }
      
        }

        $post->update($request->all());
        return ['message'=>'Updated Successfully'];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id);

        $post->delete();

        return['message'=>'Deleted Successfully'];
    }
}
