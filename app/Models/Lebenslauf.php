<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lebenslauf extends Model
{
    protected $fillable = [ 'person', 'tag', 'monat', 'jahr', 'lebenslaufdate', 'beschreibung', 'dokument'];

    public function familie()
    {
        // return $this->belongsTo(Familie::class)->withDefault([
        // 'vorname' => 'Unknown',
        // 'nachname' => ' person',
        // ]);
        return $this->belongsTo(Familie::class);
    }

    // public function setLebenslaufdateAttribute()
    // why not just store as given tag monat and jahr and have a ?? or display in blade
// no mutation just a way of displaying
    // {
    //     if (isset($this->attributes['tag']) && isset($this->attributes['monat']) && (isset($this->attributes['jahr']))) {
    //         $this->attributes['lebenslaufdate'] =
    //             date("Y-m-d", mktime(
    //                 0,
    //                 0,
    //                 0,
    //                 $this->attributes['tag'],
    //                 $this->attributes['monat'],
    //                 $this->attributes['jahr']
    //             ));
    //     }
    // }
}
