<!-- Preline JS & SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/preline/dist/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SweetAlert Toast Notifications -->
<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
  });

  @if(session('success'))
    Toast.fire({
      icon: 'success',
      title: '{{ session("success") }}'
    });
  @endif

  @if(session('error'))
    Toast.fire({
      icon: 'error',
      title: '{{ session("error") }}'
    });
  @endif

  @if($errors->any())
    Toast.fire({
      icon: 'warning',
      title: 'Periksa kembali isian formulir Anda.'
    });
  @endif

  // Universal Delete Confirmation Helper
  function confirmDelete(event, formId, itemTitle = 'data ini') {
    event.preventDefault();
    Swal.fire({
      title: 'Hapus Data?',
      text: `Apakah Anda yakin ingin menghapus "${itemTitle}"? Data yang dihapus tidak dapat dipulihkan.`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e11d48',
      cancelButtonColor: '#64748b',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal',
      reverseButtons: true,
      customClass: {
        popup: 'rounded-2xl shadow-2xl border border-slate-100'
      }
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById(formId).submit();
      }
    });
  }
</script>