<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

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
    public function storeAndPrepareData(Request $request)
    {
        // Validate the form input
        $request->validate(
            [
                'pb_reference' => 'required|string',
                'csv_file' => 'required|mimes:csv,txt|max:200', // CSV or plain text validation
            ],
            [
                'pb_reference.required' => 'Reference no. is required',
                'csv_file.required' => 'CSV file is required',
            ]
        );

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

            // Check the content of the parsed CSV for debugging
            // Uncomment the line below to debug the CSV data
            // dd($csvData);

            // Skip the first 16 rows and remove the last 1 row (blank lines)
            $csvData = array_slice($csvData, 16, -1);

            // Get the row count
            $rowCount = count($csvData);

            // Prepare PDF data
            $pinBatches = [];
            foreach ($csvData as $row) {
                // Ensure that the 4th column exists in the row and handle edge cases
                $balance = isset($row[3]) ? preg_replace('/\.00$/', '', $row[3]) : '0';

                $pinBatches[] = [
                    'serial_no' => $row[0] ?? '',  // Handle empty serial no
                    'pin' => isset($row[1]) ? trim($row[1], '="') : '',
                    'pass' => isset($row[2]) ? trim($row[2], '="') : '',
                    'balance' => $balance,  // Balance might be empty if the column isn't present
                    'pb_reference' => $request->pb_reference,
                ];
            }

            // Debugging: If you're still getting an empty "balance" value, use this:
            // dd($pinBatches);

            // Return the data
            // return $pinBatches;

            // Load the image URL
            $rearImageUrl = asset('uploads/img/rear-image.jpg'); // Use asset URL for blade

            // Store information in the database (optional)
            FileUpload::create([
                'reference_key' => $request->pb_reference,
                'csv_name' => $file->getClientOriginalName(),
                'file_url' => $path . $filename,
                'pin_count' => $rowCount,
                'balance' => $fourthColumnValue ?? null, // Use $fourthColumnValue only if it exists
            ]);

            $reference = $request->pb_reference;
            // Redirect to the page where the PDF will be generated with the data passed
            return view('pdf.index', compact('pinBatches', 'rearImageUrl', 'reference'));
        } else {
            return back()->with('warning', 'No file uploaded.');
        }
    }

     

    /**
     * Generating PDF of the print file
     */
    public function pdfGeneration()
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FileUpload::where('id', $id)->update([
            'is_deleted' => 1,
        ]);

        return redirect()->back()->with('success', 'File has been deleted successfully');
    }
}
