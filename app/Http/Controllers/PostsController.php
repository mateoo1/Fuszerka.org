<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Reply;
use App\Traffic;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Only this methodes are allowed to execute for unregistered users
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // *** TRAFFIC STATS ***
        //mark new visit in traffic table
        $client_ip = strval($request->ip());
        $browser= $request->header('User-agent');

        //Check if address exist
        $visit = Traffic::where('ip', $client_ip)->first();

        if (!empty($visit)) {
            // If ip exist then just increase visit counter
            $visit->counter = $visit->counter + 1;
            $visit->save();
        } else {
            //save as new visit
            $visit = New Traffic;
            $visit->ip = $client_ip;
            $visit->browser = $browser;
            $visit->counter = 1;
            $visit->save();
        }
        // *** END OF TRAFFIC STATS ***

        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('pages/index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|nullable|required'
        ]);

        //SPAMMING VERIFICATION
        //get last post of the user
        $post_of_user = Post::where('user_id', auth()->user()->id)->latest('created_at')->first();
        
        //Skip if user is adding post for the first time
        if(!empty($post_of_user)){
            //time of last post from database
            $post_time = strtotime($post_of_user->created_at);
            //present server time
            $now = time();
            // check the difference between last comment time and now is more than 60 seconds
            $diff = $now - $post_time;
            //check if 60 second passed from last post
            if ($diff < 60) {
                return redirect('/home')->with('error', 'Następny post możesz dodać za ' . (60 - $diff) . ' sekund');
            }
        }

        // File Upload
        if($request->hasFile('image')) {
    
            // Get filename with extension
            $fileNameWithExt = $request->file('image')->getCLientOriginalName();
            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // filename to store
            // $fileNameToStore = time() .'_'. $filename . '.'.$extension;
            $fileNameToStore = time() . '.' . $extension;
            // Save file to storage directory
            $path = $request->file('image')->storeAs('public/img', $fileNameToStore);
            //$path = $request->file('image')->storeAs('public/img/thumbnails', $fileNameToStore);

            // ** *** INTERVENTION IMAGE ** ***
            $img_path = public_path('storage/img/'. $fileNameToStore);
            $img = Image::make($img_path);

            // resize image
            $img->resize(500, null, function ($constraint) {

                $constraint->aspectRatio();
                //$constraint->upsize();

            });

            $watermark_path = public_path('storage/img/watermark_small.png');
            $watermark = Image::make($watermark_path)->opacity(100);
            $img->insert($watermark, 'bottom-right');
    
            //save to the path with new size
            $img->save($img_path);

        } else {

            $fileNameToStore = 'default-image.jpg';

        }

        // If no description set default
        if (empty($request->input('body'))) {
            $post_description = "";
            $post_short_description = "";
        } else {
            $post_description = $request->input('body');
            $post_short_description = substr($post_description,0,100) . "...";
        }

        // Create entry
        $post = new Post;
        $post->author = auth()->user()->name;
        $post->body = $post_description;
        $post->short_description = $post_short_description;
        $post->image = $fileNameToStore;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/home')->with('success', 'Post dodany - oczekuje na weryfikację.');

        /*return "Field values: " . $request->input('author') . $request->input('body');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // Authenticated users have access to full posts view
        if (Auth::check()) {

            $post = Post::find($id);
            return view("pages/post")->with('post', $post)->with('comments', $post->comments);

        //limited view for guests
        } else {

            $post = Post::find($id);
            return view("pages/postf")->with('post', $post)->with('comments', $post->comments);   

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // check if Administrator
        if (auth()->user()->name  == "Administrator") {
            return view("pages/edycja")->with('post', $post);
        }

        // Check if user has rights to edit a post (protection from edit by URL)
        if (auth()->user()->id !==$post->user_id) {
            return redirect("/");
        }

        return view("pages/edycja")->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'body' => 'required',
        ]);

        // File Upload
        if($request->hasFile('image')) {

            // Get filename with extension
            $fileNameWithExt = $request->file('image')->getCLientOriginalName();
            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore = time() .'_'. 'edited' . '.'. $extension;
            // Save file to storage directory
            $path = $request->file('image')->storeAs('public/img', $fileNameToStore);
            //$path = $request->file('image')->storeAs('public/img/thumbnails', $fileNameToStore);

            // ** *** INTERVENTION IMAGE ** ***
            $img_path = public_path('storage/img/'. $fileNameToStore);
            $img = Image::make($img_path);

            // resize image
            $img->resize(500, null, function ($constraint) {

                $constraint->aspectRatio();
                //$constraint->upsize();

            });

            $watermark_path = public_path('storage/img/watermark_small.png');
            $watermark = Image::make($watermark_path)->opacity(100);
            $img->insert($watermark, 'bottom-right');
    
            //save to the path with new size
            $img->save($img_path);

        } else {

            $fileNameToStore = 'default-image.jpg';

        }


        // If no description set default
        if (empty($request->input('body'))) {
            $post_description = "";
            $post_short_description = "";
        } else {
            $post_description = $request->input('body');
            $post_short_description = substr($post_description,0,100) . "...";
        }


        // Update entry
        $post = Post::find($id);
        //With update there is no necessary to update author of post
        //$post->author = auth()->user()->name;
        $post->body = $post_description;
        $post->short_description = $post_short_description;
        $post->admin_approval = 0;


        // Check if the user provided new file
        if($request->hasFile('image')) {
            // Delete existing image
            Storage::delete('public/img/' . $post->image);
            // assign new filename
            $post->image = $fileNameToStore;
        }
        // SAVE NEW POST
        $post->save();

        return redirect('/home')->with('success', 'Zmieniono post - oczekuje na weryfikację');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //$id is an id of post
    {
        // Select post to delete
        $post = Post::find($id);

        // Let to delete if initiated by Administrator
        if (auth()->user()->id == $post->user_id || auth()->user()->name  == "Administrator") {

            // delete image
            Storage::delete('public/img/' . $post->image);
            // delete post record
            $post->delete();
            // return to user profile
            return redirect('/home')->with('success', 'Usunięto post');

        } else {

            // Block if in some way someone unauthorized try to initiate post delete
            return redirect("/");

        }

    }

}
