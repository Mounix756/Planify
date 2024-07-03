@extends('collaborators.app.appHome')

@section('title')
Accueil
@endsection

@section('css')

@endsection


@section('content')
<div class="content">
    <div class="pb-5">
      <div class="row g-4">
        <div class="col-12 col-xxl-6">
          <div class="row align-items-center g-4">
            <img width="100px" src="{{asset('logo/logo.png')}}" alt="">
          </div>
        </div>
      </div>
    </div>
    @include('collaborators.partial.footer')
  </div>
@endsection


@section('js')

@endsection
