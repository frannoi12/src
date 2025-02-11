<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commande extends Model
{
    use HasFactory;
    protected $fillable=[
        'client',
        'vendeur_id',
        'date',
        'montant'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function lignecommandes() : HasMany{
        return $this->hasMany(LigneCommande::class);
    }
    public function user() : BelongsTo{
        return$this->belongsTo(User::class, "vendeur_id");
    }
}
