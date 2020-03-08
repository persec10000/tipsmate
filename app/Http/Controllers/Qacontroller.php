<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\QA;
use App\PageContent;
use App\Question;
use App\answer;
use TheSeer\Tokenizer\Token;
use DateTime;
use Symfony\Component\DomCrawler\Crawler;
use Session;
use App\Extensions\MongoSessionStore;
use Illuminate\Support\ServiceProvider;

class Qacontroller extends Controller
{
    //Calculate Date difference from 21 line to 34 line
    /*import use DateTime
     call: 534 line Qacontroller::ago(new \DateTIme($answer->register_date)).
    */

    public function pluralize($count, $text){
        return $count.(($count==1)?("$text"):( " ${text}s" ));
    }

    public function ago($datetime){
        $interval = date_create('now')->diff( $datetime );
        $suffix = ( $interval->invert ? ' ago' : '' );
        if ( $v = $interval->y >= 1 ) return Qacontroller::pluralize( $interval->y, 'year' ) . $suffix;
        if ( $v = $interval->m >= 1 ) return Qacontroller::pluralize( $interval->m, 'month' ) . $suffix;
        if ( $v = $interval->d >= 1 ) return Qacontroller::pluralize( $interval->d, 'day' ) . $suffix;
        if ( $v = $interval->h >= 1 ) return Qacontroller::pluralize( $interval->h, 'hour' ) . $suffix;
        if ( $v = $interval->i >= 1 ) return Qacontroller::pluralize( $interval->i, 'minute' ) . $suffix;
        return Qacontroller::pluralize( $interval->s, 'second' ) . $suffix;
    }
    //=========================================================
    public function index()
    {
        $categories = DB::table('q_a_s')->get();
        $questions = DB::table('q_a_s')
            ->Join('question', 'question.category_id', '=', 'q_a_s.id')
            ->Join('users', 'users.id', '=', 'question.user_id')
            ->select('q_a_s.id', 'question.id as data_id', 'question.title', 'question.image','question.register_date','question.comment as all_comment', 'question.comment', 'q_a_s.category', 'users.name','users.image as ques_user_image')
            ->orderBy('question.register_date', 'desc')
            ->get()->toArray();
        foreach ($questions as $v) {
            $v->answer = DB::table('answer')->where('question_id', '=', $v->data_id)->get()->toArray();
        }

        foreach($questions as $row){
            $crawler = new Crawler($row->comment);
            $text = $crawler->filter('p')->each(function ($node)  {
                return $node->text();
            });
            $row->comment=" ";
            foreach ($text as $cont){
                $row->comment =  "$row->comment  $cont";
            }
            $row->comment = str_limit($row->comment,200,'...<span class="more" id="'.$row->data_id.'" style="color: #0F69FF">(more)</span>');
        }

        $footer = DB::table('page_content')->get();


        if(Auth::user()){
            $user_image = DB::table('users')->select('image')->where('id',auth()->user()->id)->get();
            return view('home', ['categories' => $categories, 'questions' => $questions,'user_image'=>$user_image, 'post_id'=>'undefined','cat_id'=>'undefined', 'search_text'=>'undefined', 'footer'=>PageContent::get()]);
        }else{
            return view('home', ['categories' => $categories, 'questions' => $questions, 'post_id'=>'undefined', 'cat_id'=>'undefined',  'search_text'=>'undefined', 'footer' => PageContent::get()]);
        }
    }


