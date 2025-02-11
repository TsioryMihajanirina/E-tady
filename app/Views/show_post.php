<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('css/card-style.css')?>">
    <title>Post</title>
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
            background-color: #f7d7af;/**#F2E2CE */
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

    <div class="navbar navbar-expand-lg navbar-light" id="nav"> <!-- bg-light-->
        <div class="container-fluid">
            <!-- Barre de recherche -->
            <form class="d-flex" action=<?= base_url('search')?> method="post">
                <input class="form-control me-2" type="search" placeholder="Cherchez l'objet ici" name="input_recherche" aria-label="Search">
                <input class="btn btn-outline-secondary" type="submit" value="Chercher">
            </form>  

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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filtrer
                                </a>
                                <form action="filter" method="post">
                                    <select class="dropdown-menu" name="input_filtre" id="filtres">
                                        <option value="" selected>Aucun filtre</option>
                                        <option class="dropdown-item filtre" value="recents">Récents</option>
                                        <option class="dropdown-item filtre" value="electronique">Objets électroniques</option>
                                        <option class="dropdown-item filtre" value="vetements_accessoires">Vêtements et accessoires</option>
                                        <option class="dropdown-item filtre" value="document">Documents</option>
                                        <option class="dropdown-item filtre" value="autre">Autres</option>
                                        <!-- Si value == "" => affiche toutes les publications -->
                                        <option class="filtre" value="">Toutes les publications</option>
                                    </select>
                                    <button hidden type="submit" id="bouton_submettre_filtre">Valider</button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="profile">Votre profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="background-color: #D96725; color: white; border-radius: 20px 20px" href="/logout">Déconnexion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div>
        
    </div>

    <!-- Main -->
    <div id="resultats_recherche">
        <!-- Afficher toutes les cartes si pas encore de recherche-->
        <?php if(count($posts)!=0):?>
            <?php foreach($posts as $post): ?>
                <div class="post-card">
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

    <script>
        // Script pour la soumission des filtres
        const filtres = document.getElementById('filtres');
        const bouton_soumettre_filtre = document.getElementById('bouton_submettre_filtre');
        const options = Array.from(filtres.options);
        localStorage.setItem('lastRoute', location.pathname);
        // const options =  document.querySelectorAll(".filtre");
        console.log(options);

        //Metter l'option selectionnée sur selected
        // for (const option of options){
        //     console.log('opopop');
        //     option.addEventListener('click', function(){
        //         console.log('aaa') //tsy tafiditra ato
        //         // option.selected = true;
        //     })
        // }

        filtres.addEventListener('change', () => {
            bouton_soumettre_filtre.click();
        });
    </script>
    <script src="<?= base_url('js/bootstrap.bundle.min.js')?>"></script>
</body>
</html>