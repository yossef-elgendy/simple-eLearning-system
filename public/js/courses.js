$(document).ready(function (){
    /*---For Delete --*/
    function _delete()
    {

        /*---For Delete --*/
        $('.delete').each(function (index) {
            var id = $(this).val();
            $(this).click(function () {


                $.ajax({
                    url:"courses/"+id,
                    type:"DELETE",
                    cache: false,
                    data:{
                        _token:$('meta[name="csrf-token"]').attr('content'),
                        id: id
                    },
                    success:function ()
                    {
                        $('.element').eq(index).fadeOut('slow');
                        $('.element').eq(index).before('<div id="alert'+id+'" class="row justify-content-center" style="display: none;">' +
                            '<div class="col col-md-12">' +
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                            '  <strong>Operation successful</strong> You have deleted a course.\n' +
                            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                            '    <span aria-hidden="true">&times;</span>\n' +
                            '  </button>\n' +
                            '</div></div> ' +
                            '</div>');
                        $('#alert'+id).show('slow').delay(2500).hide('slow');

                    }
                });
            });


        });


    }

    $('select[name="specification_id"]').change(function (){
         if($(this).val() === 'other')
         {

             $('#specName').show('slow');


         }
         else if($(this).val() !=='other' && $(this).val()!== '')
         {


            $('#specName').hide('slow');


         }
    })

    $('#EditSpec').click(function (){
        $('#keyQ').val('1');
        $('#EditQ').hide('slow',function (){
            $('#Cancel').show('slow')
        });
        $('#SelectSpec').hide('slow',function (){
            $('#SPEC').show('slow');
        });

    });

    $('#CancelEdit').click(function (){
        $('#keyQ').val('0');
        $('#Cancel').hide('slow',function (){
            $('#EditQ').show('show');
        });
        $('#SPEC').hide('slow',function (){
            $('#SelectSpec').show('show');
        });
    });

    $('#spec').change(function (){

        $(this).find('option').each(function (){

            if($('#spec').val() === $(this).val())
            {
                $('#specNameUp').val($(this).html());
            }
        });
    });



    _delete();

});
