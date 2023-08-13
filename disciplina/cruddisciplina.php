<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Disciplina</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>CRUD DISCIPLINA</h1>
    </header>
    <main>
        <div class="box">
        <?php
##permite acesso as variaves dentro do aquivo conexao
require_once('../conexao.php');



##cadastrar
if(isset($_GET['cadastrar'])){
        ##dados recebidos pelo metodo GET
        $nota_1 = $_GET["nota_1"];
        $nota_2 = $_GET["nota_2"];
        $media = ($_GET["nota_2"] + $_GET["nota_1"]) / 2;
        $nomedisciplina = $_GET["nome"];
        $ch = $_GET["ch"];
        $semestre = $_GET["semestre"];
        $idprofessor = $_GET["professor"];

        ##codigo SQL
        $sql = "INSERT INTO disciplina(nomedisciplina, ch, semestre, idprofessor, Nota1, Nota2, Media) 
                VALUES('$nomedisciplina', '$ch', '$semestre', '$idprofessor', '$nota_1', '$nota_2', '$media')";

        ##junta o codigo sql a conexao do banco
        $sqlcombanco = $conexao->prepare($sql);

        ##executa o sql no banco de dados
        if($sqlcombanco->execute())
            {
                echo " <strong>OK!</strong> a disciplina
                $nomedisciplina foi Incluido com sucesso!!!"; 
                echo " <button class='button'><a href='../index.html'>voltar</a></button>";
            }
        }
#######alterar
if(isset($_POST['update'])){

    ##dados recebidos pelo metodo POST
    $nome = $_POST["nome"];
    $nota_1 = $_POST["nota_1"];
    $nota_2 = $_POST["nota_2"];
    $media = ($_POST["nota_1"] + $_POST["nota_2"]) / 2;
    $ch = $_POST["ch"];
    $semestre = $_POST["semestre"];
    $idprofessor = $_POST["professor"];
    $id = $_POST["id"];

      ##codigo sql
    $sql = "UPDATE  disciplina SET nomedisciplina   = :nome, ch = :ch, semestre = :semestre, idprofessor = :idprofessor, Nota1 = :nota_1, Nota2 = :nota_2 , Media = :media WHERE id= :id ";
   
    ##junta o codigo sql a conexao do banco
    $stmt = $conexao->prepare($sql);

    ##diz o paramentro e o tipo  do paramentros
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $stmt->bindParam(':nome',$nome, PDO::PARAM_STR);
    $stmt->bindParam(':nota_1',$nota_1, PDO::PARAM_INT);
    $stmt->bindParam(':nota_2',$nota_2, PDO::PARAM_INT);
    $stmt->bindParam(':media',$media, PDO::PARAM_INT);
    $stmt->bindParam(':ch',$ch, PDO::PARAM_STR);
    $stmt->bindParam(':semestre',$semestre, PDO::PARAM_STR);
    $stmt->bindParam(':idprofessor',$idprofessor, PDO::PARAM_INT);
    $stmt->execute();
 


    if($stmt->execute())
        {
            echo " <strong>OK!</strong> a disciplina $nome foi Alterada com sucesso!!!"; 

            echo " <button class='button'><a href='listadisciplina.php'>voltar</a></button>";
        }

}        


##Excluir
if(isset($_GET['excluir'])){
    $id = $_GET['id'];
    $sql ="DELETE FROM `disciplina` WHERE id={$id}";
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    if($stmt->execute())
        {
            echo " <strong>OK!</strong> a disciplina
             $id foi excluido!!!"; 

            echo " <button class='button'><a href='listadisciplina.php'>voltar</a></button>";
        }

}

        
?>
        </div>
    </main>
</body>
</html>