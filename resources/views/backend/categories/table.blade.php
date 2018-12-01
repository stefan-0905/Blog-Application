<table class="table table-bordered table-condesed">
    <thead>
        <tr>
            <th>Action</th>
            <th>Category Name</th>
            <th width="150px">Post Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td width="70">
                    <a title="Edit" class="btn btn-xs btn-default edit-row" href="{{ route('categories.edit', ['category' => $category->slug]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if($category->id == config('cms.default_category_id'))
                        <form action="{{ route('categories.destroy', ['category' => $category->slug]) }}" method="POST" style="display: inline;">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button disabled="disabled" type="submit" title="Delete Permanent" onclick="return confirm('Are you sure you want to delete this category?')" class="btn btn-xs btn-danger delete-row">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('categories.destroy', ['category' => $category->slug]) }}" method="POST" style="display: inline;">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                            <button type="submit" title="Delete Permanent" onclick="return confirm('Are you sure you want to delete this category?')" class="btn btn-xs btn-danger delete-row">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>
                    @endif
                </td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->posts()->published()->count() }}</td>
            </tr>
            @endforeach
    </tbody>
</table>