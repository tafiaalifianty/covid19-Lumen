<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logs';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'symptom_id', 'temperature', 'is_traveling', 'traveling_history', 'log_date'];

    /**
     * Return relation from symptom model
     *
     */
    public function symptom() {
        return $this->belongsTo(Symptom::class, 'symptom_id', 'id');
    }

    /**
     * Return relation from user model
     *
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
