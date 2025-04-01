<section class="ftco-section ftco-category ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 order-md-last align-items-stretch d-flex">
                        <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex" style="background-image: url(images/category.jpg);">
                            <div class="text text-center">
                                <h2>Vegetables</h2>
                                <p>Protect the health of every home</p>
                                <p><a href="/client/shop" class="btn btn-primary">Shop now</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a v-for="(category,index) in dataCategory" :href="'/client/shop?category='+category.id" class="category-wrap img mb-4 d-flex align-items-end" :style="'background-image: url('+baseUrl+category.image_url+');'">
                            <div class="text px-3 py-1">
                                <h2 class="mb-0">@{{category.name}}</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <a v-for="(category,index) in dataCategory2" :href="'/client/shop?category='+category.id" class="category-wrap img mb-4 d-flex align-items-end" :style="'background-image: url('+baseUrl+category.image_url+');'">
                    <div class="text px-3 py-1">
                        <h2 class="mb-0">@{{category.name}}</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
