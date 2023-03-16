<?php

    namespace App\Models;

    use MF\Model\Model;

    class Pedidos extends Model
    {
        private $id;
        private $titulo;
        private $status;
        private $receita_bruta;
        // $fonte faz referencia de onde é o pedido se é pessoal ou do site studybay
        private $fonte;
        private $id_usuario;
        private $oferta;
        private $paginas;
        private $disciplina;
        private $tipo;
        private $metodologia;
        private $prazo_real;
        private $prazo_entrega;
        private $prazo_garantia;
        private $tema;
        private $descricao;
        private $observacao;
        private $arquivos;

        public function __get($atributo)
        {
            return $this->$atributo;
        }

        public function __set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }

        
        public function salvar()
        {
            $query = 'insert into pedidos
            (id, titulo, status, receita_bruta, fonte, id_usuario, oferta, paginas, disciplina, tipo, 
            metodologia, prazo_real, prazo_entrega, prazo_garantia, tema, descricao, observacao, arquivos)
            values
            (:id, :titulo, :status, :receita_bruta, :fonte, :id_usuario, :oferta, :paginas, :disciplina, :tipo, 
            :metodologia, :prazo_real, :prazo_entrega, :prazo_garantia, :tema, :descricao, :observacao, :arquivos)';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->bindValue(':titulo', $this->__get('titulo'));
            $stmt->bindValue(':status', $this->__get('status'));
            $stmt->bindValue(':receita_bruta', $this->__get('receita_bruta'));
            $stmt->bindValue(':fonte', $this->__get('fonte'));
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->bindValue(':oferta', $this->__get('oferta'));
            $stmt->bindValue(':paginas', $this->__get('paginas'));
            $stmt->bindValue(':disciplina', $this->__get('disciplina'));
            $stmt->bindValue(':tipo', $this->__get('tipo'));
            $stmt->bindValue(':metodologia', $this->__get('metodologia'));
            $stmt->bindValue(':prazo_real', $this->__get('prazo_real'));
            $stmt->bindValue(':prazo_entrega', $this->__get('prazo_entrega'));
            $stmt->bindValue(':prazo_garantia', $this->__get('prazo_garantia'));
            $stmt->bindValue(':tema', $this->__get('tema'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->bindValue(':observacao', $this->__get('observacao'));
            $stmt->bindValue(':arquivos', $this->__get('arquivos'));

            $stmt->execute();

            return $this;
        }

        public function getAll()
        {
            $query = "
                select id, fonte, prazo_garantia, prazo_entrega, prazo_real, status, entregue, titulo, receita_bruta, 
                oferta, paginas, id_usuario, pagamento from pedidos
            ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();


            return $stmt->fetchAll(\PDO::FETCH_ASSOC);  
            
        }


    }?>