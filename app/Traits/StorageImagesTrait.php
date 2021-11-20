<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImagesTrait {
    public function storageUploadFile($request, $fieldName, $folderName) {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileName = $request->file($fieldName)->getClientOriginalName(); //Lấy tên file;
            $hashName = Str::random(20) . '.'. $file->getClientOriginalExtension();//Lấy tên file ngẫu nhiên;
            $filePath = $request->file($fieldName)->storeAs('public/'. $folderName, $hashName);
            $dataUploadFile = [
                'file_name' => $fileName,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadFile;
        }
        return null;
    }
}

