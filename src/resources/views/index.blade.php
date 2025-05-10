@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
    <div class="product__content">
        <div class="product__heading">
            <h2 class="product__heading-title">
                商品一覧
            </h2>
            <div class="product__heading-button">
                <a href="/products/register">
                    ＋商品を追加
                </a>
            </div>
        </div>
        <div class="product__item">
            <form class="product__search-form" action="/">
                @csrf
                <div class="product__search-input">
                    <input type="text" placeholder="商品名で検索" value="">
                </div>
                <div class="product__search-button">
                    <button class="" type="submit">
                        検索
                    </button>
                </div>
                <div class="product__search-text">
                    価格順で表示
                </div>
                <select class="product__search-select" name="">
                    <option value="">価格で並べ替え</option>
                    <option value="high">高い順に表示</option>
                    <option value="low">低い順に表示</option>
                </select>
                <div class="">
                    <!-- あとで追加予定 -->
                </div>
            </form>
            <!-- koko -->
            <div class="product__item-list">
                @foreach ($products as $product)
                <div class="product__item-card">
                    <div class="product__item-image">
                        <img src="{{ url($product->image) }}" alt="">
                    </div>
                    <div class="product__item-tag">
                        <div class="product__item-name">
                            {{ $product->name }}
                        </div>
                        <div class="product__item-price">
                            <span>￥</span>{{ $product->price }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="product__pagination">
                {{ $products->links() }}
            </div>
            <!-- koko -->
        </div>
    </div>
@endsection('content')
