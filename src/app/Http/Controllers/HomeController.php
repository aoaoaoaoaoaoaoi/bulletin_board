<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Thread;
use App\ThreadMessage;
use App\Tag;
use App\ThreadTag;
use App\Group;
use App\UserGroup;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $userJoinGroupIds = UserGroup::where('user_id', '=', $user['id'])->get()->pluck('group_id');
        $userJoinGroups = Group::whereIn('id', $userJoinGroupIds)->get();
        $groupsData=[];
        foreach ($userJoinGroups as $group)
        {
            $groupData=[
                'name' => $group->name,
                'id' => $group->id,
            ];
            $groupsData[] = $groupData;
        }
        $threadCount = Thread::orderBy('updated_at', 'desc')->count();
        $pageCount = range(1, (int)(($threadCount + 19) / 20));
        return view('home', ['pageCount' => $pageCount, 'groups' => $groupsData]);
    }

    public function searchThread(Request $request)
    {    
        $paramGroupId = $request->input('groupId');
        $groupId = $paramGroupId != null ? (int)$paramGroupId : null;
        $title = (string)$request->input('title');
        $tagName = (string)$request->input('tag');
        $paramStartFrom = $request->input('startDateStart');
        $startDateFrom = $paramStartFrom != null ? new Carbon($paramStartFrom) : null;
        $paramStartTo = $request->input('startDateEnd');
        $startDateTo = $paramStartTo != null ? new Carbon($paramStartTo) : null;
        $paramEndFrom = $request->input('endDateStart');
        $endDateFrom = $paramEndFrom != null ? new Carbon($paramEndFrom) : null;
        $paramEndTo = $request->input('startDateEnd');
        $endDateTo = $paramEndTo != null ? new Carbon($paramEndTo) : null;
        $isOnlyOwner = (bool)(($request->input('isOnlyOwner')) == "True");
        $paramInvolvedUserId = $request->input('involvedUserId');
        $involvedUserId = $paramInvolvedUserId != null ? (int)$paramInvolvedUserId : null;

        if($involvedUserId != null){
            $ownerThreadIds = ThreadMessage::getInvolvedThreadIds($involvedUserId);
            $threads = Thread::whereIn('id', $ownerThreadIds)->get();
        }else{
            $user = Auth::user();
            $ownerThreadIds = ThreadMessage::getOwnedThreadIds($user['id']);
            $threads = Thread::whereIn('id', $ownerThreadIds)->get();
            if(!$isOnlyOwner){
                $otherThreads = Thread::searchThread($startDateFrom, $startDateTo, $endDateFrom, $endDateTo, $title, $groupId)->get();
                $threads = $threads->merge($otherThreads);
            }
        }
        $threads->sortBy('id');

        $responseThreads = [];
        $isExistTag = false;
        if(!empty($tagName)){

            $isExistTag = true;
            $tag = Tag::where('name', '=', $tagName)->first();
            if(!empty($tag)){

                $threadIdByTags = ThreadTag::where('tag_id', '=', $tag->id)->orderBy('thread_id')->get()->pluck('thread_id');
                $threadIdByTagMap = [];
                foreach($threadIdByTags as $threadIdByTag){
                    $threadIdByTagMap[$threadIdByTag] = true;
                }
        
                foreach($threads as $thread){
                    if(isset($threadIdByTagMap[$thread->id])){
                        $responseThreads[] = $thread;
                    }
                }
            }
        } 
        if(!$isExistTag){
            $responseThreads = $threads->toArray();
        }
        $data = ThreadService::getInstance()->organizeThreadData($responseThreads);  
        return json_encode($data);
    }
}
