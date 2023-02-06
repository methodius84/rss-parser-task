<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getArticles(Request $request){
        $articles = Article::paginate(10, ['*']);
        $articles->appends(['sort' => 'publish_date']);
        return response()->json($articles)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
