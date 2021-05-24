<?php

function atualizar_paths($pagina){

    $url_host = filter_input(INPUT_SERVER, 'HTTP_HOST');
    define('pg', 'http://'.$url_host.'/RelativoToAbsolutePath');

    $text = file_get_contents(pg . '/'. $pagina);
    
    function alterar($matches)
    {     
      //return preg_replace("/=\"/","=\" ".pg . "/", "".$matches[0]);
      return $matches[0] . pg . "/";
    }
    
    //((src=")(?!http)(?!www))((href=")(?!http)(?!www))
    $new_text =  preg_replace_callback(
      '/((src=")(?!http)(?!www))|((href=")(?!http)(?!www))/',
                "alterar",
                $text);

    $pag_action = fopen($pagina, 'w+' ); //abre o arquivo e deixa em branco
    fwrite($pag_action, $new_text);
    fclose(fopen($pagina, 'r+'));
              
    //var_dump($new_text) ;   
    echo "arquivo corrigido com sucesso";
}




atualizar_paths('pagina.html');
