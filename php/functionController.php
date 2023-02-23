<?php
@session_start();
include_once 'funct.php';
$functioner = new funct();

/*USER SIDE FUNCTIONS */

//function to get slides
$slides = $functioner->getSlides();
$abt = $functioner->getAbtUs();
$getGames = $functioner->getGames('3');
$getGamess = $functioner->getGames2();
$indBlogs = $functioner->getIndBlogs1('3');
$indBlogss = $functioner->getIndBlogs('15');
$team = $functioner->getTeam();
$arts = $functioner->getArts();
$carts = $functioner->getTotalCarts();
$cartDet = $functioner->getAllCarts();

/*$states = $functioner->getLiStates();
$properties = $functioner->getProperties();
$allNews = $functioner->getNews();
$allNews2 = $functioner->getNews2();
$testimony = $functioner->getTestimonials();
$getAbout = $functioner->getAbout();


$dTeam = $functioner->getTeam();
$getBoard = $functioner->getBoard();
$getServices = $functioner->getServices();
$getComm = $functioner->getComm();
$ongoing = $functioner->getProjects(0);
$completed = $functioner->getProjects(1);
$vends = $functioner->getVend();
$randPro = $functioner->getRandProjects();
$randNews = $functioner->getRandNews();
$getwelcome = $functioner->getwelcome();

*/

?>

<!--<script type="text/javascript">
 var tam= ""+<?php  $noStd; ?>+"";
    alert("this"+tam);

</script>-->
