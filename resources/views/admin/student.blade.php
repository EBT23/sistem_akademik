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
        <div class="card mb-5">
          <div class="card-header pb-0">
            <h6 class="text-center">Buat Akun Siswa</h6>
          </div>
          <div class="card-body">
            <form action="{{ route('add.student') }}" method="POST">
              @csrf
            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label for="full_name">Nama Lengkap</label>
                  <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Masukan Nama Lengkap">
                </div>
                <div class="form-group">
                  <label for="kelas">Kelas</label>
                  <select name="kelas" id="kelas" class="form-control">
                    <option selected>-Pilih Kelas-</option>
                        <option value="Dasar">Dasar</option>
                        <option value="Advanced">Advanced</option>
                </select>
                </div>
                <div class="form-group">
                  <label for="umur">Umur</label>
                  <input type="number" class="form-control" id="umur" name="umur" placeholder="Masukan Umur">
                </div>
                
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email">
                </div>
                <div class="form-group">
                  <label for="kontak">Kontak</label>
                  <input type="number" class="form-control" id="kontak"  name="kontak" placeholder="Masukan no wa/hp">
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea  class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat"></textarea>
                </div>
              </div>
             
              {{-- <div class="col-md-6 ">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password"  name="password" placeholder="Masukan Password">
                </div>
              </div> --}}
              <div class="sidenav-footer">
                <br>
                <button type="submit" class="btn bg-gradient-info btn mb-0 w-100">Simpan</button>
            </div>
            </div>
          </form>
          </div>
        </div>
      </div>
      <div class="col-7">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6 class="text-center">Akun Siswa</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table id="dataTable" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Umur</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                    <th class="text text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($student as $item)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="https://api.dicebear.com/5.x/pixel-art/svg?seed=7216" class="avatar avatar-sm me-3" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $item->full_name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $item->email }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Kelas</p>
                      <p class="text-xs text-secondary mb-0">{{ $item->kelas }}</p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Umur</p>
                      <p class="text-xs text-secondary mb-0">{{ $item->umur }}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success">Online</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                    </td>
                    <td class="d-flex">
                      <a class="btn  btn-sm bg-gradient-danger text-white px-3 mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-notification{{ $item->id }}"><i class="far fa-trash-alt me-2"></i>Delete</a>
                      <div class="col-md-1">
                        <div class="modal fade" id="modal-notification{{  $item->id  }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-gradient-info">
                                <h6 class="modal-title text-white" id="modal-title-notification">Hapus Data Siswa</h6>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <form action="student-delete/{{ $item->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                              <div class="modal-body">
                                <div class="py-3 text-center">
                                  <i class="ni ni-bell-55 ni-3x text-warning"></i><br>
                                  <h7 class="text-gradient text-danger">Apakah yakin kamu ingin menghapus Akun <br><b>{{ $item->full_name }}</b> !</h7>
                                  {{-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> --}}
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn bg-gradient-info">Ya, Hapus</button>
                                <button type="button" class="btn bg-gradient-secondary text-white ml-auto" data-bs-dismiss="modal">Batal</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <a class="btn btn-sm bg-gradient-info text-white px-3 mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" data-original-title="Edit user"><i class="fas fa-pencil-alt me-2" aria-hidden="true"></i>Edit</a>
                  <!-- Modal -->
                  <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-info">
                        <h5 class="modal-title text-white" id="editModalLabel">Edit Data Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="{{  route('update.student', $item->id)  }}" method="POST">
                            @csrf
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="full_name">Nama Siswa</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Masukan Nama Siswa"
                                    value="{{ $item->full_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email"
                                    value="{{ $item->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="kelas">kelas</label>
                                    <select name="kelas" id="kelas" class="form-control">
                                      <option selected>-Pilih Kelas-</option>
                                      @foreach($getSiswa as $gs)
                                      <option @if($item->id == $gs->id_user) selected @endif value="{{ $gs->id_user }}">{{ $gs->kelas}}</option>
                                      @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="kontak">Kontak</label>
                                  <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Masukan Kontak"
                                  value="{{ $item->kontak }}">
                                </div>
                                <div class="form-group">
                                  <label for="umur">Umur</label>
                                  <input type="text" class="form-control" id="umur" name="umur" placeholder="Masukan Umur"
                                  value="{{ $item->umur }}">
                                </div>
                                <div class="form-group">
                                  <label for="alamat">Alamat</label>
                                  <input  class="form-control" id="alamat" name="alamat" value="{{ $item->alamat }}" placeholder="Masukan Alamat"></input>
                                </div>
                              </div>
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
  </div>
  @endsection