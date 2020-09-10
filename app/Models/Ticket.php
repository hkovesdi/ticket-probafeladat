<?php

namespace App\Models;

use App\Helpers\DueDateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content'
    ];

    protected static function boot() {
        parent::boot();
    
        static::saving(function($model){
            $model->due_date = (new DueDateHelper())->calculateDueDate();
        }); 
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('\App\Models\Customer', 'customer_id');
    }
}