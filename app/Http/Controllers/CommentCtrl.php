<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Podcast;
use App\Comment;

class CommentCtrl extends Controller
{
    public function create (Request $request, $id) {
        /*
            public_name: true
            seconds: null
            text: "affe"
            with_seconds: true
        */

        $user = $request->user();

        $this->validate($request, [
            'public_name' => 'required',
            'text' => 'required'
        ]);

        // Variables
        $seconds = $request->seconds;
        $with_seconds = $request->with_seconds;
        $text = $request->text;


        // Find Podcast
        $podcast = Podcast::find($id);

        // Create Comment
        $podcast->comments()->create([
            'user_id' => $user->id,
            'text' => $text,
            'seconds' => ($with_seconds && $seconds) ? $seconds : null,
        ]);

        return true;
        // return $request->text;
    }
}
