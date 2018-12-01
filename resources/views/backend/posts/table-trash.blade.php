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
            @foreach($posts as $post)
                <tr>
                    <td width="70">
                        <form action="{{ route('post.restore', ['id' => $post->id]) }}" method="POST" style="display: inline;">
                            <input type="hidden" name="_method" value="PUT">
                            @csrf
                            <button type="submit" title="Edit" class="btn btn-xs btn-default edit-row" >
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </form>
                        <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="POST" style="display: inline;">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button type="submit" title="Delete Permanent" onclick="return confirm('You are about to delete post permanently. Are you sure?')" class="btn btn-xs btn-danger delete-row">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->author->name }}</td>
                    <td>{{ $post->category->title }}</td>
                    <td>
                        <abbr title="{{ $post->created_at }}">
                            {{ $post->created_at->toFormattedDateString() }}
                        </abbr>
                    </td>
                </tr>
                @endforeach
        </tbody>
        </table>