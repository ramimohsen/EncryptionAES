<?php

namespace App\Http\Controllers;

use App\Encryptor;
use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }


    public function index()
    {
        $files =  File::all();
      return view('Files.Files')->with('files',$files);
    }


    public function create()
    {
       return view('Files.create');
    }


    public function store(Request $request)
    {
        // Validate form inputs
        $this->validate($request,[
           'description'=>'required',
           'file' => 'required'
        ]);

        // Get All file information
        $file_Uploaded = $request->file('file');
        $file_size= $file_Uploaded->getFileInfo()->getSize();
        $file_ext= $file_Uploaded->getClientOriginalExtension();
        $file_name = $file_Uploaded->getClientOriginalName();


          //Encrypt Uploaded File
           $encrypted_file = Encryptor::Encrypt_Content($file_Uploaded);
           $path = "User".auth()->user()->id."Encrypted_Files"."/".time().$file_name;

          //Store Encrypted File
          Storage::disk()->put($path,$encrypted_file);


        //saving the file to database
        $file = new File;
        $file->description = $request->input('description');
        $file->user_id = auth()->user()->id;
        $file->file_name = $file_name;
        $file->file_size = $file_size;
        $file->file_extention = $file_ext;
        $file->file_link = $path;
        $file->save();


      return redirect('/files')->with('success','File uploaded successfully');

    }


    public function show($id)
    {
      $file =   File::find($id);
      return view('Files.show')->with('file',$file);

    }


    public function edit($id)
    {
        $file =   File::find($id);

        if(auth()->user()->id !==$file->user_id){
            return redirect('/files')->with('error', 'Unauthorized Page');
        }

        return view('Files.edit')->with('file',$file);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'description'=>'required'
         ]);
 
         $file = File::find($id);
       $file->description = $request->input('description');
      // $file->key = "fff";
       $file->save();
 
       return redirect('/files')->with('success','File updated successfully');
    }


    public function destroy($id)
    {
       $file =File::find($id);
       if(auth()->user()->id !==$file->user_id){
        return redirect('/files')->with('error', 'Unauthorized Page');
    }
       Storage::disk()->delete($file->file_link);
       $file->delete();
       return redirect('/files')->with('success','File Removed successfully');

    }


    public  function  download($id)
    {
        $file = File::find($id);

        $decryptedContents = Encryptor::Decrypt_Content($file);


        return response()->make($decryptedContents, 200, array(
            'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($decryptedContents),
            'Content-Disposition' => 'attachment; filename="' . pathinfo($file->file_link, PATHINFO_BASENAME) . '"'
        ));

    }

    public  function  download_EN($id)
    {
        $file = File::find($id);
        $content= Storage::get($file->file_link);
        return response()->make($content, 200, array(
            'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($content),
            'Content-Disposition' => 'attachment; filename="' . pathinfo($file->file_link, PATHINFO_BASENAME) . '"'
        ));
    }
}
