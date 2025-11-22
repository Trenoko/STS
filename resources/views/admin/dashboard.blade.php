@extends('admin.layout')

@section('content')
<div class="bg-[#F5F5F5] rounded-xl p-6">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Chart Card -->
        <div class="lg:col-span-3 bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">User Register</h2>
            </div>
            <div class="h-72">
                <canvas id="visitsChart"></canvas>
            </div>
        </div>

        <!-- Stats Column -->
        <div class="space-y-4">
            <!-- Total User -->
            <div class="bg-white rounded-xl shadow-sm p-4 flex flex-col justify-between h-24">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-xs text-gray-500 flex items-center gap-1">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-gray-700">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </span>
                        <span>Total User</span>
                    </span>
                </div>
                <div class="text-2xl font-bold text-gray-900 leading-none">
                    {{ number_format($totalUsers, 0, ',', '.') }}
                </div>
            </div>

            <!-- Top Menu -->
            <div class="bg-white rounded-xl shadow-sm p-4 h-24 flex flex-col justify-center">
                <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-gray-700">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                    </span>
                    <span>Top Menu</span>
                </div>
                <div class="text-sm font-semibold text-gray-900 truncate">
                    {{ $topMenu ? $topMenu->title : '-' }}
                </div>
                @if($topMenu)
                    <div class="text-[11px] text-gray-500">{{ $topMenu->views }} views • {{ $topMenu->favorites }} favorites</div>
                @endif
            </div>

            <!-- Total Menu -->
            <div class="bg-white rounded-xl shadow-sm p-4 h-24 flex flex-col justify-center">
                <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-gray-700">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75-1.5.75a3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0L3 16.5m15-3.379a48.474 48.474 0 0 0-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 0 1 3 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 0 1 6 13.12M12.265 3.11a.375.375 0 1 1-.53 0L12 2.845l.265.265Zm-3 0a.375.375 0 1 1-.53 0L9 2.845l.265.265Zm6 0a.375.375 0 1 1-.53 0L15 2.845l.265.265Z" />
                        </svg>
                    </span>
                    <span>Total Menu</span>
                </div>
                <div class="text-2xl font-bold text-gray-900 leading-none">
                    {{ number_format($totalMenu, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('visitsChart').getContext('2d');
    const labels = {!! json_encode($chartLabels) !!};
    const data = {!! json_encode($chartData) !!};
    const visitsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'User Register',
                data: data,
                fill: true,
                borderColor: '#76C37D',
                backgroundColor: 'rgba(34, 197, 94, 0.15)',
                tension: 0.4,
                borderWidth: 2,
                pointRadius: 0
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#6b7280', font: { size: 11 } }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#e5e7eb' },
                    ticks: { stepSize: 500, color: '#6b7280', font: { size: 11 } }
                }
            }
        }
    });
</script>
@endsection
