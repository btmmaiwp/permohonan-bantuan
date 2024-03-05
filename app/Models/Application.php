<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    /* relationships */

    // Application::with(['scheme', 'user', 'createdBy'])->get();

    // Application::with('scheme')->get();
    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    // Application::with('user')->get();
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Application::with('createdBy')->get();
    function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
