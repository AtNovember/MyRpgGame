/**
 * Created by Инесса on 23.04.2015.
 */

$(document).ready(function(){

    //---- Анимируем галерею Навыков -----------//

    $('.center').slick({
      centerMode: true,
      centerPadding: '60px',
      slidesToShow: 2,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
    });

    /*------ SKILL PROGRESS-BAR ANIMATION ------*/

    $("#xp-plus" ).click(function(){
            valueGrow = $('.progress-bar').attr('aria-valuenow');
            $(this).parent('.progress').children('.progress-bar').animate({width: "+="+valueGrow},50,alert('Шо ты тыкаешь! да не работает эта функция. Пока нет. Заработает скажу')
            );
        });

    $(function() {
      $('.ui-progressbar').each(function() {
            var value = parseInt($(this).text());
            $(this).empty().progressbar({value: value});
      });
    });

    /* ------ ADD TASK SPOILER MENU------*/

    $(".spoiler-trigger").click(function() {
   		$(this).parent().next().collapse('toggle');
   	});

    /* ---- END FOR ALL -----*/
}) ;