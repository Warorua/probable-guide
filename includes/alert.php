
<?php
//$_SESSION['error'] = 'Test error';
//$_SESSION['success'] = 'Test success';
      if(isset($_SESSION['error'])){
        echo "         
  <script>
  $( document ).ready(function() {

    Swal.fire({
      text: 'Here a basic example of SweetAlert!',
      icon: 'success',
      buttonsStyling: false,
      confirmButtonText: 'Ok, got it!',
      customClass: {
        confirmButton: 'btn btn-primary'
      }
    });

  const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 10000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  },
  confirmButtonText: 'Ok, got it!',
  customClass: {
    confirmButton: 'btn btn-primary'
}
})

Toast.fire({
  icon: 'error',
  title: '".$_SESSION['error']."'
})
}); 
      
  </script>
        ";
        unset($_SESSION['error']);
      }

      if(isset($_SESSION['success'])){
        echo "

  <script>
  $( document ).ready(function() {
    
   const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 10000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: '".$_SESSION['success']."'
})
}); 
      
  </script>
       ";
       unset($_SESSION['success']);
      }

      if(isset($_SESSION['info'])){
        echo "

  <script>
  $( document ).ready(function() {
    
   const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 10000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'info',
  title: '".$_SESSION['info']."'
})
}); 
      
  </script>
       ";
       unset($_SESSION['info']);
      }
?>