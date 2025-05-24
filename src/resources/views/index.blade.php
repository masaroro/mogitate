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
            <form class="product__search-form" action="/products/search" method="get">
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
                <select class="product__search-select" name="sort" required>
                    <option value="">価格で並べ替え</option>
                    <option value="high" {{ request('sort')=="high" ? 'selected' : '' }}>高い順に表示</option>
                    <option value="low" {{ request('sort')=="low" ? 'selected' : '' }}>低い順に表示</option>
                </select>
                @if(!empty(request('sort')))
                <div class="product__sort-message">
                    @if(request('sort')== 'high')
                        <p>高い順に表示</p>
                        <a href="/products" class="product__sort-reset">×</a>
                    @elseif(request('sort')== 'low')
                        <p>低い順に表示</p>
                        <a href="/products" class="product__sort-reset">×</a>
                    @endif
                </div>
                @endif
            </form>
            <div class="product__item-block">
                <div class="product__item-list">
                    @foreach ($products as $product)
                    <div class="product__item-card">
                        <a href="/products/{{ $product->id }}?_from={{ urlencode(request()->fullUrl()) }}">
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
                    {{ $products->appends(request()->query())->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </div>
@endsection('content')
