<h2 class="comment-listings">Comment listings</h2><hr>
<table>
    <thead>
    <tr>
        <th>Autor</th>
        <th>At Post</th>
        <th>Id</th>
        <th>Approved</th>
        <th>Comment Delete</th>
        <th>Comment View</th>
    </tr>
    </thead>
    <tbody>
    @foreach($comments as $a)
    @foreach($a as $comment)
    <tr>
        <td>{{$comment->getUser->username}}</td>
        <td>{{$comment->getPost->title}}</td>
        <td>{{$comment->id_comments}}</td>
        <td>
            {{Form::open(['route'=>['comment.update',$comment->id_comments]])}}
            {{Form::select('status',['yes'=>'Yes','no'=>'No'],$comment->approved,['style'=>'margin-bottom:0','onchange'=>'submit()'])}}
            {{Form::close()}}
        </td>
        <td>{{HTML::linkRoute('comment.delete','Delete',$comment->id_comments)}}</td>
        <td>{{HTML::linkRoute('comment.show','Quick View',$comment->id_comments,['data-reveal-id'=>'comment-show','data-reveal-ajax'=>'true'])}}</td>
    </tr>
    @endforeach
    @endforeach
    </tbody>
</table>

