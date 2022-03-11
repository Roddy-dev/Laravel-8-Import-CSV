<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lebenslauf extends Model
{
    protected $fillable = [ 'person', 'tag', 'monat', 'jahr', 'beschreibung', 'dokument'];

    public function familie()
    {
        // return $this->belongsTo(Familie::class)->withDefault([
        // 'vorname' => 'Unknown',
        // 'nachname' => ' person',
        // ]);
        return $this->belongsTo(Familie::class);
    }
}
