<!DOCTYPE html>
<html>

<head>
    <title>Todo List</title>
    <!-- Inclua aqui seus arquivos CSS, JS e talvez algum framework que esteja usando -->
</head>

<body>
    <h1>Todo List</h1>
    <a href="http://localhost:8000/teste">Mudar</a>
        <?php if (empty($todos)) : ?>
            <p>No todos found.</p>
        <?php else : ?>
            <ul>
                <?php foreach ($todos as $todo) : ?>
                    <li id="todo-<?= $todo->getId() ?>">
                        <h2><?= htmlspecialchars($todo->getTitle()) ?></h2>
                        <!-- O botão de deletar -->
                        <button type="button" class="btn btn-danger delete-btn'" data-id="<?= $todo->getId() ?>">Delete</button>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
        <!-- Aqui você pode colocar um link ou um botão para criar uma nova tarefa -->
</body>
<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            const id = $(this).data('id');
            $.ajax({
                url: `api/todo/${id}/delete`,
                method: 'POST',
                success: function() {
                    $('#todo-' + id).remove();
                }
            });
        });
    });
</script>

</html>