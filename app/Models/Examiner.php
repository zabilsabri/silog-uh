<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examiner extends Model
{
    protected $table = 'examiners';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'thesis_id',
        'name',
        'created_at',
        'updated_at',
    ];

    public function Thesis() {
        return $this->belongsTo(Thesis::class, 'thesis_id');
    }
}
