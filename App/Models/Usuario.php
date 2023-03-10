<?php

    namespace App\Models;

    use MF\Model\Model;

    class Usuario extends Model
    {
        private $id;
        private $nome;
        private $email;
        private $senha;
        private $tipo;
        private $especialidade;
        private $area;
        private $telefone;
        private $pix;
        private $status;

        public function __get($atributo)
        {
            return $this->$atributo;
        }

        public function __set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }

        //salvar
        public function salvar()
        {
            $query = 'insert into usuarios(nome, email, senha, tipo, especialidade)values(:nome, :email, :senha, :tipo, :especialidade)';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->bindValue(':tipo', $this->__get('tipo'));
            $stmt->bindValue(':especialidade', $this->__get('especialidade'));
            $stmt->execute();

            return $this;
        }

        public function deletar($usuario)
        {
            $query = 'delete from usuarios where id = :id';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $usuario->id);  
            $stmt->execute();

            return ($stmt->rowCount() > 0);
        }


        //validar se o cadastro pode ser feito
        public function validarCadastro()
        {
            $valido = true;

            if(strlen($this->__get('nome')) < 3){
                $valido = false;
            }
            if(strlen($this->__get('email')) < 3){
                $valido = false;
            }
            if(strlen($this->__get('senha')) < 3){
                $valido = false;
            }

            return $valido;
        }

        public function getUsuarioPorEmail()
        {
            $query = "select nome, email from usuarios where email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->execute();


            return $stmt->fetchAll(\PDO::FETCH_ASSOC);  
        }

        public function getById($id)
        {
            $query = "select * from usuarios where id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", $id);   
            $stmt->execute();
            $usuario = $stmt->fetch(\PDO::FETCH_OBJ);
        
            return $usuario;
        }

            public function autenticar()
        {
            $query = "select id, tipo, nome, email, status from usuarios where (email = :email) and (senha = :senha) and (status = 1)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->execute();

            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            if($usuario['id'] != '' && $usuario['nome'] != '')
            {
                $this->__set('id', $usuario['id']);
                $this->__set('nome', $usuario['nome']); 
                $this->__set('tipo', $usuario['tipo']); 
            }

            return $usuario;
        }


        //função para pegar todos os usuarios do bd
        public function getAll()
        {
            $query = "
                select id, nome, email, especialidade from usuarios
            ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();


            return $stmt->fetchAll(\PDO::FETCH_ASSOC);  
            
        }

        
        //Função criada para escolher apenas os funcionarios do tipo 2 assim o adm não é validado e não aparece na lista 
        //para exclusão
        public function getByTipo()
        {
            $query = "
                select id, nome, email, especialidade from usuarios
                where tipo = 2
            ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();


            return $stmt->fetchAll(\PDO::FETCH_ASSOC);  
            
        }

        public function alterar()
        {
            $query = "
                update usuarios set senha = md5(:senha) where id = :id
            ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->bindValue(':id', $this->__get('id'));

            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
        }


        public function verificarSenha($id, $senha)
        {
            $query = "
                select senha from  usuarios where id = :id
            ";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $stmt->bindValue(':id', $id->id);
            $resultado = $stmt->fetch();

            if (!password_verify($senha, $resultado['senha'])) {
                return 'Senha antiga incorreta.';
            }else{
                return 'Senha ok';
            }
            
        }

    }