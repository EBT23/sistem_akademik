@extends('layouts.base',['title' => "$title"])
@section('content') 
<div class="container-fluid py-4">
    @if (Session::has('success'))
        <div class="alert alert-success text-white">
            {{ Session::get('success') }}
        </div>
    @endif
  <div class="row">
<div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6 class="text-center">Jadwal</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="dataTable" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Materi</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jam</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                <th class="text text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              {{-- @foreach ($teacher as $item) --}}
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="https://api.dicebear.com/5.x/pixel-art/svg?seed=7216" class="avatar avatar-sm me-3" alt="user1">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">Pengenalan</h6>
                      <p class="text-xs text-secondary mb-0">bahasa korea</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Jam</p>
                  <p class="text-xs text-secondary mb-0">08.00 s/d 15.00</p>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">Senin</span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-success">Online</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                </td>
                <td class="d-flex">
                  <a class="btn  btn-sm bg-gradient-warning text-white px-3 mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-notification"><i class="far fa-trash-alt me-2"></i>Delete</a>
                  <div class="col-md-1">
                    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                      <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-gradient-info">
                            <h6 class="modal-title text-white" id="modal-title-notification">Hapus Data Pengajar</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <form action="teacher-delete" method="POST">
                            @method('DELETE')
                            @csrf
                          <div class="modal-body">
                            <div class="py-3 text-center">
                              <i class="ni ni-bell-55 ni-3x text-warning"></i><br>
                              <h7 class="text-gradient text-danger">Apakah yakin kamu ingin menghapus Akun <b></b> !</h7>
                              {{-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> --}}
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-success">Ya, Hapus</button>
                            <button type="button" class="btn bg-gradient-warning text-white ml-auto" data-bs-dismiss="modal">Batal</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <a class="btn btn-sm bg-gradient-info text-white px-3 mb-0" href="javascript:;" data-toggle="tooltip" data-original-title="Edit user"><i class="fas fa-pencil-alt me-2" aria-hidden="true"></i>Edit</a>
                </td>
              </tr>
              {{-- @endforeach --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection