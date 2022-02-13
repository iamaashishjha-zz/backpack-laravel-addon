@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="card-footer">
                    <p>Created at : {{ $date }} </p>
                </div>
            </div>
            <br>

            @php
            $locale = App::currentLocale();
            // dd($locale);
            @endphp
            <div class="card">
                <div class="card-header">
                    <li>{{ __('messages.language') }}</li>
                    </ul>
                </div>

                @php
                $lang = request()->get('lang');
                App::setLocale($lang);
                @endphp
                <div class="card-body">

                    {{-- <div class="box-switch float-right mr-4">
                        <span class="en">EN</span>
                        <label class="switch">
                            <input class="change-locale" type="checkbox" value="{{ ($lang == 'np') ? 'np':'en' }}" {{ ($lang == 'np') ? 'checked':'' }}>
                    <div class="slider round" style="color:black;"></div>
                    </label>
                    <span class="np">NP</span>
                </div> --}}

                {{-- <select name="lang" id="lang" onchange="submit()">
                    <option value="en">English</option>
                    <option value="np">Nepali</option>
                </select> --}}
                @include('partials.lanSwitcher')


                {{-- <form action="{{ route('language') }}" method="post">
                @csrf
                @method('PUT')
                <select name="lang" id="lang" onchange="submit()">
                    <option value="en">English</option>
                    <option value="np">Nepali</option>
                </select>
                </form> --}}


            </div>
            <div class="card-footer">
                {{-- {{ $date_message }} --}}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
