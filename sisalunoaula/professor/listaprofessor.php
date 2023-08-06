<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Professores</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Lista de Professores</h1>
    </header>
    <main>
    <?php
/*
 * Melhor prática usando Prepared Statements
 * 
 */
require_once('../conexao.php');

$retorno = $conexao->prepare('SELECT * FROM Professor');
$retorno->execute();

?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
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
            <td> <?php echo $value['cpf'] ?> </td>
            <td> <?php echo $value['idade'] ?> </td>
            <td> <?php echo $value['datanascimento'] ?> </td>
            <td> <?php echo $value['endereco'] ?> </td>
            <td> <?php echo $value['estatus'] ?> </td>

            <td>
                <form method="POST" action="altprofessor.php">
                    <input name="id" type="hidden" value="<?php echo $value['id']; ?>" />
                    <button name="alterar" type="submit">Alterar</button>
                </form>

            </td>

            <td>
                <form method="GET" action="crudprofessor.php">
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

