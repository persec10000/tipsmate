<?php

namespace App\Http\Controllers;


use App\PageContent;
use App\VideoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function index()
    {
        $index = 1;
        $categories = DB::table('q_a_s')->get();
        $video = DB::table('q_a_s')
            ->Join('video', 'video.category_id', '=', 'q_a_s.id')
            ->Join('users', 'users.id', '=', 'video.user_id')
            ->select( 'video.title', 'video.id as data_id', 'video.video_url','video.updated_at',
                'video.description','video.views','video.like','video.unlike','video.comment',
                'q_a_s.category', 'users.name')
            ->orderBy('video.updated_at', 'desc')
            ->get()->toArray();

        return view('howto.video',['video'=>$video,'categories'=>$categories, 'index'=>$index, 'footer'=>PageContent::get()]);
    }
    public function create()
    {
        $categories = $categories = DB::table('q_a_s')->get();
        return view('howto.create_video', ['categories' => $categories, 'footer'=>PageContent::get()]);
    }
    //
    public function store(Request $request)
    {
//        $this->validate($request, [
//            'category' => 'required',
//            'title' => 'required',
//            'addvideo' => 'video|required',
//            'detail' => 'nullable'
//        ]);
        $VideoModel = new VideoModel();
        $VideoModel->title = $request->title;
        $VideoModel->category_id = $request->category;
        $VideoModel->description = $request->detail;
        $user_id = auth()->user()->id;
        $VideoModel->user_id = $user_id;
        if ($request->hasFile('addvideo')) {
            $filenameWithExt = $request->file('addvideo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('addvideo')->getClientOriginalExtension();
            $fileNameToStore = $filename . '.' . $extension;
            $request->file('addvideo')->move('upload', $filenameWithExt);
            $VideoModel->video_url = $fileNameToStore;
        } else {
            $VideoModel->video_url = null;
        }
        $VideoModel->save();
        return back();
    }

    public function showVideo($video_id)
    {
        $categories = DB::table('q_a_s')->get();

        $view = DB::table('video')->select('video.views')
            ->where('video.id','=',$video_id)
            ->get();
        $view[0]->views= $view[0]->views + 1;
        DB::table('video')->where('id', $video_id)->update(['views' => $view[0]->views]);

        $video = DB::table('q_a_s')
            ->Join('video', 'video.category_id', '=', 'q_a_s.id')
            ->Join('users', 'users.id', '=', 'video.user_id')
            ->select( 'video.title', 'video.id as data_id', 'video.video_url','video.updated_at', 'video.description','video.views','video.like','video.unlike','video.comment', 'q_a_s.category', 'users.name','users.image')
            ->orderBy('video.updated_at', 'desc')
            ->where('video.id', '=', $video_id)
            ->get()->toArray();

        $comment = DB::table('video_comment')
            ->Join('users','users.id','=','video_comment.user_id')
            ->select('video_comment.content','video_comment.id as comment_id','video_comment.video_id','users.name')
            ->where('video_comment.video_id','=',$video_id)
            ->get()->toArray();

        return view('howto.video_detail', ['categories' => $categories, 'video' => $video[0], 'comment'=>$comment, 'footer'=>PageContent::get()]);
    }

    public function category_select($id){

        $categories = DB::table('q_a_s')->get();
        if ($id != 1) {
            $video_detail = DB::table('q_a_s')
                ->Join('video', 'video.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'video.user_id')
                ->select( 'video.title', 'video.id as data_id', 'video.video_url','video.updated_at',
                    'video.description','video.views','video.like','video.unlike','video.comment',
                    'q_a_s.category', 'users.name')
                ->where('q_a_s.id', '=', $id)
                ->orderBy('video.updated_at', 'desc')
                ->get()->toArray();
            return view('howto.video', ['categories' => $categories, 'video' => $video_detail, 'index'=>$id, 'footer'=>PageContent::get()]);
        }
        else {
            $video = DB::table('q_a_s')
                ->Join('video', 'video.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'video.user_id')
                ->select( 'video.title', 'video.id as data_id', 'video.video_url','video.updated_at',
                    'video.description','video.views','video.like','video.unlike','video.comment',
                    'q_a_s.category', 'users.name')
                ->orderBy('video.updated_at', 'desc')
                ->get()->toArray();

            return view('howto.video', ['categories' => $categories, 'video' => $video, 'index'=>$id, 'footer'=>PageContent::get()]);
        }
    }

    public function search(Request $request){

        $id = 1;
        $query = $request->search;
        $categories = DB::table('q_a_s')->get();
        if ($query !='') {
            $video_detail = DB::table('q_a_s')
                ->Join('video', 'video.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'video.user_id')
                ->select( 'video.title', 'video.id as data_id', 'video.video_url','video.updated_at',
                    'video.description','video.views','video.like','video.unlike','video.comment',
                    'q_a_s.category', 'users.name')
                ->where('video.title', 'like', '%'.$query.'%')
                ->orderBy('video.updated_at', 'desc')
                ->get()->toArray();
            return view('howto.video', ['categories' => $categories, 'video' => $video_detail, 'index'=>$id, 'footer'=>PageContent::get()]);
        }
        else {
            $video = DB::table('q_a_s')
                ->Join('video', 'video.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'video.user_id')
                ->select( 'video.title', 'video.id as data_id', 'video.video_url','video.updated_at',
                    'video.description','video.views','video.like','video.unlike','video.comment',
                    'q_a_s.category', 'users.name')
                ->where('video.title', 'like', '%'.$query.'%')->orderBy('video.updated_at', 'desc')
                ->get()->toArray();

            return view('howto.video', ['categories' => $categories, 'video' => $video, 'index'=>$id, 'footer'=>PageContent::get()]);
        }
    }

    public function addcomment(Request $request)
    {
        $content = $request->detail;
        $article_id = $request->article_id;
        $user_id = auth()->user()->id;
        DB::table('video_comment')
            ->insert(['content' => $content, 'video_id'=>$article_id,'user_id' => $user_id]);


        $view = DB::table('video')->select('video.comment')
            ->where('video.id','=',$article_id)
            ->get();
        $view[0]->comment= $view[0]->comment + 1;
        DB::table('video')->where('id', $article_id)->update(['comment' => $view[0]->comment]);

        return back();
    }

    public function cal_comment($id, $table,$data_id){
        $calc = DB::table($table)->select('content')
            ->where($data_id,'=',$id)
            ->get()->toArray();
        return $calc->len();



    }

    public function like(Request $request)
    {

        if ($request->ajax()) {
            $video_id = $request->get('id');
            $user_id = auth()->user()->id;
            $result = DB::table('video')
                ->select('like_list', 'like', 'unlike_list', 'unlike')
                ->where('id', '=', $video_id)->get();
            $pattern = '|' . $user_id;
            $like_list = $result[0]->like_list;
            $unlike_list = $result[0]->unlike_list;
            $like = $result[0]->like;
            $unlike = $result[0]->unlike;
            $like_search = strpos($like_list, $pattern);
            $unlike_search = strpos($unlike_list, $pattern);
            if ($unlike_search == "") {//already no unlike
                if ($like_search != "") {////already like
                    $like -= 1;
                    $like_list = str_replace($pattern, "", $like_list);
                    DB::table('video')->where('id', $video_id)->update(['like_list' => $like_list, 'like' => $like]);
                    $data = ['like' => $like, 'unlike' => $unlike];
                } else {// already no like
                    $like_list = $like_list . $pattern;
                    $like += 1;
                    DB::table('video')->where('id', $video_id)->update(['like_list' => $like_list, 'like' => $like]);
                    $data = ['like' => $like, 'unlike' => $unlike];
                }
                return json_encode($data);
            } else {//already unlike
                if ($like_search == "") {// already no like
                    $like_list = $like_list.$pattern;
                    $unlike_list = str_replace($pattern, "", $unlike_list);
                    $like += 1;
                    $unlike -= 1;
                    DB::table('video')->where('id', $video_id)->update(['like_list' => $like_list, 'unlike_list' => $unlike_list, 'like' => $like, 'unlike' => $unlike]);
                    $data = ['like' => $like, 'unlike' => $unlike];
                    return json_encode($data);
                }

            }

        }
    }
    public function unlike(Request $request)
    {
        if ($request->ajax()) {
            $video_id = $request->get('id');
            $user_id = auth()->user()->id;
            $result = DB::table('video')
                ->select('like_list', 'like', 'unlike_list', 'unlike')
                ->where('id', '=', $video_id)->get();
            $pattern = '|' . $user_id;
            $like_list = $result[0]->like_list;
            $unlike_list = $result[0]->unlike_list;
            $like = $result[0]->like;
            $unlike = $result[0]->unlike;
            $like_search = strpos($like_list, $pattern);
            $unlike_search = strpos($unlike_list, $pattern);
            if ($like_search == "") {//already no like
                if ($unlike_search != "") {////already unlike
                    $unlike -= 1;
                    $unlike_list = str_replace($pattern, "", $unlike_list);
                    DB::table('video')->where('id', $video_id)->update(['unlike_list' => $unlike_list, 'unlike' => $unlike]);
                    $data = ['like' => $like, 'unlike' => $unlike];
                } else {// already no unlike
                    $unlike_list = $unlike_list . $pattern;
                    $unlike += 1;
                    DB::table('video')->where('id', $video_id)->update(['unlike_list' => $unlike_list, 'unlike' => $unlike]);
                    $data = ['like' => $like, 'unlike' => $unlike];
                }
                return json_encode($data);
            } else {//already like

                    $unlike_list = $unlike_list.$pattern;
                    $like_list = str_replace($pattern, "", $like_list);
                    $unlike += 1;
                    $like -= 1;
                    DB::table('video')->where('id', $video_id)->update(['like_list' => $like_list, 'unlike_list' => $unlike_list, 'like' => $like, 'unlike' => $unlike]);
                    $data = ['like' => $like, 'unlike' => $unlike];
                    return json_encode($data);


            }

        }
    }
}
