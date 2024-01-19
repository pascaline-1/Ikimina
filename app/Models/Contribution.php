<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'amount',
        'contribution_date'
    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
