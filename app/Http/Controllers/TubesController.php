<?php

namespace App\Http\Controllers;

use App\Models\Tube;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Tubes\TubeUpdateRequest;
use App\Http\Requests\Tubes\TubeCreateRequest;
use Illuminate\Support\Facades\Storage;

class TubesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => 'test'
        ]);
    }

    public function index ()
    {
        $tubes = Tube::orderBy('reference')->paginate(env('PAGINATE_DEFAULT'));
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

    public function create (TubeCreateRequest $request)
    {
        $slug = Str::slug($request->reference);
        if ($request->datasheet !== null) {
            $datasheetName = $slug . "." . $request->datasheet->extension();
        }

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
            return redirect(route('tubes'))->with(['success' => "Le tube $tube->reference a bien été ajouté."]);
        }
        return back()->with(['errors' => "Impossible d'ajouter le tube, contactez un administrateur."]);
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
            'datasheet' => $request->datasheet !== null ? $datasheetName : $tube->datasheet,
            'slug' => $slug
        ]))) {
            if ($request->datasheet !== null) {
                $request->datasheet->storeAs('datasheets/tubes/', $datasheetName, 'public');
            }
            return redirect(route('tubes.show', $tube->slug))
                ->with(['success' => "Le tube $tube->reference à bien été modifié."]);
        }

        return back()->with(['errors' => "Impossible de modifier le tube $tube->reference, contactez un administrateur."]);
    }

    public function removeDatasheet ($slug)
    {
        $tube = Tube::where('slug', $slug)->first();
        if ($this->deleteDatasheet($tube)) {
            $tube->datasheet = null;
            if ($tube->update()) {
                return redirect(route('tubes.show', $tube->slug))->with(['success' => "Le datasheet du tube $tube->reference a bien été supprimé."]);
            }
            return back()->with(['errors' => "Impossible de supprimer le tube $tube->reference, contactez un administrateur."]);
        }
        return back()->with(['errors' => "Impossible de supprimer le datasheet pour le tube $tube->reference, contactez un administrateur."]);
    }

    private function deleteDatasheet ($tube): bool
    {
        if (Storage::disk('public')->delete("datasheets/tubes/$tube->datasheet")) return true;
        return false;
    }

    public function delete($slug)
    {
        if (($tube = Tube::where('slug', $slug)->first()) !== null) {
            if ($tube->datasheet !== null) {
                if (!$this->deleteDatasheet($tube)) return back()->with(['errors' => "Impossible de supprimer le datasheet du tube $tube->reference, contactez un administrateur."]);
            }

            if ($tube->delete()) {
                return redirect(route('tubes'))->with(['success' => "Le tube $tube->reference à bien été supprimé."]);
            }
            return back()->with(['errors' => "Impossible de supprimer le tube $tube->reference, contactez un administrateur. [Erreur DB]"]);
        }

        return back()->with(['errors' => "Le tube $slug n'existe pas !"]);
    }
}
