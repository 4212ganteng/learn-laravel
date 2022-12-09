<!DOCTYPE html>
<html lang="en">

<head>
    {{-- meta here --}}
    @include('includes.meta')
    {{-- title here --}}
    <title>@yield('title') | aziganteng</title>
    {{-- sc before style --}}
    @stack('before-style')
    {{-- call style here --}}


</head>
