$(document).ready(function () {
    // $('#findquiz').hide();
    // $('#find').click(function () {
    //     $('#findquiz').fadeToggle();
    // });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.FC_list').click(function () {
        var id = this.id;
        var item = id-1;
        $('.FC_list').siblings('li').removeClass('active');
        $('.FC_list').siblings('li').eq(item).addClass('active');

    });
    $('.ATQ').hide();

    $('#answer').click(function () {
        $('.ATQ').show();
    });
    $('#askme').on('click', function () {
        $('#askme').css("background", "#000");
    });
    $('.ATQ').each(function () {
        $(this).click(function () {
            var id = this.id;
            $('#item' + id + '').toggle();
        });
    });
    $('.question').each(function(){
        $(this).click(function () {
            var id=this.id;
            // alert(id);
            $.ajax({
                url:"/viewanswer",
                method: 'post',
                data:{
                    id:id
                },
                success:function (data) {
                    $('#fq').html(data);

                }
            })
        })
    });
    // Question Search
    // $('#searchquiz').on('keyup', function () {
    //     var query = $(this).val();
    //     $.ajax({
    //         url: "/search_question",
    //         type: "post",
    //         data: {'searchquiz': query},
    //         success: function (data) {
    //             $('#question_list').html(data);
    //         }
    //     })
    // });
    // $('#question_list').on('click', 'li', function () {
    //     var value = $(this).text();
    //     $('#searchquiz').val(value);
    //     $('#question_list').html("");
    // });
    $('#find').click(function () {
        var query = $('#search').val();
        $.ajax({
            url: "/find_question",
            type: "post",
            data: {'find_query': query},
            success: function (data) {
                $('#fq').html(data);

                $('.ATQ').hide();
                $('.item_answer').hide();
                $('#answer').click(function () {
                    $('.ATQ').show();
                });
                $('.question').each(function(){
                    $(this).click(function () {
                        var id=this.id;
                        // alert(id);
                        $.ajax({
                            url:"/viewanswer",
                            method: 'post',
                            data:{
                                id:id
                            },
                            success:function (data) {
                                $('#fq').html(data);
                            }
                        })
                    })
                });
                $('.ATQ').each(function () {
                    $(this).click(function () {
                        var id = this.id;
                        $('#item' + id + '').toggle();
                    });
                });
            }
        });
    });
    //Answer Search
    // $('#search').on('keyup', function () {
    //     var query = $(this).val();
    //     $.ajax({
    //         url: "/search_answer",
    //         type: "post",
    //         data: {'search_answer': query},
    //         success: function (data) {
    //             $('#answer_list').html(data);
    //         }
    //     })
    // });
    // $('#answer_list').on('click', 'li', function () {
    //     var value = $(this).text();
    //     $('#search').val(value);
    //     $('#answer_list').html("");
    // });
    $('#btn_search').click(function () {
        var query = $('#search').val();
        // alert(query);
        $.ajax({
            url:"/find_answer",
            type:"post",
            data:{'find_query':query},
            success:function (data) {
                $('#fq').html(data);
                // $('.ATQ').hide();
                // $('.item_answer').hide();
                // $('#answer').click(function () {
                //     $('.ATQ').show();
                // });
                // $('.question').each(function(){
                //     $(this).click(function () {
                //         var id=this.id;
                //         // alert(id);
                //         $.ajax({
                //             url:"/viewanswer",
                //             method: 'post',
                //             data:{
                //                 id:id
                //             },
                //             success:function (data) {
                //                 $('#fq').html(data);
                //             }
                //         })
                //     })
                // });
                // $('.ATQ').each(function () {
                //     $(this).click(function () {
                //         var id = this.id;
                //         $('#item' + id + '').toggle();
                //     });
                // });

            }
        })
    })



    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });


});
