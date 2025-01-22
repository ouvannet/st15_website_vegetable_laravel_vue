<hr>
<section class="ftco-section ftco-partner">
	<div class="container">
		<div class="row">
			<div v-for="(logo,index) in dataLogoClient" :key="index" class="col-sm">
				<a :href="logo.website_url" class="partner">
                    <img :src="baseUrl+logo.logo_url" class="img-fluid" alt="Colorlib Template">
                </a>
			</div>
		</div>
	</div>
</section>
