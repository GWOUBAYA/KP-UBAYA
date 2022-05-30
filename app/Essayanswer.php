<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestAnswer
 *
 * @package App
 * @property string $question
 * @property string $answer
 * @property tinyInteger $correct
 */

class EssayAnswer extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'essay_id', 'answer', 'correct'];

    public static function boot()
    {
        parent::boot();

        TestAnswer::observe(new \App\Observers\UserActionsObserver);
    }

    public function question()
    {
        return $this->belongsTo(Essay::class, 'essay_id');
    }
}
