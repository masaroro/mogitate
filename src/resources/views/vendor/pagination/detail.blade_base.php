@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
    <div class="product__content">
        <div class="product__content-title">
            <a href="/products">商品一覧</a>
            <span>>{{$product->name}}</span>
        </div>
        <form class="product__form" action="">
            @csrf
            <div class="product__item">
                <div class="product__item-image">
                    <img src="/storage/images/{{ $product->image }}">
                    <div class="product__item-input">
                        <label for="file_photo">
                            <!-- ファイルを選択 -->
                            <input type="file" name="file" id="file_photo" value="{{ old('file') }}"/>
                        </label>
                        <span>
                            <!-- ここに表示 -->
                        </span>
                    </div>
                </div>
                <div class="product__detail">
                    <div class="product__name">
                        <div class="product__item-label">
                            商品名
                        </div>
                        <input type="text" placeholder="商品名を入力" value="{{$product->name}}">
                    </div>
                    <div class="product__price">
                        <div class="product__item-label">
                            値段
                        </div>
                        <input type="number" placeholder="値段を入力" value="{{$product->price}}">
                    </div>
                    <div class="product__season">
                        <div  class="product__item-label">
                            季節
                        </div>
                        <fieldset class="product__season-item">
                            <label class="product__season-item-label">
                                <input type="checkbox" name="seasons[]" value="spring">
                                <span></span>
                                    春
                            </label>
                            <label class="product__season-item-label">
                                <input type="checkbox" name="seasons[]" value="summer">
                                <span></span>
                                    夏
                            </label>
                            <label class="product__season-item-label">
                                <input type="checkbox" name="seasons[]" value="autumn">
                                <span></span>
                                    秋
                            </label>
                            <label class="product__season-item-label">
                                <input type="checkbox" name="seasons[]" value="winter">
                                <span></span>
                                    冬
                            </label>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="product__text">
                <div class="product__item-label">
                    商品説明
                </div>
                <div class="product__textarea">
                    <textarea name="description" placeholder="商品の説明を記入">{{$product->description}}</textarea>
                </div>
            </div>
        </form>
    </div>
@endsection