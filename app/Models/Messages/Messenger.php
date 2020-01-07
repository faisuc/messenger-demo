<?php

namespace App\Models\Messages;

use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'owner_id';
    protected $guarded = [];

    public function owner()
    {
        return $this->morphTo();
    }
}
