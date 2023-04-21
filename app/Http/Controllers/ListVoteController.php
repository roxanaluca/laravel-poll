<?php 
namespace App\Http\Controllers;

use App\Models\PollVote;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
class ListVoteController extends BaseController {
 
    public function listVoteContent($start = 0, $end = 5) {
        $results = PollVote::all()->take($end - $start)->skip($start)->toArray();

        if (is_array($results)) {
            return $results;
        }
        return [];
    } 
}