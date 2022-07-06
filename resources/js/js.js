$(document).ready(function(){
  $('.data').mask('11/11/1111');
  $('.hora').mask('00:00:00');
  $('.data_hora').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000');
  $('.casa_tel').mask('0000-0000');
  $('.celular_ddd').mask('(00) 00000-0000');
  $('.celular_us').mask('(000) 000-0000');
  $('.cpf').mask('000.000.000-00', {reverse: true});
  $('.dinheiro').mask('000.000.000.000.000,00', {reverse: true});


  //substitui a imagem, faz upload de imagem e troca a imagem.
  var reader = new FileReader();
  reader.onload = function (e) {
    $('#img-config').css('background-image', "url("+e.target.result+")");
    $('#img-config').removeAttr('src');
  }

  function readURL(input){
    if (input.files && input.files[0]) {
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#campo-img").change(function(){
    readURL(this);
  });

  $('.img_thumb').on('click', function(){
    var central = $('.img_central');
    var thumb = $(this).attr('src');

    if(central.attr('src') !== thumb){
      central.fadeTo('200','0', function(){
        central.attr('src', thumb);
        central.fadeTo('150', '1');
      });

      $('.img_thumb.active').removeClass('active');
      $(this).addClass('active');
    }
  });

  $('.publicar .exibir').on('click', function(){
    $(this).next().addClass('active');
    $('body').addClass('active-lightbox');
  });

  $('.lightbox .close').on('click', function(){
    $(this).parent().removeClass('active');
    $('body').removeClass('active-lightbox');
  });
});

$(document).ready(function(){
  if (!jQuery().ajaxForm)
    return;

  if ($('form.form_ajax').length){
    $('form.form_ajax').on('submit', function(e){
      e.preventDefault();
      var form = $(this);
      var alerta = form.children('.alerta');
      form.ajaxSubmit({
        dataType:'json'
        ,success: function(response){
          if (response.msg){
            alerta.html(response.msg);
            
          }

          if (response.status != 0) {
            alerta.addClass('sucesso');

          }else{
            alerta.addClass('erro');
          }

          if (response.redirecionar_pagina){
            window.location = response.redirecionar_pagina;
          }

          if (response.resetar_form){
            form[0].reset();
          }

          if (response.ocultar_alerta){
            setTimeout(
              function(){
                alerta.html('');
                alerta.removeClass('sucesso');
                alerta.removeClass('erro');
            },
            2000);
          }
        }
      });
      return false;
    });
  }
});