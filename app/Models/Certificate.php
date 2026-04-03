<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title_fr', 'title_en', 'organization', 'issued_date',
        'expiry_date', 'credential_url', 'image', 'description_fr',
        'description_en', 'order',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'expiry_date' => 'date',
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
