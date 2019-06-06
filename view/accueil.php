<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>ASSOCIATION MEDIANET</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<header>
			<div class="container">
				<h1>
					<a href="index.html">association medianet</a>
					<small>association medianet</small>
				</h1>
				<div class="h_right">
					<form>
						<input type="text" placeholder="Search..."><span>deconnection</span>
					</form>
				</div>
			</div>
		</header>
		<nav class="nav main-nav" id="menu">
			<div class="container">
				<ul>
					<li><a href="index.html">Accueil</a></li>
					<li><a href="#">Actualite</a></li>
					<li><a href="#">Services</a>
					<ul>
						<li><a href="#">forum</a></li>
						<li><a href="#">chat</a></li>
						<li><a href="#">annuaire</a></li>
					</ul>
					</li>
					<li><a href="about.html">A propos</a></li>
				</ul>
			</div>
		</nav>
		<div class="container
		content">
		<div class="main block">
			<article class="post">
			<a class="button" href="index.php/ajouterpost">Ajouter post</a>
			<?php foreach($liste as $article){?>
				<h2><?php echo $article->getTitre(); ?></h2>
				<p class="meta">Posted at <?php echo $article->getDate(); ?> by <?php echo $article->getNom(); ?></p>
				<p>
				
					<?php 
					//la fonction sustr de php permet d'extraire une sous-chaine àp d'une chaine
					echo substr($article->getArticle(),0,200)."..."; ?>				</p>
					
					<?php $id=$article->getId();
					// ds le lien hypertext ci-dessous on passe le parametre $id de l'article?>
				<a class="button" href="index.php/details?id=<?=$id?>">Read More</a>
				
			<?php }?>	
			</article>
		</div>
		<div class="side">
			<div class="block">
				<h3>Sidebar Head</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				Nam vel diam hendrerit erat fermentum aliquet sed eget arcu.</p>
				<a class="button">More</a>
			</div>
		</div>
		<div>
			<div class="container">
				<footer class="main-footer">
					<div class="f_left">
						<p>&amp;copy; 2017 - ASSOCIATION MEDIANET</p>
					</div>
					<div class="f_right">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="#">Services</a></li>
						</ul>
					</div>

				</footer>
			</div>
		</div>
	</body>
	</html>
