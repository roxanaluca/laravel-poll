<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model {
    public function poll_vote_id()
    {
        return $this->belongsTo('App\Models\PollVote', 'poll_vote_id');
    }

    protected $table = 'choice';
}