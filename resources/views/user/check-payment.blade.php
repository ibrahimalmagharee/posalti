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

                @if (Session::has('success'))
                    <div class="alert alert-primary text-center">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif

                <div class="mb-3">
                    <button class="btn btn-primary"><a href="{{route('index')}}" style="color: white">{{__('content.Back to home')}}</a></button>
                </div>
            </div>
        </div>
    @include('landing.footer')
@endsection

@section('script')
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
