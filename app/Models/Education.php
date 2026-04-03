<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'school', 'logo', 'degree_fr', 'degree_en',
        'field_fr', 'field_en', 'description_fr', 'description_en',
        'start_year', 'end_year', 'order',
    ];

    protected $casts = [
        'start_year' => 'integer',
        'end_year' => 'integer',
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
