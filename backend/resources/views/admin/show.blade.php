@extends('layouts.app')

@section('content')
    @if ($user) 
       <div>{{$user->name}}</div>   
       <div>{{$user->self_introduce}}</div>   
       @if ($user->payment)
           <div>課金中</div>      
       @else
           <div>課金していません</div> 
       @endif   
    @else
        <div>ユーザーが存在しません<div>
    @endif
@endsection