<?php


namespace App\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * Upload file in system
     *
     * @param Request $request
     * @return string
     */

    public static function storeFile(Request $request): string
    {
        return $request->file('file')->store('attachments', 'public');
    }

    /**
     * Delete file from system
     *
     * @param string $filePath
     */

    public static function deleteFile(string $filePath)
    {
        Storage::delete(public_path($filePath));
    }
}