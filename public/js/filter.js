Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;

var Filter = new Vue({
    el: '#app',
    data: {
        show: false,
        quantity: 1,
        
        sizes: [],
        materials: [],
        types: [],
        colors: [],
        bodies: [],
        borders: [],
        
        categoryTitle: undefined,
        
        category: undefined,
        size: undefined,
        material: undefined,
        type: undefined,
        body: undefined,
        border: undefined,
        
        product: {
            title: undefined,
            description: undefined,
            price: undefined,
            price_new: undefined,
            image_main: undefined,
            image_1: undefined,
            image_2: undefined,
            image_3: undefined,
            image_4: undefined,
            image_5: undefined,
            image_6: undefined
        }
    },
    ready: function () {
        $('.main-content').hide();
        $('.main-footer').hide();
    },
    methods: {
        getOptions: function (cat_id) {
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

            this.$http.post('/api/filter/category', data).then(function (response) {
                //console.log(response.data);
                self.$set('categoryTitle', response.data.title);

                self.getSizes();
            });
        },
        getSizes: function() {
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
                cat_id: this.category
            }

            this.$http.post('/api/filter/sizes', data).then(function (response) {
                //console.log(response.data);
                self.$set('sizes', response.data);
                $('.main-header').css('padding-top', '0').addClass('main-header__after');
                $('.main-header:before').css('top', '115px');
                
                $('.main-content').show();
                $('.main-footer').show();
                
                if (response.data.length > 0) {
                    self.$set('size', response.data[0].id);
                    self.getMaterials();
                }

            });
        },
        getMaterials: function () {
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
                //console.log(response.data);
                self.$set('materials', response.data);
                if (response.data.length > 0) {
                    self.$set('material', response.data[0].id);
                    self.getTypes();
                }

            });
        },
        getTypes: function () {
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
                //console.log(response.data);

                if (response.data.color) {
                    self.$set('type', 0);
                    self.getColors();
                } else {
                    self.$set('types', response.data.types);
                    if (response.data.types.length > 0) {
                        self.$set('type', response.data.types[0].id);
                        self.getColors();
                    }
                }

            });
        },
        getColors: function () {
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
                //console.log(response.data);
                //console.log(response.data.length);

                self.$set('colors', response.data);
                if (response.data.length > 0) {
                    self.$set('color', response.data[0].id);
                    self.getBodies(self.color);
                }
            });
        },
        getBodies: function (colorID) {
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
                //console.log(response.data);

                self.$set('bodies', response.data);
                if (response.data.length > 0) {
                    self.$set('body', response.data[0].id);
                    self.getBorders(self.body);
                }

            });
        },
        getBorders: function (bodyID) {
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
                //console.log(response.data);

                if (response.data.product) {
                    self.$set('border', 0);
                    self.getProduct();
                } else {
                    self.$set('borders', response.data.borders);
                    if (response.data.borders.length > 0) {
                        self.$set('border', response.data.borders[0].id);
                        self.getProduct();
                    }
                }

            });
        },
        getProduct: function (borderID) {
            
            var self = this;

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
                
                $('html').css('overflow-y', 'auto');
                $('html,body').animate({scrollTop: $('.content-header__select_wrap').offset().top}, 1000);
                
                console.log(response.data);
                
                self.$set('show', true);
                self.$set('product', response.data);

            });
        },
        addToCart: function() {
            console.log('addToCart');
        },
        quantityInc: function() {
            if (this.quantity > 100) {
                this.quantity = 99;
            } else {
                this.quantity++;
            }
        },
        quantityDec: function() {
            if(this.quantity <= 1) {
                this.quantity = 1;
            } else {
                this.quantity--;
            }
            
        }
    }
});