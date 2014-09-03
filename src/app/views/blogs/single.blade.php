@if(!$posts->isEmpty())
	@foreach($posts as $post)
		<article class="post">
			<header class="post-header">
				<h1 class="post-title">
					{{link_to_route('post.show',$post->title,$post->id_posts)}}
				</h1>
				<div class="clearfix">
					<span class="left">Create: {{explode(' ',$post->created_at)[0]}}</span>
				</div>
			</header>
			<div class="post-content">
				<p>{{$post->summary.' ...'}}</p>
				<span>{{link_to_route('post.show','Read full article',$post->id_posts)}}
			</div>
			<footer class="post-footer">
				<hr>
			</footer>
		</article>
	@endforeach
	{{$posts->links()}}
@else
	<p>No hay posts</p>
@endif
