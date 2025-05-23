<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-7 ftco-animate">
        <form action="#" class="billing-form">
          <h3 class="mb-4 billing-heading">Billing Details</h3>
          <div class="row align-items-end">
            <div class="col-md-6">
              <div class="form-group">
                <label for="firstname">Firt Name</label>
                <input v-model="billingDetails.firstName" type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="lastname">Last Name</label>
                <input v-model="billingDetails.lastName" type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="country">State / Country</label>
                <div class="select-wrap">
                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                  <select v-model="billingDetails.country" name="" id="" class="form-control">
                    <option value="">Cambodia</option>
                    <option value="">France</option>
                    <option value="">Italy</option>
                    <option value="">Philippines</option>
                    <option value="">South Korea</option>
                    <option value="">Hongkong</option>
                    <option value="">Japan</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="streetaddress">Street Address</label>
                <input v-model="billingDetails.street" type="text" class="form-control" placeholder="House number and street name">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="towncity">Town / City</label>
                <input v-model="billingDetails.city" type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone</label>
                <input v-model="billingDetails.phone" type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="emailaddress">Email Address</label>
                <input v-model="billingDetails.email" type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="w-100"></div>
            {{-- <div class="col-md-12">
              <div class="form-group mt-4">
                <div class="radio">
                  <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
                  <label><input type="radio" name="optradio"> Ship to different address</label>
                </div>
              </div>
            </div> --}}
          </div>
        </form><!-- END -->
      </div>
      <div class="col-xl-5">
        <div class="row mt-5 pt-3">
          <div class="col-md-12 d-flex mb-5">
            <div class="cart-detail cart-total p-3 p-md-4">
              <h3 class="billing-heading mb-4">Cart Total</h3>
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
          </div>
          <div class="col-md-12">
            <div class="cart-detail p-3 p-md-4">
              <h3 class="billing-heading mb-4">Payment Method</h3>
              <div v-for="(paymethod,index) in dataPaymentMethod" :key="index" class="form-group">
                <div class="col-md-12">
                  <div class="radio">
                     <label style="display:flex;"><input type="radio" name="optradio" class="mr-2" style="width:25px;height:25px;"> @{{paymethod.name}}</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <div class="checkbox">
                     <label style="display:flex;"><input type="checkbox" value="" class="mr-2" style="width:25px;height:25px;"> I have read and accept the terms and conditions</label>
                  </div>
                </div>
              </div>
              <p><a id="order-btn" @click="placeAndPayment" v-if="subTotal>0" class="btn btn-primary py-3 px-4" style="color:white;">Place an order</a></p>
            </div>
          </div>
        </div>
      </div> <!-- .col-md-8 -->
    </div>
  </div>
</section>
