<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Edusys360 - Admin Dashboard</title>
  <!-- Toastr Css File-->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
  <!-- MATERIAL ICON -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <!-- CUSTOM STYLESHEET -->
  <link rel="stylesheet" href="{{ asset('assets/assets/css/dashboard-style.css') }}">
  <!-- JQUERY AJAX -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
  <div class="container">
    <!---Sidebar Start --->

    @include('admin.body.sidebar')    
    <!---Sidebar End --->

    <!-- Main Content -->
    @yield('admin')
    <!-- Main Content End-->
  </div>   
  <!-- General JS Scripts -->
  <script src="{{ asset('assets//assets/js/index.js') }}"></script>
  <!-- JQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <!-- Toastr JS File -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- SweetAlert2 JS File -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    $(function(){
      $(document).on('click','#deleteUser',function(e){
        e.preventDefault();
        var url=$(this).attr("href");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href=url
            Swal.fire(
              'Deleted!',
              'The account has been deleted.',
              'success'
            )
          }
        })
      }); 
    });
  </script>
  <script type="text/javascript">
    $(function(){
      $(document).on('click','#deleteClass',function(e){
        e.preventDefault();
        var url=$(this).attr("href");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href=url
            Swal.fire(
              'Deleted!',
              'The class has been deleted.',
              'success'
            )
          }
        })
      }); 
    });
  </script>
  <script type="text/javascript">
    $(function(){
      $(document).on('click','#deleteYear',function(e){
        e.preventDefault();
        var url=$(this).attr("href");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href=url
            Swal.fire(
              'Deleted!',
              'The academic year has been deleted.',
              'success'
            )
          }
        })
      }); 
    });
  </script>
  <script type="text/javascript">
    $(function(){
      $(document).on('click','#deleteFeeCategory',function(e){
        e.preventDefault();
        var url=$(this).attr("href");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href=url
            Swal.fire(
              'Deleted!',
              'The fee category has been deleted.',
              'success'
            )
          }
        })
      }); 
    });
  </script>
  <script type="text/javascript">
    $(function(){
      $(document).on('click','#deleteExam',function(e){
        e.preventDefault();
        var url=$(this).attr("href");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href=url
            Swal.fire(
              'Deleted!',
              'The exam model has been deleted.',
              'success'
            )
          }
        })
      }); 
    });
  </script>
  <script type="text/javascript">
    $(function(){
      $(document).on('click','#deleteSubject',function(e){
        e.preventDefault();
        var url=$(this).attr("href");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href=url
            Swal.fire(
              'Deleted!',
              'The subject has been deleted.',
              'success'
            )
          }
        })
      }); 
    });
  </script>
  <script type="text/javascript">
    $(function(){
      $(document).on('click','#deleteFeeCategory',function(e){
        e.preventDefault();
        var url=$(this).attr("href");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href=url
            Swal.fire(
              'Deleted!',
              'The fee category has been deleted.',
              'success'
            )
          }
        })
      }); 
    });
  </script>
  <script type="text/javascript">
    $(function(){
      $(document).on('click','#deleteLeave',function(e){
        e.preventDefault();
        var url=$(this).attr("href");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href=url
            Swal.fire(
              'Deleted!',
              'The Leave has been deleted.',
              'success'
            )
          }
        })
      }); 
    });
  </script>
  <!-- Toastr Alert -->
  <script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type','info') }}"
  switch(type){
      case 'info':
      toastr.info(" {{ Session::get('message') }} ");
      break;

      case 'success':
      toastr.success(" {{ Session::get('message') }} ");
      break;

      case 'warning':
      toastr.warning(" {{ Session::get('message') }} ");
      break;

      case 'error':
      toastr.error(" {{ Session::get('message') }} ");
      break; 
  }
  @endif 
  </script>
</body>
</html>