<?php

namespace App\Http\Controllers;

use App\Models\Partie;
use Illuminate\Http\Request;

class PartieController extends Controller
{
    public function index()
    {
        $parties = Partie::withCount('coups')->latest('id')->get();

        return view('parties.index', ['parties' => $parties]);
    }

    public function store()
    {
        $partie = Partie::create();

        return redirect()->route('parties.show', $partie);
    }

    public function show(Partie $partie)
    {
        return view('parties.show', [
            'partie' => $partie,
            'cases'  => $partie->cases(),
            'coups'  => $partie->coups()->orderBy('id')->get(),
        ]);
    }

    public function jouer(Request $request, Partie $partie)
    {
        $data = $request->validate([
            'position' => ['required', 'integer', 'between:0,8'],
        ]);
        $position = (int) $data['position'];

        if ($partie->estTerminee()) {
            return back()->withErrors(['position' => 'La partie est terminée.']);
        }

        if (! $partie->caseLibre($position)) {
            return back()->withErrors(['position' => 'Cette case est déjà occupée.']);
        }

        $partie->placer($position);

        return redirect()->route('parties.show', $partie);
    }

    public function annuler(Partie $partie)
    {
        $partie->annulerDernierCoup();

        return redirect()->route('parties.show', $partie);
    }
}
