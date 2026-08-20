@props([
    'name',
    'label',
    'value' => null,
    'folder' => 'images',
    'defaultRatio' => 'free',
])

@php
    $inputId = 'image-cropper-'.str($name)->replace('_', '-').'-'.str()->random(8);
    $previewUrl = $value
        ? (Str::startsWith($value, ['http://', 'https://', '/']) ? $value : asset('storage/'.$value))
        : null;
@endphp

<div class="image-cropper-field" data-image-cropper data-default-ratio="{{ $defaultRatio }}">
    <div class="image-cropper-label-row">
        <label for="{{ $inputId }}">{{ $label }}</label>
        <span>Opsional</span>
    </div>

    <div class="image-cropper-summary">
        <div class="image-cropper-preview" data-image-preview>
            @if ($previewUrl)
                <img src="{{ $previewUrl }}" alt="Preview {{ strtolower($label) }}">
            @else
                <x-lucide-image aria-hidden="true" />
            @endif
        </div>
        <div class="image-cropper-summary-copy">
            <strong data-image-file-name>{{ $previewUrl ? 'Foto saat ini' : 'Belum ada foto' }}</strong>
            <span>JPG, PNG, atau WEBP. Maksimal 4 MB.</span>
        </div>
        <div class="image-cropper-summary-actions">
            <button type="button" class="image-cropper-action" data-image-select><x-lucide-upload aria-hidden="true" /> Pilih Foto</button>
            <button type="button" class="image-cropper-camera-button" data-image-camera><x-lucide-camera aria-hidden="true" /> Ambil Foto</button>
        </div>
    </div>

    <input id="{{ $inputId }}" name="{{ $name }}" type="file" accept="image/jpeg,image/png,image/webp" class="sr-only" data-image-input>
    <input type="file" accept="image/*" capture="environment" class="sr-only" data-camera-input>
    @error($name)<span class="form-error">{{ $message }}</span>@enderror

    <div class="image-cropper-modal" data-image-modal hidden>
        <div class="image-cropper-modal-backdrop" data-image-close></div>
        <section class="image-cropper-dialog" role="dialog" aria-modal="true" aria-labelledby="{{ $inputId }}-title">
            <div class="image-cropper-dialog-header">
                <div>
                    <h2 id="{{ $inputId }}-title">Atur Foto</h2>
                    <p>Geser gambar untuk menentukan area yang ditampilkan.</p>
                </div>
                <button type="button" class="image-cropper-close" data-image-close aria-label="Tutup editor foto"><x-lucide-x /></button>
            </div>

            <div class="image-cropper-stage" data-image-stage>
                <img data-cropper-image alt="Atur area foto">
                <div class="image-camera-stage" data-camera-stage hidden>
                    <video data-camera-video autoplay playsinline></video>
                    <p data-camera-message>Kamera sedang disiapkan...</p>
                </div>
            </div>

            <div class="image-cropper-controls" data-cropper-controls>
                <label for="{{ $inputId }}-ratio">Bentuk crop</label>
                <select id="{{ $inputId }}-ratio" data-cropper-ratio>
                    <option value="free">Bebas</option>
                    <option value="1">Kotak (1:1)</option>
                    <option value="0.75">Potret (3:4)</option>
                    <option value="1.7777778">Lanskap (16:9)</option>
                </select>
                <label for="{{ $inputId }}-zoom">Zoom</label>
                <input id="{{ $inputId }}-zoom" type="range" min="-0.3" max="0.7" value="0" step="0.01" data-cropper-zoom>
                <button type="button" class="image-cropper-text-button" data-cropper-reset>Atur Ulang</button>
            </div>

            <div class="image-cropper-camera-actions" data-camera-actions hidden>
                <button type="button" class="secondary-button" data-camera-retry>Ganti Kamera</button>
                <button type="button" class="primary-button" data-camera-capture><x-lucide-aperture aria-hidden="true" /> Ambil Gambar</button>
            </div>

            <div class="image-cropper-dialog-actions" data-cropper-actions>
                <button type="button" class="secondary-button" data-image-close>Batal</button>
                <button type="button" class="primary-button" data-cropper-apply>Simpan Crop</button>
            </div>
        </section>
    </div>
</div>
