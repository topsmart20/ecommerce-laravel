@extends('layout')

@section('title', 'Shopping Cart')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="{{ route('home') }}">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Wishlist</span>
        </div>
    </div> <!-- end breadcrumbs -->

    @if (session()->has('success-message'))
        <div class="success-msg">{{ session()->get('success-message') }}</div>
    @endif

    <div class="cart-section container">
        <div>
            @if (count($errors))
                <ul class="error-msg">
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @if (Cart::instance('wishlist')->count())
                <h2>{{ Cart::instance('wishlist')->count() }} item(s) in Wishlist</h2>

                <div class="cart-table">
                    @foreach (Cart::instance('wishlist')->content() as $item)
                        <div class="cart-table-row">
                            <div class="cart-table-row-left wishlist-table-row-left">
                                <a href="{{ route('shop.show', $item->model->id) }}">
                                    <img src="/img/macbook-pro.png" alt="item" class="cart-table-img">
                                </a>
                                <div class="cart-item-details">
                                    <div class="cart-table-item">
                                        <a href="{{ route('shop.show', $item->model->id) }}">{{ $item->model->name }}</a>
                                    </div>
                                    <div class="cart-table-description">{{ $item->model->details }}</div>
                                </div>
                            </div>
                            <div class="cart-table-row-right wishlist-table-row-right">
                                <div>{{ $item->model->presentPrice() }}</div>

                                <div class="cart-table-actions">
                                    {{-- Remove from wishlist from --}}
                                    <form class="heart-item-form" action="{{ route('wishlist.destroy', $item->rowId) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="button-icon" title="Remove from Wishlist">
                                            <i class="fas fa-heart solid-heart"></i>
                                        </button>
                                    </form>

                                    {{-- Move to Cart form --}}
                                    <form class="move-to-cart-form" action="{{ route('cart.store') }}" method="post">
                                        @csrf

                                        <input type="hidden" name="row_id" value="{{ $item->rowId }}">
                                        <input type="hidden" name="id" value="{{ $item->model->id }}">
                                        <input type="hidden" name="name" value="{{ $item->model->name }}">
                                        <input type="hidden" name="price" value="{{ $item->model->price }}">
                                        <button class="button-blue" type="submit">Move to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end cart-table-row -->
                    @endforeach
                </div> <!-- end cart-table -->
            @else 
                <div class="empty">No items in your Wishlist!</div>
                <div class="spacer"></div>
                <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                <div class="spacer"></div>
            @endif
        </div>

    </div> <!-- end cart-section -->

    @include('partials.might-like')


@endsection