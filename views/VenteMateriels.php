<!DOCTYPE html>
<HTML lang="fr">
	<HEAD>
		<meta charset="utf-8" />
		<TITLE>Le Geek Ruthénois - Matériels</TITLE>
		<META NAME="Description" CONTENT="Le Geek Ruthénois - Magasin d'informatique à Rodez">
		
		<!-- Lien vers mon CSS -->
		<link href="../css/monStyle.css" rel="stylesheet">
		
		<!-- Bootstrap CSS -->
		<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">	
		<link href="../font-awesome/css/font-awesome.css" rel="stylesheet">				
	</HEAD>
	<BODY>
		<header class="container-fluid">
			<!-- Entete du site Logo + slogan -->
			<div class="row">
				<div class="col-xs-12 col-md-3  entete"> <!-- Colonne Logo -->
					<a href="../index.html" Title="Page d'accueil du site" Alt="Le Geek Ruthénois"><img src="../images/LeGeekRuthenois.png" alt="Logo Le Geek Ruthénois" title="Logo Le Geek Ruthénois" class="logo"></a>
				</div>
				<div class="col-xs-12 col-md-9 entete sansCadre slogan"> <!-- Colonne Slogan -->
					Votre magasin d'informatique à Rodez
				</div>
			</div>
		</header>

		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 cadreAvecBordure"> <!-- bordure du contenu -->
					<div class="col-xs-12 aligneHorizontal "> <!-- titre de la page -->
							<span class="titre"><span class="glyphicon glyphicon-phone"></span> Matériels à la vente</span>
					</div>
					
					<?php 
						// On mets le type article envoyé par le formulaire dans une variable, si il n'est pas envoyé, on mets 'TOUS'
						$typeArticle="TOUS" ;
						if (isset($_GET["typeArticle"])) {
							$typeArticle=$_GET["typeArticle"];
						}
					?>
						
					<div class="row"> <!-- contenu de la page -->
						<div class="col-xs-12 cadreAvecBordure aligneHorizontal"> 
							<!-- Ajout du formulaire avec une partie PHP pour checked -->
							<form method="get" action="VenteMateriels.php" class="form-horizontal">
							  Selection : 
							  Tous <input name="typeArticle" value="TOUS" type="radio" <?php if ($typeArticle=="TOUS") echo 'checked="checked"';?>> &nbsp;&nbsp;&nbsp;&nbsp;
							  PC <input name="typeArticle" value="PC" type="radio" <?php if ($typeArticle=="PC") echo 'checked="checked"';?>> &nbsp;&nbsp;&nbsp;&nbsp;
							  Imprimantes <input name="typeArticle" value="PTR" type="radio" <?php if ($typeArticle=="PTR") echo 'checked="checked"';?>> &nbsp;&nbsp;&nbsp;&nbsp;
							  Casques <input name="typeArticle" value="CAS" type="radio" <?php if ($typeArticle=="CAS") echo 'checked="checked"';?>> &nbsp;&nbsp;&nbsp;&nbsp;
							  Scanner <input name="typeArticle" value="SCA" type="radio" <?php if ($typeArticle=="SCA") echo 'checked="checked"';?>> &nbsp;&nbsp;&nbsp;&nbsp;
							  <input class="btn btn-info" type="submit" value="Valider la selection">
							</form>					
						</div>
					</div>
					<div class="row"> <!-- contenu de la page -->
						<div class="col-xs-12 cadreAvecBordure"> 

						<?php 
							try{ // Bloc try si le fichier n'existe pas ou si on ne trouve pas d'articles de la catégoeir demandée
								if ( !file_exists('articles.txt') ) {
									throw new Exception('Fichier non trouvé.');
								}
								// Ouverture du fichier
								$monfichier = fopen('articles.txt', 'r');
								$cheminImages="../images/Produits/";
								$i=0;
								$nbArticles=0;
								while (!feof($monfichier)) { 			// Boucle pour parcourir le fichier
									$i++;
									$ligne = fgets($monfichier);		// Lecture d'une ligne dans une variable
									if ($i>1) {							// On ne prend pas en compte la 1ere ligne
										$tab = explode(';', $ligne);	// Découpage de la variable dans un tableau
										$reference=$tab[0];				
										$designation=$tab[1];
										$promo=$tab[2];
										$categorie=$tab[3];
										$prix=$tab[4];
										$image=$tab[5];
										
			
										if ($typeArticle==$categorie OR $typeArticle=="TOUS") {
											// Prise en compte de l'article
											$nbArticles++;
											echo '<div class="row cadreAvecBordure  ">'; /* Début ligne */
											echo '<div class="col-xs-12 col-sm-3 aligneHorizontal   ">'; /* Colonne image */
											echo '<img src="'.$cheminImages.$image.'" alt="'.$reference.'" title="'.$reference.'" class="tailleImagesProd">';
											echo '</div>';
											echo '<div class="col-xs-12 col-sm-7 texte">'; /* Colonne Désignation */
											echo "<br /><br /><b>";
											if ($promo=="O") {echo '<span class="produitMisEnAvant"><span class="fa fa-gift fa-spin">&nbsp;&nbsp;</span>';}
											echo "$reference</b><br/>";
											echo $designation;
											echo '</div>	'; /* Fin de la colonne désignation */
											echo '<div class="col-xs-12 col-sm-2 texte">'; /* Colonne Prix */
											echo "<br /><br /><br />";
											echo '<button type="button" class="btn btn-primary btn-lg btn-block">'.$prix.' €</button>' ;
											echo '<button type="button" class="btn btn-primary btn-lg btn-block"><span class="fa fa-shopping-cart"></span> </button>' ;
											echo '</div>'; /* Fin colonne prix */
											echo '</div>'; /* Fin ligne */
										}
									}
								}
								fclose($monfichier); 					// Fermeture du fichier
								if ( $nbArticles==0 ) {
									throw new Exception("Pas d'article dans la catégorie"); // Levée de l'exception si on a pas d'articles de la catégorie demandée
								}
							} catch ( Exception $e ) {
								// Affichage de l'exception levée (fichier inexistant ou pas d'articles de la catégorie demandée)
								echo '<div class="row cadreAvecBordure  ">';
								echo '<div class="col-xs-12 aligneHorizontal   ">';
								echo "<h1>Erreur ".$e->getMessage()." </h1>" ;
								echo "</div>";
								echo "</div>";
							} 
						?>
						</div>
					</div>
				</div>
			</div>
		</div>		
		
		<footer class="container-fluid cadreAvecBordure">
			<!-- Pied de page -->
			<div class="row aligneHorizontal">
				<div class="col-xs-12 menu">
					Menu : <a href="VenteMateriels.php" alt="Acceder à la page matériels"><span class="label label-primary"><span class="glyphicon -phone"></span> Vente de matériels</span></a> 
					<a href="NousContacter.html"><span class="label label-success"><span class="glyphicon glyphicon-envelope"></span> Nous contacter</span></a>
					<a href="MentionsLegales.html"><span class="label label-info"><span class="glyphicon glyphicon-list-alt"></span> Mentions légales</span></a>							
				</div>
				<div class="row aligneHorizontal">
					<div class="col-xs-12">
						<span class="fa fa-cube fa-spin"></span> Le Geek Ruthénois - 50 avenue de Bordeaux - 12000 Rodez - 05.65.77.10.80 - <a href="mailto:info@iut-rodez.fr">info@iut-rodez.fr</a>
					</div>
				</div>							
			</div>			
		</footer>		
		
	</BODY>
</HTML>
<!-- 
Etape 1 Lecture du fichier et affichage
Etape 2 Rajout du formulaire GET pour choisir les articles (metre par défaut celui qui a été choisi)
Etape 3 Ajouter les exceptions pour gerer le cas ou le fichier n'existe pas et les scanners non présents dans le fichier

Donner le fichier avec les lignes (1ere ligne non utilisée)
Donner Fopen, exist + try catch exception. + while (!feof($monfichier)) {
Donner checked aussi 

1ere ligne non utilisée
explode

Titre lecture fichier, boucle, exceptions, formulaires
Donner le fichier des articles
Mettreune variable pour le chemin d'acces aux images.


