<?php
require __DIR__ . '/php/db.php';

$pageTitle = 'Suporte e Questionário';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['survey_submit'])) {
    $db = getDbConnection();
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $experience = trim($_POST['experience'] ?? '');
    $product = trim($_POST['product'] ?? '');
    $rating = (int)($_POST['rating'] ?? 0);
    $message = trim($_POST['message'] ?? '');

    $stmt = $db->prepare('INSERT INTO survey_responses (name, email, experience, product, rating, message) VALUES (:name, :email, :experience, :product, :rating, :message)');
    $stmt->bindValue(':name', $name ?: 'Anónimo', SQLITE3_TEXT);
    $stmt->bindValue(':email', $email ?: 'sem-email@exemplo.com', SQLITE3_TEXT);
    $stmt->bindValue(':experience', $experience, SQLITE3_TEXT);
    $stmt->bindValue(':product', $product, SQLITE3_TEXT);
    $stmt->bindValue(':rating', $rating, SQLITE3_INTEGER);
    $stmt->bindValue(':message', $message, SQLITE3_TEXT);
    $stmt->execute();

    $notice = 'Obrigado! A tua resposta foi guardada com sucesso.';
}

require __DIR__ . '/partials/header.php';
?>

<main>
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2>Suporte e atendimento</h2>
                <p>Podes entrar em contacto, consultar dúvidas comuns e responder ao questionário de satisfação.</p>
            </div>

            <div class="contact-shell">
                <aside class="support-card">
                    <h3>Como podemos ajudar</h3>
                    <ul>
                        <li>Escolha da melhor lente para a tua X-S10</li>
                        <li>Compatibilidade com acessórios e filtros</li>
                        <li>Informação de compra por país</li>
                        <li>Configuração básica de vídeo e fotografia</li>
                        <li>Suporte técnico e dúvidas de navegação</li>
                    </ul>
                </aside>

                <div class="form-card">
                    <h3>Contacta-nos</h3>
                    <form method="post" class="form-wrap">
                        <div class="form-grid">
                            <div class="field">
                                <label for="name">Nome</label>
                                <input id="name" name="name" type="text" placeholder="O teu nome">
                            </div>
                            <div class="field">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" placeholder="nome@email.com">
                            </div>
                            <div class="field full">
                                <label for="message">Mensagem</label>
                                <textarea id="message" name="message" rows="5" placeholder="Escreve a tua dúvida..."></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Enviar pedido</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="support-questions">
                <div class="section-header" style="margin-bottom: 1rem; color: white;">
                    <h2>Questionário de satisfação</h2>
                    <p>Ajuda-nos a melhorar a experiência do site e a qualidade dos conteúdos.</p>
                </div>

                <?php if (!empty($notice)): ?>
                    <div class="notice"><?= htmlspecialchars($notice) ?></div>
                <?php endif; ?>

                <form method="post" class="question-grid">
                    <div class="field">
                        <label>Nome</label>
                        <input type="text" name="name" placeholder="Nome completo">
                    </div>
                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="email@exemplo.com">
                    </div>

                    <div class="field">
                        <label>Qual foi a tua experiência geral com o site?</label>
                        <div class="radio-list">
                            <label class="radio-option"><input type="radio" name="experience" value="Excelente"> Excelente</label>
                            <label class="radio-option"><input type="radio" name="experience" value="Boa"> Boa</label>
                            <label class="radio-option"><input type="radio" name="experience" value="Razoável"> Razoável</label>
                            <label class="radio-option"><input type="radio" name="experience" value="Pior"> Pior</label>
                        </div>
                    </div>

                    <div class="field">
                        <label>Qual secção te pareceu mais útil?</label>
                        <select name="product">
                            <option value="Câmera">Câmera</option>
                            <option value="Lentes">Lentes</option>
                            <option value="Acessórios">Acessórios</option>
                            <option value="Suporte">Suporte</option>
                            <option value="Onde Comprar">Onde Comprar</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>Classificação</label>
                        <select name="rating">
                            <option value="5">5/5 Excelente</option>
                            <option value="4">4/5 Muito bom</option>
                            <option value="3">3/5 Bom</option>
                            <option value="2">2/5 Razoável</option>
                            <option value="1">1/5 Fraco</option>
                        </select>
                    </div>

                    <div class="field full">
                        <label>Comentários finais</label>
                        <textarea name="message" rows="4" placeholder="Deixa o teu comentário..."></textarea>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit" name="survey_submit" value="1">Enviar resposta</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>
