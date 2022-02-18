<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Familie extends Model
{
    protected $fillable = ['id', 'nachname', 'vorname', 'geburtsdatum', 'geburtsjahr',
    'geburtsort', 'heiratsdatum', 'heiratsjahr', 'heiratsort', 'sterbedatum',
    'sterbejahr', 'sterbeort', 'taufdatum', 'taufort'];

    public function lebenslauf()
    {
        return $this->belongsToMany(Lebenslauf::class);
    }

    public function verweise()
    {
        return $this->belongsToMany(Verweise::class);
    }

    public function setGeburtsdatumAttribute($value)
    {
        if ($value != null) {
            $this->attributes['geburtsdatum'] = Carbon::createFromFormat('d.m.Y', $value)->format('Y-m-d');
        }
    }

    public function setGeburtsjahrAttribute($value)
    {
        if ($value != null) {
            $this->attributes['geburtsjahr'] = $value;
        }
    }

    public function setHeiratsdatumAttribute($value)
    {
        if ($value != null) {
            $this->attributes['heiratsdatum'] = Carbon::createFromFormat('d.m.Y', $value)->format('Y-m-d');
        }
    }

    public function setSterbedatumAttribute($value)
    {
        if ($value != null) {
            $this->attributes['sterbedatum'] = Carbon::createFromFormat('d.m.Y', $value)->format('Y-m-d');
        }
    }

    public function setTaufdatumAttribute($value)
    {
        if ($value != null) {
            $this->attributes['taufdatum'] = Carbon::createFromFormat('d.m.Y', $value)->format('Y-m-d');
        }
    }
}
