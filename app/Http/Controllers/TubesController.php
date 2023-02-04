<?php

namespace App\Http\Controllers;

use App\Models\Tube;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Tube\TubeUpdateRequest;
use App\Http\Requests\Tubes\RequestTubesCreate;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TubesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index ()
    {
        $tubes = Tube::orderBy('reference')->paginate(10);
        return view('tubes.index', compact('tubes'));
    }

    public function addTubeForm ()
    {
        return view('tubes.addTubeForm');
    }

    public function updateTubeForm ($slug)
    {
        $tube = Tube::where('slug', $slug)->first();
        return view('tubes.updateTubeForm', compact('tube'));
    }

    public function showTubePage ($slug)
    {
        $tube = Tube::where('slug', $slug)->first();
        return view('tubes.showTube', compact('tube'));
    }

    public function create (RequestTubesCreate $request)
    {
        $slug = Str::slug($request->reference);

        if ($request->datasheet !== null) {
            $datasheetName = $slug . "." . $request->datasheet->extension();
        }

        try {
            $tube = new Tube(array_merge($request->validated(), [
                'reference' => strtoupper($request->reference),
                'user_id' => Auth::user()->id,
                'datasheet' => $request->datasheet !== null ? $datasheetName : null,
                'slug' => $slug
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

    public function update (TubeUpdateRequest $request, $slug)
    {
        if (($tube = Tube::where('slug', $slug)->first()) === null) return back()->with(['errors' => "Le tube $slug n'existe pas!"]);
        $slug = Str::slug($request->reference);

        if ($request->datasheet !== null) {
            $datasheetName = $slug . "." . $request->datasheet->extension();
        }

        if ($tube->update(array_merge($request->validated(), [
            'reference' => strtoupper($request->reference),
            'user_id' => Auth::user()->id,
            'datasheet' => $request->datasheet !== null ? $datasheetName : null,
            'slug' => $slug
        ]))) {
            if ($request->datasheet !== null) {
                $request->datasheet->storeAs('datasheets/tubes/', $datasheetName, 'public');
            }
        }
        return redirect(route('tubes.show', $tube->slug));
    }

    public function delete($slug)
    {
        $tube = Tube::where('slug', $slug)->first();
        // TODO: Supprimer aussi le datasheet
        if ($tube->delete()) return redirect(route('tubes'))->with(['success' => "Le tube $tube->reference à bien été supprimé."]);
        return back()->with(['errors' => "Impossible de supprimer le tube $tube->reference, contactez un administrateur"]);
    }
}
