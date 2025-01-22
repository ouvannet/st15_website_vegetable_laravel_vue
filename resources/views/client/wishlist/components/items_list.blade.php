<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                          <tr class="text-center">
                            <th>&nbsp;</th>
                            <th>Product List</th>
                            <th>&nbsp;</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr v-for="( wishlist,index ) in dataWishlist" :key="index" class="text-center">
                                <td class="product-remove"><a @click="removeWishlist(wishlist.id)"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod"><div class="img" :style="'background-image:url('+baseUrl+wishlist.image_url+');'"></div></td>

                                <td class="product-name">
                                    <h3>@{{wishlist.name}}</h3>
                                    {{-- <p>Far far away, behind the word mountains,</p> --}}
                                </td>

                                <td class="price">$@{{wishlist.base_price}}</td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <button @click="decreaseQty(wishlist.id)" style="width:50px;font-size:20px;">-</button>
                                        <input type="text" name="quantity" class="quantity form-control input-number" :value="wishlist.qty" min="1" max="100">
                                        <button @click="increaseQty(wishlist.id)" style="width:50px;font-size:20px;">+</button>
                                    </div>
                                </td>

                                <td class="total">$@{{wishlist.base_price*wishlist.qty}}</td>
                            </tr><!-- END TR-->
                        </tbody>
                      </table>
                  </div>
            </div>
        </div>
    </div>
</section>
