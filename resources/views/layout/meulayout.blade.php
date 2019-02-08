<!DOCTYPE html>
<html>
<head>
    <link href="css/app.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
</head>
<body>

@hasSection('meuproduto')
<div class="card">
    <div class="card-body">
        <h3 class="card-title">CATEGORIAS</h3>
        <P class="card-text">
            @yield('meuproduto')
        </P>
        <a href="#" class="card-link">informações</a>
        <a href="#" class="card-link">ajuda</a>
    </div>
</div>
@endif

<script src="js/app.js" type="text/javascript"></script>

</body>
</html>
