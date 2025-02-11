<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('css/card-style.css')?>">
    <title>Profil d'utilisateur</title>

    <style>
        /* Style du Header */
        .header {
            background-color: #BF8450;
            text-align: center;
            padding: 5rem;
        }

        .title {
            font-size: 4rem;
            font-weight: bold;
            color: #F2F0E9;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }


        /* navbar */
        #nav{
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2); 
            /* background: linear-gradient(to right, #F2E2CE, #D8B999); */
            background: linear-gradient(to right, #F2E2CE, #FFFFFF);
            animation: myAnimation 1s ease-in-out;
        }
        @keyframes myAnimation {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* body */
        body{
            background-color: #F2E2CE;/**#F2E2CE */
        }

        /* Styles du profil utilisateur*/
        body{
            border-radius: 10px;
        }
        .card{
            width: 400px;
            border: none;
            border-radius: 10px;
            background-color: #fff;
        }
        .stats{
            background: #f2f5f8 !important;
            color: #000 !important;
        }
        .articles{
            font-size:10px;
            color: #a1aab9;
        }
        .number1{
            font-weight:500;
        }
        .followers{
            font-size:10px;
            color: #a1aab9;
        }
        .number2{
            font-weight:500;
        }
        .rating{
            font-size:10px;
            color: #a1aab9;
        }
        .number3{
            font-weight:500;
        }


        /* Styles footer */
        .footer {
            background:#232a34;
            padding-bottom: 50px;
            padding-top: 80px;
        }
        .footer_menu {
            margin-bottom: 20px;
        }
        .footer_menu ul {
            list-style: none;
            text-align: center;
        }
        .footer_menu ul li{display: inline-block;}
        .footer_menu ul li a {
            color:#fff;
            padding: 0 10px;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }
        .footer_menu ul li a:hover{color:#554c86;}

        
        .footer_profile{margin-bottom:40px;}
        .footer_profile ul{
        list-style: outside none none;
        margin: 0;
        padding: 0
        }
        .footer_profile ul li{
        display: inline-block;
        }
        @media only screen and (max-width:480px) { 
        .footer_profile ul li{margin:2px;}
        }
        .footer_profile ul li a img{width:60px;}

        .footer_profile ul li a {
            background: #554c86;
            width: 40px;
            height: 40px;
            display: block;
            text-align: center;
            margin-right: 5px;
            border-radius: 50%;
            line-height: 40px;
            box-sizing: border-box;
            text-decoration: none;
            -webkit-transition: .3s;
            transition: .3s;
            color: #fff;
        }
        .footer_copyright {
            margin-bottom: 20px;
            text-transform: uppercase;
            font-size: 12px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            color: #fff;
        }
    </style>
    
</head>
<body>

    
    <header class="header">
        <h1 class="title">E-Tady??</h1>
    </header>

    <div class="navbar navbar-expand-lg navbar-light" id="nav">
        <div class="container-fluid">    
            
            <div>
                <a class="btn btn-outline-secondary" href="/">Retourner à la page d'accueil</a>
            </div>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border rounded">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item ">
                                <a class="nav-link" style=" color: blue;" href="/create">Poster un objet</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " style="background-color: #D96725; color: white; border-radius: 20px 20px" href="/logout">Déconnexion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Profil utilisateur -->
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <div class="image mx-1">
                    <img id="showProfile" src="<?= $imageProfile['path'] ?>" class="rounded" width="155" >
                </div>
                <div class="ml-3 w-100">    
                   <h4 class="mb-0 mt-0"><?= $utilisateur["username"]?></h4>
                   <span><?=$utilisateur["email"]?></span>
                   <div class="p-2 mt-2 bg-primary d-flex justify-content-around rounded text-white stats">
                        <div class="d-flex flex-column">
                            <span class="articles">Publications</span>
                            <span class="number1"><?= $nb_posts?></span>  
                        </div>

                        <div class="d-flex flex-column">
                            <span class="followers">Contact</span>
                            <span class="number2"><?= $utilisateur['telephone']?></span>    
                        </div>
                   </div>
                   <form class="button mt-2 d-flex flex-row align-items-center" action="/profile" method="post" enctype="multipart/form-data">
                       <label id="formImage" class="w-100" for="imageProfile">
                            <div id="addImage" class="btn btn-sm btn-outline-primary w-100">Modifier profil</div>
                           <input hidden type="file" accept="image/png, image/jpeg" name="imageProfile" id="imageProfile">
                        </label>
                        <button hidden id="validImage" class="btn btn-sm btn-outline-primary w-100" type="submit">valider</button>
                    </form>
                </div>                   
            </div>               
        </div>             
    </div>


    <!-- Publications de l'utilisateur -->
    <div id="mes_publications">
        <!-- Afficher toutes les cartes si pas encore de recherche-->
        <?php if(count($posts)!=0):?>
            <?php foreach($posts as $post): ?>
                <div class="post-card position-relative">
                    <?php if ($post['utilisateur_id']==session()->get('id')): ?>
                        <!-- Boutons de modification et de suppression -->
                        <div class="position-absolute top-0 end-0">
                            <a href="/update/<?= $post['publication_id'] ?>"><div class="btn btn-warning bouton-maj" >Mettre à jour</div></a>
                            <a href="/delete/<?= $post['publication_id'] ?>"><div class="btn btn-danger bouton-supprimer" >Supprimer</div></a>
                        </div>
                        
                    <?php endif; ?>
                    <?php foreach($post[0] as $k => $image): ?>
                        <img src="<?= base_url($image['path'])?>" alt="Post Card Image" class="post-card-image">
                    <?php endforeach; ?>
                    <div class="post-card-content">
                        <h2 class="post-card-title"><?= $post['titre'] ?></h2>
                        <p class="post-card-description">
                            <?= $post['description'] ?>
                        </p>
                        <div class="post_category">
                            Catégorie de l'objet perdu: <?= $post['categorie'] ?><br>
                            <?= $post['date_creation'] ?>
                        </div>
                        <a href="">
                            <button class="post-card-button">Contact: <?= $post['telephone'] ?></button>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else:?>
            <?= "Aucune publication" ?> 
        <?php endif ?>      
    </div>



    <footer class="footer">
        <div class="container">		
            <div class="row text-center">						
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="footer_menu">
                        <ul>
                            <li><a href="/">Accueil</a></li>
                            <li><a href="/logout">Se déconnecter</a></li>
                            <li><a href="/create">Poster un objet</a></li>
                        </ul>
                    </div>						
                    <div class="footer_copyright">
                        <p>Merci d'avoir contribué.</p>
                    </div>	
                </div>							
            </div>				
        </div>
    </footer>
    <script src="<?= base_url('js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?= base_url('js/profile.js')?>"></script>
</body>
</html>





