 <!-- jQuery and Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <!-- Bootstrap 5.2 JS (tanpa jQuery) -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
 {{-- sweetalert --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.js"></script>

 <script>
     @if (Session::has('success'))
         Swal.fire({
             icon: 'success',
             title: 'Success',
             text: "{{ Session::get('success') }}",
             showConfirmButton: true,
             timer: 1500
         });
     @endif

     @if ($errors->any())
         document.addEventListener('DOMContentLoaded', function() {
             Swal.fire({
                 icon: 'error',
                 title: 'Gagal menyimpan data!',
                 html: `{!! implode('<br>', $errors->all()) !!}`,
                 confirmButtonColor: '#d33',
                 confirmButtonText: 'Oke, mengerti'
             });
         });
     @endif

     $('#DataTable').DataTable({
         "responsive": true,
     });

     $(document).ready(function() {
         $(document).on('click', '#delete', function(e) {
             e.preventDefault();
             var link = $(this).attr("href");
             Swal.fire({
                 title: 'Hapus Data',
                 text: "Yakin ingin menghapus data ini?",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Ya, Hapus!',
                 cancelButtonText: 'Batal'
             }).then((result) => {
                 if (result.isConfirmed) {
                     window.location.href = link;
                 }
             })
         })
     })
 </script>
