<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

use app\Http\Controllers\Controller;

use Input;
use DB;
use Redirect;
use Session;
use View;

class mainController extends Controller
{
    public function home(){
        $all = DB::table('article')->get();
        $category = DB::table('article')->select('category')->groupBy('category')->get();
        return View::make('Home')->with(['all' => $all, 'category' => $category]);
    }
    public function category($category1){
        $data = DB::table('article')->where('category', $category1)->get();
        $category = DB::table('article')->select('category')->groupBy('category')->get();
        return View::make('Article')->with(['all' => $data, 'category' => $category, 'name' => $category1]);
    }
    public function read($id){
        $data = DB::table('article')->where('id_article', $id)->get();
        foreach($data as $detail){
            $detailCategory = $detail->category;
            $detailId = $detail->id_article;
            $detailView = $detail->view;
        }
        DB::table('article')->where('id_article', $id)->update(['view' => $detailView+1]);
        $related = DB::table('article')->where('category', $detailCategory)->where('id_article', '!=', $detailId)->limit(5)->offset(0)->get();
        $popular = DB::table('article')->orderBy('view', 'desc')->limit(5)->offset(0)->get();
        $comments = DB::table('comments')->where('id_article', $detailId)->orderBy('tanggal', 'desc')->get();
        $category = DB::table('article')->select('category')->groupBy('category')->get();
        return View::make('Read')->with(['all' => $data, 'related' => $related, 'popular' => $popular, 'comments' => $comments, 'id' => $detailId,'category' => $category]);
    }
    public function comment(){
        $data = array(
            'nama' => Input::get('nama'),
            'comment' => Input::get('comment'),
            'tanggal' => date('Y-m-d H:m:s'),
            'id_article' => Input::get('id')
        );
        DB::table('comments')->insert($data);
        return Redirect::to('/article/read/'.Input::get('id'))->with(['message' => 'Comment has submitted.']);
    }
}