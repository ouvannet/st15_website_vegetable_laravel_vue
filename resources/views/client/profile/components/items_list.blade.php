<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center font-bold mb-5"><h2>Profile</h2></div>
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                          <tr class="text-center">
                            <th>Inv</th>
                            <th>Total</th>
                            <th>Paid By</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>Delivery Status</th>
                            <th>Address</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr v-for="( sale,index ) in dataSale" :key="index" class="text-center">
                                <td class="product-name">
                                    <h3 @click="viewINV(sale)" style="color: rgb(67, 67, 255);cursor: pointer;">INV1234567</h3>
                                </td>
                                <td class="price">$@{{sale.total_amount}}</td>
                                <td class="total">@{{sale.payment_method.name}}</td>
                                <td class="total">@{{sale.payment_status}}</td>
                                <td class="total">@{{sale.order_status}}</td>
                                <td class="total">@{{sale.order_status}}</td>
                                <td class="total">@{{sale.shipping_address}}</td>
                            </tr><!-- END TR-->
                        </tbody>
                      </table>
                  </div>
            </div>
        </div>
    </div>
</section>
