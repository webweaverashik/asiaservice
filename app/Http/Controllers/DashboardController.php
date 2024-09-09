<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {     
        $results = FileUpload::orderBy('created_at', 'desc')->get();

        // return $results;

        return view('index', compact('results'));
    }
}
