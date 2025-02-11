<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?= base_url('./css/output.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css')?>">

    <span id="id" class="hidden"><?= session()->get('id') ?></span>
    <span id="username" class="hidden"><?= session()->get('username') ?></span>
    <span id="email" class="hidden"><?= session()->get('email') ?></span>

    <style>
        body{
            background-color: #F2E2CE;
        }
        .header {
            background-color: #BF8450;
            color: #F2E2CE;
        }
        .white-background{
            background-color: #F2F0E9;
        }
        .brown-background{
            background-color: #401C07;
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
    <div class="w-full h-20 flex pt-4 pl-4 text-center header">
        <!-- <div id="retour" class=" w-fit h-fit border rounded-lg p-1 bg-red-400 font-semibold cursor-pointer">◀Retour</div> -->
        <a href="/" id="retour" class="d-block btn btn-secondary" style="height: 7vh">◀Retour</a>
        <div class="w-full text-center">
            <div class="w-fit m-auto font-bold text-2xl">E-tady🤝🏻</div>
        </div>
    </div>

    <!-- Formulaire -->

    <div class="container mt-2 mb-2">  
        <div class="row justify-content-center ">
            <div class="col-md-8 ">
                <div class="card white-background">
                    <div class="card-header font-bold">
                        <?php if (isset($publication)): ?>Modifier la <?php else: ?>Créer une <?php endif; ?> publication
                    </div>
                    <div class="card-body">
                        <form action="<?php if (isset($publication)): ?>/update/<?= $publication['id'] ?><?php else: ?> /save <?php endif; ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Profil -->
                                <div class="col-3">
                                    <img src="<?= $imageProfile['path'] ?>" class="rounded-circle" alt="Photo de profil">
                                    <p><strong><?= $utilisateur['username'] ?></strong></p>
                                </div>
                                <div class="col-9">
                                    <!-- Titre -->
                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Entrez ici le titre de la publication ( <span id="numberTape" class=" text-slate-500"></span> caractères)</label>
                                        <input type="text" class="form-control" id="title" name="title" maxlength="60" value="<?php if (isset($publication)): ?><?= $publication['titre'] ?><?php endif; ?>">
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">    
                                        <div id="divDesc" contenteditable="true" class="form-label">
                                            Entrez ici les informations concernant l'objet
                                        </div>
                                        <textarea class="form-control hidden" name="description" id="inputDesc" rows="3" required>
                                            <?php if (isset($publication)): ?>
                                                <?= $publication['description'] ?>
                                            <?php endif; ?>
                                        </textarea>
                                    </div>

                                    <!-- Catégories -->
                                    <div class="mb-3">
                                        <?php if(!isset($publication)) ?>
                                            <label for="categorie" class="form-label">Sélectionnez une catégorie pour l'objet à publier</label>
                                            <select class="form-select" type="text" name="categorie" id="input_categorie">
                                                <option value="electronique">Objets électroniques</option>
                                                <option value="vetements_accessoires">Vêtement ou accessoire</option>
                                                <option value="document">Document</option>
                                                <option value="autre" selected>Autre</option>
                                            </select>
                                    </div>

                                    <!-- Ajout image(s) -->
                                    <div class="mb-3">
                                        <div id="showImage" class=" flex flex-nowrap position-relative">
                                        <?php if (isset($publication)): ?>  
                                            <?php foreach($images as $k => $image): ?>
                                                <div id="imgUp<?= $k ?>" class="w-1/2 flex flex-nowrap relative">
                                                    <div id="remove<?= $k ?>" class="btn btn-danger position-absolute top-1 end-1 opacity-75">Effacer</div>
                                                    <img class="" src="<?= base_url($image['path'])?>" alt="Post Card Image" class="post-card-image">
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </div>

                                        <label id="inputImage" class=" w-full h-auto block mt-2 font-semibold p-1 text-slate-600 cursor-pointer" for="fileImage">
                                            Cliquez ici pour ajouter une ou <span id="nbrMaxImage"></span> images maximum
                                            <input class=" hidden" type="file" name="images[]" accept="image/png, image/jpeg" id="fileImage" multiple>
                                        </label>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success brown-background"><?php if (isset($publication)): ?>Modifier <?php else: ?>Poster <?php endif; ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="<?= base_url('./js/script.js'); ?>"></script>
</body>
</html>