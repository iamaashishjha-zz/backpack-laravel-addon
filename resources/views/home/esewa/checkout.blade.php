@extends('default')

@section('content')
<div class="title m-b-md">
    eSewa Checkout
</div>

<div class="links">

    @if($message = session('message'))
    <p>
        {{ $message }}
    </p>
    @endif

    <p>
        <strong>QuietComfort® 25 Acoustic Noise Cancelling® headphones — Apple devices</strong>
    </p>

    <br>

    <form method="POST" action="{{ route('checkout.payment.esewa.process', $order->id) }}">

        @csrf

        <button class="btn btn-primary" type="submit">
            ${{ $order->amount }} Pay with eSewa
        </button>
    </form>
</div>
@stop
