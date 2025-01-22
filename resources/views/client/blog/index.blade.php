@extends('client.layouts.app')

@section('title', 'Blog Page')

@section('content')
	@include('client.blog.components.slide')
    <section class="ftco-section ftco-degree-bg" id="app">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    @include('client.blog.components.blog_list')
                </div>
                <div class="col-lg-4 sidebar ftco-animate">
                    @include('client.blog.components.search')
                    @include('client.blog.components.category')
                    @include('client.blog.components.recent_blog')
                    @include('client.blog.components.tag_cloude')
                </div>
            </div>
        </div>
    </section>
    <script>
        const { createApp, ref } = Vue;
        createApp({
            setup() {
                const baseUrl= "{{ asset('') }}";
                const dataBlogs=ref([]);
                const recentBlog=ref([]);
                const dataTagCloude=ref([]);
                const dataCategory=ref([]);
                const formattedDate=(data)=> {
                    const date = new Date(data);
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    return date.toLocaleDateString('en-US', options);
                }
                const fetchData = async (url) => {
                    try {
                        const { data } = await axios.post(url, {}, { headers: { 'Content-Type': 'multipart/form-data' } });
                        return data;
                    } catch (error) {
                        console.error(error);
                        return [];
                    }
                };
                const getList=async()=>{
                    fetchData('/client/blog/list').then(data => {dataBlogs.value = data;recentBlog.value=data.slice(0,3);});
                    fetchData('/client/blog/tagcloude').then(data => {dataTagCloude.value = data;});
                    fetchData('/client/category/list').then(data => {dataCategory.value = data;});
                }
                getList();
                return {
                    baseUrl,
                    formattedDate,
                    dataBlogs,
                    recentBlog,
                    dataTagCloude,
                    dataCategory
                };
            }
        }).mount('#app');
    </script>
@endsection
