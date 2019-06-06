<?php
// qd on va se loger l'id utilisateur on va le conserver donc on démarre une session
//tjrs la 1e instruction d'un fichier php. voir ligne 58 et ajouterpost.php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>association medianet</title>
	<link rel="stylesheet" href="/projetmedianet/view/style.css">
</head>
<body>
<?php 
require("modele/User.php");
require("modele/Article.php");
require("controller/Dao.php");
//ca va permettre de décomposer votre url avec/
$action = explode ("/",parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
//on n'a plus besoin de trainer url ends reécupère le dernier élément du tableau
$action=end($action);
$existe=1;

//j'ai validé enreg, je recup les donnees, j'instancie utilisateur, on va verifier si
//l'utilisateurexiste ou pas
if ($action=="create") {
    $nom=$_GET["nom"];
    $prenom=$_GET["prenom"];
    $datenaiss=$_GET["datenaiss"];
    $login=$_GET["login"];
    $password=$_GET["password"];
    $email=$_GET["email"];
    $utilisateur=new User($nom,$prenom,$datenaiss,$login,$password,$email);
    $dao=Dao::getPdoGsb();
    //on appelle une methode qui compare si le user saisit avec les user de la table user
    //et on récupère vrai ou faut
    //qd vs etes avec un booleen pour tester le cas faux if(!$existeuser) !=NOT
    $existeuser=$dao->verifierUser($utilisateur);
    //on teste si faux(booleen) = ( si il existe pas )
    if (!$existeuser){
    $dao->ajouterUser($utilisateur);
    include("view/login.php");
    }else {
    include("view/enregistrement.php");
    }
}

if ($action=="enregistrer"){
    include("view/enregistrement.php");
}

if ($action=="login"){
    $login=$_GET["login"];
    $password=$_GET["password"];
    $dao=Dao::getPdoGsb();
    $user=$dao->getInfosUser($login, $password);
    if ($user!=null){
        $liste=$dao->getLesArticles();
        // on stocke l'id utilisateur pour le récupérer afin de le traiter ultérieurement
        $_SESSION["iduser"]=$user->getId();
        include("view/accueil.php");
    }else{
        $existe=0;
        include("view/login.php");
    }
}

if ($action=="index.php"){
    include("view/login.php");
}
//ici on traite la req provenant de read more
if ($action=="details"){
    //on récupère l'id
    $id=$_GET["id"];
    $dao=Dao::getPdoGsb();
    //on recherche l'article correspondant à l'id
    $article=$dao->getArticleById($id);
    //si l'article existe on affiche la page détails
    if ($article!=null){
        include("view/details.php");
    }
}
if ($action=="ajouterpost"){
            
        include("view/ajouterpost.php");
}
if ($action=="insererpost"){
    $dao=Dao::getPdoGsb();
    $titre=$_GET["titre"];
    $date=$_GET["date"];
    $idauteur=$_GET["idauteur"];
    $article=$_GET["post"];
    //on instancie un objet Article avec le nouveau constructor 
    $post=new Article($titre,$date,$idauteur,$article);
    //on fait appel à la methode d'ajout d'un nouveau post ( ds Dao)
    $dao->ajouterArticle($post);
    //on appelle tous les articles(avec le nouveau)
    $liste=$dao->getLesArticles();
    include("view/accueil.php");
}
if ($action=="accueil"){
    $dao=Dao::getPdoGsb();
    $liste=$dao->getLesArticles();
    include("view/accueil.php");

}
/* $dao=Dao::getPdoGsb();
 $liste=$dao->getLesUtilisateur();
 foreach($liste as $user1){
 echo "nom : ".$user1->getNom()." prenom :".$user1->getPrenom();
 }
 */
?>
</body>
</html>








