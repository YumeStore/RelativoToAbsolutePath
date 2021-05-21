<?php

function atualizar_paths($pagina){

     $url_host = filter_input(INPUT_SERVER, 'HTTP_HOST');
    define('pg', 'http://'.$url_host.'/RelativoToAbsolutePath');



    $text = file_get_contents(pg . '/'. $pagina);
    $doc = new DOMDocument('1.0');
    $doc->loadHTML($text);

    
  
    $text .= "src=\"www.google.com\searh\img.png\n";
    $text.= " src=\"www.google.com\searh\img.png\n";
    // the callback function


    function alterar($matches)
    {
      // as usual: $matches[0] is the complete match
      // $matches[1] the match for the first subpattern
      // enclosed in '(...)' and so on
      // espaço + 3 letras (src) + doi pontos (:) + aspa (")
      echo $matches[0];
      return $matches[0]."www.google.com/";

    }
    /* echo preg_replace_callback(
                "|(\d{2}/\d{2}/)(\d{4})|",
                "alterar",
                $text);
   
         */
    echo preg_replace_callback(
              //  "|(\w{3}=\")([^\w{3}.])|",
                "|(\w{2}=\")([\w{2}.])|",
                "alterar",
                $text);

    
    
}





atualizar_paths('pagina.html');

