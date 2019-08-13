// JavaScript Document
$(document).ready(function(e) {

  // Pega informações sobre o navegador do usuário
  navigator.sayswho = (function(){
    var ua= navigator.userAgent, tem,
    M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if(/trident/i.test(M[1])){
      tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
      return 'IE '+(tem[1] || '');
    }
    if(M[1]=== 'Chrome'){
      tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
      if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
    }
    M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
    return M.join(' ');
  })();

  // Verifica se o formato do email inserido é válido
  function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }

  $('#Logar').click(function(e) {
    var email = $('#email_login').val(),
    senha = $('#senha_login').val();

    if(email === "" || senha === "") {
     return Materialize.toast('<span> <i class="fas fa-exclamation-triangle"></i> Todos os campos devem ser preenchidos!</span>', 4000, 'rounded');
   } else {
    if(!validateEmail(email)){
      return Materialize.toast('<span> <i class="fas fa-exclamation-triangle"></i> Endereço de email inválido!</span>', 4000, 'rounded');
    }

    setTimeout(function(){
      $.ajax({
        url: '../engine/controllers/login.php',
        data: {
          email : email,
          senha: senha
        },
        success: function(data) {
          obj = JSON.parse(data);
          if(obj.res === 'true') {
            // PONTO DE CONTROLE -LOGINs EFETUADOS
            var PC_ip = $("#ip").text(),
            PC_cidade = $("#city").text(),
            PC_estado = $("#region").text(),
            PC_pais = $("#country").text(),
            PC_provedor = $("#org").text();

            $.ajax({
              url: '../engine/controllers/pc_loginefetuado.php',
              data : {
                id_usuario : obj.id_usuario,
                tipo_usuario : obj.tipo_usuario,
                ip : PC_ip,
                cidade : PC_cidade,
                estado : PC_estado,
                pais : PC_pais,
                provedor : PC_provedor,
                navegador : navigator.sayswho,
                action : 'create'
              },
              type : 'POST'
            });

            //CONDIÇÕES PARA USUÁRIOS ESPECÍFICOS
            if (email == "socorrer.proace@ufvjm.edu.br") { //email das ocorrencias sendo redirecionado
              document.location.href = '../ocorrencias/ocorrencias.php';
            } else if (email == "josilene.duarte@ufvjm.edu.br" || email == "lais.velano@ufvjm.edu.br" || email == "vania.nunes@ufvjm.edu.br" || email == "gabriella.lely@ufvjm.edu.br" || email == "mical.delfino@ufvjm.edu.br" || email == "adriana.moreira@ufvjm.edu.br" 
            || email == "nerisvaldo.araujo@ufvjm.edu.br" || email == "renata.cordeiro@ufvjm.edu.br") { 
              //emails dos usuario q terao acesso apenas a acessibilidade
              document.location.href = '../acessibilidade/consulta_solicitacoes.php';
            } else if(email == "telma.camara@ufvjm.edu.br" || email == "ludmilla.farnezi@ufvjm.edu.br"){
              //emails dos usuario q terao acesso apenas a odontologia
              document.location.href = '../odontologia/index.php';
            }else {
              document.location.href = '../';
            }

          } else if(obj.res === 'no_user_found') {
            var $toastContent = $('<span> <i class="fas fa-exclamation-triangle"></i> Usuário não encontrado.</span>');
            Materialize.toast($toastContent, 4000, 'rounded');
          } else if(obj.res === 'wrong_password') {
            var $toastContent = $('<span> <i class="fas fa-exclamation-triangle"></i> Senha Incorreta.</span>');
            Materialize.toast($toastContent, 4000, 'rounded');
          } else {
            var $toastContent = $('<span>Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.</span>');
            Materialize.toast($toastContent, 4000, 'rounded');
          }
        },
        type: 'POST'
      });
    }, 800);
  }
});

  $('#senha_login').keypress(function (e) {
    var key = e.which;
    if(key == 13){
     $('#Logar').click();
     return false;
   }
 });
});