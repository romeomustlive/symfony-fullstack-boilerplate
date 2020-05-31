<?php

namespace App\Core\Records\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Result
 * @package App\Core\Records\Models
 *
 * @property float $weight
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Result extends Model
{
    protected $table = 'records_results';

    protected $fillable = [
        'weight',
        'quantity'
    ];

    public function edit(float $weight, int $quantity)
    {
        $this->weight = $weight;
        $this->quantity = $quantity;
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
