<!-- BEGIN col-6 -->
<div class="col-xl-6 mb-3">
    <!-- BEGIN card -->
    <div class="card h-100">
        <!-- BEGIN card-body -->
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <div class="flex-grow-1">
                    <h5 class="mb-1">Bestseller</h5>
                    <div class="fs-13px">Top 3 product sales this week</div>
                </div>
                <a href="#" class="text-decoration-none">See All</a>
            </div>

            <!-- product-1 -->
            <div v-for="(product,index) in dataTable" :key="index" class="d-flex align-items-center mb-3">
                <div class="d-flex align-items-center justify-content-center me-3 w-50px h-50px bg-white p-3px rounded">
                    <img :src="baseUrl+product.image_url" alt="" class="ms-100 mh-100">
                </div>
                <div class="flex-grow-1">
                    <div>
                        <div class="text-body fw-600">@{{product.name}}</div>
                        <div class="fs-13px">$@{{product.base_price}}</div>
                    </div>
                </div>
                <div class="ps-3 text-center">
                    <div class="text-body fw-600">382</div>
                    <div class="fs-13px">sales</div>
                </div>
            </div>
        </div>
        <!-- END card-body -->
    </div>
    <!-- END card -->
</div>
<!-- END col-6 -->
