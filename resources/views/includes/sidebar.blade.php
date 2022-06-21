<div class="col-lg-4">
    <section class="sidebar">
        <div class="liveSearch-block">
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <form  class="input-group" action="{{ route('post.search') }}" method="POST">
                        @csrf
                        <input class="form-control" id='liveSearch-button' type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" name='keyword'/>
                        <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                    </form>
                    <div id="liveSearch-result-block">
                    </div>
                </div>
            </div>
        </div>
        <!-- Categories widget-->
        <div class="card mb-4">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <ul class='list-group'>
                            @foreach($categories as $cat)
                            <a href="{{ route('category.index',$cat->slug)}}" class='list-group-item
                                @isset($category){{ ($cat->id == $category->id) ? 'active' : '' }}@endisset'>
                                {{ $cat->title }}
                            </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">Tags</div>
            <div class="card-body">
                <div class="row">
                    <ul class="list-unstyled mb-0">
                        @foreach ($tags as $tag)
                        <li><a href="{{ route('tag.index',$tag->slug) }}">{{ $tag->title }}</a></li>
                        @endforeach
                    </ul>
                    {{--<div class="col-sm-6">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#!">Web Design</a></li>
                            <li><a href="#!">HTML</a></li>
                            <li><a href="#!">Freebies</a></li>
                        </ul>--}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Side widget-->
        <div class="card mb-4">
            <div class="card-header">Side Widget</div>
            <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
        </div>
    </section>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
var ax=null;
const URL={
liveSearch:"{{ route('post.search') }}",
posts:"{{ route('post.index') }}",
tags:"{{ route('tag.index.empty') }}",
};
</script>
<script src="{{ asset('js/axios_as_ax.js') }}"></script>
<script type="text/javascript">
var timer = null;
function search_request(value) {
console.log(value)
ax.post(URL.liveSearch,{
keyword:value,
live:true
}).then(res=>{
console.log(res.data);
$('#liveSearch-result-block').html('');
if(res.data.posts.length==0){
return;
}
var add_ul = ""
if(res.data.posts.length!=0){
add_ul+='<ul class=\"list-group\">';
    for (var i = 0; i < res.data.posts.length; i++) {
    add_ul+="<li class=\"list-group-item\"><a href=\""+URL.posts+"/"+res.data.posts[i].id+"\">"+res.data.posts[i].title+"</a></li>";
    }
add_ul+='</ul>';
};
if(res.data.tags.length!=0){
add_ul+='<ul class=\"list-group\">';
    for (var i = 0; i < res.data.tags.length; i++) {
    add_ul+="<li class=\"list-group-item\"><a href=\""+URL.tags+"/"+res.data.tags[i].slug+"\">#"+res.data.tags[i].title+"</a></li>";
    }
add_ul+='</ul>';
};
$('#liveSearch-result-block').html(add_ul);
}).catch(err=>{
console.log(err);
});
}
$(document).ready(()=>{
console.log('ready');
$('#liveSearch-button').keyup(function(){
var value=$(this).val();
value=value.trim();
if (!value) {
$('#liveSearch-result-block').html('');
return;
};
clearTimeout(timer);
timer = setTimeout(function() {
search_request(value);
}, 200);
});
});
</script>
<style type="text/css">
#liveSearch-result-block, #liveSearch-result-block *{
z-index: 1000!important;
}
</style>