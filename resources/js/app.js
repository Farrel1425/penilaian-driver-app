document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-sidebar-toggle]');
    const sidebar = document.querySelector('[data-admin-sidebar]');

    toggle?.addEventListener('click', () => {
        sidebar?.classList.toggle('is-open');
    });
});

const renderQuestionPreview = () => {
    const preview = document.querySelector('[data-question-preview]');
    const questionInput = document.querySelector('[data-question-input]');
    const answerTypeInput = document.querySelector('[data-answer-type]');
    const body = document.querySelector('[data-preview-body]');
    const title = document.querySelector('[data-preview-question]');
    const optionBuilder = document.querySelector('[data-option-builder]');

    if (!preview || !questionInput || !answerTypeInput || !body || !title) {
        return;
    }

    const options = [...document.querySelectorAll('[data-option-text]')]
        .map((input) => input.value.trim())
        .filter(Boolean);

    const optionLabels = options.length ? options : ['Opsi jawaban'];
    const type = answerTypeInput.value;

    title.textContent = questionInput.value.trim() || 'Bagaimana keramahan driver?';
    optionBuilder?.classList.toggle('is-hidden', !['multiple_choice', 'checkbox'].includes(type));

    if (type === 'rating') {
        body.innerHTML = '<div class="rating-preview"><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span></div>';
        return;
    }

    if (type === 'yes_no') {
        body.innerHTML = '<div class="choice-preview"><label><input type="radio" disabled> Ya</label><label><input type="radio" disabled> Tidak</label></div>';
        return;
    }

    if (type === 'multiple_choice' || type === 'checkbox') {
        const inputType = type === 'multiple_choice' ? 'radio' : 'checkbox';
        body.innerHTML = `<div class="choice-preview">${optionLabels.map((option) => `<label><input type="${inputType}" disabled> ${option}</label>`).join('')}</div>`;
        return;
    }

    if (type === 'paragraph') {
        body.innerHTML = '<textarea class="preview-input" rows="4" placeholder="Jawaban paragraf" disabled></textarea>';
        return;
    }

    body.innerHTML = '<input class="preview-input" type="text" placeholder="Jawaban singkat" disabled>';
};

document.addEventListener('DOMContentLoaded', () => {
    const optionList = document.querySelector('[data-option-list]');
    const addOption = document.querySelector('[data-add-option]');

    document.querySelector('[data-question-input]')?.addEventListener('input', renderQuestionPreview);
    document.querySelector('[data-answer-type]')?.addEventListener('change', renderQuestionPreview);
    optionList?.addEventListener('input', renderQuestionPreview);
    optionList?.addEventListener('click', (event) => {
        const remove = event.target.closest('[data-remove-option]');
        if (!remove) return;
        remove.closest('[data-option-row]')?.remove();
        renderQuestionPreview();
    });
    addOption?.addEventListener('click', () => {
        const index = optionList?.querySelectorAll('[data-option-row]').length ?? 0;
        const row = document.createElement('div');
        row.className = 'option-row';
        row.dataset.optionRow = '';
        row.innerHTML = `<input type="text" name="options[${index}][option_text]" placeholder="Opsi jawaban" data-option-text><input type="number" name="options[${index}][sort_order]" value="${index + 1}" min="0" aria-label="Urutan opsi"><button class="icon-inline-button" type="button" data-remove-option aria-label="Hapus opsi">×</button>`;
        optionList?.appendChild(row);
        row.querySelector('[data-option-text]')?.focus();
        renderQuestionPreview();
    });

    renderQuestionPreview();
});