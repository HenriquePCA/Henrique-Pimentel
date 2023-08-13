<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista de alunos</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Lista de Alunos</h1>
    </header>
    <main>
    <?php
/*
 * Melhor prática usando Prepared Statements
 * 
 */
require_once('../conexao.php');

$retorno = $conexao->prepare('SELECT * FROM aluno');
$retorno->execute();

?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Data de Nascimento</th>
            <th>Endereço</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <?php foreach ($retorno->fetchall() as $value) { ?>
        <tr>
            <td> <?php echo $value['id'] ?> </td>
            <td> <?php echo $value['nome'] ?> </td>
            <td> <?php echo $value['idade'] ?> </td>
            <td> <?php echo $value['datanascimento'] ?> </td>
            <td> <?php echo $value['endereco'] ?> </td>
            <td> <?php echo $value['estatus'] ?> </td>

            <td>
                <form method="POST" action="altaluno.php">
                    <input name="id" type="hidden" value="<?php echo $value['id']; ?>" />
                    <button name="alterar" type="submit">Alterar</button>
                </form>

            </td>

            <td>
                <form method="GET" action="crudaluno.php">
                    <input name="id" type="hidden" value="<?php echo $value['id']; ?>" />
                    <button name="excluir" type="submit">Excluir</button>
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