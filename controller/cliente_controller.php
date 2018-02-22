<?php
/**
    Data: 10/02/2018
    Objetivo: Controle de dados de clientes
    Arquivos relacionados: router.php, seja-cliente.php, cliente_class.php
**/

class ControllerCliente{
    
    public function Logar(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $cliente = new Cliente();
            $cliente->email = $_POST['txtEmail'];
            $cliente->senha = $_POST['txtSenha'];
            
            $cliente->Login($cliente);
            
        }
    }
    
    public function Cadastrar(){
        date_default_timezone_set('America/Sao_Paulo');
        $datetime = (date('Y/m/d H:i'));
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if ($_POST['txtSenha'] == $_POST['txtConfrmSenha']) {
                
                $data_hoje = date('d/m/Y');
                $dt_hoje = explode('/', $data_hoje);
                
                $dia_hoje = $dt_hoje[0];
                $mes_hoje = $dt_hoje[1];
                $ano_hoje = $dt_hoje[2];
                
                $dia = $_POST['slc_dia'];
                $mes = $_POST['slc_mes'];
                $ano = $_POST['slc_ano'];
                
                $cliente = new Cliente();

                $ddd = $_POST['txtDDD'];
                $numero = $_POST['txtCel'];

                $cliente->celular = '('.$ddd.')'.$numero;
                $cliente->nome = $_POST['txtNome'];
                $cliente->email = $_POST['txtEmail'];
                $cliente->senha = $_POST['txtSenha'];
                $cliente->sexo = $_POST['slc_sexo'];
                $cliente->enteresse = $_POST['slc_enteresse'];
                $cliente->estado = $_POST['txtUf'];
                $cliente->cidade = $_POST['txtCidade'];
                $cliente->nasc = $ano."-".$mes."-".$dia;
                $cliente->datetime =  $datetime;
                
                $anos = $ano_hoje - $ano;
                
                if($anos > 18){
                   //echo ('anos');
                    $cliente->InsertCliente($cliente);
                    
                }elseif($anos == 18){
                    
                    if ($mes < $mes_hoje) {
                        //echo ('mes');
                        $cliente->InsertCliente($cliente);
                        
                    } elseif ($mes == $mes_hoje) {
                        
                        if ($dia <= $dia_hoje) {
                            //echo ('dia');
                            $cliente->InsertCliente($cliente);
                            
                        } else {
                            header('location:seja-cliente.php?erro=idade');
                        }
                        
                    }else{
                        header('location:seja-cliente.php?erro=idade');
                    }
                    
                }else{
                    header('location:seja-cliente.php?erro=idade');
                    
                }
                
            }else{
                header('location:seja-cliente.php?erro=senha');
                
            }
            
        }
        
    }
    
    public function Alterar(){
        $id = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data_hoje = date('d/m/Y');
            $dt_hoje = explode('/', $data_hoje);

            $dia_hoje = $dt_hoje[0];
            $mes_hoje = $dt_hoje[1];
            $ano_hoje = $dt_hoje[2];

            $dia = $_POST['slc_dia'];
            $mes = $_POST['slc_mes'];
            $ano = $_POST['slc_ano'];

            $cliente = new Cliente();

            $ddd = $_POST['txtDDD'];
            $numero = $_POST['txtCel'];

            $cliente->id = $id;
            $cliente->celular = '('.$ddd.')'.$numero;
            $cliente->nome = $_POST['txtNome'];
            $cliente->email = $_POST['txtEmail'];
            $cliente->sexo = $_POST['slc_sexo'];
            $cliente->id_cidade = $_POST['cod_cidades'];
            $cliente->enteresse = $_POST['slc_prefere'];
            $cliente->nasc = $ano."-".$mes."-".$dia;

            $anos = $ano_hoje - $ano;

            if($anos > 18){
                $cliente->UpdateCliente($cliente);

            }elseif($anos == 18){

                if ($mes < $mes_hoje) {
                    $cliente->UpdateCliente($cliente);

                } elseif ($mes == $mes_hoje) {

                    if ($dia <= $dia_hoje) {
                        $cliente->UpdateCliente($cliente);

                    } else {
                        header('location:perfil.php?perfil=cliente&erro=idade');
                    }

                }else{
                    header('location:perfil.php?perfil=cliente&erro=idade');
                }

            }else{
                header('location:perfil.php?perfil=cliente&erro=idade');

            }
            
        }
        
        
    }
    
    public function BuscarDadosUsuario($id){
        require_once('model/cliente_class.php');
        
        $cliente_class = new Cliente();
        $rs = $cliente_class->SelectClienteById($id);
        
        return $rs;
        
    }
    
    public function BuscarEstados(){
        require_once('model/cliente_class.php');
        
        $cliente_classe = new Cliente();
        $result = $cliente_classe->SelectEstados();
       
        return $result;
    }
    
    public function BuscarCidade(){
        require_once('model/cliente_class.php');
        
        $cliente_class = new Cliente();
        $result = $cliente_class->SelectCidade();
        
        return $result;
        
    }
    
    public function BuscarSugestoes($id){
        require_once('model/cliente_class.php');
        
        $cliente = new Clienrte();
        $rs = $cliente->SelectSugestoes();
        
        return $rs;
    }
    
    public function getTermos(){
        $termos = "
        <center><b> TERMOS DE USO, REGRAS E POLÍTICA DE PRIVACIDADE DO SITE TONIGHT.NET.BR </b></center>
        
        <p>Seguem abaixo os termos de uso, regras e política de privacidade para nossos usuários, assinantes, anunciantes e visitantes.</p>
        
        <br>
        <p><b> CLASSIFICAÇÃO: </b></p>

        <p>Anunciantes: Todos aqueles que possuem um banner, perfil e/ou espaço para divulgação de serviços e/ou negócios no site.

        Assinantes e prestadores de serviços: Todos aqueles que possuem um perfil com muito mais recursos do que um usuário gratuito. Além disso, dependendo do plano contratado, também concorrerão a prêmios exclusivos, participarão de promoções e ganharão descontos em produtos dos nossos anunciantes.

        Usuários: São aqueles que utilizam dos recursos limitados do site de forma gratuita.</p>

        <br>
        <p><b> PRIVACIDADE: </b></p>

        <p> Sua privacidade é extremamente importante para a nossa equipe! </p>

        <p>Sempre que ocorrer a necessidade de um contato direto com um de nossos clientes e usuários, isso será feito através do site, pelo e-mail cadastrado e por meio de mensagem via aplicativo whatsapp (através do telefone cadastrado).

        Em casos extremos, ligaremos diretamente para o telefone cadastrado. </p>

        <p>Seus dados sensíveis,tais como: senha, e-mail, IP, telefone, nome real e/ou endereço completo, jamais serão expostos a outros usuários do site ou mesmo a terceiros, salvo em casos de demanda judicial/policial.</p>
        
        <br>
        <p><b> CADASTRO: </b> </p>

        <p>O conteúdo do site não se destina a menores de 18 (dezoito) anos! Assim sendo, conforme a legislação vigente no país (Brasil), fica proibido o cadastro de pessoas menores de 18 (dezoito) anos. Observação: Osite poderá, a qualquer momento, excluir o cadastro do usuário identificado (ou suspeito) como sendo menor de 18 (dezoito) anos. O ocorrido será informado às autoridades legais competentes. PEDOFILIA É CRIME! DENUNCIE!</p>

        <p>A quantidade de perfis cadastrados no site ficará a critério de cada usuário. Assim, por exemplo, se um casal quiser ter mais de um perfil, será permitido, uma vez que não cabe ao site  TONIGHT.NET.BR dizer o que um casal pode ou não pode fazer!</p>

        <p>Cuidado ao escolher uma senha! A criação da senha de cada perfil é de responsabilidade do próprio usuário do site. Lembre-se que, quanto mais complexa ela for, menor serão as chances de eventuais problemas futuros! </p>

        <p>É terminantemente proibida a criação de perfis falsos (fakes) no site que visem ludibriar os demais usuários do TONIGHT.NET.BR. Os perfis falsos, assim que identificados, serão excluídos e o ocorrido será levado ao conhecimento dos demais usuários do site, bem como às autoridades legais competentes. Tentar refazer ou criar um novo perfil só agravará ainda mais o problema! </p>

        <p>Ao se cadastrar, o usurário do site deverá incluir em seu perfil ao menos 3(três) fotos suas. Fotos falsas (fakes), assim que detectadas, resultarão na exclusão do perfil.</p>

        <p>Perfis sem movimentação por período superior a 3 (três) meses serão automaticamente excluídos (sem aviso prévio!).</p>

        <br>
        <p><b> COMUNICAÇÕES ENTRE OS USUÁRIOS, OS ASSINANTES E OS ANUNCIANTES EM QUALQUER DAS FERRAMENTAS DO SITE:</b></p>

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
        <p><b> DIREITOS DO SITE TONIGHT.NET.BR:</b></p>

        <p>Nossa equipe trabalha para manter o site TONIGHT.NET.BR sempre atualizado, seguro e com o máximo em firewall. Entretanto nossos usuários o utilizam por sua conta e risco. </p>

        <p>Todo o conteúdo removido por usuários, incluindo mídias, poderão ser armazenados em nossos backups por tempo indeterminado.</p>

        <p>Todo o conteúdo PÚBLICO poderá ser visto por todos os visitantes do site, estes tendo ou não uma conta no TONIGHT.NET.BR.</p>

        <p>Suas mídias PÚBLICAS poderão ser selecionadas para utilização em nossa página principal do site, bem como serem utilizadas em nossas campanhas de marketing.</p>

        <p>Nossa marca e logotipo são de uso restrito dos representantes legais do TONIGHT.NET.BR, e não deverão ser utilizados sem autorização prévia dos mesmos.</p>

        <p>Poderemos, a qualquer momento, alterar qualquer recurso gratuito do site para uso exclusivo dos assinantes.</p>

        <p>A qualquer momento, a equipe do TONIGHT.NET.BR poderá remover, excluir, armazenar e/ou repassar as autoridades legais todo tipo de conteúdo que julgar estar fora dos parâmetros de exigência das normas de utilização do site. </p>

        <p>A nossa logomarca poderá ser utilizada em futuros projetos na web somente pelos proprietários legais do site TONIGHT.NET.BR.</p>

        <br>
        <p><b> TERMOS RESCISÓRIOS:</b></p>

        <p>Caso o usuário venha a violar os termos de utilização e a essência do presente site, ou venha ainda, gerar possível risco ou exposição legal para nós, poderemos deixar de fornecer, no todo ou parte, os serviços constantes no site TONIGHT.NET.BR. </p>
        <p>Notificaremos você, usuário, na próxima vez que você tentar acessar sua conta. Você também é livre para excluir sua conta a qualquer momento!</p>

        <p>Não haverá reembolso de valores pagos por motivo de discordância de qualquer termo utilização deste site ou por arrependimento. Caberá reembolso somente nos casos decorrentes de problemas técnicos ou por erros de faturamento.</p>
        <p>O TONIGHT.NET.BR se posiciona como um catálogo de produtos e serviços eróticos ou classificados dos mesmos, mas tendo como sua única responsabilidade, a prestação de serviço em publicidade dos produtos e serviços que nossos anunciantes solicitam a publicação através de uma taxa de manutenção. </p>

        <br>
        <p>Em nosso Site, todo anúncio de um produto ou serviço erótico publicado, é de inteira responsabilidade da empresa ou profissional autônomo Anunciante. Sendo assim, não nos comprometemos com a qualidade, atendimento, entrega ou qualquer outro valor agregado dos produtos e serviços prestados por nossos Anunciantes. </p>

        <br>
        <p>Nós do TONIGHT.NET.BR, não nos comprometemos com a total veracidade das informações passadas por nossos anunciantes. Salvo os números de telefone para contato. Isso porque, alguns de nossos anunciantes usam pseudônimos para atender seus clientes, como no caso das Acompanhantes e Massagistas que se divulgam em nosso site. </p>

        <br>
        <p>O TONIGHT.NET.BR entende os serviços de Acompanhantes e Massagistas como serviços autônomos sem certificações para os mesmos que os identifiquem. Entendendo assim, o serviço de Acompanhante, como aquela pessoa que acompanha outra em eventos sociais ou pessoal só para ter alguém lhe fazendo companhia. E Massagista, a pessoa que se posiciona em tentar relaxar outra com movimentos diversos utilizando suas mãos e força muscular para tentar trazer algum conforto nos músculos de quem esta recebendo tal esforço por outro cedido. Sendo assim, tais atividades podem ser cobradas, onde os mesmos estipulam uma taxa por esses serviços prestados, mas sem uma intervenção de algum órgão que os coloque uma tabela de valor por cada serviço e possa regular e mediar esse mercado. Ou seja, cada profissional autônomo destas modalidades, poderá cobrar o valor que bem entenderem. </p>

        <br>
        <p>Todos os anunciantes presentes no site assinaram um termo de autorização e responsabilidade para autorização da publicação de seu anúncio, com as informações: (nomes artísticos, telefones, dados pessoais, dimensões, medidas e texto descritivo dos seus serviços ou produtos) de sua livre autoria e inteira responsabilidade. </p>

        <br>
        <p>O site TONIGHT.NET.BR  declara que todos os nossos anunciantes têm maioridade legal para se vincularem a um site erótico e prestarem seus serviços e comercializarem seus produtos. </p>

        <br>
        <p><b>DISPOSIÇÕES FINAIS:</b></p>
        
        <br>
        <p>Nosso Site tem como objetivo a divulgação de produtos e serviços do mercado adulto ou correlacionados e torná-los público a quem busca esse tipo de conteúdo e informação, desde que se tenha autoridade legal para acessar tal conteúdo, ou seja, que o visitante ou usuário tenha maioridade exigida pela constituição brasileira.  </p>
        
        <br>
        <p>Ao concordar com estes termos de utilização e serviço, você também concorda que os moderadores do site TONIGHT.NET.BR atuem como árbitros para o julgamento das questões acima citadas.</p>
        
        <br>
        <p>Boas vindas!!!</p>

        <br>
        <p>É com muito prazer e satisfação que damos boas vindas a todos e esperamos que seus desejos mais íntimos se realizem através do nosso site. Esperamos promover, acima de tudo, muitas novas e boas amizades!</p>
        
        <br>
        <p>E caso você desconfie ou saiba que possa existir alguma fraude aplicada por um de nossos anunciantes, nos avise imediatamente. </p>

        <br>
        <p>Diga não ao Trabalho e Prostituição Infantil ! </p>

        <br>
        <p>Bom Divertimento, </p>

        <br>
        <p><b>TONIGHT.NET.BR</b></p>
        ";
        
        return $termos;
    }
}


?>


