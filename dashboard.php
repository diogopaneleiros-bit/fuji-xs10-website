<?php
require __DIR__ . '/php/db.php';

$pageTitle = 'Painel de respostas';
$db = getDbConnection();
$results = $db->query('SELECT id, name, email, experience, product, rating, message, submitted_at FROM survey_responses ORDER BY submitted_at DESC LIMIT 20');

require __DIR__ . '/partials/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-header">
            <h2>Painel de respostas do questionário</h2>
            <p>Consulta as respostas de satisfação guardadas na base de dados.</p>
        </div>

        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Experiência</th>
                        <th>Secção</th>
                        <th>Classificação</th>
                        <th>Mensagem</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($results): ?>
                        <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)): ?>
                            <tr>
                                <td><?= (int)$row['id'] ?></td>
                                <td><?= htmlspecialchars($row['name'] ?? 'Anónimo') ?></td>
                                <td><?= htmlspecialchars($row['email'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($row['experience'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($row['product'] ?? '-') ?></td>
                                <td><?= (int)($row['rating'] ?? 0) ?>/5</td>
                                <td><?= htmlspecialchars($row['message'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($row['submitted_at'] ?? '-') ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">Ainda não existem respostas registadas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>
