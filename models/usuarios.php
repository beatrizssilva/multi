<?php
class usuarios extends model {
    public function Acompanhamento($id){
        $array = array();
        $mes = date('m');
        $sql = "SELECT * FROM acompanhamento WHERE id_user = :id AND mes = :mes";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":mes", $mes);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function getIpUser($ip, $id){
        $sql = "SELECT * FROM user WHERE ip = :ip AND id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":ip", $ip);
        $sql->execute();
        
        if($sql->rowCount() == 0){
            return true;
        }
    }
    
    public function setIpUser($ip, $id){
        $sql = "UPDATE user SET ip = :ip WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":ip", $ip);
        $sql->execute();
    }

    public function redefinir($senha, $codigo){
        $sql = "SELECT * FROM recuperar WHERE codigo = :codigo AND usado = 0";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":codigo", $codigo);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetch(PDO::FETCH_ASSOC);
            
            $sql = "UPDATE recuperar SET usado = 1 WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $array['id']);
            $sql->execute();
            
            $sql = "UPDATE user SET pass = :senha WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $array['id_user']);
            $sql->bindValue(":senha", md5($senha));
            $sql->execute();
            
            echo '1';
        } else {
            echo '0';
        }
    }

    public function recuperarSenha($cpf){
        $c = explode('.', $cpf);
        $p = explode('-', $c[2]);
        $cpf = $c[0].$c[1].$p[0].$p[1];
        
        $sql = "SELECT * FROM user WHERE cpf = :cpf";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":cpf", $cpf);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetch(PDO::FETCH_ASSOC);
            
            $token = md5(date('Y-m-d H:i:s').rand(0, 999).rand(0, 999));
            $token1 = str_split($token);
            $t = $token1[0].$token1[1].$token1[2].$token1[3];
            $n = intval(200+$array['id']); 
            $codigo = $n.$t;

            $data = date('Y-m-d H:i:s');
            $sql = "INSERT INTO recuperar (id_user, date, codigo) VALUES (:id_user, :data, :codigo)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_user", $array['id']);
            $sql->bindValue(":data", $data);
            $sql->bindValue(":codigo", $codigo);
            $sql->execute();

            // Inclui o arquivo class.phpmailer.php localizado na pasta class
            require_once("class/class.phpmailer.php");

            // Inicia a classe PHPMailer
            $mail = new PHPMailer(true);

            // Define os dados do servidor e tipo de conexão
            // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            $mail->IsSMTP(); // Define que a mensagem será SMTP

            try {
                $mail->Host = 'mail.laralimentos.com.br'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
                $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
                $mail->Port       = 587; //  Usar 587 porta SMTP
                $mail->Username = 'contato@laralimentos.com.br'; // Usuário do servidor SMTP (endereço de email)
                $mail->Password = 'Lar@357147'; // Senha do servidor SMTP (senha do email usado)

                //Define o remetente
                // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
                $mail->SetFrom('contato@laralimentos.com.br', 'Lar Alimentos'); //Seu e-mail
                $mail->AddReplyTo('contato@laralimentos.com.br', 'Lar Alimentos'); //Seu e-mail
                $mail->Subject = 'Recuperar Senha';//Assunto do e-mail


                //Define os destinatário(s)
                //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                $mail->AddAddress($array['email'], 'Teste Locaweb');

                //Campos abaixo são opcionais 
                //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
                //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
                //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo

                
                //Define o corpo do email
                $mail->MsgHTML('<img src="'.BASE_URL.'assets/images/logoEmail.png" alt=""/><br/><br/>'
                        . '<h3>Para Redefinir sua senha '
                        . '<h2 style="text-align:center"><strong>Clique '
                        . '<a href="'.BASE_URL.'usuarios/recuperar?pass='.$codigo.'">Aqui</a> '
                        . 'para se Cadastrar.</strong></h2><br/>Ou acesse pelo Link: '
                        . 'http://laralimentos.com.br/usuarios/recuperar?pass='.$codigo);

                ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
                //$mail->MsgHTML(file_get_contents('arquivo.html'));

                $mail->Send();
    //            echo "Mensagem enviada com sucesso</p>\n";

               //caso apresente algum erro é apresentado abaixo com essa exceção.
               }catch (phpmailerException $e) {
                 echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
           } 
           echo $array['email'];
        } else{
            echo '0';
        }
    }

    public function apagarConta($id){
        $sql = "UPDATE user SET conta = 0 WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
    public function getDependentes($id) {
        $array = array();
        
        $sql = "SELECT * FROM dependentes WHERE id_user = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        } 
        return $array;
    }
    
    public function getDadosBancarios($id) {
        $array = array();
        
        $sql = "SELECT *, (select bancos.banco from bancos where user_dados_bancarios.id_banco = bancos.id) as nome_banco,"
                . " (select tipo_conta_bancaria.tipo from tipo_conta_bancaria where user_dados_bancarios.tipo = tipo_conta_bancaria.id)"
                . " as nome_tipo FROM user_dados_bancarios WHERE id_user = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        } 
        return $array;
    }
    
    public function getBancos($texto){
        $array = array();
        $sql = "SELECT * FROM bancos WHERE banco LIKE :texto";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":texto", '%'.$texto.'%');
        $sql->execute();
        
        if($sql->rowCount() > 0){
          $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        } 
        return $array;
    }
    public function setContaBancaria($id_user, $id_banco, $agencia, $conta, $digito, $tipo){
        $sql = "INSERT INTO user_dados_bancarios (id_user, id_banco, ag, conta, digito, tipo)"
                    . " values (:id_user, :id_banco, :agencia, :conta, :digito, :tipo)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_user", $id_user);
            $sql->bindValue(":id_banco", $id_banco);
            $sql->bindValue(":agencia", $agencia);
            $sql->bindValue(":conta", $conta);
            $sql->bindValue(":digito", $digito);
            $sql->bindValue(":tipo", $tipo);
            $sql->execute();
    }
    
    public function apagarDependente($id){
        $sql = "DELETE FROM dependentes WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    public function apagarContaBancaria($id){
        $sql = "DELETE FROM user_dados_bancarios WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function setDependente($id, $nome, $relacao, $nasc, $documento){
        $sql = "INSERT INTO dependentes (id_user, nome, nasc, documento, relacao)"
                    . " values (:id, :nome, :nasc, :documento, :relacao)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":nasc", $nasc);
            $sql->bindValue(":documento", $documento);
            $sql->bindValue(":relacao", $relacao);
            $sql->execute();
    }

    public function getEndereco($id){
        $sql = "SELECT * FROM user_dados WHERE id_user = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetch();            
            if(!empty($array['rua']) || !empty($array['bairro']) || !empty($array['cidade']) || !empty($array['estado']) || !empty($array['cep'])) {
                echo '1';
            } else {
                echo '0';
            }
        } else {
            echo '0';
        }
    }

    public function editEndereco($id, $rua, $numero, $complemento, $bairro, $cidade, $uf, $cep){
        $sql = "SELECT * FROM user_dados WHERE id_user = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $sql = "UPDATE user_dados SET rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro"
                    . ", cidade = :cidade, estado = :uf, cep = :cep WHERE id_user = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":rua", $rua);
            $sql->bindValue(":numero", $numero);
            $sql->bindValue(":complemento", $complemento);
            $sql->bindValue(":bairro", $bairro);
            $sql->bindValue(":cidade", $cidade);
            $sql->bindValue(":uf", $uf);
            $sql->bindValue(":cep", $cep);
            $sql->execute();
        } else {
            $sql = "INSERT INTO user_dados (id_user, rua, numero, complemento, bairro, cidade, estado, cep)"
                    . " values (:id, :rua, :numero, :complemento, :bairro, :cidade, :uf, :cep)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":rua", $rua);
            $sql->bindValue(":numero", $numero);
            $sql->bindValue(":complemento", $complemento);
            $sql->bindValue(":bairro", $bairro);
            $sql->bindValue(":cidade", $cidade);
            $sql->bindValue(":uf", $uf);
            $sql->bindValue(":cep", $cep);
            $sql->execute();
        }
        
    }
    public function editDados($id, $date, $nome, $email, $tel, $pis, $rg, $senha){
        $sql = "SELECT * FROM user_dados WHERE id_user = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $sql = "UPDATE user_dados SET nasc = :date, pis = :pis, rg = :rg, telefone = :tel WHERE id_user = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":date", $date);
            $sql->bindValue(":tel", $tel);
            $sql->bindValue(":pis", $pis);
            $sql->bindValue(":rg", $rg);
            $sql->execute();
            
            $sql = "UPDATE user SET name = :nome, email = :email, pass = :senha WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));
            $sql->execute();
        } else {
            $sql = "INSERT INTO user_dados (id_user, nasc, telefone, pis, rg) values (:id, :nasc, :tel, :pis, :rg)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":date", $date);
            $sql->bindValue(":tel", $tel);
            $sql->bindValue(":pis", $pis);
            $sql->bindValue(":rg", $rg);
            $sql->execute();
        }
        
        
    }

    public function editFoto($id, $name){
        $sql = "SELECT * FROM user_dados WHERE id_user = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            
            $sql = "UPDATE user_dados SET foto_perfil = :foto WHERE id_user = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":foto", $name);      
            $sql->execute();
        } else {
            $sql = "INSERT INTO user_dados (id_user, foto_perfil) values (:id, :foto)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->bindValue(":foto", $name);        
            $sql->execute();
        }
    }

    public function getDadosAfiliados($id){
        $array = array();
        
        $sql = "SELECT * FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
            
            $sql = "SELECT * FROM transacoes WHERE id_user = :id ORDER BY data DESC";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();
            
            if($sql->rowCount() > 0) {
                $array['compra'] = $sql->fetch();
            } else {
                $array['compra']['data'] = "2018-01-01";
            }
            
            $sql = "SELECT * FROM user_dados WHERE id_user = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();
            
            if($sql->rowCount() > 0) {
                $array['dados'] = $sql->fetch();
                if (empty($array['dados']['foto_perfil'])){
                    $array['dados']['foto_perfil'] = "user.jpg";    
                }
            } else {
                $array['dados']['foto_perfil'] = "user.jpg";
            }
        }
       
        return $array;
    }

    //Reseta Ativo e Patente para o inicio do mes
    public function resetMes(){
       
        $sql = "UPDATE user SET ativo = :ativo, patent = :patent";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":ativo", 0);
        $sql->bindValue(":patent", 1);        
        $sql->execute();
        
        $ano = date('Y');
        $mes = date('m')-1;
        $sql = "SELECT * FROM ganhos WHERE mes = :mes AND ano = :ano";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":mes", $mes);
        $sql->bindValue(":ano", $ano);        
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            if(isset($array) && !empty($array > 0)){
                foreach ($array as $ganhos){
                    $bruto = $ganhos['valor_total'];
                    $ir = 0;
                    $inss = 0;
                    $liquido = 0;
                    switch ($bruto){
                    case $bruto > 0  && $bruto <= 1903.98:
                        $ir = 0;
                        break;;
                    case $bruto >= 1903.99 && $bruto <= 2826.65:
                        $ir = number_format(($bruto*7.5)/100, 2);
                        break;
                    case $bruto >= 2826.66 && $bruto <= 3751.05:
                        $ir = number_format(($bruto*15)/100, 2);
                        break;
                    case $bruto >= 3751.06 && $bruto <= 4664.68:
                        $ir = number_format(($bruto*22.5)/100, 2);
                        break;
                    case $bruto >= 4664.68:
                        $ir = number_format(($bruto*27.5)/100, 2);
                        break;
                    }
                    switch ($bruto){
                        case $bruto > 0  && $bruto <= 1693.72:
                            $inss = number_format(($bruto*8)/100, 2);
                            break;
                        case $bruto >= 1693.73 && $bruto <= 2822.90:
                            $inss = number_format(($bruto*9)/100, 2);
                            break;
                        case $bruto >= 2822.91 && $bruto <= 5645.80:
                            $inss = number_format(($bruto*11)/100, 2);
                            break;    
                    }
                    $liquido = $bruto - $inss - $ir;
                
                    $sql = "UPDATE ganhos SET inss = :inss, ir = :ir, total_liquido = :liquido WHERE id =:id";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id", $ganhos['id']);
                    $sql->bindValue(":inss", $inss);
                    $sql->bindValue(":ir", $ir);
                    $sql->bindValue(":liquido", $liquido);
                    $sql->execute();                    
                }ob_start();
                foreach ($array as $ganhos){
                    //3 = Fixo
                    //000001 = numero de cadastro
                    //0007 = numero da contabilidade
                    //0000000 = valor (tamanho 7 com 2 casas decimais)
                    $cadastro = str_pad($ganhos['id_user'], 6, "0", STR_PAD_LEFT); 
                    $t = number_format($ganhos['valor_total'], 2, '', ',');
                    $t1 = str_replace('.', '', $t);
                    $total = str_pad($t1, 7, "0", STR_PAD_LEFT); 
                    echo '3' . $cadastro. '0007' . $total . "\r\n";
                }
                $html = ob_get_contents();
                    ob_end_clean();
                        $name = 'contabil/pagamentos/'.date('mY').'.txt';
                        $fp = fopen($name, "a");
                        $escreve = fwrite($fp, $html);
                        fclose($fp);
                        
                //Inserir Nome do Arquivo no banco
                $nome = date('mY').'.txt';
                $tipo = 'pagamentos';
                $ano = date('Y');
                $mes = date('m')-1;
                $sql = "INSERT INTO contabil (nome, tipo, mes, ano) VALUES (:nome, :tipo, :mes, :ano)";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":tipo", $tipo);
                $sql->bindValue(":mes", $mes);
                $sql->bindValue(":ano", $ano);        
                $sql->execute();
                        
                // Inclui o arquivo class.phpmailer.php localizado na pasta class
                require_once("class/class.phpmailer.php");

                // Inicia a classe PHPMailer
                $mail = new PHPMailer(true);

                // Define os dados do servidor e tipo de conexão
                // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                $mail->IsSMTP(); // Define que a mensagem será SMTP

                try {
                    $mail->Host = 'mail.laralimentos.com.br'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
                    $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
                    $mail->Port       = 587; //  Usar 587 porta SMTP
                    $mail->Username = 'contato@laralimentos.com.br'; // Usuário do servidor SMTP (endereço de email)
                    $mail->Password = 'Lar@357147'; // Senha do servidor SMTP (senha do email usado)

                    //Define o remetente
                    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
                    $mail->SetFrom('contato@laralimentos.com.br', 'Lar Alimentos'); //Seu e-mail
                    $mail->AddReplyTo('contato@laralimentos.com.br', 'Lar Alimentos'); //Seu e-mail
                    $mail->Subject = 'Arquivo Pagamentos de Terceiros';//Assunto do e-mail


                    //Define os destinatário(s)
                    //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                    $mail->AddAddress('danielcandidocel@gmail.com', 'Inoveh');
                    $mail->AddAddress('dp01@contexcontabilidade.com.br', 'Contabilidade');
                    
                    //Campos abaixo são opcionais 
                    //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                    //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
                    //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
                    //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo

                    $name2 = ucfirst($name);
                    //Define o corpo do email
                    $mail->MsgHTML('<img src="'.BASE_URL.'/assets/images/logoEmail.png" alt=""/><br/><br/>'
                    . '<h3>Foi Gerado um novo Arquivo de Importação dos Pagamentos de Terceiros - Lar Alimentos<br/><br/>'
                    . '<h2 style="text-align:center"><strong>Clique '
                    . '<a href="http://painel.laralimentos.com.br/contabilidade/arquivos">Aqui</a>');
                    
                   
                    ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
//                    $mail->MsgHTML(file_get_contents('arquivo.html'));
//                    $mail->AddAttachment(BASE_URL.'contabil/pagamentos');
                    $mail->Send();
        //            echo "Mensagem enviada com sucesso</p>\n";

                   //caso apresente algum erro é apresentado abaixo com essa exceção.
                   }catch (phpmailerException $e) {
                     echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
               }
            }
        }
        
    }
    public function resgate() {
        
        $ano = date('Y');
        $mes = date('m')-1;
        $sql = "SELECT * FROM ganhos WHERE mes = :mes AND ano = :ano";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":mes", $mes);
        $sql->bindValue(":ano", $ano);        
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($array as $id){
                
                $sql = "SELECT * FROM resgate WHERE id_user = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id", $id['id_user']);                
                $sql->execute();
                
                if($sql->rowCount() > 0) {
                    $resgate = $sql->fetch(PDO::FETCH_ASSOC);
                    $total = $id['total_liquido'] + $resgate['total'];
                    $sql = "UPDATE resgate SET total = :total WHERE id_user =:id";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":total", $total);
                    $sql->bindValue(":id", $resgate['id_user']);
                    $sql->execute();
                    
                } else {
                
                    $sql = "INSERT INTO resgate (id_user, valor_inicial, valor_resgatado, total) VALUES (:id_user, :valor_inicial,"
                            . " :valor_resgatado, :total)";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":id_user", $id['id_user']);
                    $sql->bindValue(":valor_inicial", $id['total_liquido']);
                    $sql->bindValue(":valor_resgatado", 0);
                    $sql->bindValue(":total", $id['total_liquido']);
                    $sql->execute();
                }
            }
        }
        
    }
    
    public function getValorResgate($id){
        $array = array();
    
        $sql = "SELECT * FROM resgate WHERE id_user = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);        
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
            
        return $array;
    }

        //verifica o login do usuario
    public function verifyUser($id, $senha){
       
        $sql = "SELECT * FROM user WHERE email = :email AND pass = :pass";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $id);
        $sql->bindValue(":pass", MD5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;    
        } else {      
            $sql = "SELECT * FROM user WHERE cpf = :cpf AND pass = :pass";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":cpf", $id);
            $sql->bindValue(":pass", MD5($senha));
            $sql->execute();
            if($sql->rowCount() > 0) {
                return true;    
            } else {
                return false;
            }
        }
    }
    
    //seleciona as informações do usuario
    public function getDadosUser ($id){
        $array = array();
        
        $sql = "SELECT *, (select patent.name from patent where patent.id = user.patent)as cargo FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }        
        return $array;
    }

     public function dadosUser ($id){
        $array = array();
        
        $sql = "SELECT * FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }        
        return $array;
    }
    //Seleciona os dados do usuario após o login 
    public function getUser($id, $senha){
        $array = array();

        $sql = "SELECT * FROM user WHERE email = :email OR cpf = :cpf AND pass = :pass";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $id);
        $sql->bindValue(":cpf", $id);
        $sql->bindValue(":pass", MD5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
    
    //cadastrar novo usuario
    public function setNewUser($email, $nome, $senha, $id, $cpf, $convite) {
        $sql = "SELECT * FROM user WHERE identificador = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        $ativo = 0;
        $data_cadastro = date("Y-m-d H:i:s");
        $id_dad = $array['id'];
        
        $sql = "INSERT INTO user (id_dad, name, cpf, email, pass, ativo, data_cadastro, conta) VALUES (:id_dad, :name, :cpf, "
                . ":email, :pass, :ativo, :data_cadastro, 1)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id_dad);
        $sql->bindValue(":name", $nome);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue("email", $email);
        $sql->bindValue(":pass", MD5($senha));
        $sql->bindValue(":ativo", $ativo);
        $sql->bindValue(":data_cadastro", $data_cadastro);        
        $sql->execute();
        
        $id_user = $this->db->lastInsertId();
        $token = md5(date('Y-m-d H:i:s').rand(0, 999).rand(0, 999));
        $token1 = str_split($token);
        $t = $token1[0].$token1[1].$token1[2].$token1[3];
        $n = intval(1000+$id_user); 
        $identificador = strtoupper($n.$t);
        
        $sql = "UPDATE user SET identificador = :identificador WHERE id =:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":identificador", $identificador);
        $sql->bindValue(":id", $id_user);
        $sql->execute();
        
        //Insere Notificação de Cadastro para cada Usuário acima da Cadeia
            $this->insertNotificacaoCadastro($id_dad, $id_user);
        
        $sql = "SELECT * FROM convites WHERE convite = :convite";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":convite", $convite);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);        
        
            $sql = "UPDATE convites SET status = 1 WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $array['id']);
            $sql->execute();
        }
        return true;
    }
    
    public function insertNotificacaoCadastro($dad, $identificador) {
        $data = date("Y-m-d H:i:s");
        $sql = "INSERT INTO notificacoes (id_user_para, data, tipo, identificador) VALUES (:id_user, :data, :tipo, :id)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $dad);
        $sql->bindValue(":data", $data);
        $sql->bindValue(":tipo", 1);
        $sql->bindValue(":id", $identificador);
        $sql->execute();
       
        
        //seelciona o pai deste usuario, se existe repete a função insertPontosTotal
        $sql = "SELECT id_dad FROM user WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $dad);
        $sql->execute();
            
            if($sql->rowCount() > 0) {
                $id = $sql->fetch(PDO::FETCH_ASSOC);
                if($id['id_dad'] <> 0){
                    $this->insertNotificacaoCadastro($id['id_dad'], $identificador);
                }
            }
       
    }
    
    //seleciona a arvore até a 5ª geração definida na global $config
    public function getFilhos($id, $limite) {
        $array = array();

        $sql = "SELECT *, (select patent.name from patent where patent.id = user.patent)as patente FROM user WHERE id_dad = :id_dad";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_dad", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($array as $chave => $usuario){
                $array[$chave]['filhos'] = array();
//                if($limite > 0){
                    
                    $array[$chave]['filhos'] = $this->getFilhos($usuario['id'], $limite - 1);
//                }
            }
        }
        return $array;
    }
    
    //verifica se email ja cadastrado
    public function verifyEmail($email) {
        $sql = "SELECT * FROM user WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
            return true;
        } else {
            return false;
        }
    }
    
    public function verifyConvite($convite) {
        $sql = "SELECT * FROM convites WHERE convite = :convite AND status = 0";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":convite", $convite);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
            return true;
        } else {
            return false;
        }
    }

        //verifica se ID está correto
    public function verifyID($id) {
        $sql = "SELECT * FROM user WHERE identificador = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
            return true;
        } else {
            return false;
        }
    }
    
    //verifica se CPF já Cadastrado
    public function verifyCPF($cpf) {
        $sql = "SELECT * FROM user WHERE cpf = :cpf";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":cpf", $cpf);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
            return true;
        } else {
            return false;
        }
    }
    
    public function convidar($nome, $email, $identificador, $name){
        $id_user = $_SESSION['multLogin'];
        $data = date('Y-m-d H:i:s');
        $status = 0;
        
        $token = md5(date('Y-m-d H:i:s').rand(0, 999).rand(0, 999));
        $token1 = str_split($token);
        $t = $token1[0].$token1[1].$token1[2].$token1[3];
        $n = intval(30+$id_user); 
        $convite = $n.$t;
        
        $sql = "INSERT INTO convites (id_user, convite, data, nome, email, status) VALUES (:id_user, :convite, :data, :nome, :email, :status)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":convite", $convite);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":data", $data);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":status", $status);        
        $sql->execute();
        
        // Inclui o arquivo class.phpmailer.php localizado na pasta class
        require_once("class/class.phpmailer.php");
 
        // Inicia a classe PHPMailer
        $mail = new PHPMailer(true);
 
        // Define os dados do servidor e tipo de conexão
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->IsSMTP(); // Define que a mensagem será SMTP

        try {
            $mail->Host = 'mail.laralimentos.com.br'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
            $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
            $mail->Port       = 587; //  Usar 587 porta SMTP
            $mail->Username = 'contato@laralimentos.com.br'; // Usuário do servidor SMTP (endereço de email)
            $mail->Password = 'Lar@357147'; // Senha do servidor SMTP (senha do email usado)

            //Define o remetente
            // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
            $mail->SetFrom('contato@laralimentos.com.br', 'Lar Alimentos'); //Seu e-mail
            $mail->AddReplyTo('contato@laralimentos.com.br', 'Lar Alimentos'); //Seu e-mail
            $mail->Subject = 'Convite';//Assunto do e-mail


            //Define os destinatário(s)
            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            $mail->AddAddress($email, 'Teste Locaweb');

            //Campos abaixo são opcionais 
            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
            //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
            //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo

            $name2 = ucfirst($name);
            //Define o corpo do email
            $mail->MsgHTML('<img src="'.BASE_URL.'/assets/images/logoEmail.png" alt=""/><br/><br/>'
                    . '<h3>'.$name2.' enviou um convite para participar da Lar Alimentos.<br/><br/>'
                    . '<h2 style="text-align:center"><strong>Clique '
                    . '<a href="'.BASE_URL.'usuarios/cadastro?id='.$identificador.'&c='.$convite.'">Aqui</a> '
                    . 'para se Cadastrar.</strong></h2><br/>Ou acesse pelo Link: '
                    . 'http://laralimentos.com.br/usuarios/cadastro?id='.$identificador.'&c='.$convite);

            ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
            //$mail->MsgHTML(file_get_contents('arquivo.html'));

            $mail->Send();
//            echo "Mensagem enviada com sucesso</p>\n";

           //caso apresente algum erro é apresentado abaixo com essa exceção.
           }catch (phpmailerException $e) {
             echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
       }
                
        
        return $convite;
    }

    public function dellConvite($convite){
        $sql = "DELETE FROM convites WHERE convite = :convite";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":convite", $convite);
        $sql->execute();
    }

    public function convidados($id){
         $array = array();
     
        $sql = "SELECT * FROM convites WHERE id_user = :id ORDER BY data DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
     }
  
}