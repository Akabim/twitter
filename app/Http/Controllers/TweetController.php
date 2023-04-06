<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tweets = Tweet::all();
        return view('dashboard', compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tweets = new Tweet();
        $tweets->content = $request->content;
        $tweets->user_id = Auth::id(); 
        $tweets->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        $tweets = Tweet::find($id);
        return view('tweet.show', [
            'tweet' => $tweets,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tweets = Tweet::find($id);

       $this->authorize('edit', $tweets);
       return view('tweet.edit', [
        'tweet' => $tweets,
       ]);

       dd($tweets);

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
        $tweets = Tweet::find($id);
        $tweets->content = $request->content;
        $tweets->save();
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $tweets = Tweet::find($id);
        $tweets->delete();
        return redirect()->back();
    }

    public function __invoke(Request $request)
    {
        return view('dashboard', [
            'tweets' => Tweet::latest()->paginate(),
        ]);;
    }
}
