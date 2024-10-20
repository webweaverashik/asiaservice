<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {     
        $results = FileUpload::where('is_deleted', 0)->orderBy('created_at', 'desc')->get();

        return view('index', compact('results'));
    }
}
