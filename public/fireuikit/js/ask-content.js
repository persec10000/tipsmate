$(document).ready(function () {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    //contron function
    $('#loader').hide(); //initially hide the loading icon
    $('#loader').ajaxStart(function(){
        $(this).show();
    });
    $("#loader").ajaxStop(function(){
        $(this).hide();
    });
    $('.item_answer').hide();
    $('.COM').find("img").hide();
    $('.ATQ').hide();
    //event function definition


    $('.editcomment').each(function () {
        $('.item_edit').addClass('itme_edit');
        $(this).click(function () {
            var id=this.id;
            $('#edit'+id+'').toggle();

            var content=$('#edit_content'+id+'').html();

            $('#edit'+id+'').find('.note-editable').html(content);

            $('.note-placeholder').html('');
            $('.edit_summer_reset').each(function () {
                $(this).click(function () {
                    var id=this.id;
                    $('#editsummer'+id+'').summernote('reset');
                })
            });
        });
    });
    $('.deletecomment').each(function () {
        $(this).click(function () {
            var id=this.id;
            $('#li'+id+'').remove();
            $.ajax({
                url:window.location.origin + '/deletecomment',
                method:'post',
                data:{
                    id:id
                }
            });
        });
    });
    $('.FC_list').click(function () {
        console.log("here1");
        var id = this.id;
        var item = id-1;
        category(id,item);
    });
    $('#answer').click(function () {
        $('.ATQ').show();
    });
    $('.ATQ').each(function () {
        $(this).click(function () {
            var id = this.id;
            $('#item' + id + '').toggle();
            $(".config").unbind('click');
        });
    });
    $('#find').click(function () {
        var query = $('#search').val();
        console.log(query);
            search_question(query);


    });
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    $('.ques_content').each(function(){
        $(this).click(function () {
            var id=this.id;
            $.ajax({
                url:window.location.origin + "/viewanswer",
                method: 'post',
                data:{
                    id:id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success:function (data) {
                    $('#fq').html(data);
                    console.log(id);
                    window.history.pushState(document.documentElement.outerHTML, null, "/askme/"+id);
                    $('#post_id').html('undefined');
                    $('#answer').on('click',function () {
                        var msg = $('.notify').text();
                        alert(msg);
                        $('.item_answer').hide();
                        $('#item' + id + '').toggle();
                        $('.summernote').summernote({
                            height: '100px',
                            // placeholder: "Write your answer here...",
                            toolbar: [
                                // [groupName, [list of button]]
                                ['style', ['bold', 'italic', 'clear']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['insert', ['link', 'picture', 'video']],
                            ],
                            fontNames: ['Arial', 'Arial Black'],
                            onPaste:true
                        });
                        $('.summer_reset').each(function () {
                            $(this).click(function () {
                                var id=this.id;
                                // alert(id);
                                $('#summer'+id+'').summernote('reset');
                            })
                        })
                    });

                }
            });


        })
    });
    $('#askme').on('click', function () {
        $('#askme').css("background", "#000");
    });
    $(document).on('click', '#load_more_button', function () {
        var id = $(this).data('id');
        console.log(id);
        $('#load_more_button').html('<b>Loading...</br>');
        load_data(id, _token);
        $('.item_answer').hide();
    });
    // function definition
    function category(id,item){


        $('.FC_list').siblings('li').removeClass('active');
        $('.FC_list').siblings('li').eq(item).addClass('active');

        console.log(id);
        if(id === "1"){
            var _token = $('input[name="_token"]').val();
            console.log('load_Datat');
            $('#fq').html('');
            load_data('',_token);
        }
        else {
            $.ajax({
                url: window.location.origin + "/question",
                method: 'post',
                data: {
                    'id': id
                },
                beforeSend: function () {
                    // Show image container
                    $("#loader").show();
                },
                success: function (data) {
                    $('.item_answer').hide();
                    $('#fq').html(data);
                    $('.editcomment').each(function () {
                        // $('.item_edit').addClass('item_edit');
                        $(this).click(function () {
                            var id = this.id;
                            $('#edit' + id + '').toggle();

                            var content = $('#edit_content' + id + '').html();

                            $('#edit' + id + '').find('.note-editable').html(content);

                            $('.note-placeholder').html('');
                            $('.edit_summer_reset').each(function () {
                                $(this).click(function () {
                                    var id = this.id;
                                    $('#editsummer' + id + '').summernote('reset');
                                })
                            });
                        });
                    });
                    $('.deletecomment').each(function () {
                        $(this).click(function () {
                            var id = this.id;
                            $('#li' + id + '').remove();
                            $.ajax({
                                url: window.location.origin + '/deletecomment',
                                method: 'post',
                                data: {
                                    id: id
                                }
                            });
                        });
                    });
                    $('.more').each(function () {
                        $(this).click(function () {
                            var id = this.id;
                            var x = $('#edit_content' + id + '').html();
                            $('#com' + id + '').html(x);
                            $('.ques_content').off('click').on('click', function () {
                                $(this).click(function () {
                                    $.ajax({
                                        url: window.location.origin + "/viewanswer",
                                        method: 'post',
                                        data: {
                                            id: id
                                        },
                                        success: function (data) {
                                            $('#fq').html(data);
                                            console.log(id);
                                            window.history.pushState(document.documentElement.outerHTML, null, "/askme/" + id);
                                            $('#post_id').html('undefined');
                                        }
                                    })
                                })
                            });
                        })
                    });
                    $('.ATQ').hide();
                    $('.item_answer').hide();
                    $('#answer').unbind('click');
                    $('#answer').click(function () {
                        $('.ATQ').show();
                    });
                    $('.ATQ').each(function () {
                        $(this).click(function () {
                            var id = this.id;
                            $('#item' + id + '').toggle();
                        });
                    });
                    $('.ques_content').each(function () {

                        $(this).click(function () {
                            var id = this.id;

                            $.ajax({
                                url: window.location.origin + "/viewanswer",
                                method: 'post',
                                data: {
                                    id: id
                                },
                                success: function (data) {
                                    $('#fq').html(data);
                                    console.log(id);
                                    window.history.pushState(document.documentElement.outerHTML, null, "/askme/" + id);
                                    $('#post_id').html('undefined');
                                    $('#answer').on('click', function () {
                                        var msg = $('.notify').text();
                                        alert(msg);
                                        $('.item_answer').hide();
                                        $('#item' + id + '').toggle();
                                        $('.summernote').summernote({
                                            height: '100px',
                                            maximumImageFileSize: 1572864,
                                            // placeholder: "Write your answer here...",
                                            toolbar: [
                                                // [groupName, [list of button]]
                                                ['style', ['bold', 'italic', 'clear']],
                                                ['fontsize', ['fontsize']],
                                                ['color', ['color']],
                                                ['para', ['ul', 'ol', 'paragraph']],
                                                ['insert', ['link', 'picture', 'video']],
                                            ],
                                            fontNames: ['Arial', 'Arial Black'],
                                            onPaste: true
                                        });
                                        $('.summer_reset').each(function () {
                                            $(this).click(function () {
                                                var id = this.id;
                                                // alert(id);
                                                $('#summer' + id + '').summernote('reset');
                                            })
                                        })
                                    });

                                }
                            });


                        })
                    });
                    $('.summernote').summernote({
                        height: '300px',
                        maximumImageFileSize: 1572864,//1.5MB
                        // placeholder: "Write your answer here...",
                        toolbar: [
                            // [groupName, [list of button]]
                            ['style', ['bold', 'italic', 'clear']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['insert', ['link', 'picture', 'video']],
                        ],
                        fontNames: ['Arial', 'Arial Black'],
                        onPaste: true
                    });
                    $('.summer_reset').each(function () {
                        $(this).click(function () {
                            var id = this.id;
                            // alert(id);
                            $('#summer' + id + '').summernote('reset');
                        })
                    });
                    window.history.pushState(document.documentElement.outerHTML, null, "/askme/search/cat_id=" + id);
                },
                complete: function (data) {
                    // Hide image container
                    $("#loader").hide();
                }
            });
        }
    }
    function load_post(id){
        console.log(id);

            $.ajax({
                url:window.location.origin + "/viewanswer",
                method: 'get',
                data:{
                    id:id
                },
                success:function (data) {
                    $('#fq').html(data);
                    document.getElementById("post_id").innerHTML = "undefined"
                    $('#answer').on('click',function () {
                        var msg = $('.notify').text();
                        alert(msg);
                        $('.item_answer').hide();
                        $('#item' + id + '').toggle();
                        $('.summernote').summernote({
                            height: '100px',
                            // placeholder: "Write your answer here...",
                            toolbar: [
                                // [groupName, [list of button]]
                                ['style', ['bold', 'italic', 'clear']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['insert', ['link', 'picture', 'video']],
                            ],
                            fontNames: ['Arial', 'Arial Black'],
                            onPaste:true
                        });
                        $('.summer_reset').each(function () {
                            $(this).click(function () {
                                var id=this.id;
                                // alert(id);
                                $('#summer'+id+'').summernote('reset');
                            })
                        })
                    });
                }
            })
        }
    function load_data(id="", _token) {
        $.ajax({
            url: window.location.origin + '/load_data',
            method: "POST",
            data: {id:id, _token:_token},
            success:function (data) {
                $('#load_more_button').remove();
                $('#fq').append(data);
                $('.ATQ').each(function () {
                    $(this).click(function () {
                        var id = this.id;
                        $('#item' + id + '').toggle();
                        $(".config").unbind('click');
                    });
                });
                $('#answer_search').click(function () {
                    var query = $('#search').val();
                    $.ajax({
                        url: window.location.origin + "/find_question",
                        type: "post",
                        data: {'find_query': query},
                        success: function (data) {

                            $('#fq').html(data);
                            $('.more').each(function () {
                                $(this).click(function () {
                                    var id = this.id;
                                    var x = $('#edit_content'+id+'').html();
                                    $('#com'+id+'').html(x);
                                    $('.ques_content').off('click').on('click',function () {
                                        $(this).click(function () {
                                            $.ajax({
                                                url:window.location.origin + "/viewanswer",
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
                                })
                            });
                            $('.ATQ').hide();
                            $('.item_answer').hide();
                            $('#answer').unbind('click');
                            $('#answer').click(function () {
                                $('.ATQ').show();
                            });
                            $('.ATQ').each(function () {
                                $(this).click(function () {
                                    var id = this.id;
                                    $('#item' + id + '').toggle();
                                });
                            });
                            $('.editcomment').each(function () {
                                // $('.item_edit').addClass('item_edit');
                                $(this).click(function () {
                                    var id=this.id;
                                    $('#edit'+id+'').toggle();

                                    var content=$('#edit_content'+id+'').html();

                                    $('#edit'+id+'').find('.note-editable').html(content);

                                    $('.note-placeholder').html('');
                                    $('.edit_summer_reset').each(function () {
                                        $(this).click(function () {
                                            var id=this.id;
                                            $('#editsummer'+id+'').summernote('reset');
                                        })
                                    });
                                });
                            });
                            $('.deletecomment').each(function () {
                                $(this).click(function () {
                                    var id=this.id;
                                    $('#li'+id+'').remove();
                                    $.ajax({
                                        url:window.location.origin + '/deletecomment',
                                        method:'post',
                                        data:{
                                            id:id
                                        }
                                    });
                                });
                            });
                            $('.summernote').summernote({
                                height: '300px',
                                // placeholder: "Write your answer here...",
                                toolbar: [
                                    // [groupName, [list of button]]
                                    ['style', ['bold', 'italic', 'clear']],
                                    ['fontsize', ['fontsize']],
                                    ['color', ['color']],
                                    ['para', ['ul', 'ol', 'paragraph']],
                                    ['insert', ['link', 'picture', 'video']],
                                ],
                                fontNames: ['Arial', 'Arial Black'],
                                onPaste:true
                            })
                            $('.summer_reset').each(function () {
                                $(this).click(function () {
                                    var id=this.id;
                                    // alert(id);
                                    $('#summer'+id+'').summernote('reset');
                                })
                            })
                            $('.ques_content').each(function(){
                                $(this).click(function () {
                                    var id=this.id;
                                    $.ajax({
                                        url:window.location.origin + "/viewanswer",
                                        method: 'post',
                                        data:{
                                            id:id
                                        },
                                        success:function (data) {
                                            $('#fq').html(data);
                                            $('#answer').on('click',function () {
                                                var msg = $('.notify').text();
                                                alert(msg);
                                                $('.item_answer').hide();
                                                $('#item' + id + '').toggle();
                                                $('.summernote').summernote({
                                                    height: '100px',
                                                    // placeholder: "Write your answer here...",
                                                    toolbar: [
                                                        // [groupName, [list of button]]
                                                        ['style', ['bold', 'italic', 'clear']],
                                                        ['fontsize', ['fontsize']],
                                                        ['color', ['color']],
                                                        ['para', ['ul', 'ol', 'paragraph']],
                                                        ['insert', ['link', 'picture', 'video']],
                                                    ],
                                                    fontNames: ['Arial', 'Arial Black'],
                                                    onPaste:true
                                                });
                                                $('.summer_reset').each(function () {
                                                    $(this).click(function () {
                                                        var id=this.id;
                                                        // alert(id);
                                                        $('#summer'+id+'').summernote('reset');
                                                    })
                                                })
                                            });
                                        }
                                    })
                                })
                            });
                            $('.category').each(function () {
                                $(this).click(function () {
                                    var id=this.id;
                                    var item = id-1;
                                    category(id,item);
                                })
                            })
                        }
                    });
                });
                $('.editcomment').each(function () {
                    $('.item_edit').addClass('itme_edit');
                    $(this).click(function () {
                        var id=this.id;
                        $('#edit'+id+'').toggle();

                        var content=$('#edit_content'+id+'').html();

                        $('#edit'+id+'').find('.note-editable').html(content);

                        $('.note-placeholder').html('');
                        $('.edit_summer_reset').each(function () {
                            $(this).click(function () {
                                var id=this.id;
                                $('#editsummer'+id+'').summernote('reset');
                            })
                        });
                    });
                });
                $('.deletecomment').each(function () {
                    $(this).click(function () {
                        var id=this.id;
                        $('#li'+id+'').remove();
                        $.ajax({
                            url:window.location.origin + '/deletecomment',
                            method:'post',
                            data:{
                                id:id
                            }
                        });
                    });
                });

                $('#find').click(function () {
                    var query = $('#search').val();
                    $.ajax({
                        url: window.location.origin + "/find_question",
                        type: "post",
                        data: {'find_query': query},
                        success: function (data) {

                            $('#fq').html(data);
                            $('.more').each(function () {
                                $(this).click(function () {
                                    var id = this.id;
                                    var x = $('#edit_content'+id+'').html();
                                    $('#com'+id+'').html(x);
                                    $('.ques_content').off('click').on('click',function () {
                                        $(this).click(function () {
                                            $.ajax({
                                                url: window.location.origin + "/viewanswer",
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
                                })
                            });
                            $('.ATQ').hide();
                            $('.item_answer').hide();
                            $('#answer').unbind('click');
                            $('#answer').click(function () {
                                $('.ATQ').show();
                            });
                            $('.ATQ').each(function () {
                                $(this).click(function () {
                                    var id = this.id;
                                    $('#item' + id + '').toggle();
                                });
                            });
                            $('.editcomment').each(function () {
                                // $('.item_edit').addClass('item_edit');
                                $(this).click(function () {
                                    var id=this.id;
                                    $('#edit'+id+'').toggle();

                                    var content=$('#edit_content'+id+'').html();

                                    $('#edit'+id+'').find('.note-editable').html(content);

                                    $('.note-placeholder').html('');
                                    $('.edit_summer_reset').each(function () {
                                        $(this).click(function () {
                                            var id=this.id;
                                            $('#editsummer'+id+'').summernote('reset');
                                        })
                                    });
                                });
                            });
                            $('.deletecomment').each(function () {
                                $(this).click(function () {
                                    var id=this.id;
                                    $('#li'+id+'').remove();
                                    $.ajax({
                                        url: window.location.origin + '/deletecomment',
                                        method:'post',
                                        data:{
                                            id:id
                                        }
                                    });
                                });
                            });
                            $('.summernote').summernote({
                                height: '300px',
                                // placeholder: "Write your answer here...",
                                toolbar: [
                                    // [groupName, [list of button]]
                                    ['style', ['bold', 'italic', 'clear']],
                                    ['fontsize', ['fontsize']],
                                    ['color', ['color']],
                                    ['para', ['ul', 'ol', 'paragraph']],
                                    ['insert', ['link', 'picture', 'video']],
                                ],
                                fontNames: ['Arial', 'Arial Black'],
                                onPaste:true
                            })
                            $('.summer_reset').each(function () {
                                $(this).click(function () {
                                    var id=this.id;
                                    // alert(id);
                                    $('#summer'+id+'').summernote('reset');
                                })
                            })
                            $('.ques_content').each(function(){
                                $(this).click(function () {
                                    var id=this.id;
                                    $.ajax({
                                        url: window.location.origin + "/viewanswer",
                                        method: 'post',
                                        data:{
                                            id:id
                                        },
                                        success:function (data) {
                                            $('#fq').html(data);
                                            $('#answer').on('click',function () {
                                                var msg = $('.notify').text();
                                                alert(msg);
                                                $('.item_answer').hide();
                                                $('#item' + id + '').toggle();
                                                $('.summernote').summernote({
                                                    height: '100px',
                                                    // placeholder: "Write your answer here...",
                                                    toolbar: [
                                                        // [groupName, [list of button]]
                                                        ['style', ['bold', 'italic', 'clear']],
                                                        ['fontsize', ['fontsize']],
                                                        ['color', ['color']],
                                                        ['para', ['ul', 'ol', 'paragraph']],
                                                        ['insert', ['link', 'picture', 'video']],
                                                    ],
                                                    fontNames: ['Arial', 'Arial Black'],
                                                    onPaste:true
                                                });
                                                $('.summer_reset').each(function () {
                                                    $(this).click(function () {
                                                        var id=this.id;
                                                        // alert(id);
                                                        $('#summer'+id+'').summernote('reset');
                                                    })
                                                })
                                            });
                                        }
                                    })
                                })
                            });
                            $('.category').each(function () {
                                $(this).click(function () {
                                    var id=this.id;
                                    var item = id-1;
                                    category(id,item);
                                })
                            })
                        }
                    });
                });

                $('.btn_search').click(function () {
                    var query = $('#search').val();
                    $.ajax({
                        url: window.location.origin + "/find_answer",
                        type:"post",
                        data:{'query':query},
                        success:function (data) {
                            alert(data);
                            $('#fq').html(data);
                        }
                    })
                });
                $('.question').each(function(){
                    $(this).click(function () {
                        var id=this.id;
                        // alert(id);
                        $.ajax({
                            url: window.location.origin +  "/viewanswer",
                            method: 'post',
                            data:{
                                id:id
                            },
                            success:function (data) {
                                $('#fq').html(data);
                                window.history.pushState(document.documentElement.outerHTML, null, "/askme/"+id);
                            }
                        })

                    })
                });
                $('.more').each(function () {
                    $(this).click(function () {
                        var id = this.id;
                        var x = $('#edit_content'+id+'').html();
                        $('#com'+id+'').html(x);
                        $('.ques_content').off('click').on('click',function () {
                            $(this).click(function () {
                                $.ajax({
                                    url: window.location.origin + "/viewanswer",
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
                    })
                });
                window.history.pushState(document.documentElement.innerHTML, null, "/askme");
            }
        })
    }
    function search_question(query) {
        if(query === ""){
            var _token = $('input[name="_token"]').val();
            console.log('load_Datat');
            $('#fq').html('');
            load_data('',_token);
        }
        else {
            console.log('ajzk');
            $.ajax({
                url: window.location.origin + "/find_question",
                type: "post",
                data: {'find_query': query},
                success: function (data) {
                    $('#fq').html(data);
                    $('.more').each(function () {
                        $(this).click(function () {
                            var id = this.id;
                            var x = $('#edit_content'+id+'').html();
                            $('#com'+id+'').html(x);
                            $('.ques_content').off('click').on('click',function () {
                                $(this).click(function () {
                                    $.ajax({
                                        url: window.location.origin + "/viewanswer",
                                        method: 'post',
                                        data:{
                                            id:id
                                        },
                                        success:function (data) {
                                            $('#fq').html(data);
                                            console.log(id);
                                            window.history.pushState(document.documentElement.outerHTML, null, "/askme/"+id);
                                            $('#post_id').html('undefined');
                                        }
                                    })
                                })
                            });
                        })
                    });
                    $('.ATQ').hide();
                    $('.item_answer').hide();
                    $('#answer').unbind('click');
                    $('#answer').click(function () {
                        $('.ATQ').show();
                    });
                    $('.ATQ').each(function () {
                        $(this).click(function () {
                            var id = this.id;
                            $('#item' + id + '').toggle();
                        });
                    });
                    $('.editcomment').each(function () {
                        // $('.item_edit').addClass('item_edit');
                        $(this).click(function () {
                            var id=this.id;
                            $('#edit'+id+'').toggle();

                            var content=$('#edit_content'+id+'').html();

                            $('#edit'+id+'').find('.note-editable').html(content);

                            $('.note-placeholder').html('');
                            $('.edit_summer_reset').each(function () {
                                $(this).click(function () {
                                    var id=this.id;
                                    $('#editsummer'+id+'').summernote('reset');
                                })
                            });
                        });
                    });
                    $('.deletecomment').each(function () {
                        $(this).click(function () {
                            var id=this.id;
                            $('#li'+id+'').remove();
                            $.ajax({
                                url: window.location.origin + '/deletecomment',
                                method:'post',
                                data:{
                                    id:id
                                }
                            });
                        });
                    });
                    $('.summernote').summernote({
                        height: '300px',
                        // placeholder: "Write your answer here...",
                        toolbar: [
                            // [groupName, [list of button]]
                            ['style', ['bold', 'italic', 'clear']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['insert', ['link', 'picture', 'video']],
                        ],
                        fontNames: ['Arial', 'Arial Black'],
                        onPaste:true
                    })
                    $('.summer_reset').each(function () {
                        $(this).click(function () {
                            var id=this.id;
                            // alert(id);
                            $('#summer'+id+'').summernote('reset');
                        })
                    })
                    $('.ques_content').each(function(){
                        $(this).click(function () {
                            var id=this.id;
                            $.ajax({
                                url: window.location.origin + "/viewanswer",
                                method: 'post',
                                data:{
                                    id:id
                                },
                                success:function (data) {
                                    $('#fq').html(data);
                                    console.log(id);
                                    window.history.pushState(document.documentElement.outerHTML, null, "/askme/"+id);
                                    $('#post_id').html('undefined');
                                    $('#answer').on('click',function () {
                                        var msg = $('.notify').text();
                                        alert(msg);
                                        $('.item_answer').hide();
                                        $('#item' + id + '').toggle();
                                        $('.summernote').summernote({
                                            height: '100px',
                                            // placeholder: "Write your answer here...",
                                            toolbar: [
                                                // [groupName, [list of button]]
                                                ['style', ['bold', 'italic', 'clear']],
                                                ['fontsize', ['fontsize']],
                                                ['color', ['color']],
                                                ['para', ['ul', 'ol', 'paragraph']],
                                                ['insert', ['link', 'picture', 'video']],
                                            ],
                                            fontNames: ['Arial', 'Arial Black'],
                                            onPaste:true
                                        });
                                        $('.summer_reset').each(function () {
                                            $(this).click(function () {
                                                var id=this.id;
                                                // alert(id);
                                                $('#summer'+id+'').summernote('reset');
                                            })
                                        })
                                    });
                                }
                            })
                        })
                    });
                    $('.category').each(function () {
                        $(this).click(function () {
                            var id=this.id;
                            var item = id-1;
                            category(id,item);
                        })
                    });
                    window.history.pushState(document.documentElement.innerHTML, null, "/askme/search/search="+query);
                }
            });
        }
    }

    if($('#cat_id')[0].textContent !== "undefined"){
        console.log("select category");
        console.log($('#cat_id')[0].textContent);
        var id = $('#cat_id')[0].textContent;
        var item = id -1;
        category(id,item);
    }
    else if( $('#post_id').html() !== 'undefined') {
        console.log("post select");
        load_post($('#post_id').html());
    }
    else if( $('#search_text').html() !== 'undefined'){
        console.log("search select");
        var query = $('#search_text').html();
        console.log(query);
        search_question(query);
    }
    else{
        console.log("load_data");
        var _token = $('input[name="_token"]').val();
        load_data('', _token);
    }
    window.onpopstate = function(e){
        if(e.state){
             window.location.reload()
        }
    };


});
