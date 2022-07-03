@extends('app')

@section('title', $user->name . 'のフォロワー')

@section('content')
@include('nav')
<div class="container">
  @include('users.user')
  @foreach($followers as $person)
  @include('users.person')
  @endforeach
</div>
@endsection