<h2 class="mb-3">@{{dataBlogs.title}}</h2>
<p>
  <img :src="baseUrl+dataBlogs.featured_image" alt="" class="img-fluid">
</p>
<p>@{{dataBlogs.content}}</p>
<div class="tag-widget post-tag-container mb-5 mt-5">
  <div class="tagcloud">
    <a href="#" class="tag-cloud-link">Life</a>
    <a href="#" class="tag-cloud-link">Sport</a>
    <a href="#" class="tag-cloud-link">Tech</a>
    <a href="#" class="tag-cloud-link">Travel</a>
  </div>
</div>

<div class="about-author d-flex p-4 bg-light">
  <div class="bio align-self-md-center mr-4">
    <img :src="baseUrl+dataBlogs.author.image_url" alt="Image placeholder" class="img-fluid mb-4">
  </div>
  <div class="desc align-self-md-center">
    <h3>@{{dataBlogs.author.full_name}}</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
  </div>
</div>
