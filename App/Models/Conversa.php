<?php

    namespace App\Models;

    use MF\Model\Model;

    class Conversa extends Model
    {
        private $id;
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
    }