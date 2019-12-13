{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '記事詳細')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
  @empty($variable)
@else
 {{$article->profile->article_id}}
@endempty
   
     @empty($variable)
@else
{{$article->profile->etc}}
@endempty
   {{$article->title}}
   {{$article->body}}
  
    {{--<p>{{$article->profile->article_id}}</p>article_id
      <p>{{$article->profile->etc}}</p>etc
    <br><br>--}}
    
    
    <a href="/articles/{{$article->id}}/edit">編集する</a>
    <form action="/articles/{{$article->id}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="delete">
      <input type="submit" name="" value="削除する">
    </form>
    <a href="/articles">一覧に戻る</a>
  
   
@endsection