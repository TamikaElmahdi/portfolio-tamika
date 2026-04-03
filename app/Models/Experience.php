<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company', 'logo', 'position_fr', 'position_en',
        'description_fr', 'description_en', 'start_date', 'end_date',
        'is_current', 'location', 'contract_type', 'order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
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
