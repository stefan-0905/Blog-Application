@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@elseif(session('success'))
    <div class="alert alert-info">{{ session('success') }}</div>
@elseif(session('trash-message'))
    <?php list($message, $post_id) = session('trash-message') ?>
    <div class="alert alert-info">
        <span>{{ $message }}<span>
        <form method="POST" action="{{ route('post.restore', ['id' => $post_id]) }}" style="display: inline;">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-undo"></i> Undo</button>
        </form>
    </div>
@endif