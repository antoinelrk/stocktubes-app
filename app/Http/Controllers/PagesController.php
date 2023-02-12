<?php

namespace App\Http\Controllers;

use App\Traits\ZipMakerTrait;
use Illuminate\Support\Facades\Storage;
use Zip;

class PagesController extends Controller
{
    use ZipMakerTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home ()
    {
        return view('home');
    }

    public function zipDatasheets ()
    {
        $files = Storage::disk('public')->allFiles('/datasheets/tubes/');
        $this->makeZip($files, "datasheets-tubes.zip");

        // foreach ($files as $file) {
        //     $zip->add(public_path('storage/') . $file);
        // }
        // $zip->saveTo(public_path() . '/storage');
        // return $zip;

        /**
         * Mettre le path public en préfix 
         */
        // return Zip::create("datasheets-tubes.zip", $files)
        //             ->saveTo(public_path() . '/storage');
        // return response()->download($zip);
    }
}
