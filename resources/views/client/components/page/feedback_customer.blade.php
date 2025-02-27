<section class="ftco-section testimony-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section text-center">
            <span class="subheading">Testimony</span>
          <h2 class="mb-4">Our satisfied customer says</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="" style="display: flex;">
            <div v-for="(cus_fb,index) in dataCustomerFeedback" :key="index" class="item" >
              <div class="testimony-wrap p-4 pb-5">
                <div class="user-img mb-5" :style="'background-image: url('+baseUrl+cus_fb.user.image_url+')'">
                  <span class="quote d-flex align-items-center justify-content-center">
                    <i class="icon-quote-left"></i>
                  </span>
                </div>
                <div class="text text-center">
                  <p class="mb-5 pl-4 line">@{{cus_fb.comment}}</p>
                  <p class="name">@{{cus_fb.user.full_name}}</p>
                  <span class="position">@{{cus_fb.user.role.name}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
