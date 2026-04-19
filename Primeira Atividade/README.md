# Java Applet

Aviso Legal: Este projeto possui fins estritamente educacionais e acadêmicos. 

## Como a Implementação Funciona

O projeto é composto por dois arquivos principais: o código Java (Main.java) e a página web comprometida (index.html).

1. O Applet Dropper (Main.java)

O código Java simula o comportamento exato do malware Autorun.jar descrito na literatura forense, mas de forma segura:

Criação da Sandbox: O código cria uma pasta local chamada sandbox_dropper para isolar a sua atividade.

Simulação de Download: Em vez de fazer requisições web para baixar malwares, ele simplesmente cria dois arquivos de texto inofensivos (mercurio.txt e netuno.txt), escrevendo mensagens de aviso dentro deles.

Renomeação (A tática do atacante): Para imitar a técnica usada no ataque original, o código pega esses arquivos .txt e os renomeia para .exe (Imagen1.exe e msnwin32.exe). Isto prova que o Applet possui privilégios de escrita e modificação no disco rígido do usuário.

Execução Simulada: Por fim, o código não executa os arquivos. Ele apenas imprime mensagens no console (System.out.println) afirmando que, em um cenário real, aquele seria o momento da infecção.

2. A Página Comprometida (index.html)

O arquivo HTML representa a "Fase 1" do ataque: o site legítimo (um portal de notícias) que foi invadido pelos atacantes.

A Injeção: A página contém a tag <applet code="Main.class" archive="ExploitTeste.jar" width="1" height="1"></applet>.

Invisibilidade: O segredo do ataque está nos atributos width="1" e height="1". Isso torna o Applet praticamente invisível na tela do usuário, executando todo o código malicioso em segundo plano enquanto a vítima apenas lê as notícias.

## Como Testar a Prova de Conceito

O “malware teste” só dispara quando o applet é carregado, e isso hoje NÃO acontece em Chrome/Edge/Firefox. Você precisa usar o `appletviewer` (ou uma VM antiga). No seu caso, o mais simples é o `appletviewer`.

Passo a passo no seu PC (JDK 8):

1. Na pasta Primeira Atividade:

    `cd "C:\Users\Rodrigo Santana\Documents\desenvolvimento\github\cybersecurity\Primeira Atividade"`

   - `javac -source 1.8 -target 1.8 Main.java`
   - `jar cvf ExploitTeste.jar Main.class`

2. Descobrir onde está o JDK que tem o `appletviewer`:
   - No PowerShell: `where javac`  
   - Vai aparecer algo como:  
     `C:\Program Files\Java\jdk1.8.0_xxx\bin\javac.exe`

3. Rodar o applet usando o caminho completo do `appletviewer` (substitua pelo seu caminho real):
   - `"C:\Program Files\Java\jdk1.8.0_xxx\bin\appletviewer.exe" index.html`

Ao fazer isso:
- O `appletviewer` vai abrir uma janelinha carregando o index.html.
- Ao carregar a página, o applet `Main.class` dentro do `ExploitTeste.jar` é executado.
- A simulação cria/renomeia os arquivos na pasta `sandbox_dropper` (ao lado do index.html), exatamente como quando você roda `java Main`.

Se o comando do `appletviewer` der erro de caminho, manda aqui o resultado do `where javac` que eu te devolvo o comando certinho já ajustado.

---
Documento gerado para fins de relatório acadêmico de Análise de Vulnerabilidades / Cibersegurança.
