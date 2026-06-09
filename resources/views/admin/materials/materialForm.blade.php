@extends('components.dashmaster')

@section('body')
<div class="content-wrapper form-page">
    <div class="container-fluid form-shell">
        <div class="form-header-panel">
            <div>
                <h1><i class="fas fa-upload"></i> Add Material</h1>
                <p>{{ $class->name }} · {{ $subject->name }}</p>
            </div>
            <a href="{{ route('admin.subjects', [$class, $subject]) }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Materials</a>
        </div>

        <div id="alertBox"></div>

        <div class="form-card">
            <form action="{{ route('adminMaterials.store', ['class' => $class->id, 'subject' => $subject->id]) }}" method="POST" enctype="multipart/form-data" id="materialForm">
                @csrf
                <input type="hidden" name="class_id" value="{{ $class->id }}">
                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                <div class="form-grid">
                    <div class="field field-wide">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="field">
                        <label>Type</label>
                        <select name="type" id="materialType" required>
                            <option value="">Select Type</option>
                            <option value="document">Document</option>
                            <option value="video">Video</option>
                            <option value="link">External Link</option>
                        </select>
                    </div>
                    <div class="field" id="fileField">
                        <label>File</label>
                        <input type="file" name="file">
                    </div>
                    <div class="field field-wide" id="urlField" style="display:none;">
                        <label>URL</label>
                        <input type="url" name="url" placeholder="https://example.com/resource">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-upload"></i> Upload Material</button>
                    <a href="{{ route('admin.subjects', [$class, $subject]) }}" class="ui-btn ui-btn-light"><i class="fas fa-times"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>

<style>
.form-page { background: #f5f7fb; min-height: 100vh; }
.form-shell { max-width: 960px; padding: 18px; }
.form-header-panel, .form-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.form-header-panel { align-items: center; display: flex; justify-content: space-between; gap: 14px; margin-bottom: 14px; padding: 16px 18px; }
.form-header-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.form-header-panel h1 i { color: #123d35; margin-right: 8px; }
.form-header-panel p { color: #6b7280; margin: 4px 0 0; }
.form-card { padding: 18px; }
.form-grid { display: grid; gap: 14px; grid-template-columns: repeat(2, minmax(0, 1fr)); }
.field-wide { grid-column: 1 / -1; }
.field label { color: #374151; display: block; font-weight: 800; margin-bottom: 7px; }
.field input, .field select { border: 1px solid #d7dde6; border-radius: 6px; min-height: 40px; padding: 9px 11px; width: 100%; }
.field input:focus, .field select:focus { border-color: #123d35; box-shadow: 0 0 0 3px rgba(18, 61, 53, .12); outline: 0; }
.form-actions { display: flex; gap: 8px; margin-top: 18px; }
.ui-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 36px; padding: 8px 12px; }
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
@media (max-width: 768px) { .form-header-panel { align-items: flex-start; flex-direction: column; } .form-grid { grid-template-columns: 1fr; } }
</style>
<script>
document.getElementById("currentYear").textContent = new Date().getFullYear();
const type = document.getElementById('materialType');
const fileField = document.getElementById('fileField');
const urlField = document.getElementById('urlField');
function syncMaterialFields() {
    const isLink = type.value === 'link';
    fileField.style.display = isLink ? 'none' : 'block';
    urlField.style.display = isLink ? 'block' : 'none';
}
type.addEventListener('change', syncMaterialFields);
syncMaterialFields();
document.getElementById('materialForm').addEventListener('submit', async function(event) {
    event.preventDefault();
    const response = await fetch(this.action, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
        body: new FormData(this)
    });
    if (response.ok) {
        window.location.href = "{{ route('admin.subjects', [$class, $subject]) }}";
        return;
    }
    document.getElementById('alertBox').innerHTML = '<div class="alert alert-danger">Please check the material details and try again.</div>';
});
</script>
@endsection
