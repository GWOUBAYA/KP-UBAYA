<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Essay
 *
 * @package App
 * @property string $topic
 * @property text $essay_text
 * @property text $code_snippet
 * @property text $answer_explanation
 * @property string $more_info_link
 */

class Essay extends Model
{
    use SoftDeletes;

    protected $fillable = ['essay_text', 'code_snippet', 'more_info_link', 'topic_id'];

    public static function boot()
    {
        parent::boot();

        essay::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTopicIdAttribute($input)
    {
        $this->attributes['topic_id'] = $input ? $input : null;
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id')->withTrashed();
    }

    public function options()
    {
        return $this->hasMany(EssayAnswer::class, 'essay_id')->withTrashed();
    }
}
