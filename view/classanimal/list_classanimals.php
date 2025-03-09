<!DOCTYPE html>
<html>
<head>
  <title th:text="${title} ?: 'ClassAnimal List'"> ClassAnimals List </title>
  <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
  <link rel="stylesheet" href="/animal_php/css/mystyle.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<?php
include '../header.php';
?>
<section layout:fragment="content" style="padding: 0;">
  <section id="explore" class="explore" style="margin-top:-100px;">
    <div class="row" style="margin-top:-450px;margin-left:50px;">
      <div class="col-md-3">
        <h1 class="textexplore" style="margin-top:100px">Khám phá các nhóm động vật cùng NEKOPARA</h1>
      </div>
      <div class="col-md-3">
        <div class="container">
          <a href="/classanimals/detail/1" class="card">
            <div class="front" style="background-image: url('/animal_php/view/design/Explore/bosat.png');"></div>
            <div class="back" style="background-image: url('/animal_php/view/design/Explore/bosat.png');">
              <h1 class="textexplore" >Động vật bò sát</h1>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="container" style="margin-left:-50px;">
          <a href="/classanimals/detail/2" class="card">
            <div class="front" style="background-image: url('/animal_php/view/design/Explore/ca.png');"></div>
            <div class="back" style="background-image: url('/animal_php/view/design/Explore/ca.png');">
              <h1 class="textexplore" >Cá</h1>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="container" style="margin-left:-200px;">
          <a href="/classanimals/detail/3" class="card">
            <div class="front" style="background-image: url('/animal_php/view/design/Explore/chim.png');"></div>
            <div class="back" style="background-image: url('/animal_php/view/design/Explore/chim.png');">
              <h1 class="textexplore" >Chim</h1>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top:60px;">
      <div class="col-md-3">
        <div class="container">
          <a href="/classanimals/detail/4" class="card">
            <div class="front" style="background-image: url('/animal_php/view/design/Explore/dongvatcovu.png');"></div>
            <div class="back" style="background-image: url('/animal_php/view/design/Explore/dongvatcovu.png');">
              <h1 class="textexplore" >Động vật có vú</h1>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="container" style="margin-left:-50px;">
          <a href="/classanimals/detail/5" class="card">
            <div class="front" style="background-image: url('/animal_php/view/design/Explore/khongxuongsong.png');"></div>
            <div class="back" style="background-image: url('/animal_php/view/design/Explore/khongxuongsong.png');">
              <h1 class="textexplore" >Động vật không xương sống</h1>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="container" style="margin-left:-200px;">
          <a href="/classanimals/detail/6" class="card">
            <div class="front" style="background-image: url('/animal_php/view/design/Explore/luongcu.png');"></div>
            <div class="back" style="background-image: url('/animal_php/view/design/Explore/luongcu.png');">

              <h1 class="textexplore" >Động vật lưỡng cư</h1>

            </div>
          </a>
        </div>
      </div>
      <div class="col-md-3">
        <img src="/animal_php/view/design/About/logo.png" alt="Image 1" style="margin-left: -400px;">
      </div>
    </div>
  </section>
</section>
<?php
include '../footer.php';
?>
</body>
</html>

