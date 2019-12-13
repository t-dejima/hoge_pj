{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '編集')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
  <form action="/profiles/{{$profile->id}}" method="post">
    {{ csrf_field() }}
    <div>
      <label for="article_id">article_id</label>
      <input type="text" name="article_id"   placeholder="記事のタイトルを入れる" value="{{$profile->article_id}}">
    </div>
    <div>
      <label for="etc">etc</label>
      <textarea name="etc" rows="8" cols="80"  placeholder="記事の内容を入れる">{{$profile->etc}}</textarea>
    </div>
    <div>
      <input type="hidden" name="_method" value="patch">
      <input type="submit" value="更新">
    </div>
  </form>
  

   
@endsection
