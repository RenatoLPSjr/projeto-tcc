<?php

    namespace App\Models;

    use MF\Model\Model;

    class Conversa extends Model
    {
        private $id;
        private $idPedido;
        private $mainUser;
        private $otherUser;
        private $date;
    

        public function __get($atributo)
        {
            return $this->$atributo;
        }

        public function __set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }

        public function verificarConversaExistente($mainUser, $otherUser)
        {
            $query = "SELECT * FROM conversa WHERE (mainUser = :mainUser AND otherUser = :otherUser) OR (mainUser = :otherUser AND otherUser = :mainUser)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':mainUser', $mainUser);
            $stmt->bindValue(':otherUser', $otherUser);
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

        public function verificarConversaExistentePedido($mainUser, $otherUser, $idPedido)
        {
            $query = "SELECT * FROM conversa WHERE (mainUser = :mainUser AND otherUser = :otherUser AND idPedido = :idPedido) OR (mainUser = :otherUser AND otherUser = :mainUser AND idPedido = :idPedido)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':mainUser', $mainUser);
            $stmt->bindValue(':otherUser', $otherUser);
            $stmt->bindValue(':idPedido', $idPedido);
            $stmt->execute();
        
            $conversa = $stmt->fetch(\PDO::FETCH_ASSOC);
        
            if ($conversa) {
                // Já existe uma conversa entre mainUser e otherUser
                return array(
                    'existe' => true,
                    'idConversa' => $conversa['id']
                );
            } else {
                // Não existe uma conversa entre mainUser e otherUser
                return array(
                    'existe' => false,
                    'idConversa' => null
                );
            }
        
        }

        public function iniciarConversa($mainUser, $otherUser)
        {

            $query = "INSERT INTO conversa (mainUser, otherUser) VALUES (:mainUser, :otherUser)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':mainUser', $mainUser);
            $stmt->bindValue(':otherUser', $otherUser);

            $stmt->execute();
        
            // Retorne o ID da conversa recém-criada
            return $this->db->lastInsertId();
        }

        public function iniciarConversaPedido($mainUser, $otherUser, $idPedido)
        {

            $query = "INSERT INTO conversa (mainUser, otherUser, idPedido) VALUES (:mainUser, :otherUser, :idPedido)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':mainUser', $mainUser);
            $stmt->bindValue(':otherUser', $otherUser);
            $stmt->bindValue(':idPedido', $idPedido);
            $stmt->execute();
        
            // Retorne o ID da conversa recém-criada
            return $this->db->lastInsertId();
        }
    }