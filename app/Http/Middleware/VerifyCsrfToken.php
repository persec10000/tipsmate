<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/viewanswer','/find_question','/question','/login', 'register', '/logout', '/editcomment','/deletecomment','/editprofile', '/search_question',
        '/answer', '/addquestion', '/viewanswer', '/agree', '/opposite', '/comment', '/follow', '/best', '/search_answer',
        '/find_answer', '/article/insert', '/article/comment', 'howto/video/insert','/load_data'
    ];
}
