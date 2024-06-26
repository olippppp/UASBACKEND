@extends('layouts.template')

@section('title')
    Tambah Menu
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Menu</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.menu') }}">Menu</a></li>
            <li class="breadcrumb-item active text-white">Tambah Menu</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Form Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Tambah Menu</h1>
            <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row" style="margin-left: auto;
                margin-right: auto;">
                    <div class="col-md-7">
                        <div style="form-item">
                            <div id='imagePreview' width='100%'></div>
                            <input type="file" name="file" id="file" accept='image/*'
                                onchange='return fileValidation()' required>
                        </div>
                        <div class="form-item pt-4">
                            <label class="form-label my-3">Nama<sup>*</sup></label>
                            <input type="text" class="form-control" required name="nama">
                        </div>
                        <div class="form-item pt-2">
                            <label class="form-label my-3">Kategori<sup>*</sup></label>
                            <div>
                                <select name="kategori" class="form-control" required style="background: white;">
                                    <option value="" disabled>Pilih Kategori</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-item pt-2">
                            <label class="form-label my-3">Deskripsi<sup>*</sup></label>
                            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                        </div>
                        <div class="form-item pt-2">
                            <label class="form-label my-3">Harga<sup>*</sup></label>
                            <input type="number" class="form-control" required name="harga">
                        </div>
                        <div class="form-item pt-4">
                            <button type="submit" class="btn btn-secondary text-white">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Form Page End -->
@endsection


<script>
    function fileValidation() {
        var fileInput = document.getElementById('file');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload files with extensions .jpeg/.jpg/.png/.gif only.');
            fileInput.value = '';
            return false;
        } else {
            // Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').innerHTML = '<div>Foto Produk</div><img src="' + e
                        .target.result +
                        '" style="width: 200px; height: 200px; max-width: 200px; max-height: 200px; object-fit: cover;" />';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }
</script>
