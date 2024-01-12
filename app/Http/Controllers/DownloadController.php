<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Project_file;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class DownloadController extends Controller
{
    public function download(Request $request)
    {
        $path = $request->input('path');
        return Storage::download($path);
    }

}


