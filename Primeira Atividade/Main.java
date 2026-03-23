import java.applet.Applet;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;

/**
 *   Prova de conceito EDUCACIONAL inspirada no ataque "drive-by download".
 *
 *   O applet (ou o método main) só cria arquivos de texto inofensivos
 *   dentro de uma pasta sandbox_dropper.
 * 
 *   Depois renomeia esses arquivos para extensões .exe para simular o
 *   comportamento do dropper Autorun.jar descrito no cenário real.
 * 
 *   Nenhum executável real é baixado ou executado.
 */
public class Main extends Applet {

    /**
     * Simula o comportamento do Autorun.jar/"dropper" de forma segura.
     *
     *   Cria mercurio.txt e netuno.txt com conteúdo de texto inofensivo.
     *   Renomeia para Imagen1.exe e msnwin32.exe (ainda arquivos de texto).
     *   Registra todas as etapas no console.
     * 
     *   Simular "execucao" dos binarios maliciosos (APENAS LOG, NAO EXECUTA NADA)
     */
    private static void executarSimulacaoDropper() {
        File sandboxDir = new File("sandbox_dropper");

        try {
            if (!sandboxDir.exists()) {
                boolean created = sandboxDir.mkdirs();
                if (!created) {
                    System.out.println("Nao foi possivel criar o diretorio de sandbox.");
                    return;
                }
            }

            File mercurioTxt = new File(sandboxDir, "mercurio.txt");
            try (FileWriter writer = new FileWriter(mercurioTxt)) {
                writer.write("Conteudo SIMULADO do malware 1 (texto INOFENSIVO).\n");
                writer.write("Este arquivo representa o antigo mercurio.txt.\n");
            }

            File netunoTxt = new File(sandboxDir, "netuno.txt");
            try (FileWriter writer = new FileWriter(netunoTxt)) {
                writer.write("Conteudo simulado do malware 2.\n");
                writer.write("Este arquivo representa o antigo netuno.txt.\n");
            }

            File imagenExe = new File(sandboxDir, "Imagen1.exe");
            File msnExe = new File(sandboxDir, "msnwin32.exe");

            boolean renamed1 = mercurioTxt.renameTo(imagenExe);
            boolean renamed2 = netunoTxt.renameTo(msnExe);

            System.out.println("Arquivos simulados criados em: " + sandboxDir.getAbsolutePath());
            System.out.println("Renomeacao mercurio.txt -> Imagen1.exe: " + renamed1);
            System.out.println("Renomeacao netuno.txt -> msnwin32.exe: " + renamed2);

            System.out.println("[SIMULACAO] Aqui o malware real executaria Imagen1.exe e msnwin32.exe.");
            System.out.println("[SIMULACAO] Nesta prova de conceito, NENHUM executavel real e baixado ou executado.");

        } catch (Exception e) {
            System.out.println("Erro na simulacao do dropper (possivel restricao de seguranca em applet): " + e.getMessage());
            e.printStackTrace();
        }
    }

    public void init() {
        executarSimulacaoDropper();
    }

    public static void main(String[] args) {
        executarSimulacaoDropper();
    }
}