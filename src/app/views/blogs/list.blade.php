<h2 class="post-listings">Blog listings</h2><hr>
<table>
    <thead>
    <tr>
        <th width="300">Blog Title</th>
        <th width="120">Blog Edit</th>
        <th width="120">Blog Delete</th>
        <th width="120">Blog View</th>
    </tr>
    </thead>
    <tbody>
        @foreach($blogs as $blog)
            <tr>
                <td>{{$blog->title}}</td>
                <td>{{HTML::linkRoute('blog.edit','Edit',$blog->id_blogs)}}</td>
                <td>{{HTML::linkRoute('blog.delete','Delete',$blog->id_blogs)}}</td>
                <td>{{HTML::linkRoute('blog.show','View',$blog->id_blogs,['target'=>'_blank'])}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$blogs->links()}}
