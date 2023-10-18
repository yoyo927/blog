<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware(middleware:'auth')->except(methods:'index');
    }

    public function index(){
        //撈出文章資料
        $articles = Article::paginate(3);
    
        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    public function create(){
        return view(view:'articles.create');
    }
    public function store(Request $request){
        $content = $request->validate([
            'title' => 'required',//必填
            'content' => 'required|min:10'//必填，最少10個字
        ]);
        //要先登入才能發表，因此需要撈使用者資料
        auth()->user()->articles()->create($content);

        return redirect()->route(route:'root')->with('notice','文章新增成功!');
    }

    public function edit($id){
        // 此處要透過ID撈文章，再return view
        $article = auth()->user()->articles->find($id);
        return view('articles.edit',['article' => $article]);
    }

    public function update(Request $request, $id){
        // TODO
        $article = auth()->user()->articles->find($id);
        // TODO驗證是否符合規則
        $content = $request->validate([
            'title' =>'required',//必填
            'content' =>'required|min:10'//必填，最少10個字
        ]);

        $article->update($content);

        return redirect()->route(route:'root')->with('notice','文章修改成功!');
    }
}
