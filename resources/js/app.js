import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-sidebar-toggle]');
    const sidebar = document.querySelector('[data-admin-sidebar]');
    const passwordToggle = document.querySelector('[data-password-toggle]');
    const passwordInput = document.querySelector('[data-password-input]');
    const profileMenu = document.querySelector('[data-profile-menu]');
    const profileTrigger = document.querySelector('[data-profile-trigger]');

    toggle?.addEventListener('click', () => {
        sidebar?.classList.toggle('is-open');
    });

    passwordToggle?.addEventListener('click', () => {
        const isVisible = passwordInput?.type === 'text';

        if (!passwordInput) {
            return;
        }

        passwordInput.type = isVisible ? 'password' : 'text';
        passwordToggle.classList.toggle('is-visible', !isVisible);
        passwordToggle.setAttribute('aria-pressed', String(!isVisible));
        passwordToggle.setAttribute('aria-label', isVisible ? 'Tampilkan password' : 'Sembunyikan password');
    });

    profileTrigger?.addEventListener('click', () => {
        const isOpen = profileMenu?.classList.toggle('is-open') ?? false;
        profileTrigger.setAttribute('aria-expanded', String(isOpen));
    });

    document.addEventListener('click', (event) => {
        if (profileMenu && !profileMenu.contains(event.target)) {
            profileMenu.classList.remove('is-open');
            profileTrigger?.setAttribute('aria-expanded', 'false');
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            profileMenu?.classList.remove('is-open');
            profileTrigger?.setAttribute('aria-expanded', 'false');
        }
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

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-image-cropper]').forEach((field) => {
        const imageInput = field.querySelector('[data-image-input]');
        const cameraInput = field.querySelector('[data-camera-input]');
        const pickerTrigger = field.querySelector('[data-image-open-picker]');
        const cameraButton = field.querySelector('[data-image-camera]');
        const modal = field.querySelector('[data-image-modal]');
        const cropImage = field.querySelector('[data-cropper-image]');
        const preview = field.querySelector('[data-image-preview]');
        const fileName = field.querySelector('[data-image-file-name]');
        const zoom = field.querySelector('[data-cropper-zoom]');
        const controls = field.querySelector('[data-cropper-controls]');
        const cropperActions = field.querySelector('[data-cropper-actions]');
        const stage = field.querySelector('[data-image-stage]');
        const cameraStage = field.querySelector('[data-camera-stage]');
        const cameraActions = field.querySelector('[data-camera-actions]');
        const cameraVideo = field.querySelector('[data-camera-video]');
        const cameraMessage = field.querySelector('[data-camera-message]');
        const sourcePicker = field.querySelector('[data-image-source-picker]');
        const dropZone = field.querySelector('[data-image-drop-zone]');
        let cropper;
        let stream;

        if (!imageInput || !modal || !cropImage || !preview || !fileName || !zoom) {
            return;
        }

        const stopCamera = () => {
            stream?.getTracks().forEach((track) => track.stop());
            stream = undefined;
            cameraVideo.srcObject = null;
        };

        const closeModal = () => {
            stopCamera();
            cropper?.destroy();
            cropper = undefined;
            modal.hidden = true;
            document.body.classList.remove('image-cropper-is-open');
        };

        const openModal = () => {
            modal.hidden = false;
            document.body.classList.add('image-cropper-is-open');
        };

        const selectedRatio = () => 1;

        const openPicker = () => {
            stopCamera();
            cropper?.destroy();
            cropper = undefined;
            sourcePicker.hidden = false;
            stage.hidden = true;
            cropImage.hidden = true;
            cameraStage.hidden = true;
            cameraActions.hidden = true;
            controls.hidden = true;
            cropperActions.hidden = true;
            openModal();
        };

        const updatePreview = (file) => {
            const image = document.createElement('img');
            image.src = URL.createObjectURL(file);
            image.alt = 'Preview foto yang dipilih';
            preview.replaceChildren(image);
            fileName.textContent = file.name;
        };

        const writeImageFile = (file) => {
            const transfer = new DataTransfer();
            transfer.items.add(file);
            imageInput.files = transfer.files;
        };

        const openEditor = (file) => {
            if (!file?.type.startsWith('image/')) {
                return;
            }

            stopCamera();
            cropper?.destroy();
            sourcePicker.hidden = true;
            stage.hidden = false;
            cameraStage.hidden = true;
            cameraActions.hidden = true;
            controls.hidden = false;
            cropperActions.hidden = false;
            cropImage.hidden = false;
            zoom.value = '0';
            openModal();

            const reader = new FileReader();
            reader.addEventListener('load', () => {
                cropImage.onload = () => {
                    cropper = new Cropper(cropImage, {
                        aspectRatio: selectedRatio(),
                        autoCropArea: 0.88,
                        background: false,
                        dragMode: 'move',
                        guides: true,
                        movable: true,
                        zoomable: true,
                        responsive: true,
                        viewMode: 1,
                    });
                };
                cropImage.src = reader.result;
            });
            reader.readAsDataURL(file);
        };

        const openCamera = async () => {
            if (!navigator.mediaDevices?.getUserMedia) {
                cameraInput?.click();
                return;
            }

            cropper?.destroy();
            cropper = undefined;
            openModal();
            sourcePicker.hidden = true;
            stage.hidden = false;
            cropImage.hidden = true;
            cameraStage.hidden = false;
            cameraActions.hidden = false;
            controls.hidden = true;
            cropperActions.hidden = true;
            cameraMessage.hidden = false;
            cameraMessage.textContent = 'Kamera sedang disiapkan...';

            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: { ideal: 'environment' } },
                    audio: false,
                });
                cameraVideo.srcObject = stream;
                await cameraVideo.play();
                cameraMessage.hidden = true;
            } catch {
                cameraMessage.textContent = 'Kamera tidak tersedia. Pilih foto dari perangkat Anda.';
            }
        };

        pickerTrigger?.addEventListener('click', openPicker);
        pickerTrigger?.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                openPicker();
            }
        });
        dropZone?.addEventListener('click', () => imageInput.click());
        dropZone?.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                imageInput.click();
            }
        });
        ['dragenter', 'dragover'].forEach((eventName) => {
            dropZone?.addEventListener(eventName, (event) => {
                event.preventDefault();
                dropZone.classList.add('is-dragging');
            });
        });
        ['dragleave', 'drop'].forEach((eventName) => {
            dropZone?.addEventListener(eventName, (event) => {
                event.preventDefault();
                dropZone.classList.remove('is-dragging');
            });
        });
        dropZone?.addEventListener('drop', (event) => {
            openEditor(event.dataTransfer?.files?.[0]);
        });
        cameraButton?.addEventListener('click', openCamera);
        imageInput.addEventListener('change', () => openEditor(imageInput.files?.[0]));
        cameraInput?.addEventListener('change', () => openEditor(cameraInput.files?.[0]));

        field.querySelectorAll('[data-image-close]').forEach((button) => {
            button.addEventListener('click', closeModal);
        });

        field.querySelector('[data-camera-retry]')?.addEventListener('click', () => {
            stopCamera();
            openCamera();
        });

        field.querySelector('[data-camera-capture]')?.addEventListener('click', () => {
            if (!cameraVideo.videoWidth || !cameraVideo.videoHeight) {
                return;
            }

            const canvas = document.createElement('canvas');
            canvas.width = cameraVideo.videoWidth;
            canvas.height = cameraVideo.videoHeight;
            canvas.getContext('2d')?.drawImage(cameraVideo, 0, 0);

            canvas.toBlob((blob) => {
                if (!blob) return;
                openEditor(new File([blob], 'foto-' + Date.now() + '.jpg', { type: 'image/jpeg' }));
            }, 'image/jpeg', 0.92);
        });

        zoom.addEventListener('input', () => cropper?.zoomTo(1 + Number(zoom.value)));
        field.querySelector('[data-cropper-reset]')?.addEventListener('click', () => {
            cropper?.reset();
            cropper?.setAspectRatio(selectedRatio());
            zoom.value = '0';
        });

        field.querySelector('[data-cropper-apply]')?.addEventListener('click', () => {
            const canvas = cropper?.getCroppedCanvas({
                fillColor: '#ffffff',
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
                maxHeight: 1600,
                maxWidth: 1600,
            });

            canvas?.toBlob((blob) => {
                if (!blob) return;
                const file = new File([blob], 'foto-crop-' + Date.now() + '.jpg', { type: 'image/jpeg' });
                writeImageFile(file);
                updatePreview(file);
                closeModal();
            }, 'image/jpeg', 0.9);
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-star-rating]').forEach((rating) => {
        const updateStars = (value) => {
            rating.querySelectorAll('label').forEach((label, index) => {
                label.classList.toggle('is-selected', index < Number(value));
            });
        };

        rating.addEventListener('change', (event) => {
            if (event.target instanceof HTMLInputElement) {
                updateStars(event.target.value);
            }
        });

        const selected = rating.querySelector('input:checked');
        if (selected instanceof HTMLInputElement) {
            updateStars(selected.value);
        }
    });
});
