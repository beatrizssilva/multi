<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=0" />
             
        
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo BASE_URL; ?>assets/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo BASE_URL; ?>assets/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo BASE_URL; ?>assets/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo BASE_URL; ?>assets/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo BASE_URL; ?>assets/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo BASE_URL; ?>assets/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo BASE_URL; ?>assets/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo BASE_URL; ?>assets/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>assets/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo BASE_URL; ?>assets/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo BASE_URL; ?>assets/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>assets/favicon/favicon-16x16.png">      
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script> 
       
        <!--        FontAwesome-->
        <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style-painel.css" />
        <title>Lar Alimentos</title>
    </head>
<body>
    <header>
      
            <div class="painel-template-topo">
                <div class="painel-bl-template">
                    <img src="<?php echo BASE_URL; ?>assets/images/lar.png" alt=""/>
                </div>
                <div class="painel-corpo-template">
                    <div class="user-profile">
                        <div class="mensage">
                            <a href="">
                                <i class="far fa-envelope"></i>
                                <div class="mensage-qt">
                                    <?PHP echo '0';?>
                                </div>
                            </a>
                        </div>
                        <div class="notificacoes">
                            <a href="">
                                <i class="far fa-bell"></i>
                                <div class="notificacoes-qt">
                                    <?PHP //echo (isset($viewData['qt_carrinho']))?$viewData['qt_carrinho']:'0';?>
                                    <?PHP echo '0';?>
                                </div>
                            </a>
                        </div>                    
                        <div class="dados-user">
                            <a href="">
                                <!--<i class="fas fa-user-circle"></i>-->
                                <img src="<?php echo BASE_URL; ?>assets/images/user.jpg" class="img-circle" alt="Cinque Terre">
                                <?PHP //echo (isset($viewData['qt_carrinho']))?$viewData['qt_carrinho']:'0';?>
                                <span><?php 
                                $nome = explode(' ', $viewData['dadosUser']['name']);
                                echo ucfirst($nome[0]);?></span>
                            </a>
                        </div>
                        <div class="logout">
                        <a href="<?php echo BASE_URL;?>usuarios/logout">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>                        
                        </div>
                    </div>

                </div>
            </div>
       
        
    </header>
        <div class="painel-template-corpo">
                <div class="painel-barra-lateral">
                    <div class="perfil-user">
                        <img src="<?php echo BASE_URL; ?>assets/images/user.jpg" class="img-circle" alt="Cinque Terre">                        
                        <span><?php 
                        $nome = explode(' ', $viewData['dadosUser']['name']);
                        echo ucfirst($nome[0]);?></span>                        
                    </div>
                    <div class="consumidor">
                        <span>Consumidor:</span>
                    </div>
                    <div class="graduacao" style="<?php
                            switch ($viewData['dadosUser']['patent']){
                                case '1':
                                    echo 'color:#FFF;';
                                    break;
                                case '2':
                                    echo 'color:#F0B782';
                                    break;
                                case '3':
                                    echo 'color:#C6C5CB;';
                                    break;
                                case '4':
                                    echo 'color:#FFFD90;';
                                    break;
                                case '5':
                                    echo 'color:#EC0798;';
                                    break;
                                case '6':
                                    echo 'color:#F7FAFF;';
                                    break;
                                case '7':
                                    echo 'color:#E8EBF2;';
                                    break;
                            }?>">
                            <i class="fas fa-trophy" id="taca"></i>
                            <span>
                                <?php
                            switch ($viewData['dadosUser']['patent']){
                                case '1':
                                    echo 'Pré';
                                    break;
                                case '2':
                                    echo 'Bronze';
                                    break;
                                case '3':
                                    echo 'Prata';
                                    break;
                                case '4':
                                    echo 'Ouro';
                                    break;
                                case '5':
                                    echo 'Rubi';
                                    break;
                                case '6':
                                    echo 'Diamante';
                                    break;
                                case '7':
                                    echo 'Duplo Diamante';
                                    break;
                            }?>
                            </span>
                        </div>
                    <hr>
                    <h4 id="home"><a href="<?php echo BASE_URL;?>"><i class="fas fa-home"></i> Home</a></h4>
                    <hr>
                    <div class="panel-group colapse" id="accordion" role="tablist" aria-multiselectable="false">
                        <div class="panel panel-default colapse">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <i class="fas fa-user"></i> Meus Dados
                                </a>
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <i class="fas fa-angle-down"></i>
                                </a>
                            </h4>
                          </div>
                          <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body" id="lista">
                                <ul id="lista-menu">
                                    <a href="<?php echo BASE_URL;?>painel/dados_pessoais"><li><i class="fas fa-minus-square"></i> Pessoais</li></a>
                                    <a href="<?php echo BASE_URL;?>painel/dados_enderecos"><li><i class="fas fa-minus-square"></i> Endereços</li></a>
                                    <a href="<?php echo BASE_URL;?>painel/dados_cartoes"><li><i class="fas fa-minus-square"></i> Cartões</li></a>
                                    <a href="<?php echo BASE_URL;?>painel/dados_pontos"><li><i class="fas fa-minus-square"></i> Pontos</li></a>
                                </ul>
                            </div>
                          </div>
                        </div><hr>
                        <div class="panel panel-default colapse">
                          <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-shopping-cart"></i> Compras
                                </a>
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-angle-down"></i>
                                </a>
                            </h4>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body" id="lista">
                                <ul id="lista-menu">
                                    <a href=""><li><i class="fas fa-minus-square"></i> Novas</li></a>
                                    <a href=""><li><i class="fas fa-minus-square"></i> Efetuadas</li></a>
                                    <a href=""><li><i class="fas fa-minus-square"></i> Canceladas</li></a>
                                </ul>
                            </div>
                          </div>
                        </div><hr>
                        <div class="panel panel-default colapse">
                          <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                   <i class="fas fa-users"></i> Minha Rede
                                </a>
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-angle-down"></i>
                                </a>
                            </h4>
                          </div>
                          <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body" id="lista">
                                <ul id="lista-menu">
                                    <a href="<?php echo BASE_URL;?>painel/afiliados"><li><i class="fas fa-minus-square"></i> Afiliados</li></a>
                                    <a href="<?php echo BASE_URL;?>painel/convidar"><li><i class="fas fa-minus-square"></i> Convidar</li></a>
                                </ul>
                            </div>
                          </div>
                        </div><hr>
                        <div class="panel panel-default colapse">
                            <div class="panel-heading" role="tab" id="headingFour">
                              <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-dollar-sign"></i> Premiações
                                </a>
                                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-angle-down"></i>
                                </a>
                              </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                              <div class="panel-body" id="lista">
                                <ul id="lista-menu">
                                    <a href=""><li><i class="fas fa-minus-square"></i> Indicação</li></a>
                                    <a href=""><li><i class="fas fa-minus-square"></i> Ativação</li></a>
                                    <a href=""><li><i class="fas fa-minus-square"></i> Liderança</li></a>
                                </ul>
                              </div>
                            </div>
                        </div><hr>
                        <div class="panel panel-default colapse">
                          <div class="panel-heading" role="tab" id="headingFive">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                   <i class="fas fa-file-alt"></i> Relatórios
                                </a>
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-angle-down"></i>
                                </a>
                            </h4>
                          </div>
                          <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                            <div class="panel-body" id="lista">
                                <ul id="lista-menu">
                                    <a href=""><li><i class="fas fa-minus-square"></i> Geral</li></a>
                                    <a href=""><li><i class="fas fa-minus-square"></i> Premiação</li></a>
                                    <a href=""><li><i class="fas fa-minus-square"></i> Compras</li></a>
                                </ul> 
                            </div>
                          </div>
                        </div>
                    </div>
                    
                    </div>
            <div class="painel-home">
                    <?php $this->loadViewinTemplatePanel($viewName, $viewData); ?>
            </div>
    </div>      

    <footer>
        
    </footer>
    <script type="text/javascript">
        var BASE_URL = '<?php echo BASE_URL; ?>';
    </script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script-painel.js" type="text/javascript"></script>    
    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script> 
    
    
</body>
</html>
