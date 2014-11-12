// CanvasCam.java --------------------------------------------------------------

package webcam;


import java.awt.Canvas;
import java.awt.Color;
import java.awt.Graphics;
import java.awt.Graphics2D;
import java.awt.image.BufferStrategy;
import javax.swing.JFrame;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.imageio.ImageIO;
import javax.swing.JOptionPane;


/**
 * Este Canvas una vez se haya iniciado con {@link #start()} intentará capturar
 * imágenes de la webcam y las pintará de forma continuada en pantalla. Mientras
 * se prepara el dispositivo muestra un mensaje que avisa de que está cargando.
 * Los fotogramas por segundo a los que se muestran las imágenes son 10.
 * 
 * @author <a href="http://programmingheroes.blogspot.com">ProgramminHeroes</a>
 */
class CanvasCam extends Canvas implements Runnable {
    static JFrame f;
    static CanvasCam c;
    static conexion exec;
    /**
     * Controla la ejecución del Thread encargado de pintar en el CanvasCam.
     */
     javax.swing.JButton jButton2;
     javax.swing.JLabel jLabel1;
     javax.swing.JLabel jLabel2;
     javax.swing.JLabel jLabel3;
     javax.swing.JLabel jLabel4;
     javax.swing.JLabel jLabel5;
     javax.swing.JLabel jLabel6;
     javax.swing.JLabel jLabel7;
     javax.swing.JMenu jMenu1;
     javax.swing.JMenuBar jMenuBar1;
     javax.swing.JTextField Apellidos;
     javax.swing.JTextField Nombre;
     javax.swing.JTextField Puesto;
     static javax.swing.JTextField ID;
     static javax.swing.JTextField Fecha;
     static javax.swing.JComboBox Departamento;
     javax.swing.JButton tomar_foto;
    // End of variables declaration           
    public volatile boolean running = false;
    static String Departamentos[];
    
    /**
     * Imprescindible objeto para la utilización de la cámara.
     */
     static WebCam webcam;
    
    /**
     * Permite la utilización de Gráficos acelerados.
     */
    public BufferStrategy bufferStrategy;
    
    /**
     * Imagen actual que se encuentra pintada en el CanvasCam.
     */
    public BufferedImage img;
    
    
    public CanvasCam() {
        super();
        this.setSize(320, 240);
        this.setIgnoreRepaint(true);
    } // fin de CanvasCam();

    /**
     * Inicia el nuevo hilo que va a controlar el pintado.
     */
    public void start() {
        try
        {
            Thread a;
            a = new Thread(this);
            a.start();
        }catch(Exception e){}
    } // fin de start();
    
    /**
     * Detiene la conexión con la cámara y finaliza el hilo pintor.
     */
    public void stop() {
        webcam.close();
        running = false;
    } // fin de stop();
    
    @Override
    public void run() {        
        try {
            Thread.sleep(5000); // 1000/100 = 10 FPS
        } catch (InterruptedException ex) {
            Logger.getLogger(CanvasCam.class.getName()).log(Level.SEVERE, null, ex);
        }
        this.createBufferStrategy(2);
        bufferStrategy = this.getBufferStrategy();

        running = true;
        while (running) {            
            BufferedImage image = webcam.getImage();
            if (image != null) {
                img = image;
            }
            
            if (!bufferStrategy.contentsLost()) {
                paint(bufferStrategy.getDrawGraphics());
            }
            bufferStrategy.show();
            try {
                Thread.sleep(100); // 1000/100 = 10 FPS
            } catch (InterruptedException ex) {}
        }
    } // fin de run();
    
    @Override
    public void paint(Graphics g) {
        Graphics2D g2d = (Graphics2D) bufferStrategy.getDrawGraphics();
        paint(g2d);
        g2d.dispose();
    } // fin de paint(Graphics g);
    
