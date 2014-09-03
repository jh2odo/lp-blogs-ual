<article class="post">
    <header class="post-header">
        <h1 class="post-title">
            {{$post->title}}
        </h1>
        <div class="clearfix">
            <span class="left">Autor: {{$post->getBlog->getUser->username}} | Create: {{explode(' ',$post->created_at)[0]}} | Update: {{explode(' ',$post->updated_at)[0]}}</span>
        </div>
    </header>
    <div class="post-content">
        <p>{{ $post->content }}</p>
    </div>
    <footer class="post-footer">
        <hr>
    </footer>
</article>
<section class="comments">
    @if(!$comments->isEmpty())
        <h2>Comments on {{$post->title}}</h2>
        <ul>
            @foreach($comments as $comment)
                <li>
                    <article>
                        <header>
                            <div class="clearfix">
                                <span class="right">Create: {{explode(' ',$comment->created_at)[0]}}</span>
                                <span class="left commenter">{{link_to_route('user.show',$comment->getUser->username,$comment->getUser->id_users)}}</span>
                            </div>
                        </header>
                        <div class="comment-content">
                            <p>{{{$comment->content}}}</p>
                        </div>
                        <footer>
                            <hr>
                        </footer>
                    </article>
                </li>
            @endforeach
        </ul>
    @else
        <h2>No Comments on {{$post->title}}</h2>
    @endif
    <!--comment form -->
    
    @include('comments.commentform')

</section>
