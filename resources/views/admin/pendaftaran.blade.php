@extends('layout.base',['title' => "$title"])
@section('content')

<div class="container-fluid py-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (Session::has('success'))
    <div class="alert alert-success text-white">
        {{ Session::get('success') }}
    </div>
    @endif
    <div class="col-lg">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6 class="text-center">PENDAFTARAN</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="dataTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIS
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                    Lengkap
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIK
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                    Telepon
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Umur
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat,
                                    Tanggal Lahir
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Pendidikan Terakhir
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Agama
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                    Ortu
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Pengalaman Kerja
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Metode
                                    Pembayaran
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti
                                    Pembayaran
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                    Pembayaran
                                </th>
                                <th class="text text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftaran as $no => $item)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    {{ $no+1 }}
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs text-secondary mb-0">{{ $item->nis }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        {{-- <div>
                                            <img src="https://api.dicebear.com/5.x/pixel-art/svg?seed=7216"
                                                class="avatar avatar-sm me-3" alt="user1">
                                        </div> --}}
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs text-secondary mb-0">{{ $item->full_name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->email }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->ktp }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->kontak }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->kelas }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->alamat }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->umur }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->tempat_lahir.', '.$item->tgl_lahir }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->pendidikan_terakhir }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->status }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->agama }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->nama_ortu }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->pengalaman_kerja }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $item->metode_bayar }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <!-- Button trigger modal -->
                                    <a href="{{ asset('uploads').'/'.$item->bukti_bayar }}" target="_blank"
                                        rel="noopener noreferrer">{{ $item->bukti_bayar }}</a>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if ( $item->status_bayar == 'Pending')
                                    <p class="badge bg-danger">{{ $item->status_bayar }}</p>
                                    @else
                                    <p class="badge bg-success">{{ $item->status_bayar }}</p>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    @if ($item->status_bayar == 'Pending')
                                    <a class="btn  btn-sm bg-gradient-success text-white px-3 mb-0" href="javascript:;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-notification1{{ $item->id_user }}"><i
                                            class="far fa-trash-alt me-2"></i>Konfirmasi</a>
                                    <div class="col-md-1">
                                        <div class="modal fade" id="modal-notification1{{  $item->id_user }}"
                                            tabindex="-1" role="dialog" aria-labelledby="modal-notification1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-danger modal-dialog-centered modal-"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-info">
                                                        <h6 class="modal-title text-white"
                                                            id="modal-title-notification">Konfirmasi Pendaftaran</h6>
                                                        <button type="button" class="btn-close text-dark"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('acc_status_pembayaran',$item->id_user)  }}"
                                                        method="POST">
                                                        @method('POST')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="py-3 text-center">
                                                                <i class="ni ni-bell-55 ni-3x text-warning"></i><br>
                                                                <h7 class="text-gradient text-danger">Apakah kamu yakin,
                                                                    ingin mengkonfirmasi data ini <b>?</b></h7>
                                                                {{-- <p>A small river named Duden flows by their place
                                                                    and supplies it with the necessary regelialia.</p>
                                                                --}}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info">Ya,
                                                                Konfirmasi</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <a class="btn  btn-sm bg-gradient-danger text-white px-3 mb-0" href="javascript:;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-notification2{{ $item->id_user }}"><i
                                            class="far fa-trash-alt me-2"></i>Batalkan</a>
                                    <div class="col-md-1">
                                        <div class="modal fade" id="modal-notification2{{  $item->id_user }}"
                                            tabindex="-1" role="dialog" aria-labelledby="modal-notification1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-danger modal-dialog-centered modal-"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-info">
                                                        <h6 class="modal-title text-white"
                                                            id="modal-title-notification">Batalkan Konfirmasi</h6>
                                                        <button type="button" class="btn-close text-dark"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="{{ route('batalkan_status_pembayaran',$item->id_user)  }}"
                                                        method="POST">
                                                        @method('POST')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="py-3 text-center">
                                                                <i class="ni ni-bell-55 ni-3x text-warning"></i><br>
                                                                <h7 class="text-gradient text-danger">Apakah kamu yakin,
                                                                    ingin membatalkan data ini <b>?</b>
                                                                </h7>
                                                                {{-- <p>A small river named Duden flows by their place
                                                                    and supplies it with the necessary regelialia.</p>
                                                                --}}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info">Ya,
                                                                Konfirmasi</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif


                                    <a class="btn  btn-sm bg-gradient-danger text-white px-3 mb-0" href="javascript:;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-notification{{ $item->id_user }}"><i
                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                    <div class="col-md-1">
                                        <div class="modal fade" id="modal-notification{{  $item->id_user  }}"
                                            tabindex="-1" role="dialog" aria-labelledby="modal-notification"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-danger modal-dialog-centered modal-"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-gradient-info">
                                                        <h6 class="modal-title text-white"
                                                            id="modal-title-notification">Hapus Pendaftaran</h6>
                                                        <button type="button" class="btn-close text-dark"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('delete.pendaftaran',$item->id_user)  }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="py-3 text-center">
                                                                <i class="ni ni-bell-55 ni-3x text-warning"></i><br>
                                                                <h7 class="text-gradient text-danger">Apakah kamu yakin,
                                                                    ingin menghapus data ini <b>?</b></h7>
                                                                {{-- <p>A small river named Duden flows by their place
                                                                    and supplies it with the necessary regelialia.</p>
                                                                --}}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info">Ya,
                                                                Hapus</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
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