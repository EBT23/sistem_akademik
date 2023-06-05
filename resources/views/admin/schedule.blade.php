@extends('layout.base',['title' => "$title"])
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
      <div class="card-header pb-0 d-flex">
        <h6 class="text-left col-md-8">Jadwal</h6>
        <div class="col-lg-1 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
          <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="modal" data-bs-target="#addModal" href="javascript:;"  aria-selected="true">
                  <i class="ni ni-fat-add"></i>
                  <span class="ms-2">Add</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="dataTable" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Topik</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jam</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hari</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th  class="text text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($schedule as $no => $item)
              <tr>
                <td>
                  <span class="text-xs font-weight-bold mb-0">{{ $no+1 }}</span>
                </td>
                <td>
                  <div class="d-flex px-2 py-1">
                    {{-- <div>
                      <img src="https://api.dicebear.com/5.x/pixel-art/svg?seed=7216" class="avatar avatar-sm me-3" alt="user1">
                    </div> --}}
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $item->nama_materi }}</h6>
                      <p class="text-xs text-secondary mb-0">bahasa korea</p>
                    </div>
                  </div>
                </td>
                <td>
                  <h6 class="text-xs font-weight-bold mb-0">Jam</h6>
                  <p class="text-xs text-secondary mb-0">{{ date_format(date_create($item->dari), 'H:i') }} s/d {{ date_format(date_create($item->sampai), 'H:i') }}</p>
                </td>
                <td>
                  <h6 class="text-xs font-weight-bold mb-0">{{ date_format(date_create($item->hari), 'l') }}</h6>
                  <p class="text-xs text-secondary mb-0">{{ date_format(date_create($item->hari), 'd-M-Y') }}</p>
                </td>
                <td class="align-middle text-center text-sm">
                  @if ($item->is_active == 1 )
                     <span class="badge badge-sm bg-gradient-success">Aktif</span>
                  
                  @else
                    <span class="badge badge-sm bg-gradient-danger">Tidak Aktif</span>
                  
                  @endif
                </td>
                <td class="d-flex justify-content-center">
                  <a class="btn  btn-sm bg-gradient-danger text-white px-3 mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-notification{{ $item->id }}"><i class="far fa-trash-alt me-2"></i>Delete</a>
                  <div class="col-md-1">
                    <div class="modal fade" id="modal-notification{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                      <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-gradient-info">
                            <h6 class="modal-title text-white" id="modal-title-notification">Hapus Data Pengajar</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <form action="schedule/delete/{{ $item->id }}" method="POST">
                            @method('DELETE')
                            @csrf
                          <div class="modal-body">
                            <div class="py-3 text-center">
                              <i class="ni ni-bell-55 ni-3x text-warning"></i><br>
                              <h7 class="text-gradient text-danger">Apakah kamu yakin, ingin menghapus data ini <b>?</b></h7>
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
                  <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header bg-gradient-info">
                      <h5 class="modal-title text-white" id="editModalLabel">Edit Jadwal</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <form action="{{  route('update.schedule', $item->id)  }}" method="POST">
                          @csrf
                          <div class="form-group col-lg">
                            <label for="materi_id">Nama Topik</label>
                            <select name="materi_id" id="materi_id" class="form-control">
                              <option selected>-Pilih Topik-</option>
                              @foreach($materi as $pj)
                             <option @if($item->materi_id == $pj->id) selected @endif value="{{ $pj->id }}">{{ $pj->nama_materi}}</option>
                             @endforeach
                            </select>
                          </div>
                          <div class="row">
                          <div class="col-6">
                            <div class="form-group">
                              <label for="dari">Dari Jam</label>
                              <input type="time" class="form-control" id="dari" name="dari" value="{{ $item->dari }}" placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="sampai">Sampai Jam</label>
                              <input type="time" class="form-control" id="sampai" name="sampai" value="{{ $item->sampai }}" placeholder="">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label for="hari">Hari/Tanggal</label>
                              <input type="date" class="form-control" id="hari" name="hari" value="{{ $item->hari }}" placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="is_active">Status</label>
                              <select name="is_active" id="is_active" class="form-control">
                                  <option value="1" {{ $item->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                                  <option value="0" {{ $item->is_active == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                              </select>
                            </div>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-info">Simpan</button>
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Kembali</button>
                          </div>
                         </form>
                      </div>
                  </div>
                  </div>
              </div>
              </td>
              </tr>
              @empty
              <tr>
                <td>

                  <p class="text-center">Data masih kosong.</p>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- calender --}}
      {{-- <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-body d-flex justify-content-between align-items-center">
                      <div class="card-title mb-0">
                          <h4 class="mb-0">Calender</h4>
                      </div>
                      <div class="card-action">
                          <a href="#" class="btn btn-primary" role="button">Back</a>
                      </div>
                  </div>
              </div>
          </div>
      </div> --}}
      <div class="row">
          <div class="col-lg-12">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="card  ">
                          <div class="card-body">
                              <div id="calendar1" class="calendar"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-gradient-info">
        <h5 class="modal-title text-white" id="addModalLabel">Tambah Jadwal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="{{ route('add.schedule') }}" method="POST">
        @csrf
        <div class="form-group col-lg">
          <label for="full_name">Nama Topik</label>
          <select name="materi_id" id="materi_id" class="form-control">
            <option selected>-Pilih Topik-</option>
            @foreach($materi as $pj)
           <option value="{{ $pj->id }}">{{ $pj->nama_materi}}</option>
           @endforeach
          </select>
        </div>
        <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="dari">Dari Jam</label>
            <input type="time" class="form-control" id="dari" name="dari" placeholder="">
          </div>
          <div class="form-group">
            <label for="sampai">Sampai Jam</label>
            <input type="time" class="form-control" id="sampai" name="sampai" placeholder="">
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="hari">Hari/Tanggal</label>
            <input type="date" class="form-control" id="hari" name="hari" placeholder="">
          </div>
          <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn bg-gradient-info">Simpan</button>
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Kembali</button>
        </div>
       </form>
      </div>
    </div>
  </div>
</div>


<script>
 document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: ['dayGrid', 'timeGrid', 'list'],
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
    },
    initialView: 'dayGridMonth',
    views: {
      dayGridMonth: {
        buttonText: 'Bulan',
      },
      timeGridWeek: {
        buttonText: 'Minggu',
      },
      timeGridDay: {
        buttonText: 'Hari',
      },
      listWeek: {
        buttonText: 'Daftar',
      },
    },
    events: '/schedule',
  });

  calendar.render();
  });
  </script>
@endsection

