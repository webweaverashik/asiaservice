<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (! Auth::check()) {
        //     return Redirect::route('login')->with('fail', 'Please, login first.');
        // }
        
        return view('file_upload.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $request->validate([
            'pb_reference' => 'required',
            'csv_file' => 'required|mimes:csv',
        ],
        [
            'pb_reference.required' => 'Reference no. is required',
            'csv_file.required' => 'CSV file is required',
            'csv_file.mimes' => 'Upload only .csv file',
        ]);


        if ($request->has('csv_file')) {
            $file = $request->file('csv_file');
            $extension = $file->getClientOriginalExtension();

            $filename = 'pinbatch_'.date('dmY_His').'.'.$extension;

            $path = 'uploads/csv/'.date('M-Y').'/';
            // $file->move($path, $filename);

        } else {
            $path = null;
            $filename = null;
        }

        // FileUpload::create([
        //     'reference_key' => $request->pb_reference,
        //     'csv_name' => $request->received_date,
        //     'file_url' => $path.$filename,
        //     'pin_count' => $request->memorandum_no,
        //     'balance' => $request->sent_date,
        // ]);

        $file->move($path, $filename);


        return redirect('/upload')->with('success', 'PDF generated successfully. Please, print the file in duplex mode.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FileUpload $fileUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FileUpload $fileUpload)
    {
        //
    }
}