    public function load_post($post_id)
    {
        $categories = DB::table('q_a_s')->get();
        $questions = DB::table('q_a_s')
            ->Join('question', 'question.category_id', '=', 'q_a_s.id')
            ->Join('users', 'users.id', '=', 'question.user_id')
            ->select('q_a_s.id', 'question.id as data_id', 'question.title', 'question.image','question.register_date','question.comment as all_comment', 'question.comment', 'q_a_s.category', 'users.name','users.image as ques_user_image')
            ->orderBy('question.register_date', 'desc')
            ->get()->toArray();
        foreach ($questions as $v) {
            $v->answer = DB::table('answer')->where('question_id', '=', $v->data_id)->get()->toArray();
        }

        foreach($questions as $row){
            $crawler = new Crawler($row->comment);
            $text = $crawler->filter('p')->each(function ($node)  {
                return $node->text();
            });
            $row->comment=" ";
            foreach ($text as $cont){
                $row->comment =  "$row->comment  $cont";
            }
            $row->comment = str_limit($row->comment,200,'...<span class="more" id="'.$row->data_id.'" style="color: #0F69FF">(more)</span>');
        }

        if(Auth::user()){
            $user_image = DB::table('users')->select('image')->where('id',auth()->user()->id)->get();
            return view('home', ['categories' => $categories, 'questions' => $questions,'user_image'=>$user_image, 'post_id'=>$post_id, 'cat_id'=>'undefined', 'search_text'=>'undefined', 'footer' => PageContent::get()]);
        }else{
            return view('home', ['categories' => $categories, 'questions' => $questions , 'post_id'=>$post_id, 'cat_id'=>'undefined', 'search_text'=>'undefined', 'footer' => PageContent::get()]);
        }
    }
    public function load_category($cat_id)
    {
        $categories = DB::table('q_a_s')->get();
        $questions = DB::table('q_a_s')
            ->Join('question', 'question.category_id', '=', 'q_a_s.id')
            ->Join('users', 'users.id', '=', 'question.user_id')
            ->select('q_a_s.id', 'question.id as data_id', 'question.title', 'question.image','question.register_date','question.comment as all_comment', 'question.comment', 'q_a_s.category', 'users.name','users.image as ques_user_image')
            ->orderBy('question.register_date', 'desc')
            ->get()->toArray();
        foreach ($questions as $v) {
            $v->answer = DB::table('answer')->where('question_id', '=', $v->data_id)->get()->toArray();
        }

        foreach($questions as $row){
            $crawler = new Crawler($row->comment);
            $text = $crawler->filter('p')->each(function ($node)  {
                return $node->text();
            });
            $row->comment=" ";
            foreach ($text as $cont){
                $row->comment =  "$row->comment  $cont";
            }
            $row->comment = str_limit($row->comment,200,'...<span class="more" id="'.$row->data_id.'" style="color: #0F69FF">(more)</span>');
        }

        if(Auth::user()){

            $user_image = DB::table('users')->select('image')->where('id',auth()->user()->id)->get();
            return view('home', ['categories' => $categories, 'questions' => $questions,'user_image'=>$user_image, 'cat_id'=>$cat_id, 'post_id'=>'undefined', 'search_text'=>'undefined', 'footer' => PageContent::get()]);
        }else{
            return view('home', ['categories' => $categories, 'questions' => $questions, 'cat_id'=>$cat_id, 'post_id'=>'undefined', 'search_text'=>'undefined','footer' => PageContent::get()]);
        }
    }
    public function load_search($data)
    {
        $categories = DB::table('q_a_s')->get();
        $questions = DB::table('q_a_s')
            ->Join('question', 'question.category_id', '=', 'q_a_s.id')
            ->Join('users', 'users.id', '=', 'question.user_id')
            ->select('q_a_s.id', 'question.id as data_id', 'question.title', 'question.image','question.register_date','question.comment as all_comment', 'question.comment', 'q_a_s.category', 'users.name','users.image as ques_user_image')
            ->orderBy('question.register_date', 'desc')
            ->get()->toArray();
        foreach ($questions as $v) {
            $v->answer = DB::table('answer')->where('question_id', '=', $v->data_id)->get()->toArray();
        }


        foreach($questions as $row){
            $crawler = new Crawler($row->comment);
            $text = $crawler->filter('p')->each(function ($node)  {
                return $node->text();
            });
            $row->comment=" ";
            foreach ($text as $cont){
                $row->comment =  "$row->comment  $cont";
            }
            $row->comment = str_limit($row->comment,200,'...<span class="more" id="'.$row->data_id.'" style="color: #0F69FF">(more)</span>');
        }

        if(Auth::user()){

            $user_image = DB::table('users')->select('image')->where('id',auth()->user()->id)->get();
            return view('home', ['categories' => $categories, 'questions' => $questions,'user_image'=>$user_image, 'cat_id'=>'undefined', 'post_id'=>'undefined', 'search_text'=>$data,  'footer' => PageContent::get()]);
        }else{
            return view('home', ['categories' => $categories, 'questions' => $questions, 'cat_id'=>'undefined', 'post_id'=>'undefined', 'search_text'=>$data, 'footer' => PageContent::get()]);
        }
    }
    public function load_data(Request $request){
        if($request->ajax()){
            $categories = DB::table('q_a_s')->get();
            if($request->id > 0){
                $questions = DB::table('q_a_s')
                    ->Join('question', 'question.category_id', '=', 'q_a_s.id')
                    ->Join('users', 'users.id', '=', 'question.user_id')
                    ->select('q_a_s.id', 'question.id as data_id', 'question.title', 'question.image','question.register_date','question.comment as all_comment', 'question.comment', 'q_a_s.category', 'users.name','users.image as ques_user_image')
                    ->where('question.id','<', $request->id)
                    ->orderBy('question.register_date', 'desc')
                    ->limit(30)
                    ->get()->toArray();
                foreach ($questions as $v) {
                    $v->answer = DB::table('answer')->where('question_id', '=', $v->data_id)->get()->toArray();

                }

            }else{
                $questions = DB::table('q_a_s')
                    ->Join('question', 'question.category_id', '=', 'q_a_s.id')
                    ->Join('users', 'users.id', '=', 'question.user_id')
                    ->select('q_a_s.id', 'question.id as data_id', 'question.title', 'question.image','question.register_date','question.comment as all_comment', 'question.comment', 'q_a_s.category', 'users.name','users.image as ques_user_image')
                    ->orderBy('question.register_date', 'desc')
                    ->limit(30)
                    ->get()->toArray();
                foreach ($questions as $v) {
                    $v->answer = DB::table('answer')->where('question_id', '=', $v->data_id)->get()->toArray();

                }
            }

            foreach($questions as $row){
                $crawler = new Crawler($row->comment);
                $text = $crawler->filter('p')->each(function ($node)  {
                    return $node->text();
                });
                $row->comment=" ";
                foreach ($text as $cont){
                    $row->comment =  "$row->comment  $cont";
                }
                $row->comment = str_limit($row->comment,200,'...<span class="more" id="'.$row->data_id.'" style="color: #0F69FF">(more)</span>');
            }
            $output = '';
            $last_id = '';
            if ($questions){
                foreach($questions as $question){
                    $output .= '<li class="qa_content mb-1" style="width: 100%" id="li'.$question->data_id.'">
                        <div class="clearfix media p-3">
                            <img src="'.asset("fireuikit/images/users/".$question->ques_user_image).'" width="50px" height="50px" style="float: left" class="mr-2 rounded-circle">
                            <div class="media-body">
                                <div class="ml-2">
                                    <div class="ques_content" id="'.$question->data_id.'">
                                        <h5>
                                            <a class="question" href="javascript:void(0)" id="'.$question->data_id.'">'.$question->title.'</a>
                                        </h5>
                                        <div class="COM" id="com'.$question->data_id.'">';

                                        $output .= trim($question->comment, "</div><div class=");

                                        $output .='</div>
                                        <div id="edit_content'.$question->data_id.'" hidden>';
                                        $output .= trim($question->all_comment, "</div><div class=");
                                        $output .= '</div>
                                    </div>
                                    <div class="Wow-bw Lh-24"></div>
                                    <div class="row mt-2 config">
                                        <div class="col-3" style="text-align: left;font-size:14px">
                                            <p style="white-space: nowrap;width: 100%;overflow: hidden; text-overflow: ellipsis;">Category:&nbsp;&nbsp;<a href="javascript:void(0)" id="'.$question->id.'" class="category">'.$question->category.'</a></p>
                                        </div>
                                        <div class="col-3" style="text-align: center;font-size:14px">
                                            Answers&nbsp;&nbsp;(<a href="javascript:void(0)">'.count($question->answer).'</a>)';
                                            if(Auth::user()){
                                                if(Auth::user()->name==$question->name){
                                                    $output .= '&nbsp;<a href="javascript:void(0)"><span class="editcomment" id="'.$question->data_id.'">Edit</span></a>
                                                    &nbsp;<a href="javascript:void(0)"><span class="deletecomment" id="'.$question->data_id.'">Delete</span></a>';
                                                }
                                            }
                                    $output .= '</div>
                                        <div class="col-3" style="text-align: center;font-size:14px">
                                            <button class="ATQ" id="'.$question->data_id.'">Answer this Question</button>
                                        </div>
                                        <div class="col-3" style="text-align: left;font-size:14px">
                                            Posted by:&nbsp;&nbsp;<a href="javascript:void(0)">';
                                            if(strpos($question->name," ")!=""){
                                                $output .= substr($question->name,0,strpos($question->name," "));
                                            }
                                            else{
                                                $output .= $question->name.'</a>';
                                            }
                                        $output .='</div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        if(Auth::user()){
                            $output .= '<div class="item_answer ml-2 mr-2" id="item'.$question->data_id.'">
                                <form method="post" action="/answer" class="q_answer" id="form'.$question->data_id.'" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" name="q_id" value="'.$question->data_id.'">
                                    <input type="hidden" name="user" value="'.Auth::user()->name.'">
                                    <div class="form-group">
                                        <textarea id="summer'.$question->data_id.'" name="text" class="summernote form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Submit"/>
                                        <input type="reset" class="btn btn_default summer_reset" id="'.$question->data_id.'" value="Reset"/>
                                    </div>
                                </form>
                            </div>
                            <div class="item_edit ml-2 mr-2" id="edit{{$question->data_id}}">
                                <form method="post" action="/editcomment" class="q_answer" id="form'.$question->data_id.'" enctype="multipart/form-data">
                                   <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" name="q_id" value="'.$question->data_id.'">
                                    <input type="hidden" name="user" value="{{Auth::user()->name}}">
                                    <div class="form-group">
                                        <textarea id="editsummer'.$question->data_id.'" name="text" class="summernote form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Submit"/>
                                        <input type="reset" class="btn btn_default edit_summer_reset" id="'.$question->data_id.'" value="Reset"/>
                                    </div>
                                </form>
                            </div>';
                        }

                        else{
                            $output .= '<div class="item_answer ml-5 mb-3" id="item'.$question->data_id.'">You have to sign in using your account to answer this question.</div>';
                        }
                    $output .= '</li>';
                    $last_id = $question->data_id;
                }
                $output .= '<li><div id="load_more">
                            <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="'.$last_id.'" id="load_more_button">Load More</button>
                        </div></li>';
            }else{
                $output .= '<li>
                        <div id="load_more">
                            <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
                        </div></li>';
            }
            echo $output;
        }
    }

    public function login()
    {
        $categories = DB::table('q_a_s')->get();
        return view('login', ['footer' => PageContent::get()]);
    }

    public function howto()
    {
        $categories = $categories = DB::table('q_a_s')->get();;
        return view('howto', ['categories' => $categories, 'footer' => PageContent::get()]);
    }

    public function profile(){
        $u = array();
        $user = DB::table('users')->where('id',auth()->user()->id)->get();
        $u = isset($user[0])?$user[0]:false;
        $questions = DB::table('question')->where('user_id',auth()->user()->id)->get()->toArray();
        $article = DB::table('article')->where('user_id',auth()->user()->id)->get()->toArray();
        $video = DB::table('video')->where('user_id',auth()->user()->id)->get()->toArray();
        $article_video = count($article) + count($video);
        $f=array();
        $followers = DB::table('question')->select('user_id',DB::raw('SUM(following) as followers'))->where('user_id',auth()->user()->id)->groupBy('user_id')->get();
        $f = isset($followers[0])?$followers[0]:false;

        $answers = DB::table('answer')->where('name',auth()->user()->name)->get()->toArray();
        $pattern = '|'.auth()->user()->id.'|';
        $datas=DB::table('question')->get()->toArray();
        $following = 0;
        $length = count($datas);
        foreach ($datas as $data){
            $follow = $data->follow;
            $search_following = strpos($follow,$pattern,0);
            if($search_following!=0){
                $following+=1;
            }
        }

        return view('profile',['user'=>$u,'questions'=>$questions,'answers'=>$answers, 'article_video'=>$article_video,'followers'=>$f, 'footer' => PageContent::get()])->with('following',$following);
    }

    public function editprofile(Request $request){
        $this->validate($request, [
            'image' => 'image|nullable|max:2048'
        ]);
        $user_id = auth()->user()->id;
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '.' . $extension;
            $request->file('image')->move('fireuikit/images/users',$filenameWithExt);
//            $path = $request->file('addimage')->storeAs('public/upload', $fileNameToStore);

            DB::table('users')->where('id',$user_id)->update(['image'=>$fileNameToStore]);
            DB::table('answer')->where('name',auth()->user()->name)->update(['userimage'=>$fileNameToStore]);
            return redirect('askme');
        } else {
            return back();
        }
    }
    public function Qasearch(Request $request)
    {
        $id = $request->get('id');
        if ($id != 1) {
            $questions = DB::table('q_a_s')
                ->Join('question', 'question.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'question.user_id')
                ->select('question.title', 'question.id as data_id', 'question.image','question.register_date', 'question.comment as all_comment', 'question.comment', 'q_a_s.id', 'q_a_s.category', 'users.name','users.image as ques_user_image')
                ->where('q_a_s.id', '=', $id)
                ->orderBy('question.register_date', 'desc')
                ->get()->toArray();
            foreach ($questions as $v) {
                $v->answer = DB::table('answer')->where('question_id', '=', $v->data_id)->get()->toArray();
           }

            foreach($questions as $row){
                $crawler = new Crawler($row->comment);
                $text = $crawler->filter('p')->each(function ($node)  {
                    return $node->text();
                });
                $row->comment=" ";
                foreach ($text as $cont){
                    $row->comment =  "$row->comment  $cont";
                }
                $row->comment = str_limit($row->comment,200,'...<span class="more" id="'.$row->data_id.'">(more)</span>');
            }
        } else {
            $questions = DB::table('q_a_s')
                ->Join('question', 'question.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'question.user_id')
                ->select('question.title', 'question.id as data_id', 'question.register_date','question.image', 'question.comment as all_comment', 'question.comment', 'q_a_s.id', 'q_a_s.category', 'users.name','users.image as ques_user_image')
                ->orderBy('question.register_date', 'desc')
                ->get()->toArray();
            foreach ($questions as $v) {
                $v->answer = DB::table('answer')->where('question_id', '=', $v->data_id)->get()->toArray();

            }
            foreach($questions as $row){
                $crawler = new Crawler($row->comment);
                $text = $crawler->filter('p')->each(function ($node)  {
                    return $node->text();
                });
                $row->comment=" ";
                foreach ($text as $cont){
                    $row->comment =  "$row->comment  $cont";
                }
                $row->comment = str_limit($row->comment,200,'...<span class="more" id="'.$row->data_id.'">(more)</span>');
            }
        }

        $data = "";

        if ($questions) {
            foreach ($questions as $question) {

                $data .= '<li class="qa_content mb-1" style="width: 100%" id="li'.$question->data_id.'">
                    <div class="clearfix media p-3">
                        <img src="'.asset('fireuikit/images/users/'.$question->ques_user_image).'" width="50px" height="50px" style="float: left" class="mr-2 rounded-circle">
                        <div class="media-body">
                            <div class="ml-2">
                                <div class="ques_content" id="' . $question->data_id . '">
                                    <h5><a class="question" href="javascript:void(0)" id="' . $question->data_id . '">' . $question->title . '</a></h5>
                                    <div class="COM" id="com' . $question->data_id . '">' . $question->comment . '</div>

                                    <div id="edit_content' . $question->data_id . '" hidden>'.$question->all_comment.'</div>
                                </div>
                                <div class="Wow-bw Lh-24"></div>
                                <div class="row mt-2 config">
                                    <div class="col-3" style="text-align:left;font-size:14px">
                                        <p style="white-space: nowrap;width: 100%;overflow: hidden; text-overflow: ellipsis;">Category:&nbsp;&nbsp;<a href="javascript:void(0)" id="'.$question->id.'" class="category">' . $question->category . '</a></p>
                                    </div>
                                    <div class="col-3" style="text-align: center;font-size:14px">
                                            Answers&nbsp;&nbsp;(<a href="javascript:void(0)">' . count($question->answer) . '</a>)';
                                            if(auth()->user()){
                                                if(auth()->user()->name==$question->name){
                                                    $data.='&nbsp;<a href="javascript:void(0)"><span class="editcomment" id="' . $question->data_id . '">Edit</span></a>
                                                    &nbsp;<a href="javascript:void(0)"><span class="deletecomment" id="' . $question->data_id . '">Delete</span></a>';
                                                }
                                            }

                                $data.='</div>
                                    <div class="col-3" style="text-align:center;font-size:14px">
                                        <button class="ATQ mt-2 mb-2" id="' . $question->data_id . '">Answer this Question</button>
                                    </div>
                                    <div class="col-3" style="text-align: left;font-size:14px">
                                        Posted by:&nbsp;&nbsp;<a href="javascript:void(0)">';
                                        if(strpos($question->name," ")!=""){
                                            $data.= substr($question->name,0,strpos($question->name," "));
                                        }else{
                                            $data .=$question->name;
                                        }
                                        $data.= '</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                if(Auth::user()){
                    $data.= '<div class="item_answer ml-2 mr-2" id="item'.$question->data_id.'">
                            <form method="post" action="/answer" class="q_answer" id="form'.$question->data_id.'" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="q_id" value="'.$question->data_id.'">
                                <input type="hidden" name="user" value="'.auth()->user()->name.'">
                                <div class="form-group">

                                    <textarea id="summer'.$question->data_id.'" name="text" class="summernote form-control">
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Submit"/>
                                    <input type="reset" class="summer_reset btn btn_default" id="'.$question->data_id.'" value="Reset"/>
                                </div>
                            </form>
                         </div>
                         <div class="item_edit ml-2 mr-2" id="edit'.$question->data_id.'">
                                <form method="post" action="/editcomment" class="q_answer" id="form'.$question->data_id.'" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" name="q_id" value="'.$question->data_id.'">
                                    <input type="hidden" name="user" value="'.auth()->user()->name.'">
                                    <div class="form-group">
                                        <textarea id="editsummer'.$question->data_id.'" name="text" class="summernote form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Submit"/>
                                        <input type="reset" class="btn btn_default edit_summer_reset" id="'.$question->data_id.'" value="Reset"/>
                                    </div>
                                </form>
                            </div>';
                }else{
                    $data.='<div class="item_answer ml-5 mb-3" id="item'.$question->data_id.'">You have to sign in using your account to answer this question.</div>';
                }
                $data .= '</li>';
            }
            return Response($data);
        }

    }
    public function Qasearch1($cat_id)
    {
        $id = $cat_id;
        if ($id != 1) {
            $questions = DB::table('q_a_s')
                ->Join('question', 'question.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'question.user_id')
                ->select('question.title', 'question.id as data_id', 'question.image','question.register_date', 'question.comment as all_comment', 'question.comment', 'q_a_s.id', 'q_a_s.category', 'users.name','users.image as ques_user_image')
                ->where('q_a_s.id', '=', $id)
                ->orderBy('question.register_date', 'desc')
                ->get()->toArray();
            foreach ($questions as $v) {
                $v->answer = DB::table('answer')->where('question_id', '=', $v->data_id)->get()->toArray();
            }

            foreach($questions as $row){
                $crawler = new Crawler($row->comment);
                $text = $crawler->filter('p')->each(function ($node)  {
                    return $node->text();
                });
                $row->comment=" ";
                foreach ($text as $cont){
                    $row->comment =  "$row->comment  $cont";
                }
                $row->comment = str_limit($row->comment,200,'...<span class="more" id="'.$row->data_id.'">(more)</span>');
            }
        } else {
            $questions = DB::table('q_a_s')
                ->Join('question', 'question.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'question.user_id')
                ->select('question.title', 'question.id as data_id', 'question.register_date','question.image', 'question.comment as all_comment', 'question.comment', 'q_a_s.id', 'q_a_s.category', 'users.name','users.image as ques_user_image')
                ->orderBy('question.register_date', 'desc')
                ->get()->toArray();
            foreach ($questions as $v) {
                $v->answer = DB::table('answer')->where('question_id', '=', $v->data_id)->get()->toArray();

            }
            foreach($questions as $row){
                $crawler = new Crawler($row->comment);
                $text = $crawler->filter('p')->each(function ($node)  {
                    return $node->text();
                });
                $row->comment=" ";
                foreach ($text as $cont){
                    $row->comment =  "$row->comment  $cont";
                }
                $row->comment = str_limit($row->comment,200,'...<span class="more" id="'.$row->data_id.'">(more)</span>');
            }
        }

        $data = "";

        if ($questions) {
            foreach ($questions as $question) {

                $data .= '<li class="qa_content mb-1" style="width: 100%" id="li'.$question->data_id.'">
                    <div class="clearfix media p-3">
                        <img src="'.asset('fireuikit/images/users/'.$question->ques_user_image).'" width="50px" height="50px" style="float: left" class="mr-2 rounded-circle">
                        <div class="media-body">
                            <div class="ml-2">
                                <div class="ques_content" id="' . $question->data_id . '">
                                    <h5><a class="question" href="javascript:void(0)" id="' . $question->data_id . '">' . $question->title . '</a></h5>
                                    <div class="COM" id="com' . $question->data_id . '">' . $question->comment . '</div>

                                    <div id="edit_content' . $question->data_id . '" hidden>'.$question->all_comment.'</div>
                                </div>
                                <div class="Wow-bw Lh-24"></div>
                                <div class="row mt-2 config">
                                    <div class="col-3" style="text-align:left;font-size:14px">
                                        <p style="white-space: nowrap;width: 100%;overflow: hidden; text-overflow: ellipsis;">Category:&nbsp;&nbsp;<a href="javascript:void(0)" id="'.$question->id.'" class="category">' . $question->category . '</a></p>
                                    </div>
                                    <div class="col-3" style="text-align: center;font-size:14px">
                                            Answers&nbsp;&nbsp;(<a href="javascript:void(0)">' . count($question->answer) . '</a>)';
                if(auth()->user()){
                    if(auth()->user()->name==$question->name){
                        $data.='&nbsp;<a href="javascript:void(0)"><span class="editcomment" id="' . $question->data_id . '">Edit</span></a>
                                                    &nbsp;<a href="javascript:void(0)"><span class="deletecomment" id="' . $question->data_id . '">Delete</span></a>';
                    }
                }

                $data.='</div>
                                    <div class="col-3" style="text-align:center;font-size:14px">
                                        <button class="ATQ mt-2 mb-2" id="' . $question->data_id . '">Answer this Question</button>
                                    </div>
                                    <div class="col-3" style="text-align: left;font-size:14px">
                                        Posted by:&nbsp;&nbsp;<a href="javascript:void(0)">';
                if(strpos($question->name," ")!=""){
                    $data.= substr($question->name,0,strpos($question->name," "));
                }else{
                    $data .=$question->name;
                }
                $data.= '</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                if(Auth::user()){
                    $data.= '<div class="item_answer ml-2 mr-2" id="item'.$question->data_id.'">
                            <form method="post" action="/answer" class="q_answer" id="form'.$question->data_id.'" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="q_id" value="'.$question->data_id.'">
                                <input type="hidden" name="user" value="'.auth()->user()->name.'">
                                <div class="form-group">

                                    <textarea id="summer'.$question->data_id.'" name="text" class="summernote form-control">
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Submit"/>
                                    <input type="reset" class="summer_reset btn btn_default" id="'.$question->data_id.'" value="Reset"/>
                                </div>
                            </form>
                         </div>
                         <div class="item_edit ml-2 mr-2" id="edit'.$question->data_id.'">
                                <form method="post" action="/editcomment" class="q_answer" id="form'.$question->data_id.'" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" name="q_id" value="'.$question->data_id.'">
                                    <input type="hidden" name="user" value="'.auth()->user()->name.'">
                                    <div class="form-group">
                                        <textarea id="editsummer'.$question->data_id.'" name="text" class="summernote form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Submit"/>
                                        <input type="reset" class="btn btn_default edit_summer_reset" id="'.$question->data_id.'" value="Reset"/>
                                    </div>
                                </form>
                            </div>';
                }else{
                    $data.='<div class="item_answer ml-5 mb-3" id="item'.$question->data_id.'">You have to sign in using your account to answer this question.</div>';
                }
                $data .= '</li>';
            }
            return Response($data);
        }

    }



    public function search_question(Request $request)
    {
        if ($request->ajax()) {
            $data = Question::where('title', 'LIKE', $request->searchquiz . '%')->get();
            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block; position: relative; z-index: 2">';
                foreach ($data as $row) {
                    // concatenate output to the array
                    $output .= '<li class="list-group-item">' . $row->title . '</li>';
                }
                // end of output
                $output .= '</ul>';
            } else {
                // if there\'s no matching results according to the input
                $output .= '<li class="list-group-item">' . 'No results' . '</li>';
            }
            // return output result array
            return $output;
        }
    }
//    public function search_answer(Request $request)
//    {
//        if ($request->ajax()) {
//
//            $data = answer::where('answer', 'LIKE', '%'.$request->search_answer . '%')->get();
//            $output = '';
//            if (count($data) > 0) {
//                $output = '<ul class="list-group ml-3" style="display:block; position: relative; z-index: 2">';
//                foreach ($data as $row) {
//                    // concatenate output to the array
//                    $output .= '<li class="list-group-item">' . $row->answer . '</li>';
//                }
//                // end of output
//                $output .= '</ul>';
//            } else {
//                // if there\'s no matching results according to the input
//                $output .= '<li class="list-group-item">' . 'No results' . '</li>';
//            }
//            // return output result array
//            return $output;
//        }
//    }

    public function find_question(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('find_query');
            if ($query != '') {
                $datas = DB::table('q_a_s')
                    ->Join('question', 'question.category_id', '=', 'q_a_s.id')
                    ->Join('users', 'users.id', '=', 'question.user_id')
                    ->select('question.title', 'question.id as data_id', 'question.register_date', 'question.comment as all_comment', 'question.comment', 'q_a_s.id', 'q_a_s.category', 'users.name','users.image as ques_user_image')
                    ->where('question.title', 'LIKE','%'. $query.'%')
                    ->orderBy('question.register_date', 'desc')
                    ->get()->toArray();
                foreach ($datas as $v) {
                    $v->answer = DB::table('answer')->where('question_id', '=', $v->id)->get()->toArray();

                }
                foreach($datas as $row){
                    $crawler = new Crawler($row->comment);
                    $text = $crawler->filter('p')->each(function ($node)  {
                        return $node->text();
                    });
                    $row->comment=" ";
                    foreach ($text as $cont){
                        $row->comment =  "$row->comment  $cont";
                    }
                    $row->comment = str_limit($row->comment,200,'...<span class="more" id="'.$row->data_id.'">(more)</span>');
                }
            } else {
                $datas = DB::table('q_a_s')
                    ->Join('question', 'question.category_id', '=', 'q_a_s.id')
                    ->Join('users', 'users.id', '=', 'question.user_id')
                    ->select('question.title', 'question.id as data_id', 'question.register_date', 'question.comment as all_comment', 'question.comment', 'q_a_s.id', 'q_a_s.category', 'users.name','users.image as ques_user_image')
                    ->orderBy('question.register_date', 'desc')
                    ->get()->toArray();
                foreach ($datas as $v) {
                    $v->answer = DB::table('answer')->where('question_id', '=', $v->id)->get()->toArray();

                }
                foreach($datas as $row){
                    $crawler = new Crawler($row->comment);
                    $text = $crawler->filter('p')->each(function ($node)  {
                        return $node->text();
                    });
                    $row->comment=" ";
                    foreach ($text as $cont){
                        $row->comment =  "$row->comment  $cont";
                    }
                    $row->comment = str_limit($row->comment,200,'...<span class="more" id="'.$row->data_id.'">(more)</span>');
                }
            }

            $output = '';
            if (count($datas) > 0) {
                foreach ($datas as $data) {
                    $output .= '<li class="qa_content mb-1" style="width: 100%" id="li'.$data->data_id.'">
                                <div class="clearfix media p-3">
                                    <img src="'.asset('fireuikit/images/users/'.$data->ques_user_image).'" width="50px" height="50px" style="float: left" class="mr-2 rounded-circle">
                                    <div class="media-body">
                                        <div class="ml-2">
                                            <div class="ques_content" id="' . $data->data_id . '">
                                                <h5><a class="question" href="javascript:void(0)" id="' . $data->data_id . '">' . $data->title . '</a></h5>
                                                <div class="COM" id="com' . $data->data_id . '">' . $data->comment . '</div>

                                                <div id="edit_content' . $data->data_id . '" hidden>'.$data->all_comment.'</div>
                                            </div>
                                            <div class="Wow-bw Lh-24"></div>
                                            <div class="row mt-2 config">
                                                <div class="col-3" style="text-align:left;font-size:14px">
                                                    <p style="white-space: nowrap;width: 100%;overflow: hidden; text-overflow: ellipsis;">Category:&nbsp;&nbsp;<a href="javascript:void(0)" id="'.$data->id.'" class="category">' . $data->category . '</a></p>
                                                </div>
                                                <div class="col-3" style="text-align: center;font-size:14px">
                                                    Answers&nbsp;&nbsp;(<a href="javascript:void(0)">' . count($data->answer) . '</a>)';
                                                    if(auth()->user()){
                                                        if(auth()->user()->name==$data->name){
                                                            $output.='&nbsp;<a href="javascript:void(0)"><span class="editcomment" id="' . $data->data_id . '">Edit</span></a>
                                                                &nbsp;<a href="javascript:void(0)"><span class="deletecomment" id="' . $data->data_id . '">Delete</span></a>';
                                                        }
                                                    }

                                            $output.='</div>
                                                <div class="col-3" style="text-align:center;font-size:14px">
                                                    <button class="ATQ mt-2 mb-2" id="' . $data->data_id . '">Answer this Question</button>
                                                </div>
                                                <div class="col-3" style="text-align: left;font-size:14px">
                                                    Posted by:&nbsp;&nbsp;<a href="javascript:void(0)">';
                                                    if(strpos($data->name," ")!=""){
                                                        $output.= substr($data->name,0,strpos($data->name," "));
                                                    }else{
                                                        $output .=$data->name;
                                                    }
                                                    $output.= '</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                    if(Auth::user()){
                        $output.= '<div class="item_answer ml-2 mr-2" id="item'.$data->data_id.'">
                            <form method="post" action="/answer" class="q_answer" id="form'.$data->data_id.'" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="q_id" value="'.$data->data_id.'">
                                <input type="hidden" name="user" value="'.auth()->user()->name.'">
                                <div class="form-group">

                                    <textarea id="summer'.$data->data_id.'" name="text" class="summernote form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Submit"/>
                                    <input type="reset" class="summer_reset btn btn_default" id="'.$data->data_id.'" value="Reset"/>
                                </div>
                            </form>
                         </div>
                        <div class="item_edit ml-2 mr-2" id="edit'.$data->data_id.'">
                            <form method="post" action="editcomment" class="q_answer" id="form'.$data->data_id.'" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="q_id" value="'.$data->data_id.'">
                                <input type="hidden" name="user" value="'.auth()->user()->name.'">
                                <div class="form-group">
                                    <textarea id="editsummer'.$data->data_id.'" name="text" class="summernote form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Submit"/>
                                    <input type="reset" class="btn btn_default edit_summer_reset" id="'.$data->data_id.'" value="Reset"/>
                                </div>
                            </form>
                        </div>';
                    }else{
                        $output.='<div class="item_answer ml-5 mb-3" id="item'.$data->data_id.'">You have to sign in using your account to answer this question.</div>';
                    }

                    $output .= '</li>';
                }

            } else {
                $output .= '<li class="qa_content">' . 'No results.' . '</li>';
            }
            return $output;
        }
    }

    public function find_answer(Request $request){
        if ($request->ajax()) {
            $query = $request->get('query');

            $answers = DB::table('answer')->where('answer','LIKE','%'.$query.'%')->get()->toArray();
            return $query;
            $output = "";
//            if ($query != '') {
//                foreach ($answers as $answer) {
//                    $q_id = $answer->question_id;
//                    echo $q_id;
//
//                    $question = DB::table('question')->where('id',$q_id)->get()->toArray();
//                    $category = DB::table('q_a_s')->where('id',$question->category_id)->get()->toArray();
//                    return "OK";
//                    $output .= '<li class="qa_content mb-1" style="width: 100%">
//                                    <div class="ml-2">
//                                        <h5><a class="question" href="javascript:void(0)" id="' . $q_id . '">' . $question->title . '</a></h5>' .'<p>' . $question->comment . '</p>
//                                    </div>
//                                    <div class="Wow-bw Lh-24"></div>
//                                    <div class="row">
//                                        <div class="col-3" style="text-align:center">
//                                            <p style="white-space: nowrap;width: 100%;overflow: hidden; text-overflow: ellipsis;">Category:<a href="javascript:void(0)">' . $category->category . '</a></p>
//                                        </div>
//                                        <div class="col-3" style="text-align: center">
//                                            Answers:<a href="javascript:void(0)">0</a>
//                                        </div>
//                                        <div class="col-3" style="text-align:center">
//                                            <button class="ATQ mt-2 mb-2" id="' . $q_id . '">Answer this Question</button>
//                                        </div>
//                                        <div class="col-3" style="text-align: center">
//                                            Posted by:<a href="javascript:void(0)">xx</a>
//                                        </div>
//                                    </div>
//                                 </li>';
//
//
//                }
//            } else {
//                return "Failed";
//            }
        }
    }

    public function answer(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
            'image' => 'image|nullable|max:2048'
        ]);
        $question_id = $request->input('q_id');
        $answer_name = auth()->user()->name;
        $answer = $request->input('text');
        $user_image = auth()->user()->image;
        //Handle File Upload
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '.' . $extension;
//            $path = $request->file('image')->storeAs('public/upload', $fileNameToStore);
            $path=$request->file('image')->move('upload',$filenameWithExt);
            DB::table('answer')->insert(['name' => $answer_name, 'userimage'=>$user_image,'image_name' => $fileNameToStore, 'answer' => $answer, 'question_id' => $question_id, 'register_date' => now()]);
            return back();
        } else {
            DB::table('answer')->insert(['name' => $answer_name, 'userimage'=>$user_image,'image_name' => null, 'answer' => $answer, 'question_id' => $question_id, 'register_date' => now()]);
            return back();
        }
    }

    public function addquestion(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',

        ]);
        $user_id = auth()->user()->id;
        $category = $request->input('category');
        $question = $request->input('title');
        $comment = $request->input('comment');
        if ($comment == "") {
            $comment = null;
        }

        if(strpos($comment,'<img')!==null && strpos($comment, "<img") != ""){
            if(strpos($comment,"</p><p><img")!=null && strpos($comment,"</p><p><img") != ""){
                if(strpos($comment, '"></p><p>')){
                    $comment=$comment;
                }else{
                    // $comment = str_replace('">', '"></p><p>', $comment);
                }

            }else{
                $comment = str_replace('<img', '</p><p><img', $comment);
                // $comment = str_replace('">', '"></p><p>', $comment);

            }

        }
        DB::table('question')->insert(['title' => $question, 'comment' => $comment, 'category_id' => $category, 'user_id' => $user_id, 'register_date' => now()]);
        return back();

    }

    public function view(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');

            $data = DB::table('question')
                ->Join('users', 'users.id', '=', 'question.user_id')
                ->select('question.id', 'question.title', 'question.image as q_image','question.comment', 'question.following', 'question.register_date as q_register','users.image', 'users.name')
                ->where('question.id', '=', $id)
                ->get();



            foreach ($data as $v) {
                $v->answer = DB::table('answer')->where('question_id', '=', $v->id)
                    ->orderBy('best', 'desc')
                    ->orderBy('register_date', 'desc')
                    ->get()->toArray();
            }
            $output = "";
            if (!auth()->user()) {
                $output .= '<div class="media">
                               <img src="' . asset('fireuikit/images/users/' . $data[0]->image . '') . '" class="align-self-start mr-3 rounded-circle" style="width: 47px;height: 47px">
                               <div class="media-body">
                                   <h5>' . $data[0]->title . '</h5>
                                   <p>' . $data[0]->comment . '</p>';
                if($data[0]->q_image){
                         $output.='<div class="row ml-1 mb-2">
                                       <img src="'.asset('upload/'.$data[0]->q_image).'" style="width: 50%;height: 50%">
                                   </div>';
                }
                         $output.='<div class="row">
                                       <ul class="subdsc">
                                           <li><img src="' . asset('fireuikit/images/following.png') . '" class="following mr-2"><label style="">Following &nbsp;(' . $data[0]->following . ')</label></li>
                                           <li>Answers &nbsp;<span style="color: #007bff">(' . count($data[0]->answer) . ')</span></li>
                                        </ul>
                                   </div>
                               </div>
                             </div>
                             <h6>Answers</h6>';
                if (count($data[0]->answer) > 0) {
                    foreach ($data[0]->answer as $answer) {
                        $comments = DB::table('comment')->where('answer_id', '=', $answer->id)
                            ->orderBy('register_date', 'asc')
                            ->get()->toArray();
                        $output .= '<div class="media">
                                        <img src="' . asset('fireuikit/images/users/' . $answer->userimage . '') . '" class="align-self-start rounded-circle mr-3" style="width: 47px;height: 47px">
                                        <div class="media-body mb-3">';
                        if ($answer->best != 0) {
                                $output .= '<p><label style="color: #ffca00"><img src="' . asset('fireuikit/images/best-answer.png') . '" class="mr-2" style="width: 15px;height: 15px">Best Answer:</label>' . $answer->answer . '</p>
                                        <div class="row ml-1 mt-2 mb-2">';
                                if($answer->image_name){
                                    $output.='<img src="'.asset('upload/'.$answer->image_name).'" style="width:50%;height:50%">';
                                }
                                $output .='</div>
                                <p><span style="color: #007bff" class="mr-4">' . $answer->name . '</span>'.Qacontroller::ago(new \DateTIme($answer->register_date)).'</p>
                                <div class="button mr-4"><div class="up"><span style="position: relative;left: 20px;bottom: 5px">0</span></div></div>
                                <div class="button mr-4"><div class="down"><span style="position: relative;left: 20px;bottom: 5px">0</span></div></div>

                                <div class="comment" style="float: right" id="' . $answer->id . '">Comment &nbsp;&nbsp;&nbsp;<i class="fa fa-flag-o" style="color: #5900c7"></i></div>
                                <div class="row"></div>
                                <div style="display: inline-block;">Asker\'s rating </div><div class="rateyo" id="star" data="' . $answer->best . '" data-rateyo-rated-fill="#00FF00" style="display: inline-block"></div>

                                </div></div></div>';
                        } else {
                            $output .= '
                                <div class="row ml-1 mt-2 mb-2">';
                            $output.=$answer->answer;
                            $output.='</div><p><span style="color: #007bff" class="mr-4">' . $answer->name . '</span>'.Qacontroller::ago(new DateTIme($answer->register_date)).'</p>
                                <div class="button mr-4"><div class="up"><span style="position: relative;left: 20px;bottom: 5px">' . $answer->n_agree . '</span></div></div>
                                <div class="button mr-4"><div class="down"><span style="position: relative;left: 20px;bottom: 5px">' . $answer->n_oppo . '</span></div></div>

                                <div class="comment" style="float: right">Comment&nbsp;&nbsp;&nbsp;<i class="fa fa-flag-o" style="color: #5900c7"></i></div>
                                </div>
                                </div>
                                </div>';
                        }

                    }
                }
                $output .= '<div class="notify" hidden>You have to sign in using your account to answer this question.</div>
                            <script>

                                        $(".following").click(function() {
                                              window.location="/register";
                                            });
                                        $(".up").click(function() {
                                              window.location="/register";
                                            });
                                        $(".down").click(function() {
                                              window.location="/register";
                                            });
                                        $(".comment").click(function() {
                                              window.location="/register";
                                            });
                                        $(function() {
                                            //Best Answer Rating
                                            var rating = $("#star").attr("data");
                                            $(".counter").text(rating);
                                            $(".rateyo").rateYo({
                                                rating: rating,
                                                starWidth: "15px",
                                                spacing: "5px",
                                                readOnly: true
                                            })
                                        });
                                    </script>';
            } else {
                if (auth()->user()->name != $data[0]->name) {
                    $output .= '<div class="media">
                               <img src="' . asset('fireuikit/images/users/' . $data[0]->image . '') . '" class="align-self-start mr-3 rounded-circle" style="width: 47px;height: 47px">
                               <div class="media-body">
                                   <h5>' . $data[0]->title . '</h5>
                                   <p>' . $data[0]->comment . '</p>';

                    if($data[0]->q_image){
                        $output.='<div class="row ml-1 mb-2">
                                    <img src="'.asset('upload/'.$data[0]->q_image).'" style="width: 50%;height: 50%">
                                   </div>';
                    }
                    $output.='<div class="row">
                                       <ul class="subdsc">
                                           <li><div class="follow mr-2" id="'.$data[0]->id.'"></div><label id="cn_follow">Following&nbsp;(' . $data[0]->following . ')</label></li>
                                           <li>Answers&nbsp;<span style="color: #007bff">(' . count($data[0]->answer) . ')</span></li>
                                        </ul>
                                   </div>
                               </div>
                           </div>
                           <h6>Answers</h6>';
                    if (count($data[0]->answer) > 0) {
                        foreach ($data[0]->answer as $answer) {
                            $comments = DB::table('comment')
                                ->Join('users','users.name','=','comment.name')
                                ->select('comment.name','comment.comment','comment.register_date','users.image')
                                ->where('answer_id', '=', $answer->id)
                                ->orderBy('register_date', 'asc')
                                ->get()->toArray();

                            $output .= '<div class="media"><img src="' . asset('fireuikit/images/users/' . $answer->userimage . '') . '" class="align-self-start mr-3 rounded-circle" style="width: 47px;height: 47px">
                             <div class="media-body mb-3">';
                            if ($answer->best != 0) {
                                $output .= '<p><label style="color: #ffca00"><img src="' . asset('fireuikit/images/best-answer.png') . '" class="mr-2" style="width: 15px;height: 15px">Best Answer:</label></p>
                                <div class="row ml-1 mt-2 mb-2">';

                                $output.=$answer->answer;

                                $output.='</div>

                                <p><span style="color: #007bff" class="mr-4">' . $answer->name . '</span> '.Qacontroller::ago(new DateTIme($answer->register_date)).'</p>
                                <div class="button mr-4"><div class="up"><span id="up' . $answer->id . '" style="position: relative;left: 20px;bottom: 5px">' . $answer->n_agree . '</span></div></div>
                                <div class="button mr-4"><div class="down"><span id="down' . $answer->id . '" style="position: relative;left: 20px;bottom: 5px">' . $answer->n_oppo . '</span></div></div>

                                <div class="comment" style="float: right" id="'.$answer->id.'">Comment &nbsp;&nbsp;&nbsp;<i class="fa fa-flag-o" style="color: #5900c7"></i></div>
                                <div class="row"></div>

                                <div style="display: inline-block;">Asker\'s rating </div><div class="rateyo" id="star" data="' . $answer->best . '" data-rateyo-rated-fill="#00FF00" style="display: inline-block"></div>
                                <div class="com_drop border p-3 mt-3" id="com' . $answer->id . '">
                                <div id="list' . $answer->id . '">';

                                foreach ($comments as $comment) {
                                    $output .= '<div class="media  ">
                                        <img src="' . asset('fireuikit/images/users/'.$comment->image.'') . '" class="rounded-circle align-self-start mr-3" style="width: 47px;height: 47px">
                                        <div class="media-body">
                                            <p>' . $comment->comment . '</p>
                                            <p style="font-size: 12px;color: #007bff">' . $comment->name . '&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #212529">'.Qacontroller::ago(new DateTIme($comment->register_date)).'</span></p>

                                        </div>
                                    </div>';
                                }

                                $output .= '</div><div class="media">
                                        <img src="' . asset('fireuikit/images/users/'.auth()->user()->image.'') . '" class="rounded-circle align-self-start mr-3" style="width: 47px;height: 47px">
                                        <div class="media-body">
                                           <form class="form_comment" id="' . $answer->id . '">
                                               <input type="hidden" name="_token" value="' . csrf_token() . '">
                                               <div class="form-group" style="width: 100%">
                                                   <input type="hidden" value="' . auth()->user()->name . '" id="n' . $answer->id . '"/>
                                                   <textarea class="form-group" id="t' . $answer->id . '" name="comment" style="width: 100%"></textarea>
                                               </div>
                                               <div class="form-group">
                                                       <button type="button" value="Submit" class="comment-btn" id="' . $answer->id . '">Submit</button>
                                               </div>
                                           </form>

                                        </div>
                                    </div>
                                </div></div></div>';
                            } else {
                                $output .= '<div class="row ml-1 mt-2 mb-2">';
                                $output.=$answer->answer;

                                $output.='</div><p><span style="color: #007bff" class="mr-4">' . $answer->name . '</span> '.Qacontroller::ago(new DateTIme($answer->register_date)).'</p>
                                <div class="button mr-4"><div class="up" id="' . $answer->id . '"><span id="up' . $answer->id . '" style="position: relative;left: 20px;bottom: 5px">' . $answer->n_agree . '</span></div></div>
                                <div class="button mr-4"><div class="down" id="' . $answer->id . '"><span id="down' . $answer->id . '" style="position: relative;left: 20px;bottom: 5px">' . $answer->n_oppo . '</span></div></div>

                                <div class="comment" style="float: right" id="' . $answer->id . '">Comment &nbsp;&nbsp;&nbsp;<i class="fa fa-flag-o" style="color: #5900c7"></i></div>
                                <div class="com_drop border p-3 mt-3" id="com' . $answer->id . '">
                                <div id="list' . $answer->id . '">';

                                foreach ($comments as $comment) {
                                    $output .= '<div class="media  ">
                                        <img src="' . asset('fireuikit/images/users/' . $comment->image . '') . '" class="rounded-circle align-self-start mr-3" style="width: 47px;height: 47px">
                                        <div class="media-body">
                                            <p>' . $comment->comment . '</p>
                                            <p style="font-size: 12px;color: #007bff">' . $comment->name . '&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #212529">'.Qacontroller::ago(new DateTIme($comment->register_date)).'</span></p>

                                        </div>
                                    </div>';
                                }
                                $output .= '</div><div class="media">
                                        <img src="' . asset('fireuikit/images/users/' . auth()->user()->image . '') . '" class="rounded-circle align-self-start mr-3" style="width: 47px;height: 47px">
                                        <div class="media-body">
                                            <form class="form_comment" id="' . $answer->id . '">
                                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                                <div class="form-group" style="width: 100%">
                                                    <input type="hidden" value="' . auth()->user()->name . '" id="n' . $answer->id . '"/>
                                                    <textarea class="form-group" id="t' . $answer->id . '" name="comment" style="width: 100%" placeholder="Add a comment"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" value="Submit" class="comment-btn" id="' . $answer->id . '">Submit</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                            }
                        }
                    }
                    $output.='<div class="notify" hidden>Write your answer,please.</div>
                        <div class="item_answer border p-5" id="item'.$data[0]->id.'">
                            <form method="post" action="/answer" class="q_answer" id="form'.$data[0]->id.'" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="q_id" value="'.$data[0]->id.'">
                                <input type="hidden" name="user" value="'.auth()->user()->name.'">
                                <div class="form-group">
                                    <textarea id="summer'.$data[0]->id.'" name="text" class="summernote form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Submit"/>
                                    <input type="reset" class="btn btn_default summer_reset" id="'.$data[0]->id.'" value="Reset"/>
                                </div>
                            </form>
                        </div>';

                } else {
                    $output .= '<div class="media">
                               <img src="' . asset('fireuikit/images/users/' . $data[0]->image . '') . '" class="align-self-start mr-3 rounded-circle" style="width: 47px;height: 47px">
                               <div class="media-body">
                                   <h5>' . $data[0]->title . '</h5>
                                   <p>' . $data[0]->comment . '</p>';

                    if($data[0]->q_image){
                        $output.='<div class="row ml-1 mb-2">
                                    <img src="'.asset('upload/'.$data[0]->q_image).'" style="width: 50%;height: 50%">
                                   </div>';
                    }


                    $output.='<div class="row">
                                       <ul class="subdsc">
                                           <li><img src="' . asset('fireuikit/images/following.png') . '" class="following mr-2"><label>Following&nbsp;(' . $data[0]->following . ')</label></li>
                                           <li>Answers&nbsp;<span style="color: #007bff">(' . count($data[0]->answer) . ')</span></li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                           <h6>Answers</h6>';
                    if (count($data[0]->answer) > 0) {

                        foreach ($data[0]->answer as $answer) {
                            $comments = DB::table('comment')
                                ->Join('users','users.name','=','comment.name')
                                ->select('comment.name','comment.comment','comment.register_date','users.image')
                                ->where('answer_id', '=', $answer->id)
                                ->orderBy('register_date', 'asc')
                                ->get()->toArray();
                            $output .= '<div class="media">
                                           <img src="' . asset('fireuikit/images/users/' . $data[0]->image . '') . '" class="align-self-start mr-3 rounded-circle" style="width: 47px;height: 47px">
                                           <div class="media-body mb-3">';
                            if ($answer->best !=0) {
                                $output .= '<p><label style="color: #ffca00"><img src="' . asset('fireuikit/images/best-answer.png') . '" class="mr-2" style="width: 15px;height: 15px">Best Answer:</label></p>
                                      <div class="row ml-1 mt-2 mb-2">';
                                $output.=$answer->answer;
                            $output.='</div>
                                <p><span style="color: #007bff" class="mr-4">' . $answer->name . '</span> '.Qacontroller::ago(new DateTIme($answer->register_date)).'</p>

                                <div class="button mr-4"><div class="up" id="' . $answer->id . '"><span id="up' . $answer->id . '" style="position: relative;left: 20px;bottom: 5px">' . $answer->n_agree . '</span></div></div>
                                <div class="button mr-4"><div class="down" id="' . $answer->id . '"><span id="down' . $answer->id . '" style="position: relative;left: 20px;bottom: 5px">' . $answer->n_oppo . '</span></div></div>

                                <div class="comment" style="float: right" id="' . $answer->id . '">Comment &nbsp;&nbsp;&nbsp;<i class="fa fa-flag-o" style="color: #5900c7"></i></div>
                                <div class="row"></div>
                                <div style="display: inline-block;">Asker\'s rating </div><div class="rateyo" id="star" data="' . $answer->best . '" data-rateyo-rated-fill="#00FF00" style="display: inline-block"></div>
                                <div class="com_drop border p-3 mt-3" id="com' . $answer->id . '">

                                     <div id="list' . $answer->id . '">';

                                        foreach ($comments as $comment) {
                                            $output .= '<div class="media">
                                                    <img src="' . asset('fireuikit/images/users/' . $comment->image . '') . '" class="rounded-circle align-self-start mr-3" style="width: 47px;height: 47px">
                                                    <div class="media-body">
                                                        <p>' . $comment->comment . '</p>
                                                        <p style="font-size: 12px;color: #007bff">' . $comment->name . '&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #212529">'.Qacontroller::ago(new DateTIme($comment->register_date)).'</span></p>

                                                    </div>
                                                </div>';
                                        }
                                     $output .= '</div>
                                            <div class="media">

                                               <img src="' . asset('fireuikit/images/users/' . auth()->user()->image . '') . '" class="rounded-circle align-self-start mr-3" style="width: 47px;height: 47px">
                                               <div class="media-body">
                                                   <form class="form_comment" id="' . $answer->id . '">
                                                       <input type="hidden" name="_token" value="' . csrf_token() . '">
                                                       <div class="form-group" style="width: 100%">
                                                           <input type="hidden" value="' . auth()->user()->name . '" id="n' . $answer->id . '"/>
                                                           <textarea id="t' . $answer->id . '" name="comment" class="form-group" style="width: 100%"></textarea>
                                                       </div>
                                                       <div class="form-group">
                                                               <button type="button" value="Submit" class="comment-btn" id="' . $answer->id . '">Submit</button>
                                                       </div>
                                                   </form>

                                                </div>
                                            </div>

                                    </div>
                                </div>


                                </div>
                                </div>';

                            }
                            elseif($answer->best == 0){
                            $output .= '<div class="row ml-1 mt-2 mb-2">';
                                $output.=$answer->answer;
                            $output.='</div>
                                <p><span style="color: #007bff" class="mr-4">' . $answer->name . '</span> '.Qacontroller::ago(new DateTIme($answer->register_date)).'</p>
                                <button class="award mr-4" id="'.$answer->id.'">Award best answer</button>';


                            $output.='<div class="button mr-4"><div class="up" id="' . $answer->id . '"><span id="up' . $answer->id . '" style="position: relative;left: 20px;bottom: 5px">' . $answer->n_agree . '</span></div></div>
                                <div class="button mr-4"><div class="down" id="' . $answer->id . '"><span id="down' . $answer->id . '" style="position: relative;left: 20px;bottom: 5px">' . $answer->n_oppo . '</span></div></div>
                                <div class="comment" style="float: right" id="' . $answer->id . '">Comment &nbsp;&nbsp;&nbsp;<i class="fa fa-flag-o" style="color: #5900c7"></i></div>

                                <div class="best border p-3 mt-3 rating_container" id="award'.$answer->id.'">
                                    <p>Rage Best Answer</p>
                                    <div class="rate" data-product-id="'.$answer->id.'" id="b'.$answer->id.'" data-rateyo-rated-fill="#00FF00"></div>
                                    <button class="award-btn mt-2" id="ard'.$answer->id.'">Submit</button>
                                </div>

                                <div class="com_drop border p-3 mt-3" id="com' . $answer->id . '">
                                <div id="list' . $answer->id . '">';

                                foreach ($comments as $comment) {
                                     $output .= '<div class="media">
                                        <img src="' . asset('fireuikit/images/users/' . $comment->image . '') . '" class="rounded-circle align-self-start mr-3" style="width: 47px;height: 47px">
                                        <div class="media-body">
                                            <p>' . $comment->comment . '</p>
                                            <p style="font-size: 12px;color: #007bff">' . $comment->name . '&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #212529">'.Qacontroller::ago(new DateTIme($comment->register_date)).'</span></p>

                                        </div>
                                    </div>';
                                }
                                $output .= '</div><div class="media">
                                        <img src="' . asset('fireuikit/images/users/' . auth()->user()->image . '') . '" class="rounded-circle align-self-start mr-3" style="width: 47px;height: 47px">
                                        <div class="media-body">
                                            <form class="form_comment" id="list' . $answer->id . '">
                                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                                <div class="form-group" style="width: 100%">
                                                    <input type="hidden" value="' . auth()->user()->name . '" id="n' . $answer->id . '"/>
                                                    <textarea id="t' . $answer->id . '" name="comment" class="form-group" style="width: 100%"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" value="Submit" class="comment-btn" id="' . $answer->id . '">Submit</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <script>
                            var a = document.getElementById("star");
                            if(a!=null){
                                $(".award").hide();
                            }else{
                                $(".award").show();
                            }
                        </script>';
                            }
                        }

                    }
                    $output.='<div class="notify" hidden>Write your answer,please.</div>
                        <div class="item_answer border p-5" id="item'.$data[0]->id.'">
                            <form method="post" action="/answer" class="q_answer" id="form'.$data[0]->id.'" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="q_id" value="'.$data[0]->id.'">
                                <input type="hidden" name="user" value="'.auth()->user()->name.'">
                                <div class="form-group">
                                    <textarea id="summer'.$data[0]->id.'" name="text" class="summernote form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Submit"/>
                                    <input type="reset" class="btn btn_default summer_reset" id="'.$data[0]->id.'" value="Reset"/>
                                </div>
                            </form>
                        </div>';
                }
                $output .= '<script src="' . asset('fireuikit/js/answer-content.js') . '"></script>';
            }

            return $output;
        }

    }

    public function agree(Request $request)
    {
        if ($request->ajax()) {
            $answer_id = $request->get('id');
            $user_id = auth()->user()->id;
            $result = DB::table('answer')->select('agreement', 'n_agree', 'opposition', 'n_oppo')->where('id', '=', $answer_id)->get();
            $pattern = '|' . $user_id . '|';
            $agreement = $result[0]->agreement;
            $opposition = $result[0]->opposition;
            $n_agree = $result[0]->n_agree;
            $n_oppo = $result[0]->n_oppo;
            $agree_search = strpos($agreement, $pattern, 0);
            $oppo_search = strpos($opposition, $pattern, 0);
            if ($oppo_search == "") {
                if ($agree_search != "") {
                    $n_agree -= 1;
                    $pattern = '|' . $pattern;
                    $agree = str_replace($pattern, "", $agreement);
                    DB::table('answer')->where('id', $answer_id)->update(['agreement' => $agree, 'n_agree' => $n_agree]);
                    $data = ['n_agree' => $n_agree, 'n_oppo' => $n_oppo];
                } else {
                    $agree = $agreement . '|' . $pattern;
                    $n_agree += 1;
                    DB::table('answer')->where('id', $answer_id)->update(['agreement' => $agree, 'n_agree' => $n_agree]);
                    $data = ['n_agree' => $n_agree, 'n_oppo' => $n_oppo];
                }
            } else {
                if ($agree_search == "") {
                    $pattern = '|' . $pattern;
                    $agree = $agreement . $pattern;
                    $oppo = str_replace($pattern, "", $opposition);
                    $n_agree += 1;
                    $n_oppo -= 1;
                    DB::table('answer')->where('id', $answer_id)->update(['agreement' => $agree, 'opposition' => $oppo, 'n_agree' => $n_agree, 'n_oppo' => $n_oppo]);

                    $data = ['n_agree' => $n_agree, 'n_oppo' => $n_oppo];
                }
            }
            return json_encode($data);
        }
    }

    public function oppo(Request $request)
    {
        if ($request->ajax()) {
            $answer_id = $request->get('id');
            $user_id = auth()->user()->id;
            $result = DB::table('answer')->select('agreement', 'n_agree', 'opposition', 'n_oppo')->where('id', '=', $answer_id)->get();
            $pattern = $user_id;
            $pattern = '|' . $pattern . '|';
            $agreement = $result[0]->agreement;
            $opposition = $result[0]->opposition;
            $n_agree = $result[0]->n_agree;
            $n_oppo = $result[0]->n_oppo;
            $agree_search = strpos($agreement, $pattern, 0);
            $oppo_search = strpos($opposition, $pattern, 0);
            if ($agree_search == "") {
                if ($oppo_search != "") {
                    $n_oppo -= 1;
                    $pattern = '|' . $pattern;
                    $oppo = str_replace($pattern, "", $opposition);
                    DB::table('answer')->where('id', $answer_id)->update(['opposition' => $oppo, 'n_oppo' => $n_oppo]);
                    $data = ['n_agree' => $n_agree, 'n_oppo' => $n_oppo];
                } else {
                    $oppo = $opposition . '||' . $user_id . '|';
                    $n_oppo += 1;
                    DB::table('answer')->where('id', $answer_id)->update(['opposition' => $oppo, 'n_oppo' => $n_oppo]);
                    $data = ['n_agree' => $n_agree, 'n_oppo' => $n_oppo];
                }
            } else {
                if ($oppo_search == "") {
                    $pattern = '|' . $pattern;
                    $oppo = $opposition . $pattern;
                    $agree = str_replace($pattern, "", $agreement);
                    $n_agree -= 1;
                    $n_oppo += 1;
                    DB::table('answer')->where('id', $answer_id)->update(['agreement' => $agree, 'opposition' => $oppo, 'n_agree' => $n_agree, 'n_oppo' => $n_oppo]);

                    $data = ['n_agree' => $n_agree, 'n_oppo' => $n_oppo];
                }
            }
            return json_encode($data);

        }
    }

    public function comment(Request $request)
    {
        $answer_id = $request->get('answer_id');
        $comment = $request->get('comment');
        $name = $request->get('name');
        DB::table('comment')->insert(['name' => $name, 'answer_id' => $answer_id, 'comment' => $comment, 'register_date' => now()]);

        $comments = DB::table('comment')
            ->Join('users','users.name','=','comment.name')
            ->select('comment.name','comment.comment','comment.register_date','users.image')
            ->where('answer_id', '=', $answer_id)
            ->orderBy('register_date', 'asc')
            ->get()->toArray();
        $output = "";

        foreach ($comments as $comment) {
            $output .= '<div class="media" id="list' . $answer_id . '">
                            <img src="' . asset('fireuikit/images/users/'.$comment->image.'') . '" class="rounded-circle align-self-start mr-3" style="width: 47px;height: 47px">
                            <div class="media-body">
                                <p>' . $comment->comment . '</p>
                                <p style="font-size: 12px;color: #007bff">' . $comment->name . '&nbsp;&nbsp;<span style="color:#212529">'.Qacontroller::ago(new DateTIme($comment->register_date)).'</span></p>
                            </div>
                        </div>';
        }
        return $output;
    }

    public function follow(Request $request){
        $question_id = $request->get('id');
        $follow_name = auth()->user()->name;
        $user_id = auth()->user()->id;
        $result = DB::table('question')->select('follow', 'following')->where('id', '=', $question_id)->get();
        $pattern = '|' . $user_id . '|';
        $follow = $result[0]->follow;
        $following = $result[0]->following;
        $follow_search = strpos($follow, $pattern, 0);
        if ($follow_search != "") {
            $following -= 1;
            $pattern = '|' . $pattern;
            $follow = str_replace($pattern, "", $follow);
            DB::table('question')->where('id', $question_id)->update(['follow' => $follow, 'following' => $following]);
            $data=$following;
        } else {
            $follow = $follow . '|' . $pattern;
            $following += 1;
            DB::table('question')->where('id', $question_id)->update(['follow' => $follow, 'following' => $following]);
            $data=$following;
        }
        return $data;
    }

    public function best_answer(Request $request){
        $best = $request->get('best');
        $answer_id = $request->get('answer_id');
        DB::table('answer')->where('id',$answer_id)->update(['best'=>$best]);
    }

    public function editcomment(Request $request){

        $comment = $request->input('text');
        $question_id = $request->input('q_id');
        DB::table('question')->where('id',$question_id)->update(['comment'=>$comment]);
        return back();
    }

    public function deletecomment(Request $request){
        $id = $request->get('id');

        $questions = DB::table('q_a_s')
            ->Join('question', 'question.category_id', '=', 'q_a_s.id')
            ->Join('users', 'users.id', '=', 'question.user_id')
            ->select('q_a_s.id', 'question.id as data_id', 'question.title', 'question.image','question.register_date', 'question.comment', 'q_a_s.category', 'users.name','users.image as ques_user_image')
            ->where('question.id',$id)
            ->orderBy('question.register_date', 'desc')
            ->get()->toArray();
        foreach ($questions as $v) {

            $v->answer = DB::table('answer')->where('question_id', '=', $v->data_id)->get()->toArray();
            DB::table('answer')->where('question_id', '=', $v->data_id)->delete();
            foreach ($v->answer as $c){
                DB::table('comment')->where('answer_id',$c->id)->delete();
            }

        }
        DB::table('question')->where('id',$id)->delete();


    }

    public function  editDescription(Request $request){
        $desc = $request->input("description");
        $user_id = auth()->user()->id;
        DB::table('users')->where('id',$user_id)->update(['description'=>$desc]);
        return $this->profile();

    }
    public  function test_PHP($variable)
    {
        echo '<script>';
        echo 'console.log(' . json_encode($variable) . ')';
        echo '</script>';
    }


}
