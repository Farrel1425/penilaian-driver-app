<form class="filter-bar report-filter" method="GET">
    <input type="date" name="start_date" value="{{ $filters->startDate?->toDateString() }}">
    <input type="date" name="end_date" value="{{ $filters->endDate?->toDateString() }}">
    <select name="branch_id"><option value="">Semua cabang</option>@foreach($branches as $branch)<option value="{{ $branch->id }}" @selected($filters->branchId === $branch->id)>{{ $branch->name }}</option>@endforeach</select>
    <button class="secondary-button" type="submit">Terapkan</button>
    <a class="text-button" href="{{ url()->current() }}">Reset</a>
</form>