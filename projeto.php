<?php

//pega a pagina 
$server = $_SERVER['SERVER_NAME']; 
$endereco = $_SERVER ['REQUEST_URI'];
$url = "http://" . $server . $endereco;

$mosta = '';
$img = '';
$pdf = '';
$txt = '';
$dic = '';

$pg = explode('?',$url);
$caminho = $pg[0]; 

$pg = (isset($pg[1]) ? $pg[1] : '');

$dir = 'modulo/';
$modulos = array();
$pasta= opendir($dir);
while ($arquivo = readdir($pasta)){
	if ($arquivo != '.' && $arquivo != '..'){
		// echo $arquivo . '<br />';
		$nome = explode('.',$arquivo);
		array_push($modulos, $nome[0]);
	}

}


function monta_anexop($nome_arquivo,$arquivo,$link){
  return '
    <div class="col-xs-6 col-lg-4">
      <h4>'.$nome_arquivo.'</h4>
      <p>'.$arquivo.'</p>
      <p><a  class="btn btn-default" href="'.$link.'" role="button">Baixar</a></p>
    </div>
  ';
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Off Canvas Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/offcanvas/offcanvas.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
<!--     <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
 -->
    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

 <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
			<?php 
				foreach ($modulos as $key => $value) {
					echo '<a href="'.$caminho.'?'.$value.'" class="list-group-item">'.$value.'</a>';
				}
			?>
          </div>
        </div>



        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         <!--  <div class="jumbotron">
            <h1>Hello, world!</h1>
            <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
          </div> -->
          <div class="row">

			<table class="table table-hover  col-sm-9"  >
  			
  				
  			
			
				<?php 
				if($pg != ""){
					$arquivo = (file_exists($dir . $pg.'.csv') ? $dir . $pg.'.csv' : $dir . $pg.'.txt');
					$lines = file ($arquivo);
          foreach ($lines as $key => $value) {
          $tabela_dic = '';
					$coluna = explode(';',$value);						
						

            
            
            if($coluna[0] == 'dic'){
              if($coluna[1] == 'nome_tabela'){
                $tabela_dic.= '<thead><tr><th colspan="8">'.$coluna[2].'</th></tr></thead>';
              } 

              if($coluna[1] == 'comentario'){
                $tabela_dic.= '<tr><td colspan="8">'.$coluna[2].'</td></tr>';
              } 
              if($coluna[1] == 'tit_colunas'){
                $tabela_dic.= '<tr><th>'.$coluna[2].'</th>
                                  <th>'.$coluna[3].'</th>
                                  <th>'.$coluna[4].'</th>
                                  <th>'.$coluna[5].'</th>
                                  <th>'.$coluna[6].'</th>
                                  <th>'.$coluna[7].'</th>
                                  <th>'.$coluna[8].'</th>
                                  <th>'.$coluna[9].'</th>
                                </tr>';
              } 
              if($coluna[1] == 'val_colunas'){
                $tabela_dic.= '<tr><td>'.$coluna[2].'</td>
                                  <td>'.$coluna[3].'</td>
                                  <td>'.$coluna[4].'</td>
                                  <td>'.$coluna[5].'</td>
                                  <td>'.$coluna[6].'</td>
                                  <td>'.$coluna[7].'</td>
                                  <td>'.$coluna[8].'</td>
                                  <td>'.$coluna[9].'</td>
                                </tr>';
              } 

              if($coluna[1] == 'tit_models'){
                $tabela_dic.= '<thead><tr><th colspan="8">MODELS</th></tr></thead>';
                $tabela_dic.= '<tr><th colspan="2">'.$coluna[2].'</th>
                                  <th colspan="2">'.$coluna[3].'</th>
                                  <th colspan="2">'.$coluna[4].'</th>
                                  <th colspan="3">'.$coluna[5].'</th>
                                </tr>';
              }  

              if($coluna[1] == 'val_models'){                
                $tabela_dic.= '<tr><td colspan="2">'.$coluna[2].'</td>
                                  <td colspan="2">'.$coluna[3].'</td>
                                  <td colspan="2">'.$coluna[4].'</td>
                                  <td colspan="2">'.$coluna[5].'</td>
                                </tr>';
              } 
              if($coluna[1] == 'fim'){                
                $tabela_dic.= '<tr><td colspan="8"><br><br><br><br></td></tr>';
              } 
              
              $dic.= $tabela_dic;



              
            }
           

						//TITULO
						if($coluna[0] == 'titulo'){
							$mosta.='<thead><tr><th colspan="8">'.$coluna[1].'</th></tr></thead>';
						}
						if($coluna[0] == 'descricao'){
							$mosta.='<tr><td colspan="8">'.$coluna[1].'</td></tr>';
              $mosta.='<tr><td colspan="8"><br><br><br><br></td></tr>';
						}

						
						if($coluna[0] == 'anexos'){
               $extencao = explode('.',$coluna[2]);

               if(!isset($coluna[2])){

                 if($extencao[1] == 'jpg'){ 
                    $img.= monta_anexop($extencao[0],'<img src="anexos/'.$coluna[2].'">','anexos/'.$coluna[2]);
                  }

                  if($extencao[1] == 'pdf'){ 
                    $pdf.= monta_anexop($extencao[0],'<iframe src="anexos/'.$coluna[2].'"></iframe>','anexos/'.$coluna[2]);
                  }

                  if($extencao[1] == 'txt'){ 
                    $txt.= monta_anexop($extencao[0],'<iframe src="anexos/'.$coluna[2].'"></iframe>','anexos/'.$coluna[2]);
                  }
              }
						}

					}

           
					
				}else{
					echo 'home';
				}

           
            $mosta.= $dic;
            $mosta.='<thead><tr><th colspan="8">ANEXOS</th></tr></thead>';
            $mosta.='<tr><td colspan="8">'.$img.'</td></tr>';
            $mosta.='<tr><td colspan="8">'.$pdf.'</td></tr>';
            $mosta.='<tr><td colspan="8">'.$txt.'</td></tr>';
					echo $mosta;

				 ?>

				</table>
           

          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->

       
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2014</p>
      </footer>

    </div><!--/.container-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="http://getbootstrap.com/examples/offcanvas/offcanvas.js"></script>
  </body>
</html>
