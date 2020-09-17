<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Thread;
use App\ThreadMessage;
use App\User;
use App\UserThreadMessageReaction;
use Carbon\Carbon;

class ThreadController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $threadId = $request->input('threadId');
        $thread = Thread::where('id','=',$threadId)->first();
        $tags = DB::table('thread_tags')->where('thread_id','=',$threadId)->get()->pluck('tag_id');
        $tagName=[];
        foreach($tags as $tag){
            $tagName[]=$tag->name;
        }

        $currentMessages = ThreadMessage::where('thread_id','=',$threadId)->orderBy('thread_order','asc')->get();
        $userIds = $currentMessages->pluck('user_id');
        $user_ids_order = implode(',', $userIds);
        $users = User::whereIn('id', $userIds)->orderByRaw("FIELD(id, $user_ids_order)")->get();
        $messageIds = $currentMessages->pluck('id');
        $reactionCounts = [];
        $reactionCountData = UserThreadMessageReaction::whereIn('thread_message_id', $messageIds)->select(DB::raw('count(*) as number_of_people'))->groupBy('thread_message_id', 'reaction_type')->get();
        foreach($reactionCountData as $countData){
            $reactionCounts[$countData->thread_message_id][$countData->reaction_type] =  $countData->number_of_people;
        }
        
        $userReactionData = UserThreadMessageReaction::whereIn('thread_message_id', $messageIds)->where('user_id', '=', $user->id)->get();
        $userReaction = [];
        foreach($userReactionData as $reaction){
            $userReaction[$reaction->thread_message_id][$reaction->reaction_type] = true;
        }

        $messages=[];
        $index = 0;
        foreach($currentMessages as $message){
            $user = $users[$index];
            $message=[
                'thread_message_id' => $message['id'],
                'user_name' => $user['name'],
                'user_resource' => $user['resource'],
                'thread_order' => $message['thread_order'],
                'message' => $message['message'],
                'posted_time' => $message['posted_time'],
                'resource1' => $message['resource1'],
                'resource2' => $message['resource2'],
                'resource3' => $message['resource3'],
                'good_reaction' => isset($reactionCounts[$message['id']][1]) ? $reactionCounts[$message['id']][1] : null,
                'great_good_reaction' => isset($reactionCounts[$message['id']][2]) ? $reactionCounts[$message['id']][2] : null,
                'is_good_reaction' => isset($userReaction[$message['id']][1]),
                'is_great_good_reaction' => isset($userReaction[$message['id']][2]),
            ];
            $messages[] = $message;
            ++$index;
        }

        $createdUserMessage = array_shift($messages);
        $data=[
            'title' => $thread->title,
            'createdUser' => $createdUserMessage['user_name'],
            'createdUserResource' => $createdUserMessage['user_resource'],
            'startAt' => $thread->start_at,
            'overview' => $createdUserMessage['message'],
            'tags' => $tagName,
            'endAt' => $thread->end_at, 
            'threadId' => $threadId,  
            'message' => $messages,
        ];
        return view('thread_index', ['data' => $data]);
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $threadId = $request->input('threadId');
        $message = $request->input('sendMessage');
        $filePaths = ResourceService::getInstance()->saveResources("message-file");

        DB::insert(
            "INSERT INTO thread_messages (thread_id, thread_order, user_id, message, posted_time, resource1, resource2, resource3) 
            SELECT ?, id + 1, ?, ?, ?, ?, ?, ? FROM thread_messages where thread_id = $threadId order by thread_order desc limit 1",
            [$threadId, $user->id, $message, Carbon::now(), isset($filePaths[0]) ? $filePaths[0] : null, isset($filePaths[1]) ? $filePaths[1] : null, isset($filePaths[2]) ? $filePaths[2] : null]
        );
    }

    public function reverseReaction(Request $request)
    {
        $user = Auth::user();
        $threadMessageId = $request->input('threadMessageId');
        $reactionType = $request->input('reactionType');

        $reactionData = UserThreadMessageReaction::ThreadMessageIdAndReactionType($threadMessageId, $reactionType);

        $isReaction = false;
        if($reactionData->count() <= 0){
            UserThreadMessageReaction::insert([
                'user_id' => $user->id,
                'thread_message_id' => $threadMessageId,
                'reaction_type' => $reactionType,
            ]);
            $isReaction = true;
        }else{
            $reactionData->delete();
        }

        return json_encode(['isReaction' => $isReaction]);
    }
}
