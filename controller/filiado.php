<?php
/**
    Data: 19/02/2018
    Objetivo: GERAR GETTERS E SETTERS COM SESSION
    Arquivos relacionados: seja-filiado.php
**/

class Filiado{
    
    public $nome;
    public $nasc;
    public $email;
    public $senha;
    public $confrmSenha;
    public $celular1;
    public $celular2;
    public $etnia;
    public $sexo;
    public $altura;
    public $peso;
    public $acompanha;
    public $cobra;
    
    public function setFiliado(
        $nome, $nasc, $email, $senha, $confrmSenha, $ddd1, $celular1, $ddd2, $celular2,
        $etnia, $sexo, $altura, $peso, $acompanha, $cidade, $estado, $cobra)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $datetime = (date('Y/m/d H:i'));
        
        $data_hoje = date('d/m/Y');
        $dt_hoje = explode('/', $data_hoje);
        
        $dt_nasc = explode('-', $nasc);

        $dia_hoje = $dt_hoje[0];
        $mes_hoje = $dt_hoje[1];
        $ano_hoje = $dt_hoje[2];

        $dia = $dt_nasc[2];
        $mes = $dt_nasc[1];
        $ano = $dt_nasc[0];
                
        /* Verificar idade */
        if($ano > 18){
           $idade = true;
            
        }elseif($ano == 18){

            if ($mes < $mes_hoje) {
                $idade = true;

            } elseif ($mes == $mes_hoje) {

                if ($dia <= $dia_hoje) {
                    $idade = true;

                } else {
                    $idade = false;
                }

            }else{
                $idade = false;
            }

        }else{
            $idade = false;
        }
        
