@extends('layouts.admin')

@section('title')
    Admin - Lowongan
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/notifier.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/uikit.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}"/>
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
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Pendaftaran {{ $lowongan->name }}</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <div class="container mt-4">
          <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('karyawan.view-lowongan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="">File CV</label>
                        <input type="file" class="form-control" name="file_cv">
                    </div>

                    <div class="mb-3">
                        <label for="">Surat Lamaran</label>
                        <textarea name="surat_lamaran" id="" cols="30" class="form-control" rows="10"></textarea>
                    </div>

                    <input type="hidden" value="{{ $lowongan->id_lowongan }}" name="id_lowongan">
                    <button class="btn btn-primary text-end" type="submit">Submit</button>
                </form>
            </div>
          </div>
      </div>

      <!-- [ Main Content ] end -->
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
    <script src="{{ asset('assets/js/plugins/notifier.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>

    <script type="text/javascript">

        const detailsRoute = "{{ route('karyawan.lowongan.details', ['id' => '__ID__']) }}";
        $(document).ready(function() {
            $('.select-custome').select2({
                dropdownParent: $('#lowongan-add-modal'),
                width: 'resolve'
            });

            const _token = $('meta[name="csrf-token"]').attr("content");

            $("#save-lowongan").click(function(e) {
                e.preventDefault();

                const nama = $("#add-name").val();
                const posisi = $("#add-posisi").val();
                const lokasi = $("#add-lokasi").val();
                const deskripsi = $("#add-deskripsi").val();
                const kualifikasi = $("#add-kualifikasi").val();
                const tanggal = $("#add-tanggal").val();
                const kontak = $("#add-kontak").val();

                $.ajax({
                    url: "{{ route('karyawan.lowongan.store') }}",
                    type: "POST",
                    data: {
                        name: nama,
                        posisi: posisi,
                        lokasi: lokasi,
                        deskripsi: deskripsi,
                        kualifikasi: kualifikasi,
                        tanggal: tanggal,
                        kontak: kontak,
                        _token: _token
                    },
                    success: function(response) {
                        if (response.isModalClose) {
                            $("#add-name").val("");
                            $("#add-posisi").val("");
                            $("#add-lokasi").val("");
                            $("#add-deskripsi").val("");
                            $("#add-kualifikasi").val("");
                            $("#add-tanggal").val("");
                            $("#add-kontak").val("");
                            table.ajax.reload(null, false);
                            notifier.show(
                                response.label,
                                response.message,
                                response.type,
                                response.image,
                                response.time
                            );
                        } else {
                            notifier.show(
                                response.label,
                                response.message,
                                response.type,
                                response.image,
                                response.time
                            );
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = "Terjadi kesalahan:\n";
                        $.each(errors, function(key, value) {
                            errorMsg += value[0] + "\n";
                        });
                        alert(errorMsg);
                    }
                });
            });

            $(document).on("click", ".delete-lowongan-btn", function () {
                const lowonganId = $(this).data("id");
                $("#delete-lowongan-id").val(lowonganId);
                $("#confirmDeleteModal").modal("show");
            });

            $("#confirm-delete").click(function() {
                const lowonganId = $("#delete-lowongan-id").val();

                $.ajax({
                    url: "{{ route('karyawan.lowongan.delete') }}",
                    type: "POST",
                    data: {
                        _token: _token,
                        id: lowonganId
                    },
                    success: function(response) {
                        if (response.isModalClose) {
                            $("#confirmDeleteModal").modal("hide");
                            notifier.show(
                                response.label,
                                response.message,
                                response.type,
                                response.image,
                                response.time
                            );
                            table.ajax.reload(null, false);
                        } else {
                            notifier.show(
                                response.label,
                                response.message,
                                response.type,
                                response.image,
                                response.time
                            );
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan!");
                    }
                });
            });

            const table = $("#lowongan-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('karyawan.lowongan.index') }}",
                searching: true,
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    {
                      data: "name",
                      name: "name",
                      searchable: true,
                    },
                    { 
                      data: "posisi", 
                      name: "posisi", 
                      searchable: true,
                    },
                    {
                      data: "kontak",
                      name: "kontak",
                      searchable: true,
                    },
                    {
                        data: "id_lowongan",
                        name: "id_lowongan",
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            let detailUrl = detailsRoute.replace('__ID__', data);
                            return `
                                <ul class="list-inline me-auto mb-0">
                                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="View">
                                        <a href="${detailUrl}" class="btn btn-sm btn-light-warning edit-karyawan-btn" data-id="${data}">
                                            <i class="ti ti-edit-circle f-18"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                                        <a href="#" class="btn btn-sm btn-light-danger delete-lowongan-btn"
                                            data-id="${data}" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal">
                                                <i class="ti ti-trash f-18"></i>
                                        </a>
                                    </li>
                                </ul>
                            `;
                        },
                    },
                ],
            });


          });
    </script>
@endsection
