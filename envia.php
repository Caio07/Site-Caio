<?php
if(!isset($_POST[Submit])) die("N&atilde;o recebi nenhum par&acitc;metro. Por favor volte ao formulario.html antes");
/* Medida preventiva para evitar que outros dom�nios sejam remetente da sua mensagem. */
if (eregi('tempsite.ws$|locaweb.com.br$|hospedagemdesites.ws$|websiteseguro.com$', $_SERVER[HTTP_HOST])) {
        $emailsender='adriana@dvxfitness.com.br';
        // Esta linha deve ser modificada usando um e-mail v�lido @dominio_do_site
} else {
        $emailsender = "adriana@" . $_SERVER[HTTP_HOST];        
        // Esta linha deve ser modificada usando o mesmo e-mail v�lido @dominio_do_site escrito acima, entretanto apenas at� o caractere "@" (conforme mostrado no c�digo).
        // Precisa ser desta forma porque estamos concatenando o "Seuemail@" com a vari�vel $_SERVER["HTTP_HOST"] do PHP, e esta vari�vel j� possui como valor o dom�nio do site.   
}
 
/* Verifica qual � o sistema operacional do servidor para ajustar o cabe�alho de forma correta. N�o alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
 
// Passando os dados obtidos pelo formul�rio para as vari�veis abaixo
$nomeremetente     = $_POST['nome'];
$emailremetente    = trim($_POST['email']);
$emaildestinatario = 'adriana@dvxfitness.com.br';/* E-mail que deseja receber a mensagem*/
$mensagem          = $_POST['mensagem'];
$assunto         = 'Contato via formul�rio atacado site DVX Fitness';
 
 
/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<P>'.$nome.'</P><P>'.$email.'</P><P>'.$telefone.'</P><P>'.$cidade.'</P><P>'.$estado.'</P><P>'.$mensagem.'</P>';
 
 
/* Montando o cabe�alho da mensagem */
$headers = "MIME-Version: 1.1".$quebra_linha;
$headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
// Perceba que a linha acima cont�m "text/html", sem essa linha, a mensagem n�o chegar� formatada.
$headers .= "From: ".$emailsender.$quebra_linha;
$headers .= "Return-Path: " . $emailsender . $quebra_linha;
$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente ser� usado no campo Reply-To (Responder Para)
 
/* Enviando a mensagem */
mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
 
/* Mostrando na tela as informa��es enviadas por e-mail */
echo "<script>alert('Mensagem enviada com sucesso!');</script>";
echo "<script> window.location.href = 'http://www.dvxfitness.com.br/dvx_novo'; </script>";
?>