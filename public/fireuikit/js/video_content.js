$.ajaxSetup({
    headers:{
        "X-CSRF-TOKEN":$("meta[name='csrf-token']").attr("content")
}
});

$(".up").click(function() {
    var id=this.id;
    $.ajax({
        url: "/video/like",
        method: 'post',
        dataType:'json',
        data: {
            'id': id
        },
        success: function (data) {
           document.getElementById("like").innerHTML = data.like;
           document.getElementById("unlike").innerHTML = data.unlike;
        }
    })
});
$(".down").click(function() {
    var id=this.id;
    $.ajax({
        url: "/video/unlike",
        method: 'post',
        dataType:'json',
        data: {
            'id': id
        },
        success: function (data) {
            document.getElementById("like").innerHTML = data.like;
            document.getElementById("unlike").innerHTML = data.unlike;
        }
    })
});
