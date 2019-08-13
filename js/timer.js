var tiempo = 1201;
var tiempo1 = 1201;
var idIntervalo;
var idIntervalo1;

function incrementarTiempo() {

    var cronometro;

    var horas = 0;
    var minutos = 0;

    cronometro = document.getElementById('tiempo');

    tiempo--;

    segundos = tiempo;
    segundos = segundos % 60;
    
    minutos = Math.floor(tiempo / 60);
    minutos = minutos % 60;
    
    horas = Math.floor(tiempo / 3600);

        cronometro.innerHTML = //(horas.toString().length == 1 ? '0' + horas : horas) 
                            //+ ' <span class="minusculas">h</span> ' 
                            '<i class="fa fa-clock-o"></i> '
                            +(minutos.toString().length == 1 ? '0' + minutos : minutos) 
                            + ' <span class="minusculas">:</span> ' 
                            + (segundos.toString().length == 1 ? '0' + segundos : segundos);
                            //+ ' <span class="minusculas">s</span>';

         if(minutos == 0 && segundos == 0)
         location.reload();
}

function incrementarTiempo1(){
      var cronometro1;

      var horas1 = 0;
      var minutos1 = 0;

      cronometro1 = document.getElementById('tiempo1');

      tiempo1--;

      segundos1 = tiempo1;
      segundos1 = segundos1 % 60;
    
      minutos1 = Math.floor(tiempo1 / 60);
      minutos1 = minutos1 % 60;
    
      horas1 = Math.floor(tiempo1 / 3600);

          cronometro1.innerHTML = //(horas.toString().length == 1 ? '0' + horas : horas) 
                              //+ ' <span class="minusculas">h</span> ' 
                              '<i class="fa fa-clock-o"></i> '
                              +(minutos1.toString().length == 1 ? '0' + minutos1 : minutos1) 
                              + ' <span class="minusculas">:</span> '
                              + (segundos1.toString().length == 1 ? '0' + segundos1 : segundos1);       
}

function iniciarCronometro() {
    idIntervalo = setInterval(incrementarTiempo, 1000);
    idIntervalo = setInterval(incrementarTiempo1, 1000);
}

iniciarCronometro();