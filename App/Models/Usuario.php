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
        private $area;
        private $telefone;
        private $pix;
        private $status;
        private $path_imagem;
        private $nome_imagem;

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
            $usuario = $stmt->fetchAll(\PDO::FETCH_ASSOC);  
        
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
                select id, nome, email, path_imagem, nome_imagem, especialidade from usuarios
            ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();


            return $stmt->fetchAll(\PDO::FETCH_ASSOC);  
            
        }

        public function getHome()
        {
            $query = "
            SELECT u.id, u.nome,
                SUM(CASE WHEN p.status = 1 THEN p.receita_bruta ELSE 0 END) AS total_receita_bruta,
                SUM(p.oferta) AS total_investido, 
                (SUM(p.receita_bruta) - SUM(p.oferta)) AS diferenca,
                SUM(CASE WHEN p.status = 1 THEN 1 ELSE 0 END) AS status_1,
                (SELECT COUNT(*) FROM pedidos WHERE status IN (1, 2, 3, 4, 5)) AS status_ativos,
                (SELECT COUNT(*) FROM pedidos WHERE status = 1) AS status_enviado,
                (SELECT COUNT(*) FROM pedidos WHERE status = 2) AS status_fazendo,
                (SELECT COUNT(*) FROM pedidos WHERE status = 3) AS status_entregue,
                (SELECT COUNT(*) FROM pedidos WHERE status = 4) AS status_garantia,
                (SELECT COUNT(*) FROM pedidos WHERE status = 5) AS status_revisão,
                (SELECT COUNT(*) FROM pedidos WHERE status IN (1, 2, 3, 4, 5, 6)) AS status_todos,
                SUM(CASE WHEN p.status = 2 THEN 1 ELSE 0 END) AS status_2,
                SUM(CASE WHEN p.status = 3 THEN 1 ELSE 0 END) AS status_3,
                SUM(CASE WHEN p.status = 4 THEN 1 ELSE 0 END) AS status_4,
                SUM(CASE WHEN p.status = 5 THEN 1 ELSE 0 END) AS status_5,
                SUM(CASE WHEN p.status = 6 THEN 1 ELSE 0 END) AS status_6,
                (SELECT SUM(receita_bruta) FROM pedidos) AS soma_total_receita_bruta,
                (SELECT SUM(oferta) FROM pedidos) AS soma_total_investido,
                (SELECT SUM(receita_bruta) FROM pedidos) - (SELECT SUM(oferta) FROM pedidos) AS diferenca_total,
                (SELECT SUM(receita_bruta) FROM pedidos WHERE fonte = 1) AS soma_receita_por_fonte_1,
                (SELECT SUM(oferta) FROM pedidos WHERE fonte = 1) AS soma_oferta_1,
                (SELECT SUM(receita_bruta) FROM pedidos WHERE fonte = 1) - (SELECT SUM(oferta) FROM pedidos WHERE fonte = 1) AS total_1,
                (SELECT SUM(receita_bruta) FROM pedidos WHERE fonte = 2) AS soma_receita_por_fonte_2,
                (SELECT SUM(oferta) FROM pedidos WHERE fonte = 2) AS soma_oferta_2,
                (SELECT SUM(receita_bruta) FROM pedidos WHERE fonte = 2) - (SELECT SUM(oferta) FROM pedidos WHERE fonte = 2) AS total_2
            FROM usuarios u
            LEFT JOIN pedidos p ON u.id = p.id_usuario
            WHERE u.id NOT IN (26, 27)
            GROUP BY u.id;

            ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();


            return $stmt->fetchAll(\PDO::FETCH_ASSOC);    
        }

        public function getHomeGrafico()
        {
            $query = "
            SELECT DISTINCT MONTH(prazo_entrega) AS data_mes,
                SUM(receita_bruta) AS soma_total_receita_bruta,
                SUM(oferta) AS soma_total_investido,
                (SUM(receita_bruta) - SUM(oferta)) as total_liquido 
            FROM pedidos
            GROUP BY data_mes
            ORDER BY data_mes ASC;
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

        public function uploadImagem()
        {
            $query = '
                UPDATE usuarios SET path_imagem =:path_imagem WHERE id = :id
            ';

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':path_imagem', $this->__get('path_imagem'));
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();

            return $this;
        }

    }

