<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'symptoms';

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
    protected $fillable = ['symptom_name', 'suggestion'];

    /**
     * Return relation from log model
     *
     */
    public function logs() {
        return $this->hasMany(Log::class);
    }

}
