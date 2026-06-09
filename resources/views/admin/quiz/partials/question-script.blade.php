@php
    $seedQuestions = $questions->map(function($q) {
        return [
        'question_text' => $q->question_text,
        'option1' => $q->option1,
        'option2' => $q->option2,
        'option3' => $q->option3,
        'option4' => $q->option4,
        'correct_option' => $q->correct_option,
        ];
    })->values();
@endphp
<script>
const questionsRoot = document.getElementById('questions');
const seedQuestions = @json($seedQuestions);
let questionIndex = 0;
function escapeAttr(value) {
    return String(value || '').replaceAll('&', '&amp;').replaceAll('"', '&quot;').replaceAll('<', '&lt;').replaceAll('>', '&gt;');
}
function escapeText(value) {
    return String(value || '').replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;');
}
function addQuestion(data = {}) {
    const index = questionIndex++;
    const card = document.createElement('div');
    card.className = 'question-editor';
    card.innerHTML = `
        <div class="field field-wide"><label>Question</label><textarea name="questions[${index}][question_text]" rows="2" required>${escapeText(data.question_text)}</textarea></div>
        <div class="field"><label>Option 1</label><input name="questions[${index}][option1]" value="${escapeAttr(data.option1)}" required></div>
        <div class="field"><label>Option 2</label><input name="questions[${index}][option2]" value="${escapeAttr(data.option2)}" required></div>
        <div class="field"><label>Option 3</label><input name="questions[${index}][option3]" value="${escapeAttr(data.option3)}" required></div>
        <div class="field"><label>Option 4</label><input name="questions[${index}][option4]" value="${escapeAttr(data.option4)}" required></div>
        <div class="field"><label>Correct Option</label><select name="questions[${index}][correct_option]" required>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
        </select></div>
        <button type="button" class="icon-btn danger remove-question"><i class="fas fa-trash"></i></button>
    `;
    questionsRoot.appendChild(card);
    card.querySelector('select').value = data.correct_option || 'option1';
    card.querySelector('.remove-question').addEventListener('click', () => card.remove());
}
document.getElementById('addQuestion').addEventListener('click', () => addQuestion());
(seedQuestions.length ? seedQuestions : [{}]).forEach(addQuestion);
</script>
