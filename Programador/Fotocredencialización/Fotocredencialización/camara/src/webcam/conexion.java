/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package webcam;

/**
 *
 * @author Rogelio
 */
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import javax.swing.JOptionPane;
import static webcam.CanvasCam.exec;
public class conexion {
    Statement st;
    Connection conexion;
    String ID_Empleado="",Fecha="",ID_Departamento="",ID_Empresa="";
    String Departamentos[];
public void conecta()
{
try
{
   Class.forName("com.mysql.jdbc.Driver");
   conexion = DriverManager.getConnection("jdbc:mysql://localhost/credencial", "root", "12345"); 
    System.out.println("éxito!");
    st = conexion.createStatement();
}catch(Exception e)
{
    System.out.println("No se conecto");
}
    
}

public String regresar_Nuevo_ID() throws SQLException
{
    ResultSet rs = exec.st.executeQuery("select max(id_emp) as maxi from empleado"); 
            rs.next();
            ID_Empleado=rs.getObject("maxi")+"";
            rs.close();
            if(ID_Empleado.compareTo("null")==0)
            return "1";
            else
                return (Integer.parseInt(ID_Empleado)+1)+"";
}

public void Guardar_Contacto(String nombre, String apellidos, String puesto,String Departamento) throws SQLException
{
    ResultSet rs = exec.st.executeQuery("select id_depto,id_org from departamento where nombre_depto='"+Departamento+"'"); 
    rs.next();
    ID_Departamento=rs.getObject("id_depto")+"";
    ID_Empresa=rs.getObject("id_org")+"";
    
     st.executeUpdate("INSERT INTO empleado (nombre_emp,apellidop_emp,puesto_trabajo_emp,id_depto,id_org,fecha) "
             + "VALUES ('"+nombre+"','"+apellidos+"','"+puesto+"','"+ID_Departamento+"','"+ID_Empresa+"','"+regresa_Fecha()+"');");
     rs.close();
}

public String regresa_Fecha() throws SQLException
{
    ResultSet rs = exec.st.executeQuery("select CURDATE() as fecha"); 
    rs.next();
    Fecha=rs.getObject("fecha")+"";
    rs.close();
    return Fecha;
}

public String [] Obtener_Departamentos() throws SQLException
{ 
    ResultSet rs = exec.st.executeQuery("select  count(id_depto) as num from departamento");
    rs.next();
    int total=Integer.parseInt(rs.getObject("num")+"");
    Departamentos=new String[total];
    rs.close();
    
    rs = exec.st.executeQuery("select  nombre_depto as nombre from departamento");
    for (int i = 0; i < Departamentos.length; i++) 
    {
        rs.next();
        Departamentos[i]=rs.getObject("nombre")+"";
    }
    
    return Departamentos;
}

}
