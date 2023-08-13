<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Disciplinas</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>LISTA DE DISCIPLINAS</h1>
    </header>
    <main>
    <?php 
/*
 * Melhor prática usando Prepared Statements
 * 
 */
  require_once('../conexao.php');
   
  $retorno = $conexao->prepare('SELECT * FROM disciplina');
  $retorno->execute();

?>       
        <table> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>CH</th>
                    <th>SEMESTRE</th>
                    <th>PROFESSOR</th>
                    <th>NOTA 01</th>
                    <th>NOTA 02</th>
                    <th>MÉDIA</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <?php foreach($retorno->fetchall() as $value) { ?>
                        <tr>
                            <td> <?php echo $value['id'] ?>   </td> 
                            <td> <?php echo $value['nomedisciplina']?>  </td> 
                            <td> <?php echo $value['ch']?> </td>
                            <td> <?php echo $value['semestre']?> </td>
                            <td> <?php
                                $professor = $value['idprofessor'];

                                $retornoProfessor = $conexao -> prepare('SELECT id, nome FROM professor where id = :professor');
                                $retornoProfessor->bindParam(':professor', $professor, PDO::PARAM_INT);
                                $retornoProfessor->execute();
                    
                                foreach($retornoProfessor->fetchall() as $valueProfessor){ 
                                    echo $valueProfessor['nome'];
                                }?> 
                            </td>
                            <td> <?php echo $value['Nota1']?> </td>
                            <td> <?php echo $value['Nota2']?> </td>
                            <td> <?php echo $value['Media']?> </td>

                            <td>
                               <form method="POST" action="altdisciplina.php">
                                        <input name="id" type="hidden" value="<?php echo $value['id'];?>"/>
                                        <button name="alterar"  type="submit">Alterar</button>
                                </form>

                             </td> 

                             <td>
                               <form method="GET" action="cruddisciplina.php">
                                        <input name="id" type="hidden" value="<?php echo $value['id'];?>"/>
                                        <button name="excluir"  type="submit">Excluir</button>
                                </form>

                             </td> 


                       
                      </tr>
                    <?php  }  ?> 
                 </tr>
            </tbody>
        </table>
<?php         
   echo "<button class='button button3'><a href='../index.html'>voltar</a></button>";
?>
    </main>
</body>
</html>