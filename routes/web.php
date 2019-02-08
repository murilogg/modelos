<?php

use App\Categoria;
use Illuminate\Support\Facades\DB;


Route::get('/inserir/{nome}', function ($nome) {
    $cat = new Categoria();
    $cat->nome = $nome;
    $cat->save();
    return redirect('consulta');
});

Route::get('novaconsulta', function () {
    $cats = Categoria::all();
    foreach ($cats as $c) {
        echo "ID: " . $c->id . ", ";
        echo "Nome: " . $c->nome . "<br>";
    }
});

Route::get('/', function () {
    $casul = Categoria::all();
    echo "<link href='css/app.css' rel='stylesheet'>";
    echo "<div class='card-body'>";
    echo "<h3>CATEGORIAS<br><br></h3>";
    echo "<p class='card-text'>";
    foreach ($casul as $m) {

        echo "ID: " . $m->id . "; ";
        echo "Nome: " . $m->nome . "<br>";
        echo " <hr>";

    }
    echo "</p>";
    echo "</div>";
    echo "<a href='javascript:history.go(-1)'>VOLTAR</a>";
    //echo "<script src=\'js/app.js\' type=\'text/javascript\'></script>";
});

Route::get('/apagando/{num}', function ($num) {
    DB::table('categorias')->where('id', $num)->delete();
    echo "<h1>REGISTRO COM ID: $num APAGADO COM SUCESSO</h1> ";
});

Route::get('buscar/{id}', function ($id) {
    $cat = Categoria::findOrFail($id);
    if (isset($cat)) {
        echo "ID: " . $cat->id . ", ";
        echo "Nome: " . $cat->nome . "<br>";
    } else {
        echo "<h1>CATEGORIA NÃO ENCONTRADO</h1>";
    }
});

Route::get('atualizar/{id}/{nome}', function ($id, $nome) {
    $cat = Categoria::find($id);
    if (isset($cat)) {
        $cat->nome = $nome;
        $cat->save();
        return redirect('/');
    } else {
        echo "<h1>CATEGORIA NÃO ENCONTRADO</h1>";
    }
});

Route::get('remover/{id}', function ($id) {
    $cat = Categoria::find($id);
    if (isset($cat)) {
        $cat->delete();
        return redirect('/');
    } else {
        echo "<h1>CATEGORIA NÃO ENCONTRADA</h1>";
    }
});

Route::get('pornome/{nome}', function ($nome) {
    $cat = Categoria::where('nome', $nome)->get();
    if (isset($cat)) {
        foreach ($cat as $c) {
            echo "ID: " . $c->id . "; ";
            echo "Nome: " . $c->nome . "<br>";
        }
    } else {
        echo "<h1>CATEGORIA NÃO ENCONTRADO</h1>";
    }
});

Route::get('idmaiorque/{id}', function ($id) {
    $cat = Categoria::where('id', '>=', $id)->get();
    foreach ($cat as $c) {
        echo "ID: " . $c->id . "; ";
        echo "Nome: " . $c->nome . "<br>";
    }
    $cat = Categoria::where('id', '>=', $id)->count();
    echo "<h1>COUNT: $cat</h1>";
    $cat = Categoria::where('id', '>=', $id)->max('id');
    echo "<h1>MAX: $cat</h1>";
});

Route::get('id123', function () {
    $cat = Categoria::find([1, 2, 3]);
    foreach ($cat as $c) {
        echo "ID: " . $c->id . "; ";
        echo "Nome: " . $c->nome . "<br>";
    }
});

Route::get('/todas', function () {
    $cat = Categoria::withTrashed()->get();
    foreach ($cat as $c) {
        echo "ID: " . $c->id . "; ";
        echo "Nome: " . $c->nome;
        if ($c->trashed()) {
            echo "(apagado)<br>";
        } else {
            echo "<br>";
        }
    }
});

Route::get('ver/{id}', function ($id) {
    //$cat = Categoria::withTrashed()->find($id);
    $cat = Categoria::withTrashed()->where('id', $id)->get()->first();
    if (isset($cat)) {
        echo "ID: " . $cat->id . ", ";
        echo "Nome: " . $cat->nome;
        if ($cat->trashed())
            echo " <-(apagado)<br>";
    } else {
        echo "<h1>CATEGORIA NÃO ENCONTRADO</h1>";
    }
    echo "<br><br><pre>$cat = Categoria::withTrashed()->find($id);</pre><br>";
});

Route::get('somenteapagados', function () {
    $cat = Categoria::onlyTrashed()->get();
    foreach ($cat as $c) {
        echo "ID: " . $c->id . ", ";
        echo "Nome: " . $c->nome . " <br>";
    }
});

Route::get('restaurar/{id}', function ($id) {
    $cat = Categoria::withTrashed()->find($id);
    if (isset($cat)) {
        $cat->restore();
        echo "Categoria Restaurada: " . $cat->id . "<br>";
        echo "<a href=\"/\">Listar todas</a>";
    } else {
        echo "<h1>CATEGORIA NÃO ENCONTRADO</h1>";
    }
});

Route::get('apagarpermanente/{id}', function ($id) {
    $cat = Categoria::withTrashed()->find($id);

    if (isset($cat)) {
        $cat->forcedelete();
        return redirect('/todas');
    } else {
        echo "<h1>CATEGORIA NÃO ENCONTRADO</h1>";
    }
});








