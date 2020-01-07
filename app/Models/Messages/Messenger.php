<?php

namespace App\Models\Messages;

use App\Traits\FormatsDate;
use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    use FormatsDate;
    public $incrementing = false;
    protected $primaryKey = 'owner_id';
    protected $guarded = [];

    public function owner()
    {
        return $this->morphTo();
    }
}
