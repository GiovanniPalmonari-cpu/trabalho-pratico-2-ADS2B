<?php
/**
 * Curso: Tecnologia em Análise e Desenvolvimento de Sistemas
 * Disciplina: Linguagem e Técnicas de Programação
 * Professor: José Carlos Domingues Flores
 * Turma: ADS2B
 * Componentes:
 *   26002959-2 - Giovanni Palmonari
 *   26015725-2 - Etinosa
 *   26008832-2 - Lucas Tavares Ortega
 *   26002534-2 - Ricardo Henrique
 *   26014646-2 - Filipe Cruz
 * Data: 12 de Novembro de 2026
 * Descritivo: Funções auxiliares, segurança e mensagens do sistema.
 */

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}

function setFlash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verifyCsrf(): void
{
    $sent = $_POST['csrf_token'] ?? '';
    $saved = $_SESSION['csrf_token'] ?? '';

    if (!is_string($sent) || !is_string($saved) || $saved === '' || !hash_equals($saved, $sent)) {
        http_response_code(419);
        exit('Solicitação inválida. Atualize a página e tente novamente.');
    }
}

function postString(string $key): string
{
    return trim((string) ($_POST[$key] ?? ''));
}
