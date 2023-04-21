<?php 
namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\PollVote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
class VoteController extends BaseController
{
    public function printFullPollVote(Request $request, $id) {
        $question = PollVote::find($id);
        $choices = Choice::where('poll_vote_id', $id)->get()->toArray();
        $data = ['question'=> $question, 'choices' => $choices ];

        return response()->json($data)->header('Content-Type', 'application/json');
    }

    public function voteChoice(Request $request) {
        $request->validate([
            'answer' => 'required',
            '_id' => 'required'
        ]);
        $choices = Choice::where('poll_vote_id', $request->_id)->get();

        if (is_array($request->input('answer'))) { 
            foreach($request->input('answer') as $answer) {
                $choices[$answer]->votes = $choices[$answer]->votes + 1;
                $choices[$answer]->save();
            }
        } else {
            $choices[$request->answer]->votes = $choices[$request->answer]->votes + 1;
            $choices[$request->answer]->save();
        }

        return redirect('/');
    }
    
    public function addPollQuestion(Request $request) {
        $request->validate([
            'count' => 'required',
            'is_single_check' => 'nullable',
            'expire_at' => 'nullable',
            'statement' => 'required',
            'email' => 'required'
        ]);

        $id = User::where('email', $request->email)->get()[0]->id;

        $pollquestion = new PollVote();
        $pollquestion->user_id = $id;
        $pollquestion->statement = $request->statement;
        $pollquestion->expires_at = $request->expire_at;
        $pollquestion->is_single_check = $request->is_single_check === 'on';
        $pollquestion->publish_date = date('Y-m-d h:i:s', time());
        $pollquestion->save();

        for ($i = 0; $i< $request->count; $i++) {
            $choice = new Choice();
            $choice->statement = $request[$i];
            $choice->poll_vote_id = $pollquestion->id;
            $choice->save();
        }
        return redirect('/');
    }
}