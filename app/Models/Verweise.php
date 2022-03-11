<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verweise extends Model
{
    protected $fillable = ['person_id', 'zu_person_id', 'katagorie', 'beschreibung'];

    public function familie()
    {
        return $this->belongsTo(Familie::class);
    }

    public function setZuPersonIdAttribute($value)
    {
        if ($value == 0) {
            $this->attributes['zu_person_id'] = null;
        }
    }
}
