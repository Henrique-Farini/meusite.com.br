<?php

// --- definição de diagrama de classes
class Pessoa {
    private $nome;
    private $email;

    public function __construct($nome, $email) {
        $this->nome = $nome;
        $this->email = $email;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getIdade() {
        return $this->email;
    }
}

class Aluno extends Pessoa {
    private $ra;

    public function __construct($nome, $email, $ra) {
        parent::__construct($nome, $email);
        $this->ra = $ra;
    }

    public function getRa() {
        return $this->ra;
    }
}

class Professor extends Pessoa {
    private $disciplina;

    public function __construct($nome, $email, $disciplina) {
        parent::__construct($nome, $email);
        $this->disciplina = $disciplina;
    }

    public function getDisciplina() {
        return $this->disciplina;
    }
}

class Curso {
    private $nome;
    private $professor;
    private $alunos = [];

    public function __construct($nome, Professor $professor) {
        $this->nome = $nome;
        $this->professor = $professor;
    }
    public function adicionarAluno(Aluno $aluno) {
        $this->alunos[] = $aluno;
    }
    public function listarAlunos() {
        foreach ($this->alunos as $aluno) {
            echo "Aluno: " . $aluno->getNome() . " (RA: " . $aluno->getRa() . ")<br>";
        }
    }
    public function getProfessor() {
        return $this->professor;
    }
    public function getNome() {
        return $this->nome;
    }
}
// --- exemplo de uso das classes
  


?>
