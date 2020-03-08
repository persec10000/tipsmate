<?php
return [
    "driver" => "smtp",
    "host" => "smtp.gmail.com",
    "port" => 465,
    "from" => array(
        "address" => "enways17@gmail.com",
        "name" => "noreply"
    ),
    "username" => "no-reply@slamgator.com",
    "password" => "@+y#5$8BzPZM",
    "encryption" => "ssl",
    "sendmail" => "/usr/sbin/sendmail -bs"
];
