<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $fillable = [
        'name_fr', 'name_en', 'icon', 'color', 'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function trans(string $field): string
    {
        $locale = app()->getLocale();
        $localizedField = $field . '_' . $locale;
        if (isset($this->attributes[$localizedField])) {
            return $this->attributes[$localizedField] ?? '';
        }
        $fallback = $field . '_fr';
        return $this->attributes[$fallback] ?? '';
    }
}
