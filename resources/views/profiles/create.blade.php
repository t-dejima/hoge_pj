{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '新規作成')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
  <form action="/profiles" method="post">
    {{-- 以下を入れないとエラーになる --}}
    {{ csrf_field() }}
    <div>
      <label for="article_id">articles_id</label>
       <input type="text" name="article_id" placeholder="id">
    </div>
    <div>
      <label for="etc">etc</label>
      <input type="text" name="etc" placeholder="etc">
    </div>
    
    <div>
      <input type="submit" value="送信">
    </div>
  </form>
@endsection