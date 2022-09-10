<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tubes\RequestTubesCreate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Tube;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TubesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index ()
    {
        try {
            $tubes = Tube::orderBy('reference')
                ->paginate();
        } catch (ModelNotFoundException $e) {
            return $e;
        }
        return view('tubes.index', compact('tubes'));
    }

    public function addTubeForm ()
    {
        return view('tubes.addTubeForm');
    }

    public function updateTubeForm ()
    {
        return view('tubes.updateTubeForm');
    }

    public function showTubePage ($slug)
    {
        try {
            $tube = Tube::where('slug', $slug)->first();
        } catch (ModelNotFoundException $e) {
            return $e;
        }

        return view('tubes.showTube', compact('tube'));
    }

    public function create (RequestTubesCreate $request)
    {
        if ($request->datasheet !== null) {
            $datasheetName = strtoupper($request->reference) . "." . $request->datasheet->extension();
        }

        try {
            $tube = new Tube(array_merge($request->validated(), [
                'reference' => strtoupper($request->reference),
                'user_id' => Auth::user()->id,
                'datasheet' => $request->datasheet !== null ? $datasheetName : null,
                'slug' => Str::slug($request->reference)
            ]));

            if ($tube->save()) {
                if ($request->datasheet !== null) {
                    $request->datasheet->storeAs('datasheets/tubes/', $datasheetName, 'public');
                }
            }

        } catch (ModelNotFoundException $e) {
            return $e;
        }
        return redirect(route('tubes'));
    }
}
