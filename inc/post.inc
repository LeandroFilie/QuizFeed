<?php
echo '<div class="post-info">
  <div class="post-info-details">
    <div class="user-info">
      <img src="'.$linha["avatar"].'" alt="Avatar" class="avatar" loading="lazy" />
      <span>'.$linha["nome_usuario"].'</span>
    </div> 
      
    <div class="post-info-content">
      <span>'.$dataFormatada.'</span>
      <span>'.$horaPost.'</span>
    </div>
  </div>

  <div class="more-menu-post" value="'.$linha["id_postagem"].'" onclick="abrirMenu('.$linha["id_postagem"].')">
    <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></div>
    <div class="more-menu" value="'.$linha["id_postagem"].'">';
    if($linha["nome_usuario"] == $_SESSION["nome_usuario"] || $_SESSION["permissao"] == 1){
      if($_SESSION["permissao"] == 1){
        echo '<div class="more-menu-item excluir" onclick=removerPostAdm('.$linha["id_postagem"].')>';
      }
      else{
        echo '<div class="more-menu-item excluir" onclick=removerPost('.$linha["id_postagem"].')>';
      }
      echo '
              <img src="./assets/images/trash.svg" alt="Excluir" loading="lazy" />
              <p>Excluir</p>
            </div>';
    }
    else if($_SESSION["permissao"] != 1){
      echo '<div class="more-menu-item denunciar" onclick=denunciarPost('.$linha["id_postagem"].')>
              <img src="./assets/images/alert-octagon.svg" loading="lazy" />
              <p>Denunciar</p>
            </div>';
    }
    if($_SESSION["permissao"] == 1 && $linha["situacao"] == 2){
      echo '<div class="more-menu-item tirar-denuncia" onclick=tirarDenuncia('.$linha["id_postagem"].')>
              <img src="./assets/images/alert-octagon.svg" loading="lazy" />
              <p>Tirar Denuncia</p>
            </div>';
    }

    echo '
    </div>
    
  </div>
</div>';

if($linha["conteudo"] != ''){
  echo '<p>'.$linha["conteudo"].'</p>';
}

if($linha["imagem"] != NULL){
  echo '<img src="'.$linha["imagem"].'" class="image-post" alt="Imagem do Post" loading="lazy"/>';
}

echo '
<div class="post-footer">';

  $selectLikes .= ' WHERE cod_postagem = '.$linha["id_postagem"].'';
  $resultadoLikes = mysqli_query($conexao,$selectLikes); 
  $qtdLikes = mysqli_num_rows($resultadoLikes);

  $selectCountComentarioPost = "SELECT conteudo FROM comentario WHERE cod_postagem = '".$linha["id_postagem"]."'";
  $resultadoCountComentarioPost = mysqli_query($conexao,$selectCountComentarioPost); 
  $qtdComentarios = mysqli_num_rows($resultadoCountComentarioPost);

echo ' 
  <div class="info-interacoes" value="'.$linha["id_postagem"].'">
    <span id="likeCount"><span id="numeroLikes">'.$qtdLikes.'</span> Curtidas</span>
    <span id="comentarioCount"><span id="numeroComentarios">'.$qtdComentarios.'</span> Comentários</span>
  </div>

  <div class="interacoes">
      <div class="like" value="'.$linha["id_postagem"].'" onclick="curtir('.$linha["id_postagem"].')">
      ';
      echo '  
        <span >Curtir</span>
      ';
        $selectLikeUser = "SELECT email_usuario as email_curtida, cod_postagem as postagem_like FROM curtida WHERE email_usuario = '".$_SESSION["email"]."' AND cod_postagem = '".$linha["id_postagem"]."'";
        $resultadoLikeUser = mysqli_query($conexao,$selectLikeUser); 

        if(mysqli_num_rows($resultadoLikeUser) > 0){
          echo '<img src="./assets/images/liked.svg" alt="liked" loading="lazy"/>';
        }
        else{
          echo '<img src="./assets/images/like.svg" alt="like" loading="lazy" />';
        }

        echo '
      </div>

      <div class="comentario" onclick="focusComentar('.$linha["id_postagem"].')">
        <span>Comentar</span>
      <img src="./assets/images/answer.svg" alt="comentar" class="comentar" loading="lazy"/>
    </div>
  </div>

