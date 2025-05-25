<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{

    protected $table = 'thesis';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'supervisor',
        'year',
        'file_path',
        'file_name',
        'user_id',
    ];

    /**
     * Get the user that owns the thesis.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function examiner() {
        return $this->hasMany(Examiner::class, 'examiner_id');
    }
}
