<?php

    namespace App\Models;

    use MF\Model\Model;

    class Mensagens extends Model
    {
        private $id;
        private $mensagem;
        private $mainUser;
        private $otherUser;
        private $dateTime;
        private $id_conversa;
    

        public function __get($atributo)
        {
            return $this->$atributo;
        }

        public function __set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }


        public function buscarMensagensConversa($mainUser, $otherUser)
        {
            $query = "SELECT m.*, u.nome AS nomeUsuario from mensagens m
            LEFT JOIN usuarios u 
            ON m.otherUser = u.id
            WHERE (m.mainUser = :mainUser AND m.otherUser = :otherUser) OR (m.mainUser = :otherUser AND m.otherUser = :mainUser)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':mainUser', $mainUser);
            $stmt->bindValue(':otherUser', $otherUser);
            $stmt->execute();

            $mensagens = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Adicionar a propriedade "remetente" às mensagens
            foreach ($mensagens as &$mensagem) {
                if ($mensagem['mainUser'] == $mainUser) {
                    $mensagem['remetente'] = 'mainUser';
                } else {
                    $mensagem['remetente'] = 'otherUser';
                }
            }


            return $mensagens;
        }

        public function buscarMensagensConversaPedido($mainUser, $otherUser, $idPedido)
        {
            $query = "SELECT m.*, u.nome AS nomeUsuario from mensagens m
            LEFT JOIN usuarios u 
            ON m.mainUser = u.id
            WHERE (m.mainUser = :mainUser AND m.otherUser = :otherUser AND m.id_pedido = :id_pedido) OR (m.mainUser = :otherUser AND m.otherUser = :mainUser AND m.id_pedido = :id_pedido)
            ORDER BY 
            m.id ASC";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':mainUser', $mainUser);
            $stmt->bindValue(':otherUser', $otherUser);
            $stmt->bindValue(':id_pedido', $idPedido);
            $stmt->execute();

            $mensagens = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Adicionar a propriedade "remetente" às mensagens
            foreach ($mensagens as &$mensagem) {
                if ($mensagem['mainUser'] == $mainUser) {
                    $mensagem['remetente'] = 'mainUser';
                } else {
                    $mensagem['remetente'] = 'otherUser';
                }
            }


            return $mensagens;
        }

        public function iniciarMensagem($mainUser, $otherUser, $idConversa)
        {

            $query = "INSERT INTO mensagens (mainUser, otherUser, id_conversa) VALUES (:mainUser, :otherUser, :id_conversa)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':mainUser', $mainUser);
            $stmt->bindValue(':otherUser', $otherUser);
            $stmt->bindValue(':id_conversa', $idConversa);
            $stmt->execute();
        
            // Retorne o ID da conversa recém-criada
            return $this->db->lastInsertId();
        }

        public function verificarConversaPedido($mainUser, $otherUser,$idPedido){
            $query = "SELECT * FROM mensagens WHERE (mainUser = :mainUser AND otherUser = :otherUser AND id_pedido = :idPedido) OR (mainUser = :otherUser AND otherUser = :mainUser AND id_pedido = :idPedido)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':mainUser', $mainUser);
            $stmt->bindValue(':otherUser', $otherUser);
            $stmt->bindValue(':idPedido', $idPedido);
            $stmt->execute();
        
            $conversa = $stmt->fetch(\PDO::FETCH_ASSOC);
        
            if ($conversa) {
                // Já existe uma conversa entre mainUser e otherUser
                return true;
            } else {
                // Não existe uma conversa entre mainUser e otherUser
                return false;
            }
        }

        public function iniciarMensagemPedido($mainUser, $otherUser, $idPedido)
        {

            $query = "INSERT INTO mensagens (mainUser, otherUser, id_pedido, mensagem) VALUES (:mainUser, :otherUser, :id_pedido, :mensagem)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':mainUser', $mainUser);
            $stmt->bindValue(':otherUser', $otherUser);
            $stmt->bindValue(':id_pedido', $idPedido);
            $stmt->bindValue(':mensagem', "Iniciando");
            $stmt->execute();
        
            // Retorne o ID da conversa recém-criada
            return $this->db->lastInsertId();
        }


        public function novaMensagem($mainUser, $otherUser, $mensagens)
        {

            $query = "INSERT INTO mensagens (mainUser, otherUser, mensagem) VALUES (:mainUser, :otherUser, :mensagem)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':mainUser', $mainUser);
            $stmt->bindValue(':otherUser', $otherUser);
            $stmt->bindValue(':mensagem', $mensagens);
            $stmt->execute();
        
            // Retorne o ID da conversa recém-criada
            return $this->db->lastInsertId();
        }

        public function novaMensagemPedido($mainUser, $otherUser, $mensagens, $idPedido)
        {

            $query = "INSERT INTO mensagens (mainUser, otherUser, mensagem, id_pedido) VALUES (:mainUser, :otherUser, :mensagem, :id_pedido)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':mainUser', $mainUser);
            $stmt->bindValue(':otherUser', $otherUser);
            $stmt->bindValue(':mensagem', $mensagens);
            $stmt->bindValue(':id_pedido', $idPedido);
            $stmt->execute();
        
            // Retorne o ID da conversa recém-criada
            return $this->db->lastInsertId();
        }

    }



?>