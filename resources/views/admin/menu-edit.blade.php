@extends('admin.admin')

@section('content')
<div class="d-flex justify-content-center">

<div class="premium-card p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">✏️ Edit Menu</h5>
        <a href="{{ route('menus.admin.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
    </div>

    <form method="POST" action="{{ route('menus.update',$menu->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="name" class="form-control premium-input"
                       value="{{ $menu->name }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Harga</label>
                <input type="number" name="price" class="form-control premium-input"
                       value="{{ $menu->price }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select premium-input">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected($menu->category_id==$cat->id)>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Foto Menu</label>

                <label class="upload-box">
                    <input type="file" name="image" hidden onchange="previewEditImage(this)">

                    <div class="upload-inner" id="uploadEditPreview">
                        @if($menu->image)
                            <img src="{{ asset('storage/'.$menu->image) }}"
                                 style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                        @else
                            <i class="bi bi-cloud-upload fs-2"></i>
                            <span>Klik untuk upload</span>
                        @endif
                    </div>
                </label>
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="form-control premium-input">{{ $menu->description }}</textarea>
            </div>

        </div>

        <div class="text-end mt-4">
            <button class="btn btn-success px-4">💾 Update</button>
            <a href="{{ route('menus.admin.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>

    </form>

</div>
</div>

<script>
function previewEditImage(input){
    if(input.files && input.files[0]){
        const reader = new FileReader();

        reader.onload = function(e){
            document.getElementById('uploadEditPreview').innerHTML = `
                <img src="${e.target.result}"
                     style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
            `;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
