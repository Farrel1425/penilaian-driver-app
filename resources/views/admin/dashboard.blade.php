<x-layouts.admin title="Dashboard">
    @include('admin.partials.report-filter', ['filters' => $filters, 'branches' => $branches])

    <div class="stat-grid">
        <x-admin.stat-card label="Total Penilaian" :value="$data['stats']['total_assessments']" note="Sesuai filter" />
        <x-admin.stat-card label="Rating Driver" :value="$data['stats']['average_driver_rating'] ?? '-'" note="Hanya skala 1-5" />
        <x-admin.stat-card label="Rating Kendaraan" :value="$data['stats']['average_vehicle_rating'] ?? '-'" note="Hanya skala 1-5" />
        <x-admin.stat-card label="Penilaian Hari Ini" :value="$data['stats']['today_assessments']" note="Tanggal hari ini" />
    </div>

    <div class="dashboard-grid">
        <x-admin.panel title="Trend Rating"><div class="chart-panel">@include('admin.partials.trend', ['trend' => $data['trend']])</div></x-admin.panel>
        <x-admin.panel title="Distribusi Rating">@include('admin.partials.distribution', ['distribution' => $data['distribution']])</x-admin.panel>
    </div>

    <div class="dashboard-grid dashboard-grid-wide">
        <x-admin.panel title="Penilaian Terbaru"><div class="table-wrap"><table class="data-table compact"><thead><tr><th>Waktu</th><th>Driver</th><th>Kendaraan</th><th>Cabang</th></tr></thead><tbody>@forelse($data['latestRatings'] as $rating)<tr><td>{{ $rating->submitted_at?->format('d M Y H:i') }}</td><td>{{ $rating->driver?->full_name }}</td><td>{{ $rating->vehicle?->police_number }}</td><td>{{ $rating->branch?->name }}</td></tr>@empty<tr><td colspan="4"><x-admin.empty-state title="Belum ada penilaian" /></td></tr>@endforelse</tbody></table></div></x-admin.panel>
        <x-admin.panel title="Statistik Cabang"><div class="ranking-list">@forelse($data['branchStats'] as $row)<div><strong>{{ $row['branch'] }}</strong><span>{{ $row['total'] }} penilaian · Avg {{ $row['average'] ?? '-' }}</span></div>@empty<x-admin.empty-state title="Belum ada statistik cabang" />@endforelse</div></x-admin.panel>
    </div>

    <div class="dashboard-grid">
        <x-admin.panel title="Ranking Driver"><div class="ranking-list">@forelse($data['driverRanking'] as $row)<div><strong>{{ $row['name'] }}</strong><span>{{ $row['branch'] }} · Avg {{ $row['average'] ?? '-' }} · {{ $row['total'] }} penilaian</span></div>@empty<x-admin.empty-state title="Belum ada ranking driver" />@endforelse</div></x-admin.panel>
        <x-admin.panel title="Ranking Kendaraan"><div class="ranking-list">@forelse($data['vehicleRanking'] as $row)<div><strong>{{ $row['name'] }}</strong><span>{{ $row['label'] }} · Avg {{ $row['average'] ?? '-' }} · {{ $row['total'] }} penilaian</span></div>@empty<x-admin.empty-state title="Belum ada ranking kendaraan" />@endforelse</div></x-admin.panel>
    </div>
</x-layouts.admin>
