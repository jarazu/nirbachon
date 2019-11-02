@extends('layouts.app')

@section('content')

    <div class="row">
         <!-- <div class="col-md-12 text-center" >
            <img class="img-responsive img-center"  src="{{URL::to('img/logo.png')}}" alt="">
        </div>  -->
        <div class="col-md-12">
            <img src="{{URL::to('img/Rbanner-02.jpg')}}" class="img-responsive img-center" alt="">
        </div>
    </div>





@endsection

@section('style')
<style>
    .img-center {margin:0 auto;}
</style>
    @endsection
