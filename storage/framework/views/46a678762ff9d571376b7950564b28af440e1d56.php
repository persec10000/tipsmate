<?php $__env->startSection('link'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/qa.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/rightside.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fireuikit/css/assets/jquery.rateyo.min.css')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('leftside'); ?>

    <div id="cat-all" roll="navigation" class="row">
        <ul class="none FW-400 ml-3" id="categories">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="FC_list" data-product-id="cat<?php echo e($row->id); ?>" id="<?php echo e($row->id); ?>">
                    <?php echo e($row->category); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-6 col-sm-6">
        <div id='loader' style='display: none;'>
            <img src='<?php echo e(asset('fireuikit/images/ajax-loader.gif')); ?>' width='50px' height='50px'>
        </div>

        <div class="row">
            <?php echo e(csrf_field()); ?>

            <ul id="fq" style="width: 100%">
            </ul>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php if(Auth::user()): ?>
<?php $__env->startSection('rightside'); ?>
    <div class=" col-md-2 col-sm-2">
        <div class="ml-3">
            <div id="askbar-holder">
                <form id="ask_frm" method="post" action="<?php echo e(route('addquestion')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="Bgc-t Bgr-n Va-m Fl-start shared-sprite ask-star-icon D-ib Mend-5 Wpx-25 Hpx-25 Fl-start"
                         id="ask_sprite">
                        <img src="<?php echo e(asset('fireuikit/images/combo.png')); ?>">
                    </div>
                    <h2 class="D-ib Fz-18 Fw-300 Mt-neg-1">Ask a Question</h2>
                    <div class="Fw-300">
                        usually answered within minutes!
                    </div>
                    <div class="form-group mb-5">

                        <select class="mt-3 mb-3 form-control" id="sltitle" name="category">
                            <option selected>Select</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($row->id != 1): ?>
                                    <option value="<?php echo e($row->id); ?>"><?php echo e($row->category); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <textarea class="form-control mb-3" name="title" placeholder="What's up" id="rtext"></textarea>
                        <div class="form-group">
                            <textarea id="summernote1" name="comment" class="form-control"></textarea>

                        </div>
                        <footer>
                            <ul>
                                <li>
                                
                                    <input type="button" id="clear" class="btn btn_default" name="clear" value="Reset">
                                <li>
                                    <button id="send" type="submit" class="btn btn-primary">Send</button>
                                </li>
                            </ul>
                        </footer>
                    </div>
                </form>
            </div>
            <div class="google">
                <img src="<?php echo e(asset('fireuikit/images/google_ads.png')); ?>" style="width: 100%">
            </div>
            <div class="mt-3">
                <h4 style="font-weight: bold">Recent Posts......</h4>
                <p><?php echo e($questions[0]->title); ?></p>
                <p><?php echo e($questions[1]->title); ?></p>
                <p><?php echo e($questions[2]->title); ?></p>
                <p><?php echo e($questions[3]->title); ?></p>
                <p><?php echo e($questions[4]->title); ?></p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('fireuikit/js/ask-content.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var _token = $('input[name="_token"]').val();
            load_data('', _token);
            function load_data(id="", _token) {
                $.ajax({
                    url:"<?php echo e(route('loadmore.load_data')); ?>",
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
                                url: "/find_question",
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
                                                        url:"viewanswer",
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
                                                url:'/deletecomment',
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
                                                url:"viewanswer",
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
                                    url:'/deletecomment',
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
                            url: "/find_question",
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
                                                    url:"viewanswer",
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
                                            url:'/deletecomment',
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
                                            url:"viewanswer",
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
                                url:"/find_answer",
                                type:"post",
                                data:{'query':query},
                                success:function (data) {
                                    // alert(data);
                                    $('#fq').html(data);
                                }
                            })
                        });
                        $('.question').each(function(){
                            $(this).click(function () {
                                var id=this.id;
                                // alert(id);
                                $.ajax({
                                    url:"viewanswer",
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
                        $('.more').each(function () {
                            $(this).click(function () {
                                var id = this.id;
                                var x = $('#edit_content'+id+'').html();
                                $('#com'+id+'').html(x);
                                $('.ques_content').off('click').on('click',function () {
                                    $(this).click(function () {
                                        $.ajax({
                                            url:"viewanswer",
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
                    }
                })
            }
            
        
                
            $(document).on('click', '#load_more_button', function () {
                var id = $(this).data('id');
                $('#load_more_button').html('<b>Loading...</br>');
                load_data(id, _token);
                $('.item_answer').hide();

                
                
          })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gordon2012/public_html/tipsmate/resources/views/home.blade.php ENDPATH**/ ?>