<?php
    //описание страницы для поисковых роботов
    $title = "This is the first page of our RPG Game";
    $keywords = "";
    $content = "";
    $description = "";

    //подключаем header.php, куда через переменные вставляем наши СЕО-данные:
    require_once('header.php');
?>

<!--<div class="container">--> <!-- в данном конкретном случае контейнер нам не нужем, чтобы слайдер занимал всю страницу-->
    <!--SLIDER -->
   <div id="carousel" class="carousel slide">
       <!--Round inticators-->
       <ol class="carousel-indicators">
           <li class="active" data-target="#carousel" data-slide="0"></li>
           <li data-target="#carousel" data-slide="1"></li>
           <li data-target="#carousel" data-slide="2"></li>
       </ol>


   <!--собственно слайды-->
       <div class="carousel-inner">
           <!--SLIDE 1-->
           <div class="item active">
               <img src="img/storytale/story01.jpg" alt="">
               <div class="carousel-caption"> <!-- slide text -->
                   <h3>Slide 1</h3>
                   <p>Blah-blah-blah</p>
               </div>
           </div>

           <!--slide 2-->
           <div class="item">
               <img src="img/storytale/story02.jpg" alt="">
               <div class="carousel-caption">
                   <h3>Slide 2</h3>
                   <p>2nd</p>
               </div>
           </div>

           <!--slide 3-->
           <div class="item">
               <img src="img/storytale/story03.jpg" alt="">
           </div>

       </div>

       <!-- Arrows -->
       <a href="#carousel" class="left carousel-control" data-slide="prev">
           <span class="glyphicon glyphicon-chevron-left"></span>
       </a>
       <a href="#carousel" class="right carousel-control" data-slide="next">
           <span class="glyphicon glyphicon-chevron-right"></span>
       </a>
       <a href="#carousel"></a>

   </div>
   <!-- END OF SLIDER-->

<!--</div> <!--END OF CLASS=COMTAINER-->

<?php
    require_once('footer.php');
?>