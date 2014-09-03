
    @if(!$blogs->isEmpty())
		@foreach($blogs as $blog)
			<article class="post">
				<header class="post-header">
					<h1 class="post-title">
						{{link_to_route('blog.show',$blog->title,$blog->id_users)}}
					</h1>
				</header>
				<footer class="post-footer">
					<hr>
				</footer>
			</article>
		@endforeach
    @else
		<p>No tiene blogs</p>
    @endif