</div>

<div class="section-comentarios">';

  echo '
    <div id="'.$linha["id_postagem"].'">';

    $selectComentarioPost = "SELECT comentario.email_usuario as email_usuario, usuario_comum.nome_usuario as nome_usuario, usuario_comum.avatar as avatar, comentario.conteudo as conteudo, comentario.data as data, comentario.hora as hora FROM comentario INNER JOIN usuario_comum ON comentario.email_usuario = usuario_comum.email_usuario WHERE cod_postagem = '".$linha["id_postagem"]."' ORDER BY comentario.data ASC, comentario.hora ASC";
    
      if($qtdComentarios > 3){
        $initial = $qtdComentarios - 3;

        $selectComentarioPost .= " LIMIT $initial, 3";

        echo '<span class="ver-mais" onclick="allComentarios('.$linha["id_postagem"].')">Ver comentários mais antigos</span>';
      }

      $resultadoComentarioPost = mysqli_query($conexao,$selectComentarioPost); 

      while(($linhaComentarios = mysqli_fetch_assoc($resultadoComentarioPost))){
        $dataComentario = date('d/m/Y', strtotime($linhaComentarios["data"]));
        $anoComentario = date('Y', strtotime($linhaComentarios["data"]));

        $dataAtual = date('d/m/Y');
        $anoAtual = date('Y');

        if($dataComentario == $dataAtual){
          $dataFormatadaComentario = 'Hoje';
        }
        else if($anoComentario == $anoAtual){
          $dataFormatadaComentario = date('d/m', strtotime($linhaComentarios["data"]));
        }
        else{
          $dataFormatadaComentario = $dataComentario;
        }

        $horaComentario = date('H:i', strtotime($linhaComentarios["hora"]));

        echo '
          <div class="comentario" data-user="'.$linhaComentarios["email_usuario"].'" data-time="'.$linhaComentarios["hora"].'" data-date="'.$linhaComentarios["data"].'">
            <div class="avatar">
              <img src="'.$linhaComentarios["avatar"].'" alt="Avatar" class="avatar" loading="lazy"/>
            </div>
            <div class="comentario-content">
              <div class="comentario-header">
                <span>'.$linhaComentarios["nome_usuario"].'</span>';
                if($linhaComentarios["nome_usuario"] == $_SESSION["nome_usuario"] || $_SESSION["permissao"] == 1){
                    echo '
                    <div class="more-menu-comentario" onclick=\'abrirMenuComentarios("'.$linhaComentarios["data"].'", "'.$linhaComentarios["hora"].'", "'.$linhaComentarios["email_usuario"].'")\'>
                    <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></div>
                    <div class="menu" data-user="'.$linhaComentarios["email_usuario"].'" data-time="'.$linhaComentarios["hora"].'" data-date="'.$linhaComentarios["data"].'">
                      <div class="more-menu-comentario excluir" onclick=\'removerComentario("'.$linhaComentarios["data"].'", "'.$linhaComentarios["hora"].'", "'.$linhaComentarios["email_usuario"].'", "'.$linha["id_postagem"].'")\'>
                        <img src="./assets/images/trash.svg" alt="Excluir" loading="lazy" />
                        <p>Excluir</p>
                      </div>
                    </div>
                  </div>';
                } 
              echo '</div>
              
              <p>'.$linhaComentarios["conteudo"].'</p>
              <div class="comentario-info">
                <span>'.$dataFormatadaComentario.'</span>
                <span>'.$horaComentario.'</span>
              </div>
            </div>

          </div> 
        ';
      }

  echo '
    </div>

    <div class="enviar-comentario" value='.$linha["id_postagem"].'>
      <input type="text" name="'.$linha["id_postagem"].'" placeholder="Escreva seu comentário" maxlength="500" />
      <img src="./assets/images/send.svg" alt="" class="button_enviar_comentario" onclick="comentar('.$linha["id_postagem"].')" loading="lazy">
    </div>

</div>

<input type="hidden" id="nome_usuario" value="'.$_SESSION["nome_usuario"].'" />
<input type="hidden" id="permissao" value="'.$_SESSION["permissao"].'" />

';

?>