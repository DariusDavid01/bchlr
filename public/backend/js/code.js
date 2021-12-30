$(function(){
    $(document).on('click','#delete',function(e){
      e.preventDefault();
      var link = $(this).attr("href");
          Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }
        })
    });
  });

  $(function(){
    $(document).on('click','#confirm',function(e){
      e.preventDefault();
      var link = $(this).attr("href");
          Swal.fire({
          title: 'Are you sure to confirm?',
          text: "Once confirmed, you will not be able to change your mind!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, confirm it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Confirmed!',
              'The order has been confirmed.',
              'success'
            )
          }
        })
    });
  });
  $(function(){
    $(document).on('click','#processing',function(e){
      e.preventDefault();
      var link = $(this).attr("href");
          Swal.fire({
          title: 'Are you sure to process?',
          text: "Once processed, you will not be able to change your mind!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, process it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Confirmed!',
              'The order has been processed.',
              'success'
            )
          }
        })
    });
  });
  $(function(){
    $(document).on('click','#picked',function(e){
      e.preventDefault();
      var link = $(this).attr("href");
          Swal.fire({
          title: 'Are you sure to pick?',
          text: "Once picked, you will not be able to change your mind!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, pick it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Confirmed!',
              'The order has been picked.',
              'success'
            )
          }
        })
    });
  });
  $(function(){
    $(document).on('click','#shipped',function(e){
      e.preventDefault();
      var link = $(this).attr("href");
          Swal.fire({
          title: 'Are you sure to ship?',
          text: "Once shipped, you will not be able to change your mind!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, ship it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Confirmed!',
              'The order has been shipped.',
              'success'
            )
          }
        })
    });
  });
  $(function(){
    $(document).on('click','#delivered',function(e){
      e.preventDefault();
      var link = $(this).attr("href");
          Swal.fire({
          title: 'Are you sure to deliver?',
          text: "Once delivered, you will not be able to change your mind!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, deliver it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Confirmed!',
              'The order has been delivered.',
              'success'
            )
          }
        })
    });
  });