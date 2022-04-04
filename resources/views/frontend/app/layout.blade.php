<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="template" content="ShoppingBook">
    <meta name="title" content="ShoppingBook">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
          content="organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, products, farm, grocery, natural, online">
    <title>Home - ShoppingBook</title>
    <link rel="icon" href="images/favicon.png">
@include('frontend.partial.css')
</head>
<body>
@yield('content')
@include('frontend.partial.footer')
@include('frontend.partial.script')
</body>
</html>
