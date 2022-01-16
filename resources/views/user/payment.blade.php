@extends('app')

@section('content')
    @include('landing.header')
        <div class="payment-section overlay-shape pt-150">
            <div class="container text-center">
                @if ($errors->any())
                    <div class="alert alert-danger" id="Error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div style="margin-bottom: 4%; box-shadow: 0 8px 30px rgb(0 0 0 / 5%) !important; padding: 5%">
                    @if (!Auth::user()->last_financial()->status)
                        <div class="welcome-auth-user">
                            {{\Auth::user()->name}}
                            {{__('content.Welcome, please pay the amount by clicking on the button')}}

                            @if (Lang::locale() == 'ar')
                                <p class="mt-3">{{ \Auth::user()->last_financial()->title->title_ar }}</p>
                                @else
                                <p class="mt-3">{{ \Auth::user()->last_financial()->title->title_en }}</p>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('payment.store') }}">
                            @csrf
                            <button class="btn btn-primary mb-3 mt-3 w-50" id="btn_checkout_payment">{{__('content.Checkout')}} ({{$amount}} QAR)</button>
                        </form>
                        @else
                        <div class="text-danger">Error</div>
                    @endif
                </div>
            </div>
        </div>
    @include('landing.footer')
@endsection

@section('script')
@endsection
