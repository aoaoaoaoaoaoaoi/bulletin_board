<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
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
        $thread = DB::table('threads')->where('id','=',$threadId)->first();
        $createdUserId = $thread->created_user_id;
        $createdUser = User::where('id','=',$createdUserId)->first();
        $tags = DB::table('thread_tags')->where('thread_id','=',$threadId)->get()->pluck('tag_id');
        $tagName=[];
        foreach($tags as $tag){
            $tagName[]=$tag->name;
        }

        $currentMessages = ThreadMessage::where('thread_id','=',$threadId)->orderBy('thread_order','asc')->get();
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
        foreach($currentMessages as $message){
            //TODO:処理はループの外でする
            $user = User::where('id','=',$message['user_id'])->first();
            $userName = $user['name'];
            $message=[
                'thread_message_id' => $message['id'],
                'user_name' => $userName,
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
        }

        $data=[
            'title' => $thread->title,
            'createdUser' => $createdUser->name,
            'createdUserResource' => $createdUser->resource,
            'startAt' => $thread->start_at,
            'overview' => $thread->overview,
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
        $message = $request->input('message');
        
        // ファイル名を取得して、ユニークなファイル名に変更
        $resourceName = [];
        for ($i=0; $i < 3; $i++) { 
            if(!isset($_FILES['message-file']['error'][i]) || !is_int($_FILES['message-file']['error'][i])) {
                $file_name = $_FILES['message-file']['name'][i];
                if($file_name != ""){
                    $uniq_file_name = date("YmdHis") . "_" . $file_name;
                    ResourceService::getInstance()->saveIconresource($uniq_file_name, "message-file", "message_image");
                    $resourceName[] = $uniq_file_name;
                }
            }
        }

        //TODO:ロック必要
        //$currentLastMessage = ThreadMessage::where('thread_id','=',$threadId)->orderBy('thread_order','desc')->first();
        //$nextthreadOrder = $currentLastMessage == null ? 1 : $currentLastMessage['thread_order']+1;

        DB::insert(
            "INSERT INTO thread_messages (thread_id, thread_order, user_id, message, posted_time, resource1, resource2, resource3) 
            SELECT ?, id + 1, ?, ?, ?, ?, ?, ? FROM thread_messages where thread_id = $threadId order by thread_order desc limit 1",
            [$threadId, $user->id, $message, isset($resourceName[0]) ? $resourceName[0] : null, isset($resourceName[1]) ? $resourceName[1] : null, isset($resourceName[2]) ? $resourceName[2] : null]
        );

        /*ThreadMessage::insert([
            'thread_id' => $threadId,
            'thread_order' => $nextthreadOrder,
            'user_id' => $user->id,
            'message' => $message,
            'posted_time' => Carbon::now(),
            'resource1' => isset($resourceName[0]) ? $resourceName[0] : null,
            'resource2' => isset($resourceName[1]) ? $resourceName[1] : null,
            'resource3' => isset($resourceName[2]) ? $resourceName[2] : null,
        ]);*/
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
