<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// tombol cari ditekan
if( isset($_POST["cari"]) ) {
	$mahasiswa = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Admin</title>
	
	<style>
        
/* Google Fonts Import Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{
  margin: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  height: 100vh;
  align-items: center;
  justify-content: center;
  background: #c1f7f5;
}
.navbar{
    padding: 0;
  display: flex;
  align-items: center;
  background: #fff;
  padding: 20px 15px;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}

.navbar h1{
  margin-left: 100px;
}

.navbar span{
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  color: blue;
}

.navbar .navbar-item a{
  margin-left: 30px;
  position: relative;
  color: #333;
  font-size: 20px;
  font-weight: 500;
  text-decoration: none;
}

.navbar .navbar-item a:before{
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  height: 3px;
  width: 0%;
  background: #34efdf;
  border-radius: 12px;
  transition: all 0.4s ease;
}
.navbar .navbar-item a:hover:before{
  width: 100%;
}

.container {
  margin: 0 auto;
  max-width: 910px;
}

#large-th{
    margin-top: 20px;
}

.choose {
  width: 100%;
  height: 40px;
}
.fa {
  margin-right: 20px;
  font-size: 30px;
  color: gray;
  float: right;
}
/******************************************
Book stuff
*******************************************/

.book {
  display: inline-block;
  width: 230px;
  height: 390px;
  box-shadow: 0 0 20px #aaa;
  margin: 25px;
  padding: 10px 10px 0 10px;
  vertical-align: top;
  transition: height 1s;
}
/* star button */

.cover {
  border: 2px solid gray;
  height: 80%;
  overflow: hidden;
}

.cover img {
  width: 100%;
}

.book p {
  margin-top: 12px;
  font-size: 20px;
}

.book .author {
  font-size: 15px;
}
@media (max-width: 941px) {
  .container {
    max-width: 700px;
  }
  .book {
    margin: 49px;
  }
}
@media (max-width: 730px) {
  .book {
    display: block;
    margin: 0 auto;
    margin-top: 50px;
  }

}

/*********************************
other
**********************************/

.container h1 {
  text-align: center;
  font-size: 50px;
}

/**********************************
display change
***********************************/
/*book height smaller, cover opacity, move text onto cover and star too
animate it */

/* remove button? */


/***********************************
star animation
***********************************/
/***********************************
zoom on click
***********************************/

	</style>

</head>
<body>

<div class="navbar">
	<div class="navbar-title">
		<h1>Daftar <span>Sekolah</span></h1>
	</div>
	<div class="navbar-item">
		<a href="index.php">Daftar Siswa</a>
		<a href="guru.php">Daftar Guru</a>
		<a href="buku.php">Daftar Buku</a>
		<a href="list.php">List Buku</a>
		<a href="logout.php">Logout</a>
	</div>
</div>

<div id="large-th">
  <div class="container">
    <h1> List Buku </h1>
    <br>
    <div class="choose">
      <a href="#list-th"><i class="fa fa-th-list" aria-hidden="true"></i></a>
      <a href="#large-th"><i class="fa fa-th-large" aria-hidden="true"></i></a>
    </div>
    <div id="list-th">
      <div class="book read">
        <div class="cover">
          <img src="https://s-media-cache-ak0.pinimg.com/564x/f9/8e/2d/f98e2d661445620266c0855d418aab71.jpg">
        </div>
        <div class="description">
          <p class="title">Frankenstein<br>
            <span class="author">Mary Shelley</span></p>
        </div>
      </div>
      <div class="book read">
        <div class="cover">
          <img src="https://alysbcohen.files.wordpress.com/2015/01/little-princess-book-cover.jpg">
        </div>
        <div class="description">
          <p class="title">A Little Princess<br>
            <span class="author">Frances Hodgson Burnett</span></p>
        </div>
      </div>
      <div class="book unread">
        <div class="cover">
          <img src="http://www.publishersweekly.com/images/data/ARTICLE_PHOTO/photo/000/028/28129-1.JPG">
        </div>
        <div class="description">
          <p class="title">Roughing It</br>
            <span class="author">Mark Twain</span></p>
        </div>
      </div>
      <div class="book unread">
        <div class="cover">
          <img src="http://talkingwriting.com//sites/default/files/Bird-by-Bird-image1.jpg">
        </div>
        <div class="description">
          <p class="title">Bird By Bird</br>
            <span class="author">Anne Lamott</span></p>
        </div>
      </div>
<div class="book read">
        <div class="cover">
          <img src="http://d.gr-assets.com/books/1414348859l/23209971.jpg">
        </div>
        <div class="description">
          <p class="title">Girl at War</br>
            <span class="author">Sara Novic</span></p>
        </div>
      </div>
<div class="book read">
        <div class="cover">
          <img src="http://prodimage.images-bn.com/pimages/9780062315007_p0_v2_s192x300.jpg">
        </div>
        <div class="description">
          <p class="title">The Alchemist</br>
            <span class="author">Paulo Coelho</span></p>
        </div>
      </div>


    </div>
  </div>
</div>

<script src="js/script.js"></script>

</body>
</html>