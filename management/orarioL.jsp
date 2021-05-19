<!DOCTYPE html>
<HTML>

  <%@ page import = "java.io.*,java.util.*,java.sql.*" %>
  <%@ page import = "javax.servlet.http.*,javax.servlet.*" %>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Milanesi Commerce Management </title>
    <link rel="icon" href="../immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.management.css">
  </head>

  <body>

      <div class="header-page">
        <div class="header">
          <p> Accesso effettuato da: <?php echo "{$row_dip["IDdipendente"]} - {$row_dip["nome"]} {$row_dip["cognome"]} - {$row_dip["email_aziendale"]}" ?> </p>
        </div>
        <br>
        <h2> Management area </h2>
        <br>
        <a href="http://localhost/elaborato/management/managementPage.php"> <button name="management-page"> Torna alla home </button> </a> <br><br>
        <hr><br>
      </div>

      <div class="filtri taglia-container2">
        <h1> Orario di lavoro </h1>
        <table border="1" class="orari">
          <tr>
            <th> # </th>
            <%
              PrintWriter out2 = response.getWriter();
              try
              {
                Class.forName("com.mysql.cj.jdbc.Driver");

                Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/elaboratoluca_dip","root","");
                Statement st = conn.createStatement();


                ResultSet rs = st.executeQuery("show databases");
                while(rs.next())
                {
                  // if (rs) {
                    out2.println(rs.getString("Database"));
                //   }
                //   else {
                //     out2.println("<td> " + rs.getString("orario_inizio") + "</td>");
                //   }
                }
              }
              catch (Exception e)
              {
                out2.println(e);
              }
            %>
          </tr>
          <tr>
            <td> Ora di inizio </td>

          </tr>
          <tr>
            <td> Ora di fine </td>

          </tr>
        </table>
      </div>

  </body>

</HTML>
