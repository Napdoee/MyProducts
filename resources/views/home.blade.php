@extends('templates.guest')
@section('title', 'Home')

@section('content')
<div class="row row-cards">
    <div class="card p-0">
      <!-- <div class="card-header">
        <h3 class="card-title">Carousel with captions</h3>
      </div> -->
      <div class="card-body p-0">
        <div id="carousel-captions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner ">
            @foreach($products as $row)
            <div class="carousel-item py-3 @if($loop->first) active @endif">
              <img class="d-block w-100" alt="{{ $row->name }}" src="{{ asset('storage/images/'.$row->image) }}" style="max-height: 70vh; object-fit: contain; object-position: top;">
              <div class="carousel-caption-background d-none d-md-block"></div>
              <div class="carousel-caption d-none d-md-block">
                <h3>{{ $row->name }}</h3>
                <a href="{{ route('product.details', $row->slug) }}" class="btn btn-outline-light">Show Detail</a>
              </div>
            </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carousel-captions" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carousel-captions" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </a>
        </div>
      </div>
    </div>
    <h1 class="display-6 fw-bolder">List Products</h1>
    @foreach($products as $row)
    @php 
        $discountInStatus = ($row->discount_id && $row->discount->active === 1);
        if($discountInStatus) {
            $discountText = (100/100 - $row->discount->discount_percent/100) * $row->price;
        }
    @endphp
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card">
          <!-- <div class="ribbon ribbon-top bg-azure">NEW</div> -->
          <!-- Photo -->
          <div class="img-responsive img-responsive-16x9 card-img-top" 
          style="background-image: url({{ asset('storage/images/'.$row->image) }}); object-fit:contain;"></div>
          <!-- <img class="card-img img-thumbnail" src="{{ asset('storage/images/'.$row->image) }}" /> -->
          <div class="card-body">
            @if($discountInStatus)
                <div class="ribbon bg-red">{{ $row->discount->description." -".$row->discount->discount_percent."%" }}</div>
            @endif
            <p class="text-muted my-1">{{ $row->category->category_name }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title my-3">{{ Str::of($row->name)->limit(15) }}</h3>
                <p class="card-text">Rp. {{ number_format($discountInStatus ? $discountText : $row->price) }}</p>
            </div>
            <a href="{{ route('product.details', $row->slug) }}" class="btn btn-primary w-100 mb-2">Show Detail</a>
            <button class="btn btn-outline-primary w-100">Add to Cart</button>
          </div>
          <!-- <div class="card-footer">
            <button class="btn btn-primary w-100 mb-2">Show Detail</button>
            <button class="btn btn-outline-primary w-100">Add to Cart</button>
          </div> -->
        </div>
     </div>
     @endforeach
</div>
@endSection