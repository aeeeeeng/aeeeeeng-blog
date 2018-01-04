function ajaxDeleteWithSweetAlert(url, name, token)
{
  var result;
  swal({
      title: 'Are you sure to deleted '+name+'??',
      html: $('<div>')
        .addClass('some-class')
        .text('Data will be deleted'),
      animation: false,
      showCancelButton: true,
      customClass: 'animated tada',
      background: '#fff url(//bit.ly/1Nqn9HU)',
    })
  .then((result) => {
      if (result.value) {
        $.ajax({
          url: url,
          type: 'delete',
          dataType: 'json',
          data: {
            _method : 'delete',
            _token : token
          }
        })
        .done(function(data) {
          result = true;
        })
        .fail(function(data) {
          result = false;
        })
        .always(function(data) {
          if(result){
            if(data.success){
              swal({
                  title: 'Success',
                  html: $('<div>')
                    .addClass('some-class')
                    .text('Data '+name+' has ben deleted'),
                  animation: false,
                  customClass: 'animated tada'
                }).then(function(){
                  window.location.reload();
                })
            } else{
              swal({
                title: 'Error',
                html: $('<div>')
                  .addClass('some-class')
                  .text('Invalid Request'),
                animation: false,
                customClass: 'animated tada'
              })
            }
          } else{
            swal({
              title: 'Error',
              html: $('<div>')
                .addClass('some-class')
                .text('Internal Server Error'),
              animation: false,
              customClass: 'animated tada'
            })
          }
        });
      } else if (result.dismiss === 'cancel') {
        null;
      }
    })
}
