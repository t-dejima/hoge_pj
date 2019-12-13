{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', '記事一覧')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')

<p>{{config('const.BASE_URL')}}</p>
{{config('const.DIRECTRY_NAME.1')}}
{{config('const.APP_SETTING.user')}}
 <table>
    <tr>
      <th>性別</th>
      <td>
        <ul>
          @foreach (config('const.Users.GENDER_LIST') as $key => $value)
            <li>{!! Form::radio('gender', $value) !!}{{ __("values.gender_{$key}") }}</li>
          @endforeach
        </ul>
      </td>
    </tr>
  </table>
{{Form::select('age', config('const.DIRECTRY_NAME'))}}
  <div>
    <a href="/articles/create">新規作成</a>
  </div>

   <div class="container">
       <div class="row">
            <div class="col-md-3">   
                <form class="form-inline">
                    <div class="form-group">
                    <input type="text" name="keyword"
                    placeholder="titleを入力">
                    <input type="submit" value="検索" >
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">title</th>
      <th scope="col">body</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
           @foreach ($articles as $article)
    <tr>
      <th scope="row">{{$article->id}}</th>
      <td>{{$article->title}}</td>
      <td>{{$article->body}}</td>
      <td><a href="/articles/{{$article->id}}">詳細を表示</a></td>
       <td><a href="/articles/{{$article->id}}/edit">編集する</a></td>
  
      <td>  <form action="/articles/delete/{{$article->id}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="delete">
      <input type="submit" name="" value="削除する"></td>
    </tr>
     @endforeach
  </tbody>
</table>
   {{ $articles->links() }}
    <p>CSVファイルを選択してください</p>
<form role="form" method="post" action="import_csv" enctype="multipart/form-data">
{{ csrf_field() }}
    <input type="file" name="csv_file">
    <button type="submit" class="">インポート</button>
</form>


a

        <a href="/members/create">メンバー追加</a>
        <h4>未削除</h4>
        <table>
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>ポジション</th>
                    <th>身長</th>
                    <th>アクション</th>
                </tr>
                @forelse ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->body }}</td>
                      
                        <td>
                            <a href="/articles/destroy/{{ $article->id}}">削除</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <h4>削除済</h4>
         {{-- <table>
          <tbody>
                @forelse ($deleted as $delete)
                    <tr>
                        <td>{{ $delete->id }}</td>
                        <td>{{ $delete->title }}</td>
                        <td>{{ $delete->body }}</td>
                      
                        <td>
                            <a href="/articles/restore/{{ $delete->id}}">復旧</a>
                            <a href="/articles/force-delete/{{ $delete->id}}">完全削除</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endforelse
            </tbody>
        </table>--}}
    



@endsection
