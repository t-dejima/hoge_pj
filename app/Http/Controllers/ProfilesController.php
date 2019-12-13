<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Profile;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $profiles = Profile::all();
      return view('profiles.index', ['profiles' => $profiles]);
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // モデルからインスタンスを生成
  $profile = new Profile;
  // $requestにformからのデータが格納されているので、以下のようにそれぞれ代入する
  $profile->article_id = $request->article_id;
  $profile->etc = $request->etc;
  // 保存
  $profile->save();
  // 保存後 一覧ページへリダイレクト
  return redirect('/profiles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 引数で受け取った$idを元にfindでレコードを取得
  $profile = Profile::find($id);
  // viewにデータを渡す
  return view('profiles.show', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$profile = Profile::find($id);
        //$profile = Profile::find($id);
        $profile = Article::find($id)->Profile;
  return view('profiles.edit', ['profile' => $profile]);
  logger($profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // idを元にレコードを検索して$articleに代入
  $profile = Profile::find($id);
  // editで編集されたデータを$articleにそれぞれ代入する
  $profile->article_id = $request->article_id;
  $profile->etc = $request->etc;
  // 保存
  $profile->save();
  // 詳細ページへリダイレクト
  return redirect("/profiles/".$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
