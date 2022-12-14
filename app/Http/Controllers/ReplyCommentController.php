<?php

namespace App\Http\Controllers;

use App\Models\ReplyComment;
use App\Http\Requests\StoreReplyCommentRequest;
use App\Http\Requests\UpdateReplyCommentRequest;

class ReplyCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReplyCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReplyCommentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReplyComment  $replyComment
     * @return \Illuminate\Http\Response
     */
    public function show(ReplyComment $replyComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReplyComment  $replyComment
     * @return \Illuminate\Http\Response
     */
    public function edit(ReplyComment $replyComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReplyCommentRequest  $request
     * @param  \App\Models\ReplyComment  $replyComment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReplyCommentRequest $request, ReplyComment $replyComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReplyComment  $replyComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReplyComment $replyComment)
    {
        //
    }
}
