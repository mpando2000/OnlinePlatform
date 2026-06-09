<input type="hidden" name="quiz_type" value="questions">
<div class="form-grid">
    <div class="field">
        <label>Title</label>
        <input type="text" name="title" value="{{ old('title', optional($quiz)->title) }}" required>
    </div>
    <div class="field">
        <label>Duration Minutes</label>
        <input type="number" name="duration" value="{{ old('duration', optional($quiz)->duration ?? 30) }}" min="1" required>
    </div>
    <div class="field">
        <label>Class</label>
        <select name="class_id" required>
            <option value="">Select Class</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}" @selected((string) old('class_id', optional($quiz)->class_id) === (string) $class->id)>{{ $class->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="field">
        <label>Subject</label>
        <select name="subject_id" required>
            <option value="">Select Subject</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" @selected((string) old('subject_id', optional($quiz)->subject_id) === (string) $subject->id)>{{ $subject->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="field">
        <label>Start Time</label>
        <input type="datetime-local" name="start_time" value="{{ old('start_time', optional(optional($quiz)->start_time)->format('Y-m-d\\TH:i')) }}" required>
    </div>
    <div class="field">
        <label>End Time</label>
        <input type="datetime-local" name="end_time" value="{{ old('end_time', optional(optional($quiz)->end_time)->format('Y-m-d\\TH:i')) }}" required>
    </div>
    <div class="field field-wide">
        <label>Description</label>
        <textarea name="description" rows="3" required>{{ old('description', optional($quiz)->description) }}</textarea>
    </div>
</div>
