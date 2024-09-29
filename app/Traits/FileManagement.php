<?php

namespace App\Traits;
use Illuminate\Support\Facades\File;


trait FileManagement{

    public function storeFile($file ,$storePath){

        if($file){

            $file_name = time().'_'.$file->getClientOriginalName();
            
            $file->move(public_path($storePath),$file_name);
            
            return $storePath.$file_name;
        

        }

        return null;

    }



    public function deleteFile($file_path){
         $old_file_path = public_path($file_path);

            if(File::exists($old_file_path)){
                        File::delete($old_file_path);
            }
    }
}