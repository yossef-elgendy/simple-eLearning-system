$(document).ready(function () {


    /*-----For Update User------*/
    $('#edit').click(function (){
       $('#showCard').animate({
           height:'hide',
           display:"none"
       },'slow');
        $('#editCard').animate({
            display:"block",
            height:'show',
        },'slow');
    });

    $('#cancelEdit').click(function (){
        $('#editCard').animate({
            height:'hide',
            display:"none",
        },'slow');
        $('#showCard').animate({
            display:"block",
            height:'show',
        },'slow');
    });


    $('#Update').click(function (){
        var token = $('meta[name="csrf-token"]').attr('content');
        var id = $(this).val();
        console.log($('#address').html());
        $.ajax({
            url:'/profile/'+id,
            method:"PUT",
            data:{
                _token:token,
                id:id,
                name:$('#name').val(),
                email:$('#email').val(),
                mobile:$('#mobile').val(),
                address:$('#address').val(),
                dateOfBirth:$('#dateOfBirth').val(),
                old_password:$('#old_password').val(),
                new_password:$('#new_password').val(),
                confirm_new_password:$('#confirm_new_password').val(),
            },
            dataType:'json',
            cache:false,
            success:function (data) {
                console.log(data);
                let key = data.success ;
                if(key)
                {

                    $('#old_password').val('');
                    $('#new_password').val('');
                    $('#confirm_new_password').val('');
                    $('#newName').html(data.user['name'].toUpperCase());
                    $('#newEmail').html('<strong>Email:</strong> '+data.user['email']);
                    $('#newMobile').html('<strong>Mobile:</strong> '+data.user['mobile']);
                    $('#newDateOfBirth').html('<strong>Date Of Birth:</strong> '+data.user['dateOfBirth']);
                    $('#newAddress').html('<strong>Address:</strong> '+data.user['address']);
                    $('#editCard').animate({
                        height:'hide',
                        display:"none",
                    },'slow');
                    $('#showCard').animate({
                        display:"block",
                        height:'show',
                    },'slow');
                    $('#alertUpdateUser').html('<div class="col col-md-6"><div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                        '  <strong>Account is updated!</strong> congrats your account has been updated.\n' +
                        '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                        '    <span aria-hidden="true">&times;</span>\n' +
                        '  </button>\n' +
                        '</div></div>').show('slow').delay(2000).hide('slow');
                }
                else
                {
                    if(data.errors['name']!== "")
                    {
                        $('#name').addClass('is-invalid');
                        $('#nameE').html(data.errors['name']);
                    }
                    else
                    {
                        $('#name').removeClass('is-invalid');
                        $('#nameE').html(data.errors['name']);
                    }

                    if(data.errors['email']!== "")
                    {
                        $('#email').addClass('is-invalid');
                        $('#emailE').html(data.errors['name']);
                    }
                    else
                    {
                        $('#email').removeClass('is-invalid');
                        $('#emailE').html(data.errors['name']);
                    }

                    if(data.errors['mobile']!== "")
                    {
                        $('#mobile').addClass('is-invalid');
                        $('#mobileE').html(data.errors['name']);
                    }
                    else
                    {
                        $('#mobile').removeClass('is-invalid');
                        $('#mobileE').html(data.errors['name']);
                    }

                    if(data.errors['dateOfBirth']!=="")
                    {
                        $('#dateOfBirth').addClass('is-invalid');
                        $('#dobE').html(data.errors['name']);
                    }
                    else
                    {
                        $('#dateOfBirth').removeClass('is-invalid');
                        $('#dobE').html(data.errors['name']);
                    }

                    if (data.errors['old_passwordE']!=="")
                    {
                        $('#old_password').addClass('is-invalid');
                        $('#old_pwE').html( data.errors['old_passwordE']);
                    }
                    else
                    {
                        $('#old_password').removeClass('is-invalid');
                        $('#old_pwE').html( data.errors['old_passwordE']);
                    }

                    if (data.errors['old_password']!=="")
                    {
                        $('#old_password').addClass('is-invalid');
                        $('#old_pwE').html(data.errors['old_password'] );
                    }
                    else
                    {
                        $('#old_password').removeClass('is-invalid');
                        $('#old_pwE').html(data.errors['old_password']);
                    }

                    if(data.errors['new_password'])
                    {
                        $('#new_password').addClass('is-invalid');
                        $('#new_pwE').html(data.errors['new_password'] );
                    }
                    else
                    {
                        $('#new_password').removeClass('is-invalid');
                        $('#new_pwE').html(data.errors['new_password'] );
                    }

                    if(data.errors['confirm_new_password']!=="")
                    {
                        $('#confirm_new_password').addClass('is-invalid');
                        $('#confirm_new_pwE').html(data.errors['confirm_new_password'] );
                    }
                    else
                    {
                        $('#confirm_new_password').removeClass('is-invalid');
                        $('#confirm_new_pwE').html(data.errors['confirm_new_password'] );
                    }


                }

            }
        });
    });

    /*-----------For Enroll And Drop Out From Courses-------------*/
    $('.course').each(function (index){
        var token = $('meta[name="csrf-token"]').attr('content');

        $(this).find('.dropout').click(function (){
            var id = $(this).val();
            $.ajax({
                url:"/myCourses/"+id,
                method:"DELETE",
                data:{
                    _token:token,
                    id:id,

                },
                cache: false,
                dataType: 'json',
                success:function (data) {
                    if (data['status'])
                    {
                        if(window.location.pathname === "/myCourses/"+id)
                        {
                            $('#buttonDropout'+id).animate({
                                height:'hide',
                                display:'none',
                            },'slow');

                            $('#reply').animate({
                                height:'hide',
                                display:'none',
                            },'slow');

                            setTimeout(function () {
                                window.location.href = "/myCourses"; //will redirect to your blog page (an ex: blog.html)
                            }, 2000);
                        }
                        else
                        {


                            $('.course').eq(index).animate({
                                height:'hide',
                                display:'none',
                            },'slow');

                        }

                        $('.course').eq(index).before('<div id="alertDropout" style="display: none" class="row justify-content-center"><div id="alert" class="col col-md-6"><div  class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                            '  <strong>You have dropped out the course!</strong> if there is something wrong in the service tell us in the feedbacks please.\n' +
                            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                            '    <span aria-hidden="true">&times;</span>\n' +
                            '  </button>\n' +
                            '</div></div></div>');
                        $('#alertDropout').show('slow').delay(2000).hide('slow');






                    }
                    else
                    {
                        $('.course').eq(index).before('<div id="alertDropout" style="display: none" class="row justify-content-center"><div id="alert" class="col col-md-6"><div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                            '  <strong>You are not enrolled in this course !!</strong>.\n' +
                            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                            '    <span aria-hidden="true">&times;</span>\n' +
                            '  </button>\n' +
                            '</div></div></div>');
                        $('#alertDropout').show('slow').delay(2000).hide('slow');
                    }
                }

            });

        });

        $(this).find('.enroll').click(function (){
            var id = $(this).val();
            $.ajax({
                url:"/allCourses/"+id,
                method:"POST",
                data:{
                    _token:token,
                    id:id,
                },
                cache: false,
                dataType: 'json',
                success:function (data) {
                    if (data['status'])
                    {
                        $('#buttonEnroll'+id).animate({
                            height:'hide',
                            display:'none',
                        },'slow');

                        if(window.location.pathname === "/myCourses/"+id)
                        {
                            setTimeout(function () {
                                window.location.href = "/myCourses"; //will redirect to your blog page (an ex: blog.html)
                            }, 2000);
                        }
                        $('.course').eq(index).before('<div id="alertEnroll" style="display: none" class="row justify-content-center"><div id="alert" class="col col-md-6"><div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                            '  <strong>Congrats</strong> you have successfully enrolled in our course.\n' +
                            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                            '    <span aria-hidden="true">&times;</span>\n' +
                            '  </button>\n' +
                            '</div></div></div>');
                        $('#alertEnroll').show('slow').delay(2000).hide('slow');




                    }
                    else
                    {
                        $('.course').eq(index).before('<div id="alertEnroll " style="display: none" class="row justify-content-center"><div id="alert"class="col col-md-6"><div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                            '  <strong>You are already enrolled in this course !!</strong>.\n' +
                            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                            '    <span aria-hidden="true">&times;</span>\n' +
                            '  </button>\n' +
                            '</div></div></div>');
                        $('.course').eq(index).find('.alert').show('slow').delay(2000).hide('slow');
                    }
                }

            });

        });

    });

    /*------------ For Adding Feedback ----------------*/
    $('#ReplyButton').click(function (){
        var token = $('meta[name="csrf-token"]').attr('content');
        var id = $(this).val();
        $.ajax({
            url:"/myCourses/addFeedBack/"+id,
            method:"PUT",
            dataType:'json',
            data:{
                _token:token,
                id:id,
                feedBack: $('#feedback').val(),

            },
            cache:false,
            success:function (data){

                console.log(data["feedback"]);
                let result = data;
                $('#feedbacks').prepend(' <div style="display:none;" class="row mb-2 comment ">\n' +
                    '                                    <div class="card bg-first px-3" style="border-radius: 20px;">\n' +
                    '                                        <div class="card-body bg-first text-white">\n' +
                    '                                            <div class="row">\n' +
                    '                                                    <h6 class="card-title">Name:'+result['user']['name']+'</h6>\n' +
                    '                                            </div>\n' +
                    '                                            <div class="row">\n' +
                    '                                                <p class="card-text pl-5">'+result['feedback']['feedBack']+'</p>\n' +
                    '                                            </div>'+
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                </div>');


                $('.comment').first().show('slow');

                $('#reply').animate({
                    height:'hide',
                    display:'none',
                },'slow');

                setTimeout(function () {
                    window.location.href = "/myCourses/"+id; //will redirect to your blog page (an ex: blog.html)
                }, 2000);

            }
        })

    })





});
