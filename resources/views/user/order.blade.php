@extends('templates.guest')
@section('title','Your Orders')

@section('content')
<div class="row row-cards">
    @if($orders->isEmpty())
        <div class="empty">
            <p class="empty-title">You don't have any orders at this time</p>
            <p class="empty-subtitle text-muted">
              If you have any orders, it will display here
            </p>
            <div class="empty-action">
                <a href="{{ route('product') }}" class="btn btn-primary">
                Going to products
                </a>
            </div>
        </div>
    @else
    <div class="d-flex gap-3">
        @foreach($fetchStatus as $key => $row)
        <div class="col-4">
            <span class="badge @if($row->status === 'pending') bg-azure-lt
            @elseif($row->status === 'progress') bg-orange-lt
            @else bg-teal-lt @endif h3">{{ Str::upper($row->status) }}</span>
            <div class="row row-cards">
                @foreach($orders as $order)
                    @continue($order->status !== $row->status)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                              <div class="card-title">Order #{{ $order->id }}
                                <small class="text-muted d-block">{{ $order->order_date }}</small>
                              </div>
                              <div class="card-actions">
                                <span class="ms-2 badge @if($order->status === 'pending') bg-azure-lt
                                @elseif($order->status === 'progress') bg-orange-lt
                                @else bg-teal-lt @endif p-2">
                                    {{ Str::upper($order->status) }}
                                </span>
                              </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="card-text text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                               <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                               <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            </svg> {{ $order->name }}
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="card-text text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                               <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                               <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                                            </svg> {{ $order->address }} 
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                  <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-1">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index + 1 }}" aria-expanded="true">
                                        Summary Cart
                                      </button>
                                    </h2>
                                    <div id="collapse-{{ $loop->index + 1 }}" class="accordion-collapse collapse">
                                      <div class="accordion-body pt-0">
                                        <table class="table table-transparent table-responsive">
                                            <tbody>
                                                @foreach($order->items as $item)
                                                <tr>
                                                    <td>
                                                        <a class="strong mb-1 text-primary" href="#">{{ "(".$item->quantity."x) ".$item->product->name}}</a>
                                                    </td>
                                                    <td class="text-end">${{ number_format($item->sub_price) }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="font-weight-bold text-end">DUE TOTAL</td>
                                                    <td class="font-weight-bold text-end">${{ number_format($order->total_price) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection