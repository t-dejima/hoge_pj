{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '記事一覧')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
  <div>
    <a href="/profiles/create">新規作成</a>
  </div>
  @foreach ($profiles as $profile)
    <h4>{{$profile->article_id}}</h4>
    <h4>{{$profile->etc}}</h4>
 <hr>
  @endforeach
@endsection