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
            <h6 class="text-left col-md-8">Informasi</h6>
            <div class="col-lg-1 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
              <div class="nav-wrapper position-relative end-0">
                    <a class="btn btn-sm bg-gradient-info text-white px-3 mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#addModal" href="javascript:;"><i class="ni ni-fat-add" aria-hidden="true"></i>Add</a>
                    </a>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
              @if ($informasi->count() > 0)
                  <ul>
                      @foreach ($informasi as $inf)
                          <li>
                              <h3>{{ $inf->judul }}</h3>
                              <p>{{ $inf->konten }}</p>
                          </li>
                          <div class="d-flex">
                            <span>
                              <a class="btn  btn-sm bg-gradient-danger text-white px-3 m-md-1 mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal-notification{{ $inf->id }}"><i class="far fa-trash-alt me-2"></i>Delete</a>
                              <div class="col-md-1 ">
                                <div class="modal fade" id="modal-notification{{ $inf->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header bg-gradient-info">
                                        <h6 class="modal-title text-white" id="modal-title-notification">Hapus Informasi</h6>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                      </div>
                                      <form action="information/delete/{{ $inf->id }}" method="POST">
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
                            </span>
                           <span>
                            <a class="btn btn-sm bg-gradient-info text-white px-3 mt-1 mb-0" href="javascript:;" data-bs-toggle="modal" data-bs-target="#editModal{{ $inf->id }}" data-original-title="Edit user"><i class="fas fa-pencil-alt me-2" aria-hidden="true"></i>Edit</a>
                            <!-- Modal -->
                             <div class="modal fade" id="editModal{{ $inf->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-lg">
                               <div class="modal-content">
                                   <div class="modal-header bg-gradient-info">
                                   <h5 class="modal-title text-white" id="editModalLabel">Edit Informasi</h5>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                   </div>
                                   <div class="modal-body">
                                   <form action="{{  route('update.information', $inf->id)  }}" method="POST">
                                       @csrf
                                       <div class="form-group">
                                         <label for="judul">Judul</label>
                                         <input type="text" class="form-control" id="judul" name="judul" value="{{ $inf->judul }}" placeholder="">
                                       </div>
                                       <div class="form-group">
                                        <label for="konten">Konten</label>
                                        <textarea name="konten" id="konten" cols="30" rows="8">{{ $inf->konten }}</textarea>
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
                       </div>
                           </span>
                           
                      @endforeach
                  </ul>
              @else
                  <h5 class="text-center">Tidak ada informasi.</h5>
              @endif
              
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
        <h5 class="modal-title text-white" id="addModalLabel">Tambah Informasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="{{ route('add.information') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-lg">
        <div class="form-group">
          <label for="judul">Judul</label>
          <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan Judul">
        </div>
        <div class="form-group">
          <label for="konten">Konten</label>
          <textarea name="konten" id="konten" cols="30" rows="8"></textarea>
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

<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('konten', {
        height: '450',
        // Ensure that the Magic Line plugin, which is required for this sample, is loaded.
        extraPlugins: 'magicline',
        // Magic Line does not require any additional ACF settings.
        // We set config.extraAllowedContent because HTML code in this sample contains
        // a <div> element with custom styles that we would like to allow.
        extraAllowedContent: 'div{border,background,text-align}',
        removeButtons: 'PasteFromWord'

    });

    var rupiah = document.getElementById("harga");
    rupiah.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, "Rp. ");
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
</script>
@endsection