<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        background: #00000096;
        padding: 20px;
        /* border-radius: 10px; */
        transform: scale(0.5);
        opacity: 0;
        border: 0px !important;

    }
</style>
<div id="modal" class="modal">
    <div class="modal-content" style="background: #00000034 !important;overflow-x: scroll;position: relative;display: flex;align-items: center;">
        {{-- <div id="close-btn" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;"></div> --}}
        <div id="payment_data" class="max-w-3xl mx-auto p-6 bg-white rounded shadow-sm my-6" id="invoice" style="z-index: 9999;padding:20px;position: absolute;">
            <center>
                <h2>Process Payment</h2>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" width="208" height="208" style="shape-rendering: auto; display: block; background: transparent;" xmlns:xlink="http://www.w3.org/1999/xlink"><g><circle stroke-width="7" stroke="#e90c59" fill="none" r="0" cy="50" cx="50">
                    <animate begin="0s" calcMode="spline" keySplines="0 0.2 0.8 1" keyTimes="0;1" values="0;35" dur="0.9433962264150942s" repeatCount="indefinite" attributeName="r"></animate>
                    <animate begin="0s" calcMode="spline" keySplines="0.2 0 0.8 1" keyTimes="0;1" values="1;0" dur="0.9433962264150942s" repeatCount="indefinite" attributeName="opacity"></animate>
                  </circle><circle stroke-width="7" stroke="#46dff0" fill="none" r="0" cy="50" cx="50">
                    <animate begin="-0.4716981132075471s" calcMode="spline" keySplines="0 0.2 0.8 1" keyTimes="0;1" values="0;35" dur="0.9433962264150942s" repeatCount="indefinite" attributeName="r"></animate>
                    <animate begin="-0.4716981132075471s" calcMode="spline" keySplines="0.2 0 0.8 1" keyTimes="0;1" values="1;0" dur="0.9433962264150942s" repeatCount="indefinite" attributeName="opacity"></animate>
                  </circle><g></g></g></svg>
            </center>
        </div>
        <div id="inv_data" class="max-w-3xl mx-auto p-6 bg-white rounded shadow-sm my-6" id="invoice" style="z-index: 9999;padding:20px;max-width:40%;transform: translateX(1300px);margin-top:20px;">
            <div class="grid grid-cols-2 items-center">
              <div>
                <a class="navbar-brand">Vegefoods</a>
              </div>
              <div class="text-right">
                <p class="text-gray-500 text-sm">
                    @{{dataContact.email}}
                </p>
                <p class="text-gray-500 text-sm mt-1">
                  @{{dataContact.phone}}
                </p>
              </div>
            </div>
            <!-- Client info -->
            <div class="grid grid-cols-2 items-center mt-8">
                <div>
                    <p class="font-bold text-gray-800">
                        Bill to :
                    </p>
                    <p class="text-gray-500">
                        @{{billingDetails.firstName}} @{{billingDetails.lastName}}
                        <br />
                        @{{billingDetails.country}}, @{{billingDetails.street}}, @{{billingDetails.city}}
                    </p>
                    <p class="text-gray-500">
                        @{{billingDetails.email}}
                        <br>
                        @{{billingDetails.phone}}
                    </p>
                </div>

                <div class="text-right">
                    <p class="">
                        Invoice number:
                        <span class="text-gray-500">INV-2023786123</span>
                    </p>
                    <p>
                        Invoice date: <span class="text-gray-500">@{{getFormattedDate()}}</span>
                    </p>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="-mx-4 mt-8 flow-root sm:mx-0">
              <table class="w-full" style="width:100%;" >
                <colgroup>
                  <col class="w-full sm:w-1/2">
                  <col class="sm:w-1/6">
                  <col class="sm:w-1/6">
                  <col class="sm:w-1/6">
                </colgroup>
                <thead class="border-b border-gray-300 text-gray-900">
                  <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Items</th>
                    <th scope="col" class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">Quantity</th>
                    <th scope="col" class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">Price</th>
                    <th scope="col" class="py-3.5 pl-3 pr-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(cart,index) in dataCart" :key="index" class="border-b border-gray-200">
                    <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                      <div class="font-medium text-gray-900">@{{cart.name}}</div>
                    </td>
                    <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">@{{cart.qty}}</td>
                    <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">$@{{cart.base_price}}</td>
                    <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">$@{{cart.qty*cart.base_price}}</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-6 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Subtotal</th>
                    <th scope="row" class="pl-6 pr-3 pt-6 text-left text-sm font-normal text-gray-500 sm:hidden">Subtotal</th>
                    <td class="pl-3 pr-6 pt-6 text-right text-sm text-gray-500 sm:pr-0">$@{{subTotal}}</td>
                  </tr>
                  <tr>
                    <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Delivery</th>
                    <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-normal text-gray-500 sm:hidden">Delivery</th>
                    <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">$@{{totalDelivery}}</td>
                  </tr>
                  <tr>
                    <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Discount</th>
                    <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-normal text-gray-500 sm:hidden">Discount</th>
                    <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">$@{{totalDiscount}}</td>
                  </tr>
                  <tr>
                    <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-4 text-right text-sm font-semibold text-gray-900 sm:table-cell sm:pl-0">Total</th>
                    <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-semibold text-gray-900 sm:hidden">Total</th>
                    <td class="pl-3 pr-4 pt-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">$@{{subTotal+totalDelivery+totalDiscount}}</td>
                  </tr>
                </tfoot>
              </table>
            </div>

            <!--  Footer  -->
            <div class="border-t-2 pt-4 text-xs text-gray-500 text-center mt-16">
              Please pay the invoice before the due date. You can pay the invoice by logging in to your account from our client portal.
            </div>

        </div>

    </div>
</div>


<script>
    $(document).ready(function(){
        const modal = $("#modal");
        const openBtn = $("#order-btn");
        const closeBtn = $("#close-btn");
        $(openBtn).click(function(){
            modal.css('display','flex');
            anime({
                targets: ".modal-content",
                scale: [0.5, 1],
                opacity: [0, 1],
                duration: 500,
                easing: "easeOutExpo"
            });
            anime({
                targets: "#payment_data",
                translateY: 200,
                complete: () => {
                }
            });
            setTimeout(() => {
                anime({
                    targets: "#payment_data",
                    translateX: -1000,
                    complete: () => {
                    }
                });
                anime({
                    targets: "#inv_data",
                    translateX: 0,
                });
            }, 4000);
        })

        $(closeBtn).click(function(){
            anime({
                targets: ".modal-content",
                scale: [1, 0.5],
                opacity: [1, 0],
                duration: 400,
                easing: "easeInExpo",
                complete: () => {
                    modal.css('display','none')
                }
            });
        })
        // Close modal on background click
        $(modal).click(function(e){
            if (e.target === modal) {
                closeBtn.click();
            }
        })
    })
</script>

