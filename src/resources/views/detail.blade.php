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
        <form class="product__form" action="/products/{{$product->id}}" method="post">
            @csrf
            <div class="product__item">
                <div class="product__item-image">
                    <img src="/storage/images/{{ $product->image }}">
                    <div class="product__item-input">
                        <label class="product__item-file" for="file_photo">
                            <input type="file" name="file" id="file_photo" accept=".jpg, .jpeg, .png"/>
                            ファイルを選択
                        </label>
                        <span>{{$product->image}}</span>
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
                            @foreach ($seasons as $season)
                            <label class="product__season-item-label">
                                <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ $product->seasons->contains('id', $season->id) ? 'checked' : ''}}>
                                <span></span>
                                    {{ $season->name }}
                            </label>
                            @endforeach
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
            <div class="product__button-block">
                <div class="product__button-inner">
                    <input class="product__button-back" type="submit" value="戻る" name="back">
                    <input class="product__button-save" type="submit" value="変更を保存" name="register">
                </div>
                <input class="product__button-delete" type="submit" value="削除" name="delete">
            </div>
            <input type="hidden" name="id" value="{{ $product->id }}">
        </form>
    </div>
@endsection