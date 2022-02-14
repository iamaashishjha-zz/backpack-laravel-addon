@extends('layouts.app')

@section('content')

@php
// use App\Base\Helpers\GetNepaliServerDate;
$lang = App::getLocale();
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('messages.dashboard') }}
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('messages.login') }}
                </div>
                <div class="card-footer">
                    @if ($lang == 'en')
                    <p>Created at : {{ __('messages.user_created_at').$englishDate }} </p>
                    @elseif($lang == 'np')
                    <p> {{ $nepaliDate.__('messages.user_created_at') }} </p>
                    @else
                    <p>Created Date not Saved</p>
                    @endif
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection
