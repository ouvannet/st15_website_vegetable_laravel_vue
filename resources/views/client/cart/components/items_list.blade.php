<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                          <tr class="text-center">
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>Product name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr v-for="( cart,index ) in dataCart" :key="index" class="text-center">
                                <td class="product-remove"><a @click="removeCart(cart.id)"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod"><div class="img" :style="'background-image:url('+baseUrl+cart.image_url+');'"></div></td>

                                <td class="product-name">
                                    <h3>@{{cart.name}}</h3>
                                    {{-- <p>Far far away, behind the word mountains,</p> --}}
                                </td>

                                <td class="price">$@{{cart.base_price}}</td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <button @click="decreaseQty(cart.id)" style="width:50px;font-size:20px;">-</button>
                                        <input type="text" name="quantity" class="quantity form-control input-number" :value="cart.qty" min="1" max="100">
                                        <button @click="increaseQty(cart.id)" style="width:50px;font-size:20px;">+</button>
                                    </div>
                                </td>

                                <td class="total">$@{{cart.base_price*cart.qty}}</td>
                            </tr><!-- END TR-->
                        </tbody>
                      </table>
                  </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Coupon Code</h3>
                    <p>Enter your coupon code if you have one</p>
                      <form action="#" class="info">
              <div class="form-group">
                  <label for="">Coupon code</label>
                <input type="text" class="form-control text-left px-3" placeholder="">
              </div>
            </form>
                </div>
                <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
            </div>
            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Estimate shipping and tax</h3>
                    <p>Enter your destination to get a shipping estimate</p>
                      <form action="#" class="info">
              <div class="form-group">
                  <label for="">Country</label>
                <input type="text" class="form-control text-left px-3" placeholder="">
              </div>
              <div class="form-group">
                  <label for="country">State/Province</label>
                <input type="text" class="form-control text-left px-3" placeholder="">
              </div>
              <div class="form-group">
                  <label for="country">Zip/Postal Code</label>
                <input type="text" class="form-control text-left px-3" placeholder="">
              </div>
            </form>
                </div>
                <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
            </div>
            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Cart Totals</h3>
                    <p class="d-flex">
                        <span>Subtotal</span>
                        <span>$@{{subTotal}}</span>
                    </p>
                    <p class="d-flex">
                        <span>Delivery</span>
                        <span>$@{{totalDelivery}}</span>
                    </p>
                    <p class="d-flex">
                        <span>Discount</span>
                        <span>$@{{totalDiscount}}</span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Total</span>
                        <span>$@{{subTotal+totalDelivery+totalDiscount}}</span>
                    </p>
                </div>
                <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
            </div>
        </div>
    </div>
</section>
