@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- @FIXME ユーザーデータの存在チェック -->
            変数$userが存在するかどうか→empty($user)
            <div class="card">
                <div class="card-header">ユーザ一覧</div>

                <!-- @FIXME ユーザーデータを表示 -->
                  @foreach($my_user as $user)
                    <div class="card-body">
                        <!-- @FIXME ユーザー名を表示 -->
                        {{ $user->name }}
                        <div style="float:right">
                              やりたいことは、フォローしているかどうかでユーザーを判別すること
                              配列に値があるかどうかで条件分岐→ではどういう配列にすればいいのか。
                              in_array(値, 配列)
                              @if
                                <!-- @FIXME 未フォロー時の表示 -->
                                {!! Form::open(['id' => 'formTweet', 'url' => 'users/follow/', 'enctype' => 'multipart/form-data']) !!}
                                    {{Form::hidden('followId', $user->id, ['id' => 'followId'])}}
                                    <button type="submit" class="btn btn-light">
                                        {{ __('フォローする') }}
                                    </button>
                                {!! Form::close() !!}

                              @elseif
                                <!-- @FIXME フォロー中の表示 -->
                                フォロー中
                              @endif
                        </div>
                    </div>

                    <hr>
                  @endforeach
                <!-- @FIXME ページングを表示 -->

            </div>
        </div>
    </div>
</div>
@endsection
