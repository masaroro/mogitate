@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
    <div class="product__content">
        <div class="product__heading">
            @if(!empty(request('keyword')))
            <h2 class="product__heading-title">
                "{{request('keyword')}}"の商品一覧
            </h2>
            @else
            <h2 class="product__heading-title">
                商品一覧
            </h2>
            <div class="product__heading-button">
                <a href="/products/register">
                    ＋商品を追加
                </a>
            </div>
            @endif
        </div>
        <div class="product__item">
            <form class="product__search-form" action="/products/search" method="post">
                @csrf
                <input class="product__search-input" type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
                <div class="product__search-button">
                    <button type="submit">
                        検索
                    </button>
                </div>
                <div class="product__search-text">
                    価格順で表示
                </div>
                <select class="product__search-select" name="sort">
                    <option value="" {{ old('sort', '') == '' ? 'selected' : '' }}>価格で並べ替え</option>
                    <option value="high" {{ old('sort')=="high" ? 'selected' : '' }}>高い順に表示</option>
                    <option value="low" {{ old('sort')=="low" ? 'selected' : '' }}>低い順に表示</option>
                </select>
                <div class="">
                    <!-- あとで追加予定 -->
                </div>
            </form>
            <div class="product__item-block">
                <div class="product__item-list">
                    @foreach ($products as $product)
                    <div class="product__item-card">
                        <a href="/products/{{ $product->id }}">
                            <div class="product__item-image">
                                <img src="/storage/images/{{ $product->image }}" alt="">
                            </div>
                            <div class="product__item-tag">
                                <div class="product__item-name">
                                    {{ $product->name }}
                                </div>
                                <div class="product__item-price">
                                    <span>￥</span>{{ $product->price }}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="product__pagination">
                    {{ $products->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </div>
@endsection('content')
