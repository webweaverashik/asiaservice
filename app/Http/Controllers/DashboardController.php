<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {     
        $results = FileUpload::all();

        // return $results;

        return view('index', compact('results'));
    }
}
