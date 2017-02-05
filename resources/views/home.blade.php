@extends('layouts.master')

@section('title')
    Home
@endsection

@section('content')

@include('includes.slider')
<main class="main-content">
    <header class="main-content__header">
	<div class="content-header__current_wrap">
	    <p class="content-header__current">@{{categoryTitle}}</p>
	</div>
	<div class="content-header__select_wrap">
	    <ul class="content__select_lists">
		<li class="select__list_head" v-if="sizes.length > 0">Select a size: 
		    <select class="select__list_selects"v-model="size" v-on:change="getMaterials">
			<option class="list__selects_option" v-bind:value="size.id" v-for="size in sizes">@{{size.title}}</option>
		    </select>
		</li>
		<li class="select__list_head" v-if="materials.length > 0">Select a material:
		    <select class="select__list_selects" v-model="material" v-on:change="getTypes">
			<option class="form__input_option" v-bind:value="material.id" v-for="material in materials">@{{material.title}}</option>
		    </select>
		</li>
		<li class="select__list_head" v-if="types.length > 0">Select a type:
		    <select class="select__list_selects" v-model="type" v-on:change="getColors">
			<option class="form__input_option" v-bind:value="type.id" v-for="type in types">@{{type.title}}</option>
		    </select>
		</li>
	    </ul>
	</div>
    </header>

    <div class="main-content__item_wrap" v-show="show" style="display: none">
	<div class="content__item_images">
	    <div class="content__images_general">
		<img class="content__general_image" src="/@{{product.image_main}}" v-bind:alt="product.title">
	    </div>
	    <ul class="content__images_list">
		<li class="content__list_image" v-if="product.image_1 != ''">
		    <img class="content__images_image" src="/@{{product.image_1}}" v-bind:alt="product.title">
		</li>
		<li class="content__list_image" v-if="product.image_2 != ''">
		    <img class="content__images_image" src="/@{{product.image_2}}" v-bind:alt="product.title">
		</li>
		<li class="content__list_image" v-if="product.image_3 != ''">
		    <img class="content__images_image" src="/@{{product.image_3}}" v-bind:alt="product.title">
		</li>
		<li class="content__list_image" v-if="product.image_4 != ''">
		    <img class="content__images_image" src="/@{{product.image_4}}" v-bind:alt="product.title">
		</li>
		<li class="content__list_image" v-if="product.image_5 != ''">
		    <img class="content__images_image" src="/@{{product.image_5}}" v-bind:alt="product.title">
		</li>
		<li class="content__list_image" v-if="product.image_6 != ''">
		    <img class="content__images_image" src="/@{{product.image_6}}" v-bind:alt="product.title">
		</li>
	    </ul>
	</div>

	<div class="content__item_info">
	    <h3 class="item__info_title">@{{product.title}}</h3>
	    <p class="item__info_text">@{{product.description}}</p>
	    <div class="item__info_social">
		<ul class="info__social_list">
		    <li class="info__social_icon icon_s_g"></li>
		    <li class="info__social_icon icon_fb"></li>
		    <li class="info__social_icon icon_s_youtube"></li>
		    <li class="info__social_icon icon_s_insta"></li>
		</ul>
	    </div>

	    <div class="item__info_price" v-if="product.price_new != undefined">
		<p class="info__price_old" v-if="product.price_new"><s>$@{{product.price}}</s></p>
		<p class="info__price_current">$@{{product.price_new}}</p>
	    </div>
	    
	    <div class="item__info_price" v-if="product.price_new == undefined">
		<p class="info__price_current">$@{{product.price}}</p>
	    </div>

	    <div class="content__item_select">
		<div class="item__select_color">
		    <p class="select__color_text">Select a color</p>
		    <ul class="select__color_lists">
			<li class="select__color_list" v-for="item in colors" v-bind:class="{ active: color == item.id}" v-on:click="getBodies(item.id)">
			    <div v-if="item.color != ''" v-bind:style="{ background: item.color}"></div>
			    <div v-if="item.color == '' && item.image != ''" v-bind:style="{ backgroundImage: 'url(/' + item.image + ')'}"></div>
			    <div v-if="item.color == '' && item.image == ''" style="background: linear-gradient(-45deg, #ddd 50%, #333 50%)"></div>
			</li>
		    </ul>
		</div>

		<div class="item__select_type">
		    <ul class="select__type_lists">
			<li class="select__type_list" v-for="body in bodies">
			    <label v-on:click="getBorders(body.id)">@{{body.title}}</label>
			</li>
		    </ul>
		</div>
		
		<div class="borders">
		    <div class="border" v-for="item in borders" v-bind:class="{ active: border == item.id}" v-on:click="getProduct(item.id)">
			<div v-if="item.color != ''" v-bind:style="{ background: item.color}"></div>
			<div v-else style="background: linear-gradient(-45deg, #ddd 50%, #333 50%)"></div>
		    </div>
		</div>

		<div class="item__add-cart">
		    <div class="item__add-cart_wrap">
			<a href="#0" class="item__add-cart_minus" v-on:click.prevent="quantityDec">-</a>
		    </div>
		    <div class="item__add-cart_wrap">
			<p class="item__add-cart_number">@{{quantity}}</p>
		    </div>
		    <a href="#0" class="item__add-cart_plus" v-on:click.prevent="quantityInc">+</a>
		    <a href="#0" class="item__add-cart_btn" v-on:click="addToCart">Add to Cart</a>
		</div>
	    </div>

	</div>

	<div class="item__other-products_wrap">

	    <h3 class="item__other-products_title">Other products</h3>
	    <div class="other-products__item">
		<h3 class="other-products__item_title">Python MacBook</h3>
		<a href="#0" class="other-products__item_link">Select</a>
		<p class="other-products__item_price">From $150</p>
	    </div>
	    <div class="other-products__item">
		<h3 class="other-products__item_title">Python Iphone 4S</h3>
		<a href="#0" class="other-products__item_link">Select</a>
		<p class="other-products__item_price">From $50</p>
	    </div>
	    <div class="other-products__item">
		<h3 class="other-products__item_title">Python Iwatch</h3>
		<a href="#0" class="other-products__item_link">Select</a>
		<p class="other-products__item_price">From $20</p>
	    </div>
	</div>
    </div>
</main>
<style>
    .select__color_list {
	border-radius: 50%;
	overflow: hidden;
	margin-right: 4px;
    }
    .select__color_list div {
	width: 100%;
	height: 100%;
    }
    .select__color_list.active {
	box-shadow: 0 0 10px grey;
    }
    .borders .border {
	display: inline-block;
	width: 30px;
	height: 30px;
	box-shadow: 0px 0px 15px grey;
    }
    .borders .border.active {
	box-shadow: 0px 0px 15px brown;
	border-radius: 5px;
    }
    .borders .border div {
	width: 100%;
	height: 100%;
    }
</style>
@endsection