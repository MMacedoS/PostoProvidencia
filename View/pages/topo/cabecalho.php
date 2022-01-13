<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posto Providencia</title>    
      <script src="<?=ROTA_JS?>/jquery5.6.0.js"></script>
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
      <link rel="stylesheet" href="<?=ROTA_CSS?>/style.css">
      <link rel="stylesheet" href="<?=ROTA_CSS?>/boxicons.min.css">
</head>
<body>
    <div class="sidebar">
            <div class="logo_content">
        <div class="logo">
        <i class='bx bxl-codepen'></i>
            <div class="logo_name">
                Sistema Providencia
            </div>
        </div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav_list">
        <li>
                <a href="<?=ROTA_GERAL?>">
                <i class='bx bx-grid-alt' ></i>    
                <span class="link_name">Painel Principal</span></a>
                <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="<?=ROTA_GERAL?>/Cadastro">
            <i class='bx bx-wallet-alt'></i>      
            <span class="link_name">Cadastros</span></a>
            <span class="tooltip">Cadastro</span>
        </li>
        <li>
            <a href="<?=ROTA_GERAL?>/Movimento"> <i class='bx bx-stats'></i>
            <span class="link_name">Movimentação</span></a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href=""> <i class='bx bx-grid-alt' ></i>    <span class="link_name"></span></a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href=""> <i class='bx bx-grid-alt' ></i>    <span class="link_name"></span></a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href=""> <i class='bx bx-grid-alt' ></i>    <span class="link_name"></span></a>
            <span class="tooltip">Dashboard</span>
        </li>
        
    </ul>

    <div class="profile_content">
        <div class="profile">
         <div class="profile_details">
            <img src="<?=ROTA_GERAL?>/View/img/user.jpg" alt="user">
            <div class="name_job">
                <div class="name">
                    Mauricio
                </div>
                <div class="job">
                    Desenvolvedor
                </div>
            </div>
            </div>
            <i class="bx bx-log-out" id="log_out"></i>
        </div>
    </div>
    </div>
    <div class="home_content">
        <div class="text">