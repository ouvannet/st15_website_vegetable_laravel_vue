<div class="row">
    <div v-for="(blog,index) in dataBlogs" :key="index" class="col-md-12 d-flex ">
      <div class="blog-entry align-self-stretch d-md-flex">
        <a :href="'/client/blog/readblog/'+blog.id" class="block-20" :style="'background-image: url('+baseUrl+blog.featured_image+');'">
        </a>
        <div class="text d-block pl-md-4">
          <div class="meta mb-3">
            <div><a :href="'/client/blog/readblog/'+blog.id">@{{formattedDate(blog.published_at)}}</a></div>
            <div><a :href="'/client/blog/readblog/'+blog.id">@{{blog.author.full_name}}</a></div>
            <div><a :href="'/client/blog/readblog/'+blog.id" class="meta-chat"><span class="icon-chat"></span> @{{blog.comments.length}}</a></div>
          </div>
          <h3 class="heading"><a :href="'/client/blog/readblog/'+blog.id">@{{blog.title}}</a></h3>
          <p>@{{blog.content}}</p>
          <p><a :href="'/client/blog/readblog/'+blog.id" class="btn btn-primary py-2 px-3">Read more</a></p>
        </div>
      </div>
    </div>
</div>
