<div class="form-grid">
    <div class="field field-wide">
        <label>Image</label>
        <input type="file" name="image" accept="image/*" @if($requireImage) required @endif>
    </div>
    <div class="field field-wide">
        <label>Caption</label>
        <textarea name="caption" rows="4" required>{{ old('caption', optional($slider)->caption) }}</textarea>
    </div>
    <div class="field">
        <label>Order</label>
        <input type="number" name="order" value="{{ old('order', optional($slider)->order) }}" min="0">
    </div>
    <div class="field check-field">
        <label>
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', optional($slider)->is_active ?? true))>
            Active
        </label>
    </div>
</div>
