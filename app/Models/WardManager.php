<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WardManager extends Model
{
    use HasFactory;

    protected $table = 'ward_managers';

    protected $fillable = [
        'user_id',
        'ward_code',
        'creator_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public $incrementing = true;
    protected $keyType = 'int';

}
