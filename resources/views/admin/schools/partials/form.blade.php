<div class="form-grid">
    <div class="field">
        <label>School Name</label>
        <input type="text" name="name" value="{{ old('name', optional($school)->name) }}" required>
    </div>
    <div class="field">
        <label>School Code</label>
        <input type="text" name="code" value="{{ old('code', optional($school)->code) }}" required>
    </div>
    <div class="field">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ old('phone', optional($school)->phone) }}">
    </div>
    <div class="field">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', optional($school)->email) }}">
    </div>
    <div class="field">
        <label>Status</label>
        <select name="status" required>
            @php($status = old('status', optional($school)->status ?: 'active'))
            <option value="active" @selected($status === 'active')>Active</option>
            <option value="inactive" @selected($status === 'inactive')>Inactive</option>
        </select>
    </div>
    <div class="field">
        <label>Address</label>
        <input type="text" name="address" value="{{ old('address', optional($school)->address) }}">
    </div>
    <div class="field field-wide">
        <label>Description</label>
        <textarea name="description" rows="4">{{ old('description', optional($school)->description) }}</textarea>
    </div>
</div>
