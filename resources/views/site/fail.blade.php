@extends('site.master')

@section('title', 'Failed Process | ' . config('app.name'))


@section('content')


    <div class="page-wrapper">
        <div class="cart shopping">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="block">
                           <div class="alert alert-danger">
                            <p>Payment process faild</p>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
