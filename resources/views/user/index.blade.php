@extends('app')
@section('content')
    <div class="coming-soon-section overlay-shape">
        <div class="container">
            <div class="coming-soon-content">
                <div class="coming-soon-counter">
                    <div class="new-counter new-counter-2">
                        <p class="day1"></p>
                        <p class="hr1"></p>
                        <p class="min1"></p>
                        <p class="sec1"></p>
                    </div>
                    <div>
                        <h3 style="font-weight: bold; color: white">{{\Auth::user()->name}} أهلا وسهلا بك في بوصلتي</h3>
                    </div>
                    <div class="coming-soon-details">
                        <h2>قريباً</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
