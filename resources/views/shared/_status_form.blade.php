<form action="{{ route('status.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <textarea name="content" rows="3" placeholder="说说新鲜事..." class="form-control"></textarea>
        <div class="text-right mt-2">
        <button type="submit" class="btn btn-primary">发布</button>
        </div>
    </div>
</form>
