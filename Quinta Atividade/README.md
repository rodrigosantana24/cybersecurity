# Quinta Atividade - Comunicação entre Frames 

Esta atividade demonstra a comunicação entre dois frames em uma página HTML, com foco em organização de código e no comportamento de acesso entre documentos no mesmo contexto de origem.

## Objetivo 
Implementar uma interface com dois frames, onde:

1. Cada frame possui um `textarea` e um botão.
2. O texto digitado no **Frame 1** pode ser enviado para o **Frame 2**.
3. O texto digitado no **Frame 2** pode ser enviado para o **Frame 1**.
4. Todo o JavaScript fica centralizado no **Frame 1**.

## Estrutura dos arquivos
- `index.html`: cria os dois frames lado a lado.
- `frame1.html`: interface do Frame 1 e toda a lógica JavaScript.
- `frame2.html`: interface do Frame 2 (sem JavaScript).

## Como funciona
1. O usuário escreve no `textarea` do Frame 1 e clica em **Copiar para o frame 2**.
2. O script no Frame 1 acessa o `textarea` do Frame 2 e copia o conteúdo.
3. O usuário escreve no `textarea` do Frame 2 e clica em **Copiar para o frame 1**.
4. Mesmo esse botão sendo do Frame 2, sua ação foi conectada pelo JavaScript do Frame 1, que realiza a cópia de volta.

## Como executar
1. Abra o arquivo `index.html` em um navegador.
2. Teste o envio de texto do Frame 1 para o Frame 2.
3. Teste o envio de texto do Frame 2 para o Frame 1.

A aplicação deve permitir a troca de conteúdo entre os dois `textarea`, respeitando o requisito de que todo o JavaScript esteja no Frame 1.

