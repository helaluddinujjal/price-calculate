
   //confirm delete
   $(document).on('click','.confirm-delete',function(){
    var record=$(this).attr('record')
    var recorded=$(this).attr('recorded')
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href="/admin/delete-"+record+'/'+recorded;
        } 
      })
})

$(document).ready(function(){
  $(document).on('input',"input.qty",function(e){
    var qty=$(this).val();
    var cat=$(this).attr('cat');
    var x = [];
    $(".unitP_"+cat).each(function() {
      x.push(parseFloat($(this).text())*qty);
    });
    var count=1

    $.each(x, function(index,value){
      $(".dis_unitT_"+cat+'_'+count).text(value.toFixed(2));
      var sum = 0;
      $(".column_"+count).each(function(){
        sum += parseFloat($(this).text());
      });
      $("#columnT_"+count).text(sum.toFixed(2))
      count=count+1
  });
   // console.log($(".unitT_"+cat).length)
  })
})

    // status update
    $(document).on('click','.updateStatus',function(){
      var status=$(this).children('i').attr('status');
      var get_id=$(this).attr('get_id');
      var name=$(this).attr('id');
      name=name.split('-',1)
      $.ajax({
          type:'post',
          url:'/admin/update-status-'+name,
          data:{status:status,id:get_id},
          success:function(res){
              //alert(res.status)
              if (res.status==1) {
                  $('#'+name+'-'+res.get_id).html('<i title="Click to inactive" class="fa fa-toggle-on fa-2x" aria-hidden="true" status="Active"></i>')
              } else {
                  $('#'+name+'-'+res.get_id).html('<i title="Click to active" class="fa fa-toggle-off fa-2x" aria-hidden="true" status="Inactive"></i>')
              }
          },
          error:function(){
              alert("Something Wrong..Please try later ")
          }
      })
  })
