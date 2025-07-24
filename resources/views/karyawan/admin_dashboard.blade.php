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

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center my-2" style="width: 100%;">
                                <div>
                                    <h5 class="card-title">Progress Karyawan</h5>
                                    <a type="button" href="{{ route('karyawan.admin.exportDashboardAdmin') }}" class="btn btn-success me-3">Export</a>
                                </div>

                                <!-- Filter tanggal dan tombol -->
                                <div class="d-flex align-items-center ms-auto" style="width: 40%;">
                                    <input type="date" id="filter_awal" name="filter_awal" class="form-control" placeholder="Tanggal awal">
                                    <div class="px-3">-</div>
                                    <input type="date" id="filter_akhir" name="filter_akhir" class="form-control" placeholder="Tanggal akhir">
                                    <button type="button" id="filter-progress" class="btn btn-primary ms-2" style="border-radius: 10px;">
                                        <i class="ti ti-filter"></i>
                                    </button>
                                </div>
                            </div>
                            <canvas id="combined-chart" height="100"></canvas>
                        </div>

                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <a type="button" href="{{ route('karyawan.dashboard') }}" class="card border mb-0">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center justify-content-between gap-1">
                                                <h6 class="mb-0">Total Project</h6>
                                                <p class="mb-0 text-muted d-flex align-items-center gap-1">
                                                    Yang diikuti dan dibuat
                                                </p>
                                            </div>
                                            <div class="my-3">{{ " " }}</div>
                                            <div class="d-flex align-items-center gap-1">
                                                <h5 class="mb-0">{{ $projects->count() }}</h5>
                                                <p class="mb-0 text-muted d-flex align-items-center gap-2">Project</p>
                                            </div>
                                        </div>
                                    </a>
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
                                    <a type="button" href="{{ route('karyawan.project.details', ['id' => $project->id_project]) }}" class="col-12 ">
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
                                                <div class="d-flex align-items-center gap-1">
                                                    @foreach ($project->progress_summary as $statusProgress => $count)
                                                        <span class="badge bg-primary">
                                                            {{ $statusProgress }} : {{ $count }}
                                                        </span>
                                                    @endforeach
                                                 </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
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
                                <div class="table-responsive">
                                    <table class="table table-hover" id="dashboard-table-progress">
                                        <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th style="width: 30%">Nama Karyawan</th>
                                            <th style="width: 30%">Jumlah Client</th>
                                            <th style="width: 35%">Jumlah Follow Up Status</th>
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
<script>
let combinedChart = null;

$(document).ready(function () {
    const detailRoute = "{{ route('karyawan.project.details', ['id' => '__ID__']) }}";

    buildDatatableProject();
    buildDataTableProgress();
    buildChart();
    
    $('#filter-progress').on('click', function () {
        var filter_awal = $('#filter_awal').val();
        var filter_akhir = $('#filter_akhir').val();

        if (filter_awal !== '' && filter_akhir !== '') {
            // Destroy datatables if already initialized
            if ($.fn.dataTable.isDataTable('#dashboard-table')) {
                $('#dashboard-table').DataTable().clear().destroy();
                $('#dashboard-table colgroup').empty();
            }

            if ($.fn.dataTable.isDataTable('#dashboard-table-progress')) {
                $('#dashboard-table-progress').DataTable().clear().destroy();
                $('#dashboard-table-progress colgroup').empty();
            }   

            buildDatatableProject(filter_awal, filter_akhir);
            buildDataTableProgress(filter_awal, filter_akhir);
            buildChart(filter_awal, filter_akhir);

        } else {
            notifier.show(
                'Alert!',
                'Tanggal filter harus terisi!',
                'warning',
                false,
                '/assets/images/notification/high_priority-48.png',
                3000
            );
        }
    });

    function buildDatatableProject(filter_awal = '', filter_akhir = '') {
            $('#dashboard-table').attr('style', 'width: 100% !important');
        $("#dashboard-table").DataTable({
            destroy:true,
            processing: true,
            serverSide: true,
            ajax: {
                type: 'GET',
                url: "{{ route('karyawan.dashboard') }}",
                data: {
                    filter_awal: filter_awal,
                    filter_akhir: filter_akhir,
                }
            },
            searching: true,
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", searchable: false },
                { data: "nama_project", name: "nama_project", searchable: true },
                { data: "anggota_project_count", name: "anggota_project_count", searchable: true },
                { data: "progress_project_count", name: "progress_project_count", searchable: true },
                {
                    data: "id_project",
                    name: "id_project",
                    class: "text-center",
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
    }

    function buildDataTableProgress(filter_awal = '', filter_akhir = '') {
        $("#dashboard-table-progress").DataTable({
            destroy:true,
            processing: true,
            serverSide: true,
            ajax: {
                type: 'GET',
                url: "{{ route('karyawan.admin.requestDatatableKaryawan') }}",
                data: {
                    filter_awal: filter_awal,
                    filter_akhir: filter_akhir,
                }
            },
            searching: true,
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", searchable: false },
                { data: "nama_karyawan", name: "nama_karyawan", searchable: true },
                { data: "jumlah_client", name: "jumlah_client",
                    render: function(data, type, row, meta){
                        return `<a href='/karyawan/project?id_karyawan=${row.id_karyawan}'>${data}</a>`
                    }
                },
                { data: "jumlah_follow_up", name: "jumlah_follow_up",
                    render: function(data, type, row, meta){
                        return `<a href='/karyawan/admin/dashboard/follow-up/${row.id_karyawan}'>${data}</a>`
                    }
                }
            ],
        });
    }

    function buildChart(filter_awal = '', filter_akhir = '') {
        $.ajax({
            url: "{{ route('karyawan.admin.requestDataChart') }}",
            type: "GET",
            data: {
                filter_awal: filter_awal,
                filter_akhir: filter_akhir
            },
            success: function(response) {
                const ctx = document.getElementById('combined-chart').getContext('2d');
                const progressData = response.progressPerKaryawan;
                const statusColors = response.statusColors;

                const statusSet = new Set();
                const karyawanLabels = Object.keys(progressData);
                karyawanLabels.forEach(nama => {
                    Object.keys(progressData[nama]['data']).forEach(status => statusSet.add(status));
                });

                const statusLabels = Object.keys(statusColors);

                const datasets = statusLabels.map(status => ({
                    label: status,
                    data: karyawanLabels.map(nama => progressData[nama]?.data[status] || 0),
                    backgroundColor: statusColors[status] || '#ccc'
                }));

                if (combinedChart) {
                    combinedChart.destroy();
                }

                combinedChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: karyawanLabels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                            },
                        },
                        interaction: {
                            mode: 'nearest',
                            axis: 'x',
                            intersect: false
                        },
                        onClick: function (evt, activeElements) {
                            if (activeElements.length > 0) {
                                const element = activeElements[0];
                                const datasetIndex = element.datasetIndex;
                                const index = element.index;

                                const namaKaryawan = this.data.labels[index];
                                const status = this.data.datasets[datasetIndex].label;

                                const statusId = progressData[namaKaryawan]?.status_ids[status];
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
