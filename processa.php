<?php

function atualizar_paths($pagina){

    $url_host = filter_input(INPUT_SERVER, 'HTTP_HOST');
    define('pg', 'http://'.$url_host.'/RelativoToAbsolutePath');



    $text = file_get_contents(pg . '/'. $pagina);
    $doc = new DOMDocument('1.0');
    $doc->loadHTML($text);


    $text_new = str_replace('href="', 'href="' . pg . '/', $text);
    $text_new = str_replace('src="', 'src="' . pg . '/', $text_new);
    $text_new = str_replace( pg . "/http" ,  "http",  $text_new);

    $pag_action = fopen($pagina, 'w+' ); //abre o arquivo e deixa em branco
    fwrite($pag_action, $text_new);
    fclose(fopen($pagina, 'r+'));

    echo "<h1>Código Novo</h1>";
    var_dump($text_new);
    echo '<br>----------------------------------------------<br>';
    echo "<h1>Código Antigo</h1>";
    var_dump($text);

    return 0;

}

atualizar_paths('pagina.html');

