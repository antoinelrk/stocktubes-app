<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SemiConductor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Smc\SmcCreateRequest;
use App\Http\Requests\Smc\SmcUpdateRequest;

class SemiConductorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index ()
    {
        $smc = SemiConductor::orderBy('reference')->paginate(env('PAGINATE_DEFAULT'));
        return view('smc.index', compact('smc'));
    }

    public function updateSmcForm ($slug)
    {
        $smc = SemiConductor::where('slug', $slug)->first();
        return view('smc.updateSmcForm', compact('smc'));
    }

    public function showSmcPage ($slug)
    {
        $smc = SemiConductor::where('slug', $slug)->first();
        return view('smc.showSmc', compact('smc'));
    }

    public function create(SmcCreateRequest $request)
    {
        $slug = Str::slug($request->reference);
        if ($request->datasheet !== null) {
            $datasheetName = $slug . "." . $request->datasheet->extension();
        }

        $smc = new SemiConductor(array_merge($request->validated(), [
            'reference' => strtoupper($request->reference),
            'user_id' => Auth::user()->id,
            'datasheet' => $request->datasheet !== null ? $datasheetName : null,
            'slug' => $slug
        ]));

        if ($smc->save()) {
            if ($request->datasheet !== null) {
                $request->datasheet->storeAs('datasheets/smc/', $datasheetName, 'public');
            }
            return redirect(route('smc'))->with(['success' => "Le semi-conduteur $smc->reference a bien été ajouté."]);
        }
        return back()->with(['errors' => "Impossible d'ajouter le semi-conduteur, contactez un administrateur."]);
    }

    public function update(SmcUpdateRequest $request, $slug)
    {
        if (($smc = SemiConductor::where('slug', $slug)->first()) === null) return back()->with(['errors' => "Le semi-conducteur $slug n'existe pas!"]);
        $slug = Str::slug($request->reference);

        if ($request->datasheet !== null) {
            $datasheetName = $slug . "." . $request->datasheet->extension();
        }

        if ($smc->update(array_merge($request->validated(), [
            'reference' => strtoupper($request->reference),
            'datasheet' => $request->datasheet !== null ? $datasheetName : $smc->datasheet,
            'slug' => $slug
        ]))) {
            if ($request->datasheet !== null) {
                $request->datasheet->storeAs('datasheets/smc/', $datasheetName, 'public');
            }
            return redirect(route('smc.show', $smc->slug))
                ->with(['success' => "Le semi-conducteur $smc->reference à bien été modifié."]);
        }

        return back()->with(['errors' => "Impossible de modifier le semi-conducteur $smc->reference, contactez un administrateur."]);
    }

    public function removeDatasheet ($slug)
    {
        $smc = SemiConductor::where('slug', $slug)->first();
        if ($this->deleteDatasheet($smc)) {
            $smc->datasheet = null;
            if ($smc->update()) {
                return redirect(route('smc.show', $smc->slug))->with(['success' => "Le datasheet du semi-conduteur $smc->reference a bien été supprimé."]);
            }
            return back()->with(['errors' => "Impossible de supprimer le semi-conduteur $smc->reference, contactez un administrateur."]);
        }
        return back()->with(['errors' => "Impossible de supprimer le datasheet pour le semi-conduteur $smc->reference, contactez un administrateur."]);
    }

    private function deleteDatasheet ($smc): bool
    {
        if (Storage::disk('public')->delete("datasheets/smc/$smc->datasheet")) return true;
        return false;
    }

    public function delete($slug)
    {
        if (($smc = SemiConductor::where('slug', $slug)->first()) !== null) {
            if ($smc->datasheet !== null) {
                if (!$this->deleteDatasheet($smc)) return back()->with(['errors' => "Impossible de supprimer le datasheet du semi-conduteur $smc->reference, contactez un administrateur."]);
            }

            if ($smc->delete()) {
                return redirect(route('smc'))->with(['success' => "Le semi-conduteur $smc->reference à bien été supprimé."]);
            }
            return back()->with(['errors' => "Impossible de supprimer le semi-conduteur $smc->reference, contactez un administrateur. [Erreur DB]"]);
        }

        return back()->with(['errors' => "Le semi-conduteur $slug n'existe pas !"]);
    }
}
