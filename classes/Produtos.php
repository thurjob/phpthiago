<?php
class Produto {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function adicionar($nome, $descricao, $preco, $categoria, $imagem) {
        $sql = "INSERT INTO produtos (nome, descricao, preco, categoria, imagem) 
                VALUES ('$nome', '$descricao', '$preco', '$categoria', '$imagem')";
        
        return $this->conn->query($sql);
    }
    
    public function listarTodos() {
        $sql = "SELECT * FROM produtos ORDER BY created_at DESC";
        $result = $this->conn->query($sql);
    
        $produtos = [];
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }
    
        return $produtos;
    }
    public function buscarPorId($id) {
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function atualizar($id, $nome, $descricao, $preco, $categoria, $imagem) {

        $sql = "UPDATE produtos 
                SET nome = '$nome', descricao = '$descricao', preco = '$preco', categoria = '$categoria', imagem = '$imagem' 
                WHERE id = $id";
        
        return $this->conn->query($sql); 
    }
    
    
    public function excluir($id) {
        $sql = "DELETE FROM produtos WHERE id = $id";
        
        return $this->conn->query($sql);  
    }
    
}
?>