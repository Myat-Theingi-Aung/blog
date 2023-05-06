$(document).ready(function(){
    
    $(document).on('click', '.del-btn', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
  
        Swal.fire({
            title: 'Are You Sure?',
            text: "Do You Want to Delete?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK',
            cancelButtonText: 'CANCEL',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $('.deleteForm' + id).submit();
            }
        })
    });
});
