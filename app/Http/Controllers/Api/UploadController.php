<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:pdf']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::random(40) . '.pdf';
            $path = $file->storeAs('pdfs', $filename, 's3');
            $url = Storage::cloud()->url($path);
            
            return response()->json(['url' => $url], 201);
        }

        return response()->json(['error' => 'Invalid file upload.'], 422);
    }
}
