@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">ユーザー一覧</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <a class="chat_user_name text-decoration-none" href="{{route('admin.user.show',['user'=>$user->id])}}">     
                                <div>{{$user->name}}</div>
                            </a>
                            @if ($user->payment == true)
                                <div>現在課金中です</div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
