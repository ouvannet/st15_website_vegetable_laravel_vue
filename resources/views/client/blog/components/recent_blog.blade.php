<div class="sidebar-box">
    <h3 class="heading">Recent Blog</h3>
    <div v-for="(recent,index) in recentBlog" :key="index" class="block-21 mb-4 d-flex">
      <a class="blog-img mr-4" :style="'background-image: url('+baseUrl+recent.featured_image+');'"></a>
      <div class="text">
        <h3 class="heading-1"><a :href="'/client/blog/readblog/'+recent.id">@{{recent.title}}</a></h3>
        <div class="meta">
          <div><a :href="'/client/blog/readblog/'+recent.id"><span class="icon-calendar"></span> @{{formattedDate(recent.published_at)}}</a></div>
          <div><a :href="'/client/blog/readblog/'+recent.id"><span class="icon-person"></span> @{{recent.author.full_name}}</a></div>
          <div><a :href="'/client/blog/readblog/'+recent.id"><span class="icon-chat"></span> @{{recent.comments.length}}</a></div>
        </div>
      </div>
    </div>
</div>
