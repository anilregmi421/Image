<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::where( 'user_id', auth()->user()->id )->get();
        return view('index', compact('images'));
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
        if ($request->has('image')) {
                    //Get filename with the extension
                    $filenameWithExt = $request->file('image')->getClientOriginalName();
        
                    //Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        
                    //Get just ext
                    $extension = $request->file('image')->getClientOriginalExtension();
        
                    //Filename to store
                    $fileNameToProfile = $filename . '_' . time() . '.' . $extension;
        
                    //Upload Image
                    $path = $request->file('image')->move('images', $fileNameToProfile);
                }
    
        DB::beginTransaction();
        try{
            $image= new Image();
            $image->name= $request->input('name');
            $image->address= $request->input('address');
            $image->image= $fileNameToProfile;
            $image->user_id = auth()->user()->id;
            $image->save();
        } catch(Exception $exception) {
            DB::rollBack();
            // toastr()->error('Error While Adding Image');
            return redirect()->back();
        }
        DB::commit();
        // toastr()->success('Image Added Successfully');
        return redirect()->back();
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::find($id);
        return view('edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        DB::beginTransaction();
        try{
            $image= Image::find($id);
            $image->name= $request->input('name');
            $image->address= $request->input('address');
            $image->image= $request->input('image');
            $image->user_id = auth()->user()->id;
            $image->update();
        } catch(Exception $exception) {
            DB::rollBack();
            // toastr()->error('Error While Updating Image');
            return redirect()->back();
        }
        DB::commit();
        // toastr()->success('Image Updated Successfully');
        return redirect('/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $image =  Image::find($id);
            $image->delete();
        }
        catch(\Exception $exception)
        {
            DB::rollBack();
            // toastr()->error('Error While Deleting image');
        return redirect()->back();
        }
        DB::commit();
        // toastr()->success('Image Deleted Successfully');
        return redirect()->back();
    }
}
