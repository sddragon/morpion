<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partie extends Model
{
    protected $table = 'parties';

    protected $fillable = ['plateau', 'joueur_courant'];

    private const ALIGNEMENTS = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8],
        [0, 3, 6], [1, 4, 7], [2, 5, 8],
        [0, 4, 8], [2, 4, 6],
    ];

    public function coups(): HasMany
    {
        return $this->hasMany(Coup::class);
    }

    public function cases(): array
    {
        return str_split($this->plateau);
    }

    public function caseLibre(int $position): bool
    {
        return $this->cases()[$position] === '-';
    }

    public function placer(int $position): void
    {
        $symbole = $this->joueur_courant;

        $plateau = $this->plateau;
        $plateau[$position] = $symbole;
        $this->plateau = $plateau;
        $this->joueur_courant = $symbole === 'X' ? 'O' : 'X';
        $this->save();

        $this->coups()->create([
            'position' => $position,
            'symbole'  => $symbole,
        ]);
    }

    public function gagnant(): ?string
    {
        $cases = $this->cases();

        foreach (self::ALIGNEMENTS as [$a, $b, $c]) {
            if ($cases[$a] !== '-' && $cases[$a] === $cases[$b] && $cases[$a] === $cases[$c]) {
                return $cases[$a];
            }
        }

        return null;
    }

    public function estNulle(): bool
    {
        return $this->gagnant() === null && ! str_contains($this->plateau, '-');
    }

    public function estTerminee(): bool
    {
        return $this->gagnant() !== null || $this->estNulle();
    }

    public function annulerDernierCoup(): void
    {
        $coup = $this->coups()->latest('id')->first();

        if ($coup === null) {
            return;
        }

        $plateau = $this->plateau;
        $plateau[$coup->position] = '-';
        $this->plateau = $plateau;
        $this->joueur_courant = $coup->symbole;
        $this->save();

        $coup->delete();
    }

    public function statut(): string
    {
        if ($gagnant = $this->gagnant()) {
            return 'Gagnée par ' . $gagnant;
        }

        return $this->estNulle() ? 'Match nul' : 'En cours';
    }
}