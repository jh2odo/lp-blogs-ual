@if(!$blogs->isEmpty())
	@foreach($blogs as $blog)
		<article class="post">
			<header class="post-header">
				<h1 class="post-title">
					{{link_to_route('blog.show',$blog->title,$blog->id_blogs)}}
				</h1>
				<div class="clearfix">
	   				<span class="left">Autor: {{$blog->getUser->username}} | Create: {{explode(' ',$blog->created_at)[0]}} | Update: {{explode(' ',$blog->updated_at)[0]}}</span>
				</div>
			</header>
			<div class="post-content">
				<p>{{$blog->description}}</p>
			</div>
			<footer class="post-footer">
				<hr>
			</footer>
		</article>
	@endforeach
	{{$blogs->links()}}
@else
	<p>No hay blogs</p>
@endif

