# Terceira Atividade - Minhas Soluções  DVWA (Nível mais alto)

Este diretório traz uma implementação individual para cada ataque do DVWA, seguindo a ideia do nível impossible e reforçando controles de segurança no lado do servidor.

## Estrutura

- `solucoes/`: uma solução por ataque.

## Ataques e soluções implementadas

| Ataque | Arquivo | Solução aplicada |
| --- | --- | --- |
| API | `solucoes/api.php` | Exige `Bearer Token` e valida token no backend antes de processar requisição. |
| Authentication Bypass | `solucoes/authbypass.php` | Valida sessão autenticada e autorização explícita para administrador (`401/403`). |
| Broken Access Control (BAC) | `solucoes/bac.php` | Controle de autorização por dono do recurso ou admin + consulta preparada. |
| Brute Force | `solucoes/brute.php` | Limite de tentativas por janela de tempo + bloqueio temporário + `password_verify`. |
| CAPTCHA | `solucoes/captcha.php` | Verificação obrigatória de CAPTCHA e token CSRF antes de ação sensível. |
| Cryptography | `solucoes/cryptography.php` | Criptografia autenticada com AES-256-GCM, IV aleatório e tag de integridade. |
| CSP Bypass | `solucoes/csp.php` | CSP restritiva (`script-src 'self'`) e negação de inline script por padrão. |
| CSRF | `solucoes/csrf.php` | Token anti-CSRF com `hash_equals`, valida senha atual e usa query preparada. |
| Command Injection | `solucoes/exec.php` | Aceita apenas IPv4 válido e usa `escapeshellarg` no comando. |
| File Inclusion | `solucoes/fi.php` | Inclusão apenas por allowlist de arquivos permitidos. |
| JavaScript Attack | `solucoes/javascript.php` | Revalidação completa no servidor (não confia em validação client-side). |
| Open Redirect | `solucoes/open_redirect.php` | Redirecionamento apenas por IDs permitidos (allowlist). |
| SQL Injection | `solucoes/sqli.php` | Consulta parametrizada com `PDO::prepare` e `bindValue`. |
| SQL Injection Blind | `solucoes/sqli_blind.php` | Query parametrizada e resposta booleana sem vazamento de dados sensíveis. |
| File Upload | `solucoes/upload.php` | Validação de extensão/MIME/conteúdo real da imagem + nome aleatório seguro. |
| Weak Session ID | `solucoes/weak_id.php` | ID de sessão criptograficamente forte com `random_bytes` e cookie seguro. |
| XSS DOM | `solucoes/xss_d.php` | Saída JSON segura (`JSON_HEX_*`) para evitar injeção no DOM. |
| XSS Reflected | `solucoes/xss_r.php` | Escape de saída com `htmlspecialchars(..., ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')`. |
| XSS Stored | `solucoes/xss_s.php` | Escape na saída e persistência via prepared statement. |

## Observação

Documento gerado para fins de relatório acadêmico de Análise de Vulnerabilidades / Cibersegurança.
