<?php
/**
 * Created by PhpStorm.
 * User: Rami M.Mohsen
 * Date: 6/7/2018
 * Time: 2:10 AM
 */

namespace App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class Encryptor
{

    public  static  function Encrypt_Content($filepath)
    {
        $encrypted_file = Crypt::encrypt(file_get_contents($filepath->getRealPath()));
        return $encrypted_file;
    }


    public  static  function  Decrypt_Content($file)
    {
        $encryptedContents = Storage::get($file->file_link);
        $decryptedContents = Crypt::decrypt($encryptedContents);

        return $decryptedContents;
    }





}