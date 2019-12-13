@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                  
                      <ul>
    @can('system-only') {{-- システム管理者権限のみに表示される --}}
      <li><a href="">システム管理者機能1</a></li>
    @elsecan('admin-higher')　{{-- 管理者権限以上に表示される --}}
      <li><a href="">管理者機能3</a></li>
      <li><a href="">管理者機能3</a></li>
    @elsecan('user-higher') {{-- 一般権限以上に表示される --}}
      <li><a href="">一般機能4</a></li>
      <li><a href="">一般機能5</a></li>
      <li><a href="">一般機能6</a></li>
      <li><a href="">一般機能7</a></li>
    @endcan
  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
