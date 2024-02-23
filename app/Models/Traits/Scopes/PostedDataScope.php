<?php

namespace App\Models\Traits\Scopes;

trait PostedDataScope {
    public function scopeSelection($q) {
        return $q->with('media');
    }
}
