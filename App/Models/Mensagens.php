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
    

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function iniciarConversa($mainUser, $otherUser)
    {

        $query = "INSERT INTO mensagens (mainUser, otherUser) VALUES (:mainUser, :otherUser)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':mainUser', $mainUser);
        $stmt->bindValue(':otherUser', $otherUser);
        $stmt->execute();
    
        // Retorne o ID da conversa recém-criada
        return $this->db->lastInsertId();
    }

    public function buscarMensagensConversa($mainUser, $otherUser)
    {
        $query = "SELECT * FROM mensagens WHERE (mainUser = :mainUser AND otherUser = :otherUser) OR (mainUser = :otherUser AND otherUser = :mainUser)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':mainUser', $mainUser);
        $stmt->bindValue(':otherUser', $otherUser);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    }



?>