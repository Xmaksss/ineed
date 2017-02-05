@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" id="filter">
			<a href="#" v-for="cat in categories" v-on:click.prevent="getOptions(cat.id)">@{{cat.title}}</a>

            <select id="size" v-model="size" v-if="sizes.length > 0" v-on:change="getMaterials">
				<option v-bind:value="size.id" v-for="size in sizes">@{{size.title}}</option>
			</select>
			<select id="material" v-model="material" v-if="materials.length > 0" v-on:change="getTypes">
				<option v-bind:value="material.id" v-for="material in materials">@{{material.title}}</option>
			</select>
			<select id="type" v-model="type" v-if="types.length > 0" v-on:change="getColors">
				<option v-bind:value="type.id" v-for="type in types">@{{type.title}}</option>
			</select>

			<div class="colors">
				<div class="color" v-for="item in colors" v-bind:class="{ active: color == item.id}" v-on:click="getBodies(item.id)">
					<div v-if="item.color != ''" v-bind:style="{ background: item.color}"></div>
					<div v-if="item.color == '' && item.image != ''" v-bind:style="{ backgroundImage: 'url(/' + item.image + ')'}"></div>
					<div v-if="item.color == '' && item.image == ''" style="background: linear-gradient(-45deg, #ddd 50%, #333 50%)"></div>
				</div>
			</div>

			<a href="#" v-for="body in bodies" v-on:click.prevent="getBorders(body.id)">@{{body.title}}</a>

			<div class="borders">
				<div class="border" v-for="item in borders" v-bind:class="{ active: border == item.id}" v-on:click="getProduct(item.id)">
					<div v-if="item.color != ''" v-bind:style="{ background: item.color}"></div>
					<div v-else style="background: linear-gradient(-45deg, #ddd 50%, #333 50%)"></div>
				</div>
			</div>

        </div>
    </div>
</div>
<style>
	.colors .color {
		display: inline-block;
		width: 50px;
		height: 50px;
		box-shadow: 0px 0px 15px grey;
	}
	.colors .color.active {
		box-shadow: 0px 0px 15px brown;
		border-radius: 8px;
	}
	.colors .color div {
		width: 100%;
		height: 100%;
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.1.2/vue-resource.min.js"></script>
<script>

    Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;

    var Filter = new Vue({
	el: '#filter',
	data: {

		lang: '{{LaravelLocalization::getCurrentLocale()}}',
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

		this.$http.post('/api/filter/categories').then(function (response) {

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
			this.$set('types', []);
			this.$set('type', undefined);
			this.$set('colors', []);
			this.$set('color', undefined);
			this.$set('bodies', []);
			this.$set('body', undefined);
			this.$set('borders', []);
			this.$set('border', undefined);

			this.category = cat_id;
			var data = {
				cat_id: this.category
			}

			this.$http.post('/api/filter/sizes', data).then(function (response) {
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

			this.$set('materials', []);
			this.$set('material', undefined);
			this.$set('types', []);
			this.$set('type', undefined);
			this.$set('colors', []);
			this.$set('color', undefined);
			this.$set('bodies', []);
			this.$set('body', undefined);
			this.$set('borders', []);
			this.$set('border', undefined);

			var data = {
				cat_id: this.category,
				size_id: this.size
			}

			this.$http.post('/api/filter/materials', data).then(function (response) {
				console.log(response.data);
				self.$set('materials', response.data);
				if(response.data.length > 0) {
					self.$set('material', response.data[0].id);
					self.getTypes();
				}

			});
		},
		getTypes: function() {
			var self = this;

			this.$set('types', []);
			this.$set('type', undefined);
			this.$set('colors', []);
			this.$set('color', undefined);
			this.$set('bodies', []);
			this.$set('body', undefined);
			this.$set('borders', []);
			this.$set('border', undefined);

			var data = {
				cat_id: this.category,
				size_id: this.size,
				material_id: this.material
			}

			this.$http.post('/api/filter/types', data).then(function (response) {
				console.log(response.data);

				if (response.data.color) {
					self.$set('type', 0);
					self.getColors();
				} else {
					self.$set('types', response.data.types);
					if(response.data.types.length > 0) {
						self.$set('type', response.data.types[0].id);
						self.getColors();
					}
				}

			});
		},
		getColors: function() {
			var self = this;

			this.$set('colors', []);
			this.$set('color', undefined);
			this.$set('bodies', []);
			this.$set('body', undefined);
			this.$set('borders', []);
			this.$set('border', undefined);
			

			var data = {
				cat_id: this.category,
				size_id: this.size,
				material_id: this.material,
				type_id: this.type
			}

			this.$http.post('/api/filter/colors', data).then(function (response) {
				console.log(response.data);
				console.log(response.data.length);

				self.$set('colors', response.data);
				if(response.data.length > 0) {
					self.$set('color', response.data[0].id);
					self.getBodies(self.color);
				}
			});
		},
		getBodies: function(colorID) {
			var self = this;

			this.$set('color', colorID);

			this.$set('bodies', []);
			this.$set('body', undefined);
			this.$set('borders', []);
			this.$set('border', undefined);

			var data = {
				cat_id: this.category,
				size_id: this.size,
				material_id: this.material,
				type_id: this.type,
				color_id: this.color
			}

			this.$http.post('/api/filter/bodies', data).then(function (response) {
				console.log(response.data);

				self.$set('bodies', response.data);
				if(response.data.length > 0) {
					self.$set('body', response.data[0].id);
					self.getBorders(self.body);
				}

			});
		},
		getBorders: function(bodyID) {
			var self = this;

			this.$set('body', bodyID);
			this.$set('borders', []);

			var data = {
				cat_id: this.category,
				size_id: this.size,
				material_id: this.material,
				type_id: this.type,
				color_id: this.color,
				body_id: this.body
			}

			this.$http.post('/api/filter/borders', data).then(function (response) {
				console.log(response.data);

				if (response.data.product) {
					self.$set('border', 0);
					self.getProduct();
				} else {
					self.$set('borders', response.data.borders);
					if(response.data.borders.length > 0) {
						self.$set('border', response.data.borders[0].id);
						self.getProduct();
					}
				}

			});
		},
		getProduct: function(borderID) {

			this.$set('border', borderID);
			
			var data = {
				cat_id: this.category,
				size_id: this.size,
				material_id: this.material,
				type_id: this.type,
				color_id: this.color,
				body_id: this.body,
				border_id: this.border
			}

			this.$http.post('/api/filter/product', data).then(function (response) {

				console.log(response.data);


			});
		}
	}
    });
</script>
@endsection
