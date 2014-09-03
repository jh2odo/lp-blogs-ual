<h2 class="post-listings">Post listings</h2><hr>
@foreach($blogs as $blog)
<h3 class="post-listings">Blog: {{$blog->title}}</h2><hr>	
@if(!$blog->getPosts->isEmpty())

<table>
    <thead>
    <tr>
        <th width="300">Post Title</th>
        <th width="120">Post Edit</th>
        <th width="120">Post Delete</th>
        <th width="120">Post View</th>
    </tr>
    </thead>
    <tbody>
        @foreach($blog->getPosts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td>{{HTML::linkRoute('post.edit','Edit',$post->id_posts)}}</td>
                <td>{{HTML::linkRoute('post.delete','Delete',$post->id_posts)}}</td>
                <td>{{HTML::linkRoute('post.show','View',$post->id_posts,['target'=>'_blank'])}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
	<p>No tiene posts</p>
@endif
@endforeach
{{$blogs->links()}}
