$.ajaxSetup({
    headers:{
        "X-CSRF-TOKEN":$("meta[name='csrf-token']").attr("content")
}
});
$(".up").click(function() {
    var id=this.id;
    $.ajax({
        url: "/agree",
        method: 'post',
        dataType:'json',
        data: {
            'id': id
        },
        success: function (data) {
           $('#up'+id+'').html('<span id="#up'+id+'">'+data.n_agree+'</span>');
           $('#down'+id+'').html('<span id="#down'+id+'">'+data.n_oppo+'</span>');
        }
    })
});
$(".down").click(function() {
    var id=this.id;
    $.ajax({
        url: "/opposite",
        method: 'post',
        dataType:'json',
        data: {
            'id': id
        },
        success: function (data) {
            $('#up'+id+'').html('<span id="#up'+id+'">'+data.n_agree+'</span>');
            $('#down'+id+'').html('<span id="#down'+id+'">'+data.n_oppo+'</span>');
        }
    })
});
$(".follow").click(function () {
    var id=this.id;
    // alert(id);
    $.ajax({
        url: "/follow",
        method: 'post',

        data: {
            'id': id
        },
        success: function (data) {
            $('#cn_follow').html("<label id='cn_follow'>Following("+data+")</label>");
        }
    })
})
$(".com_drop").hide();
$(".comment").click(function() {
    var id = this.id;
    $("#com"+id+"").toggle();

});
$(".comment-btn").click(function () {
    var id = this.id;
    var comment = $("#t"+id+"").val();
    var name = $("#n"+id+"").val();

    $.ajax({
        url: "/comment",
        method: 'post',
        data: {
            'answer_id': id,
            'comment':comment,
            'name':name
        },
        success: function (data) {
            $("#list"+id+"").html(data);
        }
    })
})
$(".best").hide();

//Click Award best answer
$(".award").each(function () {

    $(this).click(function () {
        var id=this.id;
        $('.rating_container').hide();
        $('#award'+id).toggle();
    })
})
//Rating
$(function () {
    //Best Answer Rating
    var rating = $("#star").attr("data");

    $(".counter") . text(rating);
    $(".rateyo").rateYo({
        rating:rating,
        starWidth: "15px",
        spacing: "5px",
        readOnly:true
    })

    $(".rate").each(function(){
        var $rateYo = $(".rate").rateYo({
            starWidth: "15px",
            spacing: "5px",
            precision:0
        });
        $(this).click(function () {
            var id=this.id;
            var item_id =$(this).attr('data-product-id');
            // alert(item_id);
            var $r = $("#"+id+"").rateYo();
            // var $rating = $r.rateYo("option","rating");
            $("#ard"+item_id+"").unbind('click');
            $("#ard"+item_id+"").click(function () {
                var rating=$r.rateYo("rating");
                // alert(rating);
                $.ajax({
                    url:"/best",
                    method:"post",
                    data:{
                        'best':rating,
                        'answer_id':item_id
                    },success:function () {
                        window.location.assign('/askme');
                    }
                })
            })

        })
    })
});
