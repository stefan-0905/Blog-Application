<table class="table table-bordered table-condesed">
    <thead>
        <tr>
            <th>Action</th>
            <th>Title</th>
            <th width="150px">Author</th>
            <th width="150px">Category</th>
            <th width="170px">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php $request = request(); ?>
        @foreach($posts as $post)
            <tr>
                <td width="70">
                    @if(checkUserPermissions($request, "Posts@edit", $post->id))
                    <a title="Edit" class="btn btn-xs btn-default edit-row" href="{{ route('post.edit', ['post' => $post->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                    @else 
                        <a title="Edit" class="disabled btn btn-xs btn-default edit-row" href="#">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endif
                    @if(checkUserPermissions($request, "Posts@delete", $post->id))
                    <a title="Delete" class="btn btn-xs btn-danger delete-row" href="{{ route('post.delete', ['post' => $post->id]) }}">
                        <i class="fa fa-times"></i>
                    </a>
                    @else 
                        <a title="Delete" class="disabled btn btn-xs btn-danger delete-row" href="#">
                            <i class="fa fa-times"></i>
                        </a>
                    @endif
                </td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->author->name }}</td>
                <td>{{ $post->category->title }}</td>
                <td>
                    <abbr title="{{ $post->created_at }}">
                        {{ $post->created_at->toFormattedDateString() }}
                    </abbr> | {!! $post->publicationLabel() !!}</td>
            </tr>
            @endforeach
    </tbody>
</table>