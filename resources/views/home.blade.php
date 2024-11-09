@extends('customer.dashboard')

@section('konten')
<div class="home-slider">
    <div class="slider">
        <div class="slide active">
            <img src="img/menu1.png" alt="Menu 1" />
        </div>
        <div class="slide">
            <img src="img/menu2.png" alt="Menu 2" />
        </div>
    </div>
    <div class="slider-controls">
        <button id="prev-slide" class="prev" aria-label="Previous Slide">&#10094;</button>
        <button id="next-slide" class="next" aria-label="Next Slide">&#10095;</button>
    </div>
</div>
@endsection
