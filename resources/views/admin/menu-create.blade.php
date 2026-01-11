@extends('admin.admin')

@section('content')
<div class="d-flex justify-content-center">

<div class="premium-card p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">✨ Tambah Menu</h5>
        <a href="{{ route('menus.admin.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
    </div>

    <form method="POST" action="{{ route('menus.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="name" class="form-control premium-input" placeholder="Contoh: Nasi Goreng">
            </div>

            <div class="col-md-6">
                <label class="form-label">Harga</label>
                <input type="number" name="price" class="form-control premium-input" placeholder="15000">
            </div>

            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select premium-input">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="upload-box">
    <input type="file" name="image" hidden onchange="previewImage(this)">
    <div class="upload-inner" id="uploadPreview">
        <i class="bi bi-cloud-upload fs-2"></i>
        <span>Klik untuk upload</span>
    </div>
</label>
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" rows="3" class="form-control premium-input" placeholder="Deskripsi menu..."></textarea>
            </div>

        </div>

        <div class="text-end mt-4">
            <button class="btn btn-success px-4">💾 Simpan</button>
            <a href="{{ route('menus.admin.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>

    </form>

</div>
</div>
<script>
function previewImage(input){
    if(input.files && input.files[0]){
        const reader = new FileReader();

        reader.onload = function(e){
            document.getElementById('uploadPreview').innerHTML = `
                <img src="${e.target.result}"
                     style="width:100%; height:100%; object-fit:cover; border-radius:10px;">
            `;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
