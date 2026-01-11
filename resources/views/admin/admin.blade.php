<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* =======================
   GENERAL UI
======================= */
.search-box input{border-radius:30px;padding-left:45px;}
.search-box i{position:absolute;left:15px;top:50%;transform:translateY(-50%);color:#888;}

.menu-card{border-radius:18px;overflow:hidden;transition:.25s;}
.menu-card:hover{transform:translateY(-8px);box-shadow:0 15px 35px rgba(0,0,0,.15);}

.menu-image{height:180px;object-fit:cover;}
.price{font-size:1.2rem;font-weight:bold;color:#16a34a;}

.card-actions .btn{border-radius:50%;width:34px;height:34px;padding:0;}

.badge-category{
    position:absolute;
    bottom:10px;
    left:10px;
    background:rgba(0,0,0,.7);
    color:#fff;
}

/* =======================
   DARK MODE
======================= */
body.dark-mode{background:#121212!important;color:#e0e0e0;}
.dark-mode .card{background:#1e1e1e;color:#e0e0e0;}
.dark-mode .navbar{background:#000!important;}
.dark-mode .form-control,
.dark-mode .form-select{background:#2a2a2a;color:#fff;border-color:#444;}
.dark-mode .modal-content{background:#1e1e1e;color:#fff;}

/* =======================
   FORM PREMIUM
======================= */
.form-control,.form-select{
    border-radius:12px;
    padding:10px 14px;
}

.input-group-text{
    border-radius:12px 0 0 12px;
    background:#f1f5f9;
}

.card-modern{
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    border:none;
}

.premium-card{
    max-width:1100px;
    width:100%;
    margin:auto;
    border-radius:18px;
    background:rgba(255,255,255,.75);
    backdrop-filter:blur(12px);
    box-shadow:0 25px 50px rgba(0,0,0,.15);
    border:1px solid rgba(255,255,255,.4);
}

.dark-mode .premium-card{
    background:rgba(30,30,30,.75);
    border-color:rgba(255,255,255,.1);
}

/* =======================
   UPLOAD BOX
======================= */
.upload-box{
    border:2px dashed #0d6efd;
    border-radius:12px;
    cursor:pointer;
    width:140px;
    height:140px;
    display:inline-block;
    transition:.2s;
}

.upload-box:hover{
    background:rgba(13,110,253,.05);
}

.upload-inner{
    width:100%;
    height:100%;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    color:#0d6efd;
}

.preview-img{
    max-height:160px;
    border-radius:12px;
    margin-top:10px;
}

/* =======================
   NAVBAR
======================= */
.premium-navbar{
    background:#0f172a;
    color:white;
    box-shadow:0 4px 12px rgba(0,0,0,.25);
    padding:12px 0;
}

/* =======================
   CONTENT SPACING
======================= */
.main-content{
    margin-top:40px;
}
</style>
</head>

<body class="bg-light">

<nav class="navbar navbar-dark premium-navbar">
    <div class="container d-flex justify-content-between align-items-center">

        <span class="navbar-brand">Admin Resto</span>

        <div class="d-flex align-items-center gap-3">

            <!-- Tombol tambah menu -->
            <a href="{{ route('menus.create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Menu
            </a>

            <!-- Task / Notifikasi -->
            <div class="position-relative">
                <i class="bi bi-bell text-white fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                </span>
            </div>

            <!-- Dark mode -->
            <button id="darkToggle" class="btn btn-outline-light btn-sm">🌙</button>

        </div>
    </div>
</nav>


<div class="container my-5 pt-4 main-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){

/* SWEETALERT DELETE */
document.querySelectorAll('.btn-delete').forEach(button=>{
    button.addEventListener('click',function(){
        const form=this.closest('form');
        Swal.fire({
            title:'Yakin hapus menu?',
            text:'Data tidak bisa dikembalikan!',
            icon:'warning',
            showCancelButton:true,
            confirmButtonColor:'#d33',
            cancelButtonColor:'#3085d6',
            confirmButtonText:'Ya, hapus!',
            cancelButtonText:'Batal'
        }).then((result)=>{
            if(result.isConfirmed) form.submit();
        });
    });
});

/* MODAL DETAIL */
document.querySelectorAll('.menu-click').forEach(card=>{
    card.addEventListener('click',function(e){
        if(e.target.closest('.card-actions')) return;

        document.getElementById('modalName').innerText=this.dataset.name;
        document.getElementById('modalPrice').innerText=this.dataset.price;
        document.getElementById('modalCategory').innerText=this.dataset.category;
        document.getElementById('modalDescription').innerText=this.dataset.description;
        document.getElementById('modalImage').src=this.dataset.image;

        new bootstrap.Modal(document.getElementById('menuDetailModal')).show();
    });
});

/* DARK MODE */
const toggle=document.getElementById('darkToggle');
const body=document.body;

if(localStorage.getItem('darkMode')==='on'){
    body.classList.add('dark-mode');
    toggle.innerText='☀️';
}

toggle.addEventListener('click',()=>{
    body.classList.toggle('dark-mode');

    if(body.classList.contains('dark-mode')){
        localStorage.setItem('darkMode','on');
        toggle.innerText='☀️';
    }else{
        localStorage.setItem('darkMode','off');
        toggle.innerText='🌙';
    }
});

});
</script>

</body>
</html>
