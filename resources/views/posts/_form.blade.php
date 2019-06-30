<div class="form-group">
    <label>{{ __('Title') }}</label>
    <input type="text" name="title" class="form-control"
        value="{{ old('title', $post->title ?? null) }}"/>
</div>

<div class="form-group">
    <label>{{ __('Content') }}</label>
    <textarea type="text" name="content" class="form-control" rows="20">{{ old('content', $post->content ?? null) }}</textarea>
</div>

<div class="form-group">
    <label>{{ __('Thumbnail') }}</label>
    <input type="file" name="thumbnail" class="form-control-file"/>
</div>

@errors @enderrors