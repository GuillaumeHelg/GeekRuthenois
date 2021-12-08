<!DOCTYPE html>
<HTML lang="fr">
	<HEAD>
		<meta charset="utf-8" />
		<TITLE>Le Geek Ruthénois - Matériels</TITLE>
		<META NAME="Description" CONTENT="Le Geek Ruthénois - Magasin d'informatique à Rodez">
		
		<!-- Lien vers mon CSS -->
		<link href="./css/monStyle.css" rel="stylesheet">
		
		<!-- Bootstrap CSS -->
		<link href="./bootstrap/css/bootstrap.css" rel="stylesheet">	
		<link href="./font-awesome/css/font-awesome.css" rel="stylesheet">				
	</HEAD>
	<BODY>
	<?php
		$host = 'localhost';
		$port = '3306';
		$db = 'geekruthenois';
		$user = 'root';
		$pass = 'root';
		$charset = 'utf8mb4';

		$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,
		];
		try {
			$pdo = new PDO($dsn, $user, $pass, $options);
		} catch (PDOException $e) {
			echo $e->getMessage();
			throw new PDOException($e->getMessage(), (int)$e->getCode());
		}
	?>

		<header class="container-fluid">
			<!-- Entete du site Logo + slogan -->
			<div class="row">
				<div class="col-xs-12 col-md-3  entete"> <!-- Colonne Logo -->
					<a href="pages/index.html" Title="Page d'accueil du site" Alt="Le Geek Ruthénois"><img src="./images/LeGeekRuthenois.png" alt="Logo Le Geek Ruthénois" title="Logo Le Geek Ruthénois" class="logo"></a>
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
						<span class="titre"><span class="glyphicon glyphicon-phone"></span>Matériels à la vente</span>
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
						if($typeArticle == "TOUS") {
							$sql = "select * from articles";
							$stmt = $pdo->query($sql);
						} else {
							$sql = "select * from articles where Categorie = ?";
							$stmt = $pdo->prepare($sql);
							$stmt->execute([$typeArticle]);	
						}
						
						while($row = $stmt->fetch()) { ?> 
							<div class="row cadreAvecBordure">
							    <div class="col-xs-12 col-sm-3 aligneHorizontal">
                                <?php
                                $image = $row['Image']; 
                                $cheminImages = "images/";
                                $reference = $row['ID'];
                                echo '<img src="'.$cheminImages.$image.'" alt="'.$reference.'" title="'.$reference.'" class="tailleImagesProd" width="300px" >';
                                ?>
								</div>
								<div class="col-xs-12 col-sm-7 texte">
									<b><?php echo $row['Titre']; ?></b>
									<br /><br /><b>
									<?php echo $row['Description']; ?>
								</div>
								<div class="col-xs-12 col-sm-2 texte">
									<br /><br /><br />
									<button type="button" class="btn btn-primary btn-lg btn-block"><?php echo $row['Prix']; ?></button>
									<button type="button" class="btn btn-primary btn-lg btn-block"><span class="fa fa-shopping-cart"></span> </button>
								</div>
							</div>
						<?php } ?>				
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
