<?php

namespace App\Core\Records\Models;

use App\Core\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Exercise
 * @package App\Core\Records\Models
 *
 * @property string $name
 * @property string|null $description
 */
class Exercise extends Model
{
    protected $table = 'records_exercises';

    protected $fillable = [
        'name',
        'description'
    ];

    public $timestamps = false;

    public function edit(string $name, ?string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
