@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" id="filter">
			<a href="#" v-for="cat in categories" v-on:click.prevent="getOptions(cat.id)">@{{cat.title_en}}</a>
            <select id="size" v-model="size" v-if="sizes.length > 0" v-on:change="getMaterials">
				<option v-bind:value="size.id" v-for="size in sizes">@{{size.title_en}}</option>
			</select>
			<select id="material" v-model="material" v-if="materials.length > 0">
				<option v-bind:value="material.id" v-for="material in materials">@{{material.title_en}}</option>
			</select>
			<select id="type" v-model="type" v-if="types.length > 0">
				<option v-bind:value="type.id" v-for="type in types">@{{type.title_en}}</option>
			</select>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.1.2/vue-resource.min.js"></script>
<script>

    Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;

    var Filter = new Vue({
	el: '#filter',
	data: {
		categories: [],
	    sizes: [],
	    materials: [],
	    types: [],
	    colors: [],
	    bodies: [],
	    borders: [],

		category: undefined,

		size: undefined,
		material: undefined,
		type: undefined,
		body: undefined,
		border: undefined
	},
	ready: function() {
		var self = this;

		this.$http.get('/filter/categories').then(function (response) {

			self.$set('categories', response.data);

        });
	},
	methods: {
		getOptions: function(cat_id) {
			var self = this;

			this.$set('sizes', []);
			this.$set('size', undefined);
			this.$set('materials', []);
			this.$set('material', undefined);

			this.category = cat_id;

			this.$http.get('/filter/sizes?cat_id=' + self.category).then(function (response) {
				console.log(response.data);
				self.$set('sizes', response.data);
				if(response.data.length > 0) {
					self.$set('size', response.data[0].id);
					self.getMaterials();
				}

			});
		},
		getMaterials: function() {
			var self = this;

			this.$http.get('/filter/materials?cat_id=' + self.category + '&size_id='+self.size).then(function (response) {
				console.log(response.data);
				self.$set('materials', response.data);
				if(response.data.length > 0) {
					self.$set('material', response.data[0].id);
					self.getTypes();
				}

			});
		}
	}
    });
</script>
@endsection
