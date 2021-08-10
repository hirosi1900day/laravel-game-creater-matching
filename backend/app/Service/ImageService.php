<?php

namespace App\Service;


use Illuminate\Support\Facades\Storage;

class ImageService {
   public static function uplodeFile($file, $fileName, $latepath) {
      if(!$latepath){
         //新規登録
         //保存するファイルに名前をつける 
         $fileName = time().'.'.$file->getClientOriginalExtension();
         $path = Storage::disk('s3')->putFileAs('$fileName',$file, $fileName,'public');
          return $path;
     } else {
         //アップデート
         //保存するファイルに名前をつける
         Storage::disk('s3')->delete($latepath);
         $fileName = time().'.'. $file->getClientOriginalExtension();
         $path = Storage::disk('s3')->putFileAs('$fileName',$file, $fileName,'public');
         return $path;
     }
   }
}
