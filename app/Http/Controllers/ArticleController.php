<?php

namespace App\Http\Controllers;

use App\article;

use App\Tag;
use App\Providers\PostFormFields;
use App\VideoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use TheSeer\Tokenizer\Token;

use App\PageContent;
class ArticleController extends Controller

{

     public function index()
    {
        $categories = DB::table('q_a_s')->get();

        $article = DB::table('q_a_s')
            ->Join('article', 'article.category_id', '=', 'q_a_s.id')
            ->Join('users', 'users.id', '=', 'article.user_id')
            ->select( 'article.title', 'article.id as data_id', 'article.post_image','article.updated_at', 'article.content_html', 'q_a_s.category', 'users.name')
            ->orderBy('article.updated_at', 'desc')
            ->get()->toArray();
        $index = 1;


        return view('article', ['categories' => $categories, 'article' => $article , 'index'=>$index, 'footer'=> PageContent::get() ]);
    }

    public function showArticle($art_id)
    {
        $categories = DB::table('q_a_s')->get();
        $article_detail = DB::table('article')
            ->Join('q_a_s', 'q_a_s.id', '=', 'article.category_id')
            ->Join('users', 'users.id', '=', 'article.user_id')
            ->select( 'article.title', 'article.id as data_id', 'article.post_image','article.updated_at', 'article.content_html', 'q_a_s.category', 'users.name')
            ->where('article.id', '=', $art_id)
            ->get();

        $comment = DB::table('article_comment')
            ->Join('users','users.id','=','article_comment.user_id')
            ->select('article_comment.content','article_comment.id as comment_id','article_comment.article_id','users.name')
            ->where('article_comment.article_id','=',$art_id)
            ->get()->toArray();
        return view('article_detail', ['categories' => $categories, 'article' => $article_detail[0],'comment'=>$comment , 'footer'=>PageContent::get()]);
    }

    public function howto()
    {
        $categories = DB::table('q_a_s')->get();
        $article = DB::table('q_a_s')
            ->Join('article', 'article.category_id', '=', 'q_a_s.id')
            ->Join('users', 'users.id', '=', 'article.user_id')
            ->select( 'article.title', 'article.id as data_id', 'article.post_image','article.updated_at', 'article.content_html', 'q_a_s.category', 'users.name')
            ->orderBy('article.updated_at', 'desc')
            ->limit(6)
            ->get()->toArray();

        $video = DB::table('q_a_s')
            ->Join('video', 'video.category_id', '=', 'q_a_s.id')
            ->Join('users', 'users.id', '=', 'video.user_id')
            ->select( 'video.id as data_id', 'video.title', 'video.video_url','video.updated_at', 'video.description','video.views','video.like','video.unlike','video.comment', 'q_a_s.category', 'users.name')
            ->orderBy('video.updated_at', 'desc')
            ->limit(6)
            ->get()->toArray();

        return view('howto', ['categories' => $categories, 'video' => $video, 'article' => $article, 'footer'=>PageContent::get()]);
    }


    public function create()
    {
        $categories = $categories = DB::table('q_a_s')->get();
        return view('howto.create_article', ['categories' => $categories,  'footer'=>PageContent::get()]);
    }

    public function store(Request $request)
    {
//        $this->validate($request, [
//            'category' => 'required',
//            'title' => 'required',
//            'addimage' => 'image|required|max:2048',
//            'detail' => 'nullable'
//        ]);
        $article = new article();
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content_html = $request->detail;
        $user_id = auth()->user()->id;
        $article->user_id = $user_id;

        if ($request->hasFile('addimage')) {
            $filenameWithExt = $request->file('addimage')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('addimage')->getClientOriginalExtension();
            $fileNameToStore = $filename . '.' . $extension;
            $request->file('addimage')->move('upload', $filenameWithExt);
            $article->post_image = $fileNameToStore;
        } else {
            $article->post_image = null;
        }
        $article->save();
        return back();
    }
    public function category_select($id){

        $categories = DB::table('q_a_s')->get();

        if ($id != 1) {
            $article_detail = DB::table('q_a_s')
                ->Join('article', 'article.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'article.user_id')
                ->select(  'article.title','article.id as data_id', 'article.post_image','article.updated_at', 'article.content_html','q_a_s.id' ,'q_a_s.category', 'users.name')
                ->where('q_a_s.id', '=', $id)
                ->orderBy('article.updated_at', 'desc')
                ->get()->toArray();
            return view('article', ['categories' => $categories, 'article' => $article_detail, 'index'=>$id, 'footer'=>PageContent::get()]);
        }
        else {
            $article = DB::table('q_a_s')
                ->Join('article', 'article.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'article.user_id')
                ->select(  'article.title','article.id as data_id', 'article.post_image','article.updated_at', 'article.content_html', 'q_a_s.category', 'users.name')
                ->orderBy('article.updated_at', 'desc')
                ->get()->toArray();

            return view('article', ['categories' => $categories, 'article' => $article, 'index'=>$id, 'footer'=>PageContent::get()]);
        }
    }

    public function search(Request $request){

        $id = 1;
        $query = $request->search;

        $categories = DB::table('q_a_s')->get();
        if ($query !='') {
            $article_detail = DB::table('q_a_s')
                ->Join('article', 'article.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'article.user_id')
                ->select( 'article.title', 'article.id as data_id', 'article.post_image','article.updated_at', 'article.content_html','q_a_s.id' ,'q_a_s.category', 'users.name')
                ->where('article.title', 'like', '%'.$query.'%')
                ->orderBy('article.updated_at', 'desc')
                ->get()->toArray();
            return view('article', ['categories' => $categories, 'article' => $article_detail, 'index'=>$id, 'footer'=>PageContent::get()]);
        }
        else {
            $article = DB::table('q_a_s')
                ->Join('article', 'article.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'article.user_id')
                ->select( 'article.title', 'article.id as data_id', 'article.post_image','article.updated_at', 'article.content_html', 'q_a_s.category', 'users.name')
                ->orderBy('article.updated_at', 'desc')
                ->get()->toArray();

            return view('article', ['categories' => $categories, 'article' => $article, 'index'=>$id, 'footer'=>PageContent::get()]);
        }
    }
    public function addcomment(Request $request)
    {

        $content = $request->detail;
        $article_id = $request->article_id;
        $user_id = auth()->user()->id;
        DB::table('article_comment')
            ->insert(['content' => $content, 'article_id'=>$article_id,'user_id' => $user_id]);

        return back();
    }

    public function imageUpload(Request $request)
    {
        if($request->ajax()) {

            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                    $name = md5(rand(100, 200));
                    $ext = explode('.', $_FILES['file']['name']);
                    $filename = $name . '.' . $ext[1];
                    $destination = 'fireuikit/images/' . $filename; //change this directory
                    $location = $_FILES["file"]["tmp_name"];
                    move_uploaded_file($location, $destination);
                    echo $destination;//change this URL
                }
                else
                {
                    echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                }
            }
        }
    }

    public   function test_PHP($variable)
    {
        echo '<script>';
        echo 'console.log(' . json_encode($variable) . ')';
        echo '</script>';
    }

    public function pageContent($page_tag){

         $page_content = DB::table('page_content')->where('page_sc_name','=', $page_tag)->get();

         return view('page', ['pageContent'=>$page_content[0],'footer'=>PageContent::get()]);
    }

}
