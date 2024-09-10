<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {     
        $results = FileUpload::orderBy('created_at', 'desc')->where('is_deleted', 0)->get();

        return view('index', compact('results'));
    }
}
