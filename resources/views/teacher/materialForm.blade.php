@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-upload"></i> Add Material</h1>
                <p>{{ $subject->name }} • {{ $class->name }}</p>
            </div>
            <a href="{{ route('teacher.subjects', ['class' => $class->id, 'subject' => $subject->id]) }}" class="ui-btn ui-btn-soft">
                <i class="fas fa-arrow-left"></i> Materials
            </a>
        </div>

        <div id="materialAlert"></div>

        <section class="panel-card form-card">
            <form id="materialForm" action="{{ route('teacherMaterials.store', ['class' => $class->id, 'subject' => $subject->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="class_id" value="{{ $class->id }}">
                <input type="hidden" name="subject_id" value="{{ $subject->id }}">

                <div class="field">
                    <label for="title">Title</label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}" required>
                </div>

                <div class="field">
                    <label for="type">Type</label>
                    <select id="type" name="type" required>
                        <option value="">Select type</option>
                        <option value="document" {{ old('type') === 'document' ? 'selected' : '' }}>Document</option>
                        <option value="video" {{ old('type') === 'video' ? 'selected' : '' }}>Video</option>
                        <option value="link" {{ old('type') === 'link' ? 'selected' : '' }}>External Link</option>
                    </select>
                </div>

                <div class="field" id="fileField" hidden>
                    <label for="file">File</label>
                    <input id="file" type="file" name="file">
                </div>

                <div class="field" id="urlField" hidden>
                    <label for="url">URL</label>
                    <input id="url" type="url" name="url" value="{{ old('url') }}" placeholder="https://example.com/resource">
                </div>

                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary">
                        <i class="fas fa-save"></i> Save Material
                    </button>
                </div>
            </form>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
<script>
(function () {
    const type = document.getElementById("type");
    const fileField = document.getElementById("fileField");
    const urlField = document.getElementById("urlField");
    const form = document.getElementById("materialForm");
    const alertBox = document.getElementById("materialAlert");

    function syncFields() {
        const isLink = type.value === "link";
        fileField.hidden = !type.value || isLink;
        urlField.hidden = !isLink;
        document.getElementById("file").required = Boolean(type.value && !isLink);
        document.getElementById("url").required = isLink;
    }

    type.addEventListener("change", syncFields);
    syncFields();

    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        const response = await fetch(form.action, {
            method: "POST",
            headers: { "X-Requested-With": "XMLHttpRequest", "Accept": "application/json" },
            body: new FormData(form)
        });

        if (response.ok) {
            alertBox.innerHTML = '<div class="alert alert-success panel-alert">Material uploaded successfully.</div>';
            form.reset();
            syncFields();
            return;
        }

        alertBox.innerHTML = '<div class="alert alert-danger panel-alert">Please check the form and try again.</div>';
    });
})();
</script>
@endsection
