<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'title_fr', 'title_en', 'bio_fr', 'bio_en',
        'email', 'phone', 'github', 'linkedin', 'website',
        'avatar', 'cv_path', 'location', 'available', 'years_experience',
    ];

    protected $casts = [
        'available' => 'boolean',
        'years_experience' => 'integer',
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
