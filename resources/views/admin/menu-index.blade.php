@extends('admin.admin')

@section('content')
<h4 class="mb-4 fw-bold">Daftar Menu</h4>

{{-- SEARCH BAR --}}
<form method="GET" action="{{ url('/admin/menus') }}" class="mb-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="position-relative search-box">
                <i class="bi bi-search"></i>
                <input type="text"
                       name="search"
                       value="{{ $search ?? '' }}"
                       class="form-control"
                       placeholder="Cari menu...">
            </div>
        </div>
    </div>
</form>

{{-- GRID MENU --}}
<div class="row g-4 justify-content-center">

@forelse($menus as $menu)
<div class="col-xl-3 col-lg-4 col-md-6">

    <div class="mt-4 d-flex justify-content-center">
    {{ $menus->links('pagination::bootstrap-5') }}
</div>

<div class="card menu-card shadow-sm border-0 h-100 menu-click"
     data-name="{{ $menu->name }}"
     data-price="Rp {{ number_format($menu->price,0,',','.') }}"
     data-category="{{ $menu->category->name ?? 'Tanpa kategori' }}"
     data-description="{{ $menu->description ?? '-' }}"
     data-image="{{ $menu->image ? asset('storage/'.$menu->image) : asset('no-image.png') }}">

    <div class="position-relative">
        <img src="{{ $menu->image ? asset('storage/'.$menu->image) : asset('no-image.png') }}"
             class="card-img-top menu-image">

        <span class="badge badge-category">
            {{ $menu->category->name ?? 'Tanpa kategori' }}
        </span>

        @if($menu->is_promo)
            <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                🔥 Promo
            </span>
        @endif
    </div>

    <div class="card-body">
        <h6 class="fw-bold mb-1">{{ $menu->name }}</h6>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <span class="price">
                Rp {{ number_format($menu->price,0,',','.') }}
            </span>

            <div class="card-actions">
                <a href="{{ route('menus.edit',$menu->id) }}"
                   class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-pencil"></i>
                </a>

                <form action="{{ route('menus.destroy',$menu->id) }}"
                      method="POST"
                      class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            class="btn btn-outline-danger btn-sm btn-delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
@empty
<p class="text-center text-muted">Menu tidak ditemukan</p>
@endforelse

</div>

{{-- MODAL DETAIL MENU --}}
<div class="modal fade" id="menuDetailModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body p-0">

        <img id="modalImage" class="w-100" style="height:300px; object-fit:cover;">

        <div class="p-4">
            <h4 id="modalName"></h4>
            <span class="badge bg-secondary mb-2" id="modalCategory"></span>

            <h5 class="text-success mt-2" id="modalPrice"></h5>

            <p class="mt-3 text-muted" id="modalDescription"></p>

            <div class="text-end">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection
