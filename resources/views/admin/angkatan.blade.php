@extends('layout.base',['title' => "$title"])
@section('content')

<div class="container-fluid py-4">
    @if (Session::has('success'))
    <div class="alert alert-success text-white">
        {{ Session::get('success') }}
    </div>
    @endif
    <div class="row">
        <div class="col-5">
            <div class="card mb-2">
                <div class="card-header pb-0">
                    <h6 class="text-center">Tambah Angkatan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.angkatan') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="thn_angkatan">Angkatan</label>
                                    <input type="text" class="form-control" id="thn_angkatan" name="thn_angkatan" placeholder="Masukan Angkatan" >
                                </div>
                                <div class="form-group">
                                    <label for="full_name">Status Angkatan</label>
                                    <select name="is_active" id="is_active" class="form-select">
                                        <option value="1">Active</option>
                                        <option value="0"> Non Active</option>
                                    </select>
                                </div>
                                <div class="sidenav-footer">
                                    <br>
                                    <button type="submit" class="btn bg-gradient-info btn mb-0 w-100">Simpan</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6 class="text-center">Angkatan</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="dataTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Angkatan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($angkatan as $no => $item)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    {{ $no+1 }}
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        {{-- <div>
                          <img src="https://api.dicebear.com/5.x/pixel-art/svg?seed=7216" class="avatar avatar-sm me-3" alt="user1">
                        </div> --}}
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs text-secondary mb-0">{{ $item->thn_angkatan }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  @if ($item->is_active == 1)
                                  <span class="badge badge-sm bg-gradient-success">Active</span>
                                  @else
                                  <span class="badge badge-sm bg-gradient-success">Non Active</span>
                                      
                                  @endif
                                </td>
                                <td class="d-flex">
                                    <a class="btn  btn-sm bg-gradient-danger text-white px-3 mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-notification{{ $item->id }}"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                    <div class="col-md-1">
                                        <div class="modal fade" id="modal-notification{{  $item->id  }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-info">
                                                        <h6 class="modal-title text-white" id="modal-title-notification">Hapus Angkatan</h6>
                                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="angkatan/delete/{{ $item->id }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="py-3 text-center">
                                                                <i class="ni ni-bell-55 ni-3x text-warning"></i><br>
                                                                <h7 class="text-gradient text-danger">Apakah kamu yakin, ingin menghapus data ini <b>?</b></h7>
                                                                {{-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> --}}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info">Ya, Hapus</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn btn-sm bg-gradient-info text-white px-3 mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" data-original-title="Edit user"><i class="fas fa-pencil-alt me-2" aria-hidden="true"></i>Edit</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-gradient-info">
                                                    <h5 class="modal-title text-white" id="editModalLabel">Edit Topik</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{  route('update.angkatan', $item->id)  }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="thn_angkatan">Nama Angkatan</label>
                                                            <input type="month" class="form-control" id="thn_angkatan" name="thn_angkatan" placeholder="Masukan Angkatan" value="{{ $item->thn_angkatan }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="full_name">Status Angkatan</label>
                                                            <select name="is_active" id="is_active" class="form-select">
                                                                <option value="{{ $item->is_active }}">
                                                                    @if ($item->is_active == 1)
                                                                    <span class="badge badge-sm bg-gradient-success">Active</span>
                                                                    @else
                                                                    <span class="badge badge-sm bg-gradient-success">Non Active</span>
                                                                        
                                                                    @endif</option>
                                                                <option value="1">Active</option>
                                                                <option value="0"> Non Active</option>
                                                            </select>
                                                          </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-sm bg-gradient-info">Simpan</button>
                                                            <button type="button" class="btn btn-sm bg-gradient-secondary" data-bs-dismiss="modal">Kembali</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