        if($idade == true){
            if ($senha == $confrmSenha) {
                
                $_SESSION['nome'] = $nome;
                $_SESSION['nasc'] = $nasc;
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
                $_SESSION['celular1'] = '('.$ddd1.')'.$celular1;
                
                if($celular2 != null && $ddd2){ 
                    $_SESSION['celular2'] = '('.$ddd2.')'.$celular2;
                }
                $_SESSION['etnia'] = $etnia;
                $_SESSION['sexo'] = $sexo;
                $_SESSION['altura'] = $altura;
                $_SESSION['peso'] = $peso;
                $_SESSION['acompanha'] = $acompanha;
                $_SESSION['cidade'] = $cidade;
                $_SESSION['estado'] = $estado;
                $_SESSION['cobra'] = $cobra;
                
            }else{
                header('location:seja-filiado.php?Erro=Senha');
            }
            
        }else{
            header('location:seja-filiado.php?Erro=Idade');
        }
        
    }
    
    public function getFiliado(){
        
        $filiado = new Filiado();
        
        $filiado->nome = $_SESSION['nome'];
        $filiado->nasc = $_SESSION['nasc'];
        $filiado->email = $_SESSION['email'];
        $filiado->senha = $_SESSION['senha'];
        $filiado->celular1 = $_SESSION['celular1'];
        
        if($_SESSION['celular2'] != null){
        
            $filiado->celular2 = $_SESSION['celular2'];
        }
        
        $filiado->etnia = $_SESSION['etnia'];
        $filiado->sexo = $_SESSION['sexo'];
        $filiado->altura = $_SESSION['altura'];
        $filiado->peso = $_SESSION['peso'];
        $filiado->acompanha = $_SESSION['acompanha'];
        $filiado->cidade = $_SESSION['cidade'];
        $filiado->estado = $_SESSION['estado'];
        $filiado->cobra = $_SESSION['cobra'];
        
        return $filiado;
        
    }
    
    public function getTermos(){
        $termos="
        <center><b> TERMOS DE USO, REGRAS E POLÍTICA DE PRIVACIDADE DO SITE TONIGHT.NET.BR </b></center>

        <p> (Redigida aos ) </p>

        <p>Seguem abaixo os termos de uso, regras e política de privacidade para nossos usuários, assinantes, anunciantes e visitantes.</p>
        
        <br>
        <p><b> DA CLASSIFICAÇÃO: </b></P>

        <p>Anunciantes: Todos aqueles que possuem um banner, perfil e/ou espaço para divulgação de serviços e/ou negócios no site.

        Assinantes e prestadores de serviços: Todos aqueles que possuem um perfil com muito mais recursos do que um usuário gratuito. Além disso, dependendo do plano contratado, também concorrerão a prêmios exclusivos, participarão de promoções e ganharão descontos em produtos dos nossos anunciantes.

        Usuários: São aqueles que utilizam dos recursos limitados do site de forma gratuita.</p>

        <br>
        <p><b> DA PRIVACIDADE: </b></p>

        <p> Sua privacidade é extremamente importante para a nossa equipe! </p>

        <p>Sempre que ocorrer a necessidade de um contato direto com um de nossos clientes e usuários, isso será feito através do site, pelo e-mail cadastrado e por meio de mensagem via aplicativo whatsapp (através do telefone cadastrado).

        Em casos extremos, ligaremos diretamente para o telefone cadastrado. </p>

        <p>Seus dados sensíveis,tais como: senha, e-mail, IP, telefone, nome real e/ou endereço completo, jamais serão expostos a outros usuários do site ou mesmo a terceiros, salvo em casos de demanda judicial/policial.</p>
        
        <br>
        <p><b> DO CADASTRO: </b> </p>

        <p>O conteúdo do site não se destina a menores de 18 (dezoito) anos! Assim sendo, conforme a legislação vigente no país (Brasil), fica proibido o cadastro de pessoas menores de 18 (dezoito) anos. Observação: Osite poderá, a qualquer momento, excluir o cadastro do usuário identificado (ou suspeito) como sendo menor de 18 (dezoito) anos. O ocorrido será informado às autoridades legais competentes. PEDOFILIA É CRIME! DENUNCIE!</p>

        <p>A quantidade de perfis cadastrados no site ficará a critério de cada usuário. Assim, por exemplo, se um casal quiser ter mais de um perfil, será permitido, uma vez que não cabe ao site  TONIGHT.NET.BR dizer o que um casal pode ou não pode fazer!</p>

        <p>Cuidado ao escolher uma senha! A criação da senha de cada perfil é de responsabilidade do próprio usuário do site. Lembre-se que, quanto mais complexa ela for, menor serão as chances de eventuais problemas futuros! </p>

        <p>É terminantemente proibida a criação de perfis falsos (fakes) no site que visem ludibriar os demais usuários do TONIGHT.NET.BR. Os perfis falsos, assim que identificados, serão excluídos e o ocorrido será levado ao conhecimento dos demais usuários do site, bem como às autoridades legais competentes. Tentar refazer ou criar um novo perfil só agravará ainda mais o problema! </p>

        <p>Ao se cadastrar, o usurário do site deverá incluir em seu perfil ao menos 3(três) fotos suas. Fotos falsas (fakes), assim que detectadas, resultarão na exclusão do perfil.</p>

        <p>Perfis sem movimentação por período superior a 3 (três) meses serão automaticamente excluídos (sem aviso prévio!).</p>

        <br>
        <p><b>DAS COMUNICAÇÕES ENTRE OS USUÁRIOS, OS ASSINANTES E OS ANUNCIANTES EM QUALQUER DAS FERRAMENTAS DO SITE:</b></p>

        <p>A comunicação realizada no site TONIGHT.NET.BR deverá ser pautada na boa educação, na cordialidade e com base no respeito pelos desejos e limites do outro.</p>

        <p>Toda e qualquer imageme/ou vídeo publicado e/ou compartilhado no site é de inteira responsabilidade dos próprios usuários e dos demais anunciantes do site.</p>

        <p>Todo o conteúdo de comercial e/ou anúncio de festas, produtos e serviços terá de ser publicado em local específico dentro do site TONIGHT.NET.BR. O que fugir a esta regra, terá de ter uma autorização prévia do site.</p>

        <p>Você não poderá enviar vírus ou outros códigos maliciosos.</p>

        <p>Toda forma de desrespeito aos usuários, assinantes e demais participantes do site será repudiada imediatamente, assim que o denunciado for identificado. </p>
        <p>Tudo o que for falado publicamente no site, a quem quer que seja, será arquivado e poderá ser utilizado no caso de eventuais demandas/solicitações judiciais. </p>

        <p>Intimidações, ameaças, ofensas, bullying são práticas criminosas! A constatação de quaisquer delas em nosso site serão remetidas às autoridades competentes para que tomem as medidas cabíveis.</p>

        <p>É proibido o uso do site TONIGHT.NET.BR para prática de qualquer tipo de contravenção, crime ou atos que não estejam em conformidade com a legislação brasileira.</p>

        <p>Não será tolerada qualquer tipo de publicação que gere discussões desnecessárias bem como que contenham informações que agridam a integridade (como por exemplo: mentiras, calúnias, difamações, injúrias, etc.) de qualquer pessoa que frequente o site.</p>

         <p>O TONIGHT.NET.BR veda e tomará as medidas legais cabíveis contra todo conteúdo  considerado como spam ou algo do gênero.</p>

        <br>
        <p><b>DA PUBLICAÇÃO DE MÍDIAS (FOTOS, VÍDEOS E AFINS):</b></p>

        <p>Toda a publicação de mídia confeccionada e editada será feita exclusivamente por você usuário, que terá seus direitos de uso preservados.</p>

        <p>É proibido o uso de mídias copiadas da webe/ou de outros usuários do site TONIGHT.NET.BR.</p>

        <p>Toda imagem publicada e compartilhada de terceiros, amigos e afins só será permitida com autorização prévia dos mesmos.</p>

        <p>Todo conteúdo que contenha pedofilia, zoofilia, necrofilia, mutilação ou conteúdo considerado ilegal, discriminatório ou agressivo será retirado do site e denunciado às autoridades competentes.</p>

        <br>
        <p><b>DOS DIREITOS E DEVERES ESPECIAIS PARA ANUNCIANTES:</b></p>

        <p>Os anunciantes poderão utilizar o próprio mural para anunciar seus produtos e serviços. </p>
        <p>Isto poderá ser feito uma única vez ao dia, enquanto durar sua assinatura no site TONIGHT.NET.BR, conforme o contrato escolhido, e nos murais específicos para esta finalidade (propaganda de produtos e serviços), podendo, caso desejarem, conter imagens e/ou valores.</p>

        <br>
        <p><b>DOS DIREITOS DO SITE TONIGHT.NET.BR:</b></p>

        <p>Nossa equipe trabalha para manter o site TONIGHT.NET.BR sempre atualizado, seguro e com o máximo em firewall. Entretanto nossos usuários o utilizam por sua conta e risco. </p>

        <p>Todo o conteúdo removido por usuários, incluindo mídias, poderão ser armazenados em nossos backups por tempo indeterminado.</p>

        <p>Todo o conteúdo PÚBLICO poderá ser visto por todos os visitantes do site, estes tendo ou não uma conta no TONIGHT.NET.BR.</p>

        <p>Suas mídias PÚBLICAS poderão ser selecionadas para utilização em nossa página principal do site, bem como serem utilizadas em nossas campanhas de marketing.</p>

        <p>Nossa marca e logotipo são de uso restrito dos representantes legais do TONIGHT.NET.BR, e não deverão ser utilizados sem autorização prévia dos mesmos.</p>

        <p>Poderemos, a qualquer momento, alterar qualquer recurso gratuito do site para uso exclusivo dos assinantes.</p>

        <p>A qualquer momento, a equipe do TONIGHT.NET.BR poderá remover, excluir, armazenar e/ou repassar as autoridades legais todo tipo de conteúdo que julgar estar fora dos parâmetros de exigência das normas de utilização do site. </p>

        <p>A nossa logomarca poderá ser utilizada em futuros projetos na web somente pelos proprietários legais do site TONIGHT.NET.BR.</p>

        <br>
        <p><b>DOS TERMOS RESCISÓRIOS:</b></p>

        <p>Caso o usuário venha a violar os termos de utilização e a essência do presente site, ou venha ainda, gerar possível risco ou exposição legal para nós, poderemos deixar de fornecer, no todo ou parte, os serviços constantes no site TONIGHT.NET.BR. </p>
        <p>Notificaremos você, usuário, na próxima vez que você tentar acessar sua conta. Você também é livre para excluir sua conta a qualquer momento!</p>

        <p>Não haverá reembolso de valores pagos por motivo de discordância de qualquer termo utilização deste site ou por arrependimento. Caberá reembolso somente nos casos decorrentes de problemas técnicos ou por erros de faturamento.</p>

        <br>
        <p><b>DISPOSIÇÕES FINAIS:</b></p>

        <p>Ao concordar com estes termos de utilização e serviço, você também concorda que os moderadores do site TONIGHT.NET.BR atuem como árbitros para o julgamento das questões acima citadas.</p>

        <p>Boas vindas!!!</p>

        <p>É com muito prazer e satisfação que damos boas vindas a todos e esperamos que seus desejos mais íntimos se realizem através do nosso site. Esperamos promover, acima de tudo, muitas novas e boas amizades!</p>

        ";
        
        return $termos;
    }
    
}

?>