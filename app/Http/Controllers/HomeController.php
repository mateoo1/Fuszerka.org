<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Post;
use App\Comment;
use App\Reply;
use App\Traffic;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Only this methodes are allowed to execute for unregistered users
        $this->middleware('auth', ['except' => ['fuszerki', 'profeski']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $name = auth()->user()->name;
        $user = User::find($user_id);

        #$post = Post::find($id);
        #$posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('home')->with('posts', $user->posts);
    }

    public function fuszerki() 
    {
        // Show all posts sorted by number of negative votes
        $posts = Post::orderBy('num_of_neg', 'desc')->paginate(10);
        return view('pages/fuszerki')->with('posts', $posts);  
    }

    public function profeski() 
    {
        // Show all posts sorted by number of positive votes
        $posts = Post::orderBy('num_of_pos', 'desc')->paginate(10);
        return view('pages/profeski')->with('posts', $posts);  
    }

    // *** ADMINISTRATION ***
    public function queue()
    {
        // check if Administrator
        if (auth()->user()->name  == "Administrator") {
            $posts = Post::orderBy('id', 'asc')->get();
            return view('pages/queue')->with('posts', $posts);
        }
        return redirect('/');
    }

    public function rejected()
    {
        // check if Administrator
        if (auth()->user()->name  == "Administrator") {
            $posts = Post::orderBy('id', 'asc')->get();
            return view('pages/rejected')->with('posts', $posts);
        }
        return redirect('/');
    }

    public function traffic() 
    {
        // check if Administrator
        if (auth()->user()->name  == "Administrator") {
            
            $visits = Traffic::orderBy('updated_at', 'desc')->get();
            return view('pages/traffic')->with('visits', $visits);

        }

        return redirect('/');
    }

    public function users() 
    {
        // check if Administrator
        if (auth()->user()->name  == "Administrator") {

            $users = user::orderBy('created_at', 'desc')->get();
            return view('pages/users')->with('users', $users);

        }
        return redirect('/');
    }
    //  ***         ***         ***
  

    //  *** POST MANAGEMENT ***
    public function approve()
    {
        $post_to_approve = request('post_id');
        $post = Post::find($post_to_approve);
        $post->admin_approval = 1;
        $post->save();
        return redirect('/queue')->with('success', 'Zaakceptowano post');
    }

    public function unapprove()
    {
        $post_to_unapprove = request('post_id');
        $post = Post::find($post_to_unapprove);
        $post->admin_approval = 0;
        $post->save();
        return redirect('/queue')->with('success', 'Post cofnięty do kolejki.');
    }

    public function reject()
    {
        $post_to_reject = request('post_id');
        $reject_reason = request('reject_reason');
        $post = Post::find($post_to_reject);
        $post->admin_approval = 2;
        $post->reject_reason = $reject_reason;
        $post->save();
        return redirect('/queue')->with('success', 'Post odrzucony.');
    }

    public function revoke()
    {
        $post_to_reject = request('post_id');
        $reject_reason = request('reject_reason');
        $post = Post::find($post_to_reject);
        $post->admin_approval = 0;
        $post->save();
        return redirect('/rejected')->with('success', 'Post cofnięty do kolejki.');
    }
    //  ***         ***         ***


    //  *** VOTING SYSTEM ***
    public function positive(Request $request)
    {
        //variables from AJAX
        $user_id = $request->positive_vote;
        $post_id = $request->post_id;

        //array for tests
        $response = array(
            'status' => 'success',
            'alert' => 'Już głosowałeś.',
            'post_id' => '#info'. $post_id,
        );

        //prepare apendded record for databse
        $positive_vote = $request->positive_vote . ',';

        //get post from db
        $post = Post::find($post_id);

        //get votes from both columns and merge them to check if user commit vote to any
        $positive_votes_array = explode(',', $post->positives);
        $negative_votes_array = explode(',', $post->negatives);
        $votes_array = array_merge( $positive_votes_array, $negative_votes_array);

        //check if user voted
        if(in_array($user_id, $votes_array)){
            return response()->json($response); 
        }

        //if not save user vote and return to index
        $post->positives = $post->positives . $positive_vote;
        $post->save();


            //   ***   Select, count and update how many votes are commited   ***
            $post_after_save = Post::find($post_id);
            $positive_votes_array_after_save = explode(',', $post->positives);
            $negative_votes_array_after_save = explode(',', $post->negatives);
            $post_after_save->num_of_pos = count($positive_votes_array_after_save)-1;
            $post_after_save->num_of_neg = count($negative_votes_array_after_save)-1;
            $post_after_save->save();
            //   ***   ***   ***   ***   ***   ***   ***   ***


        return response()->json($response);
    }

    public function negative(Request $request)
    {
        //variables from AJAX
        $user_id = $request->negative_vote;
        $post_id = $request->post_id;

        //array for tests
        $response = array(
            'status' => 'success',
            'alert' => 'Już głosowałeś.',
            'post_id' => '#info'. $post_id,
        );

        //for databse
        $negative_vote = $request->negative_vote . ',';

        $post = Post::find($post_id);

        $positive_votes_array = explode(',', $post->positives);
        $negative_votes_array = explode(',', $post->negatives);
        $votes_array = array_merge( $positive_votes_array, $negative_votes_array);

        if(in_array($user_id, $votes_array)){
            return response()->json($response);  
        }

        $post->negatives = $post->negatives . $negative_vote;
        $post->save();


            //   ***   Select, count and update how many votes are commited   ***
            $post_after_save = Post::find($post_id);
            $positive_votes_array_after_save = explode(',', $post->positives);
            $negative_votes_array_after_save = explode(',', $post->negatives);
            $post_after_save->num_of_pos = count($positive_votes_array_after_save)-1;
            $post_after_save->num_of_neg = count($negative_votes_array_after_save)-1;
            $post_after_save->save();
            //   ***   ***   ***   ***   ***   ***   ***   ***


        return response()->json($response);    
    }
    //  ***         ***         ***


    //  *** COMMENTING SYSTEM ***
    public function comment(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required',
            'user' => 'required',
            'comment' => 'required',
            ]);
        // Select last comment of the user to check its time
        $comment_of_user = Comment::where('user', $request->user)->latest('created_at')->first();
        if(!empty($comment_of_user)){
            $comment_time = strtotime($comment_of_user->created_at);
            $now = time();
            // check the difference between last comment time and now is more than 60 seconds
            $diff = $now - $comment_time;
            $time_left = 60 -$diff;
            $sekundy = array(2,3,4,22,23,24,32,33,34,42,43,44,52,53,54);

            if ($diff < 60) {

                if($time_left == 1 ) {
                    return redirect('/posts/' . $request->post_id)->with('error', 'Następny komentarz możesz dodać za sekundę');
                } elseif (in_array($time_left, $sekundy)) {
                    return redirect('/posts/' . $request->post_id)->with('error', 'Następny komentarz możesz dodać za ' . $time_left . ' sekundy');
                } else {
                    return redirect('/posts/' . $request->post_id)->with('error', 'Następny komentarz możesz dodać za ' . $time_left . ' sekund');
                }
            }
        }
        //add comment
        $comment = new Comment;
        $comment->post_id = $request->post_id;
        $comment->user = $request->user;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect('/posts/' . $request->post_id)->with('success', 'Komentarz dodany.');
    }

    public function comment_delete(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        if (auth()->user()->name == $comment->user || auth()->user()->name  == "Administrator") {
            $comment->delete();
            return redirect('/posts/' . $request->post_id)->with('success', 'Komentarz usunięty');
        } else {
            return redirect('/posts/' . $request->post_id);
        }
    }


    public function comment_reply($post_id, $comment_id) 
    {
        $comment = Comment::find($comment_id);
        return view('pages/reply')->with('post_id', $post_id)->with('comment', $comment);
    }

    public function reply(Request $request) 
    {
        $this->validate($request, [
            'reply' => 'required',
            ]);

        // Select last comment of the user to check its time
        $last_reply = Reply::where('replier', $request->user)->latest('created_at')->first();
        if(!empty($last_reply)){
            $reply_time = strtotime($last_reply->created_at);
            $now = time();
            // check the difference between last comment time and now is more than 60 seconds
            $diff = $now - $reply_time;
            $time_left = 30 - $diff;
            $sekundy = array(2,3,4,22,23,24,32,33,34,42,43,44,52,53,54);

            if ($diff < 30) {

                if($time_left == 1 ) {

                    return redirect('/reply/' . $request->post_id . '/' . $request->comment_id)
                        ->with('error', 'Następną odpowiedź możesz dodać za sekundę');

                } elseif (in_array($time_left, $sekundy)) {

                    return redirect('/reply/' . $request->post_id . '/' . $request->comment_id)
                        ->with('error', 'Następną odpowiedź możesz dodać za ' . $time_left . ' sekundy');
                        
                } else {
                    
                    return redirect('/reply/' . $request->post_id . '/' . $request->comment_id)
                        ->with('error', 'Następną odpowiedź możesz dodać za ' . $time_left . ' sekund');
                }
            }
        }

        $reply_record = new Reply;
        $reply_record->replier = $request->user;
        $reply_record->comment_id = $request->comment_id;
        $reply_record->reply = $request->reply;
        $reply_record->save();
        
        return redirect('posts/' . $request->post_id)->with('success', 'Odpowiedź dodana');
    }

    public function reply_delete(Request $request)
    {
        $reply = Reply::find($request->reply_id);
        // check if Administrator
        if (auth()->user()->name  == "Administrator") {
            $reply->delete();
            return redirect('/posts/' . $request->post_id)->with('success', 'Komentarz usunięty');
        }
        // Block if user has no rights to delete a post
        if (auth()->user()->name !==$reply->replier) {
            return redirect('/posts/' . $request->post_id);
        }
        // Delete comment
        $reply->delete();
        return redirect('/posts/' . $request->post_id)->with('success', 'Komentarz usunięty');
    }

    public function notify(Request $request) 
    {
        $reported_data = array($request->post_id, $request->author, $request->user, $request->date);
        return view("pages/notify")->with('info', $reported_data);
    }
}
    //  ***         ***         ***