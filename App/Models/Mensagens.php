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

    }



?>