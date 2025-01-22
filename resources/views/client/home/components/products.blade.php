<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Featured Products</span>
                <h2 class="mb-4">Our Products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div v-for="(product,index) in dataProducts" :key="index" class="col-md-6 col-lg-3">
                <div class="product">
                    <a :href="'/client/shop/single_product/'+product.id" class="img-prod">
                        <img class="img-fluid" :src="baseUrl+product.image_url" alt="Colorlib Template">
                        <span class="status">30%</span>
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a :href="'/client/shop/single_product/'+product.id">@{{product.name}}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price">
                                    {{-- <span class="mr-2 price-dc">$120.00</span> --}}
                                    <span class="price-sale">$@{{product.base_price}}</span>
                                </p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a :href="'/client/shop/single_product/'+product.id" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <a @click="clickCart(product)" class="buy-now d-flex justify-content-center align-items-center mx-1" :style="checkExistCart(product)?'background:gray;':''">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                                <a @click="clickWishlist(product)" class="heart d-flex justify-content-center align-items-center " :style="checkExistWishlist(product)?'background:gray;':''">
                                    <span><i class="ion-ios-heart"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
