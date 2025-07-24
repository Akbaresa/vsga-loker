@extends('layouts.admin')

@section('title')
    Karyawan - Dashboard
@endsection

@section('pre-loader')
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
@endsection

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Dashboard</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                                <h5 class="card-title">Progress Karyawan </h5>
                                <canvas id="combined-chart" height="100"></canvas>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="card border mb-0">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center justify-content-between gap-1">
                                                <h6 class="mb-0">Total Project</h6>
                                                <p class="mb-0 text-muted d-flex align-items-center gap-1">
                                                    Yang diikuti dan dibuat
                                                </p>
                                            </div>
                                            <div class="my-3">{{ " " }}</div>
                                            <div class="d-flex align-items-center gap-1">
                                                <h5 class="mb-0">{{ $projectsCount }}</h5>
                                                <p class="mb-0 text-muted d-flex align-items-center gap-2">Project</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border mb-0">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center justify-content-between gap-1">
                                                <h6 class="mb-0">Project yang dibuat</h6>
                                            </div>
                                            <h5 class="my-3">{{ " " }}</h5>
                                            <div class="d-flex align-items-center gap-1">
                                                <h5 class="mb-0">{{ $createdProjectsCount }}</h5>
                                                <p class="mb-0 text-muted d-flex align-items-center gap-2">Project</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($projects as $project)
                                    <div class="col-12">
                                        <div class="card border mb-0">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center justify-content-between gap-1">
                                                    <h6 class="mb-0">{{ $project->nama_project }}</h6>
                                                    <p class="mb-0 text-muted d-flex align-items-center gap-1">
                                                        <svg class="pc-icon text-primary">
                                                            <use xlink:href="#custom-folder-open"></use>
                                                        </svg>
                                                    </p>
                                                </div>
                                                <div class="d-flex align-items-center gap-1 mt-2">
                                                    <h5 class="mb-0">{{ $project->anggota_project_count }}</h5>
                                                    <p class="mb-0 text-muted d-flex align-items-center gap-2">Anggota project</p>
                                                </div>
                                                <div class="d-flex align-items-center gap-1">
                                                    <h5 class="mb-0">{{ $project->progress_project_count }}</h5>
                                                    <p class="mb-0 text-muted d-flex align-items-center gap-2">Progress individu diserahkan</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover" id="dashboard-table">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Nama Project</th>
                                        <th>Jumlah Anggota</th>
                                        <th>Jumlah Progress Saya</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col my-1">
                    <p class="m-0">Loker Web &#9829; crafted with Zoltraak</p>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr.min.js') }}"></script>
    <script>
        let combinedChart = null;
        const detailRoute = "{{ route('karyawan.project.details', ['id' => '__ID__']) }}";
        const projects = @json($projects);
        $(document).ready(function () {
            buildChart();
            const table = $("#dashboard-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('karyawan.dashboard') }}",
                searching: true,
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex", searchable: false },
                    { data: "nama_project", name: "nama_project", searchable: true },
                    { data: "anggota_project_count", name: "anggota_project_count", searchable: true },
                    { data: "progress_project_count", name: "progress_project_count", searchable: true },
                    {
                        data: "id_project",
                        name: "id_project",
                        class : "text-center",
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            let detailUrl = detailRoute.replace('__ID__', data);
                            return `
                                <ul class="list-inline me-auto mb-0">
                                   <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Detail">
                                        <a href="${detailUrl}" class="btn btn-sm btn-light-primary" >
                                            <i class="ti ti-eye f-18"></i>
                                        </a>
                                   </li>
                                </ul>
                            `;
                        },
                    },
                ],
            });

            function buildChart(filter_awal = '', filter_akhir = '') {
                $.ajax({
                    url: "{{ route('karyawan.requestChartByKaryawan') }}",
                    type: "GET",
                    data: {
                        filter_awal: filter_awal,
                        filter_akhir: filter_akhir,
                    },
                    success: function(response) {
                        const ctx = document.getElementById('combined-chart').getContext('2d');

                        const statusLabels = Object.keys(response.statusData);
                        const statusCounts = Object.values(response.statusData);
                        const statusColors = statusLabels.map(status => response.statusColors[status] || '#ccc');
                        const statusIds = response.statusIds;

                        if (window.combinedChart) {
                            window.combinedChart.destroy();
                        }

                        const datasets = statusLabels.map(status => ({
                            label: status,
                            data: [response.statusData[status]],
                            backgroundColor: response.statusColors[status] || '#ccc'
                        }));

                        window.combinedChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Progress'],
                                datasets: datasets
                            },
                            options: {
                                responsive: true,
                                indexAxis: 'x',
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return `${context.dataset.label}: ${context.raw}`;
                                            }
                                        }
                                    },
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1,
                                            precision: 0
                                        }
                                    }
                                },
                                onClick: function (evt, activeElements) {
                                    if (activeElements.length > 0) {
                                        const datasetIndex = activeElements[0].datasetIndex;
                                        const status = this.data.datasets[datasetIndex].label;

                                        const statusId = statusIds[status]; // ambil ID dari nama status

                                        if (statusId) {
                                            const url = `/karyawan/laporan/progress?status_project=${encodeURIComponent(statusId)}`;
                                            window.location.href = url;
                                        }
                                    }
                                }
                            }
                        });

                    },
                    error: function () {
                        notifier.show(
                            'Error!',
                            'Gagal memuat data grafik!',
                            'danger',
                            false,
                            '/assets/images/notification/high_priority-48.png',
                            3000
                        );
                    }
                });
            }

        });
    </script>
@endsection
