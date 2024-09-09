<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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
    // public function store(Request $request)
    // {
    //     // Validate the form input
    //     $request->validate([
    //         'pb_reference' => 'required|string',
    //         'csv_file' => 'required|mimes:csv,txt|max:200', // CSV or plain text validation
    //     ],
    //     [
    //         'pb_reference.required' => 'Reference no. is required',
    //         'csv_file.required' => 'CSV file is required',
    //     ]);

    //     // Check if the file is present
    //     if ($request->hasFile('csv_file')) {

    //         $file = $request->file('csv_file');
    //         $extension = $file->getClientOriginalExtension();

    //         $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) .  '_' . date('d_M_Y_h_i_s_A') . '.' . $extension;

    //         $path = 'uploads/csv/' . date('M_Y') . '/';

    //         $file->move($path, $filename);


    //         FileUpload::create([
    //             'reference_key' => $request->pb_reference,
    //             'csv_name' => $file->getClientOriginalName(),
    //             'file_url' => $path.$filename,
    //             'pin_count' => $request->memorandum_no,
    //             'balance' => $request->sent_date,
    //         ]);

    //         // Optional: Return success response
    //         return back()->with('success', 'File uploaded successfully.');
    //     } else {
    //         return back()->with('error', 'No file uploaded.');
    //     }
    // }
    public function store(Request $request)
{
    // Validate the form input
    $request->validate([
        'pb_reference' => 'required|string',
        'csv_file' => 'required|mimes:csv,txt|max:200', // CSV or plain text validation
    ], [
        'pb_reference.required' => 'Reference no. is required',
        'csv_file.required' => 'CSV file is required',
    ]);

    // Check if the file is present
    if ($request->hasFile('csv_file')) {
        $file = $request->file('csv_file');
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . date('d_M_Y_h_i_s_A') . '.' . $file->getClientOriginalExtension();
        
        // Save the file in the 'public/uploads/csv/' folder
        $path = 'uploads/csv/' . date('M_Y') . '/';
        $file->move(public_path($path), $filename);

        // Read the CSV file using the correct path
        $filePath = public_path($path . $filename);
        $csvData = array_map('str_getcsv', file($filePath));

        // Skip the first 16 rows and remove the last 2 rows
        $csvData = array_slice($csvData, 16, -1);

        // Get the row count
        $rowCount = count($csvData);

        // Extract the 4th column value
        if ($rowCount > 0) {
            $fourthColumnValue = $csvData[0][3]; // Get 4th column value (assuming all rows have the same value)
        }


        FileUpload::create([
            'reference_key' => $request->pb_reference,
            'csv_name' => $file->getClientOriginalName(),
            'file_url' => $path.$filename,
            'pin_count' => $rowCount,
            'balance' => $fourthColumnValue,
        ]);
        
        // Return success response
        return back()->with('success', 'File uploaded successfully. Row count: ' . $rowCount . '. 4th column value: ' . $fourthColumnValue);
    } else {
        return back()->with('error', 'No file uploaded.');
    }
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
