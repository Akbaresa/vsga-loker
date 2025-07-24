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
                <h2 class="mb-0">Daftar Loker</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->


      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card table-card">
            <div class="card-body">
              <div class="text-end p-4 pb-sm-2">
                <a
                  class="btn btn-primary d-inline-flex align-items-center gap-2 text-white"
                  data-bs-toggle="modal"
                  data-bs-target="#lowongan-add-modal"
                >
                  <i class="ti ti-plus f-18"></i> Loker baru
                </a>
              </div>
              <div class="table-responsive mx-4">
                <table class="table table-hover mb-4" id="lowongan-table">
                  <thead>
                    <tr>
                      <th width="8%">No</th>
                      <th width="20%">Nama Perusahaan</th>
                      <th width="12%">Posisi</th>
                      <th width="10%">Contact Perusahaan</th>
                      <th width="10%" class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>

  {{-- lowongan add modal --}}
  <div class="modal fade" id="lowongan-add-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="mb-0">Tambah lowongan</h5>
          <a href="#" class="avtar avtar-s btn-link-danger btn-pc-default ms-auto" data-bs-dismiss="modal">
            <i class="ti ti-x f-20"></i>
          </a>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="mb-3 position-relative">
                <label class="form-label">Nama Perusahaan</label>
                <input id="add-name"
                      name="nama"
                      type="text"
                      class="form-control"
                      placeholder="Masukkan Nama" />
              </div>

              <div class="mb-3">
                <label class="form-label">Posisi Yang Dibutuhkan</label>
                <input id="add-posisi"
                    name="nama"
                    type="text"
                    class="form-control"
                    placeholder="Masukkan Posisi" />
              </div>
              <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <input id="add-lokasi"
                    name="nama"
                    type="text"
                    class="form-control"
                    placeholder="Masukkan Lokasi" />
              </div>
              <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" id="add-deskripsi"></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Kualifikasi</label>
                <input id="add-kualifikasi"
                    name="nama"
                    type="text"
                    class="form-control"
                    placeholder="Masukkan Kualifikasi" />
              </div>
              <div class="mb-3">
                <label class="form-label">Tanggal Kadaluarsa</label>
                <input id="add-tanggal" type="date" class="form-control" />
              </div>
              <div class="mb-3">
                <label class="form-label">Kontak Perusahaan</label>
                <input id="add-kontak"
                    name="nama"
                    type="text"
                    class="form-control"
                    placeholder="Masukkan Kontak Perusahaan" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <div class="flex-grow-1 text-end">
            <button type="button" class="btn btn-link-danger btn-pc-default" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="save-lowongan" data-bs-dismiss="modal">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- lowongan delete modal --}}
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                <input type="hidden" id="delete-lowongan-id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">Hapus</button>
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
