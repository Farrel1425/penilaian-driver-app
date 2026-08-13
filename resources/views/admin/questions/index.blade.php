<x-layouts.admin title="Master Pertanyaan">
    <x-admin.page-header title="Master Pertanyaan" description="Kelola pertanyaan penilaian driver dan kendaraan.">
        <a class="primary-button" href="{{ route('admin.questions.create') }}">Tambah Pertanyaan</a>
    </x-admin.page-header>

    <x-admin.flash />

    <x-admin.panel>
        <form class="filter-bar filter-bar-wide" method="GET" action="{{ route('admin.questions.index') }}">
            <input name="search" value="{{ request('search') }}" placeholder="Cari pertanyaan">
            <select name="target_type"><option value="">Semua target</option><option value="driver" @selected(request('target_type') === 'driver')>Driver</option><option value="vehicle" @selected(request('target_type') === 'vehicle')>Kendaraan</option></select>
            <select name="answer_type"><option value="">Semua tipe</option><option value="rating" @selected(request('answer_type') === 'rating')>Rating</option><option value="yes_no" @selected(request('answer_type') === 'yes_no')>Ya/Tidak</option><option value="multiple_choice" @selected(request('answer_type') === 'multiple_choice')>Pilihan Ganda</option><option value="checkbox" @selected(request('answer_type') === 'checkbox')>Checkbox</option><option value="short_text" @selected(request('answer_type') === 'short_text')>Jawaban Singkat</option><option value="paragraph" @selected(request('answer_type') === 'paragraph')>Paragraf</option></select>
            <select name="status"><option value="">Semua status</option><option value="active" @selected(request('status') === 'active')>Aktif</option><option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option></select>
            <button class="secondary-button" type="submit">Filter</button><a class="text-button" href="{{ route('admin.questions.index') }}">Reset</a>
        </form>

        <div class="table-wrap"><table class="data-table"><thead><tr><th>No</th><th>Pertanyaan</th><th>Target</th><th>Tipe Jawaban</th><th>Wajib</th><th>Urutan</th><th>Status</th><th>Action</th></tr></thead><tbody>
            @forelse($questions as $question)
                <tr>
                    <td>{{ $questions->firstItem() + $loop->index }}</td>
                    <td><strong>{{ $question->question }}</strong><small>{{ $question->options_count }} opsi</small></td>
                    <td>{{ $question->target_type === 'driver' ? 'Driver' : 'Kendaraan' }}</td>
                    <td>{{ str($question->answer_type)->replace('_', ' ')->title() }}</td>
                    <td>{{ $question->is_required ? 'Wajib' : 'Opsional' }}</td>
                    <td>{{ $question->sort_order }}</td>
                    <td><x-admin.status-badge :tone="$question->status === 'active' ? 'success' : 'neutral'">{{ $question->status === 'active' ? 'Aktif' : 'Nonaktif' }}</x-admin.status-badge></td>
                    <td><x-admin.row-actions><a href="{{ route('admin.questions.show', $question) }}">Detail</a><a href="{{ route('admin.questions.edit', $question) }}">Edit</a></x-admin.row-actions></td>
                </tr>
            @empty
                <tr><td colspan="8"><x-admin.empty-state title="Belum ada pertanyaan" description="Tambahkan pertanyaan agar form penilaian dapat dibangun dari database." /></td></tr>
            @endforelse
        </tbody></table></div>{{ $questions->links() }}
    </x-admin.panel>
</x-layouts.admin>