<div class="sidebar-box ftco-animate">
    <h3 class="heading">Categories</h3>
    <ul class="categories">
      <li v-for="(cat,index) in dataCategory" :key="index"><a href="#">@{{cat.name}} <span>(0)</span></a></li>
    </ul>
  </div>
