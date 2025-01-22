<div class="sidebar-box ftco-animate">
    <h3 class="heading">Tag Cloud</h3>
    <div class="tagcloud">
      <a v-for="(tag,index) in dataTagCloude" :key="index" href="#" class="tag-cloud-link">@{{tag.name}}</a>
    </div>
</div>