    public void paint(Graphics2D g) {
        g.setColor(Color.PINK);
        g.fillRect(0, 0, this.getWidth(), this.getHeight());
        if (img == null) {
            g.setColor(Color.BLACK);
            g.setFont(g.getFont().deriveFont(30F));
            g.drawString("Cargando imágenes de la cámara...",
                10, this.getHeight()-10);
            return;
        }
        g.drawImage(img, (int)((this.getWidth()-img.getWidth())/2),
                (int)((this.getHeight()-img.getHeight())/2), this);
    } // fin de paint(Graphics2D);
    
    public void limpiar()
    {
         Nombre.setText("");
            Apellidos.setText("");
            Puesto.setText("");
    }
    
     public  void initComponents() {

        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();
        Apellidos = new javax.swing.JTextField();
        Nombre = new javax.swing.JTextField();
        Puesto = new javax.swing.JTextField();
        jLabel4 = new javax.swing.JLabel();
        jButton2 = new javax.swing.JButton();
        jLabel5 = new javax.swing.JLabel();
        ID = new javax.swing.JTextField();
        tomar_foto = new javax.swing.JButton();
        jLabel6 = new javax.swing.JLabel();
        Fecha = new javax.swing.JTextField();
        jLabel7 = new javax.swing.JLabel();
        Departamento = new javax.swing.JComboBox();
        jMenuBar1 = new javax.swing.JMenuBar();
        jMenu1 = new javax.swing.JMenu();

        jLabel1.setText("Nombre");

        jLabel2.setText("ID Empleado");

        jLabel3.setText("Puesto");

        jLabel4.setFont(new java.awt.Font("Arial Black", 1, 36)); // NOI18N
        jLabel4.setText("Software de Fotocredencialización");


        jButton2.setText("Limpiar Campos");

        jLabel5.setText("Apellidos");

        ID.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jTextField4ActionPerformed(evt);
            }
        });

        tomar_foto.setText("Crear Credencial (Guardar Datos)");
        tomar_foto.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                try {
                    tomar_fotoMouseClicked(evt);
                } catch (IOException ex) {
                    Logger.getLogger(CanvasCam.class.getName()).log(Level.SEVERE, null, ex);
                } catch (SQLException ex) {
                    Logger.getLogger(CanvasCam.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
        });
        
        

        jLabel6.setText("Fecha");

        jLabel7.setText("Departamento");

        jMenu1.setText("Mostrar Fotos");


        jMenuBar1.add(jMenu1);

        f.setJMenuBar(jMenuBar1);
        jMenu1.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                Process p;
                try {
                    p = Runtime.getRuntime().exec("explorer.exe fotos");
                    p.waitFor();
                } catch (IOException ex) {
                    Logger.getLogger(CanvasCam.class.getName()).log(Level.SEVERE, null, ex);
                } catch (InterruptedException ex) {
                    Logger.getLogger(CanvasCam.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
        });

         jButton2.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) 
            {
                limpiar();
            }
        });
        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(f.getContentPane());
        f.getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addContainerGap()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                            .addComponent(jLabel4)
                            .addGroup(layout.createSequentialGroup()
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                                        .addComponent(jLabel7)
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                                        .addComponent(Departamento, javax.swing.GroupLayout.PREFERRED_SIZE, 173, javax.swing.GroupLayout.PREFERRED_SIZE))
                                    .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                        .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                                            .addComponent(jLabel6)
                                            .addGap(49, 49, 49)
                                            .addComponent(Fecha, javax.swing.GroupLayout.PREFERRED_SIZE, 173, javax.swing.GroupLayout.PREFERRED_SIZE))
                                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                                            .addGroup(layout.createSequentialGroup()
                                                .addComponent(jLabel3)
                                                .addGap(45, 45, 45)
                                                .addComponent(Puesto, javax.swing.GroupLayout.PREFERRED_SIZE, 173, javax.swing.GroupLayout.PREFERRED_SIZE))
                                            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                                                .addComponent(jLabel1)
                                                .addGap(41, 41, 41)
                                                .addComponent(Nombre, javax.swing.GroupLayout.PREFERRED_SIZE, 173, javax.swing.GroupLayout.PREFERRED_SIZE))
                                            .addGroup(layout.createSequentialGroup()
                                                .addComponent(jLabel2)
                                                .addGap(18, 18, 18)
                                                .addComponent(ID, javax.swing.GroupLayout.PREFERRED_SIZE, 173, javax.swing.GroupLayout.PREFERRED_SIZE)))))
                                .addGap(39, 39, 39)
                                .addComponent(jLabel5)
                                .addGap(18, 18, 18)
                                .addComponent(Apellidos, javax.swing.GroupLayout.PREFERRED_SIZE, 173, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addComponent(this, javax.swing.GroupLayout.PREFERRED_SIZE, 314, javax.swing.GroupLayout.PREFERRED_SIZE))))
                    .addGroup(layout.createSequentialGroup()
                        .addGap(241, 241, 241)
                        .addGap(44, 44, 44)
                        .addComponent(tomar_foto)
                        .addGap(48, 48, 48)
                        .addComponent(jButton2)))
                .addContainerGap(72, Short.MAX_VALUE))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addComponent(jLabel4)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(layout.createSequentialGroup()
                                .addGap(54, 54, 54)
                                .addComponent(jLabel2))
                            .addGroup(layout.createSequentialGroup()
                                .addGap(48, 48, 48)
                                .addComponent(ID, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)))
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(jLabel1)
                            .addComponent(Nombre, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(jLabel5)
                            .addComponent(Apellidos, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(18, 18, 18)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(jLabel3)
                            .addComponent(Puesto, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(18, 18, 18)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(jLabel6)
                            .addComponent(Fecha, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(29, 29, 29)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(jLabel7)
                            .addComponent(Departamento, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)))
                    .addGroup(layout.createSequentialGroup()
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addComponent(this, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, 138, Short.MAX_VALUE)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jButton2)
                    .addComponent(tomar_foto))
                .addGap(69, 69, 69))
        );

    }// </editor-fold>                        

    public void jTextField4ActionPerformed(java.awt.event.ActionEvent evt) {                                            
        // TODO add your handling code here:
    }                                           

    public void tomar_fotoMouseClicked(java.awt.event.MouseEvent evt) throws IOException, SQLException{                                        
            ImageIO.write(webcam.getImage(),"jpg", new File("fotos/"+ID.getText().toString()+".jpg"));
            exec.Guardar_Contacto(Nombre.getText().toString(), Apellidos.getText().toString(), Puesto.getText().toString(),Departamento.getSelectedItem().toString());
            ID.setText(exec.regresar_Nuevo_ID());
            limpiar();
            JOptionPane.showMessageDialog(Departamento, "Datos Guardos Con Éxito!!");
            
    }   
    public void iniciar_componentes()
    {
        try
        {
        initComponents();
        }catch(Exception e)
        {    
        }
    }
    public static void main(String[] args) {
        try
        {
        exec=new conexion();
        exec.conecta();
        webcam = new WebCam();
        webcam.start();
        
        Departamentos=exec.Obtener_Departamentos();
        while(true)
        {
            if(webcam.cameraAvailable)
            {
                f = new JFrame("WebCam");
                c = new CanvasCam();
                f.add(c);
                c.start();
                c.iniciar_componentes();
                f.pack();
                f.setVisible(true);
                f.setSize(1000, 600);
                f.setResizable(false);
                f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
                ID.setEnabled(false);
                ID.setDisabledTextColor(Color.black);
                ID.setText(exec.regresar_Nuevo_ID());
                Fecha.setEnabled(false);
                Fecha.setDisabledTextColor(Color.black);
                Fecha.setText(exec.regresa_Fecha());
                for (int i = 0; i < Departamentos.length; i++) 
                {
                    Departamento.addItem(Departamentos[i]);
                }
            break;
            }
        }
        }catch(Exception e)
        {
            System.out.println(e);    
        }
        
    } // fin de main(String[]);
  
} // fin de la clase CanvasCam

// fin de CanvasCam.java