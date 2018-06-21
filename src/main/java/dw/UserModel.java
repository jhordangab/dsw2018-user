package dw;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

public class UserModel {
  private String name;
  public String getName() {
    return name;
  }
  public void setName(String name) {
    this.name = name;
  }

  private String email;
  public String getEmail() {
    return email;
  }
  public void setEmail(String email) {
    this.email = email;
  }

  private int age;
  public int getAge() {
    return age;
  }
  public void setAge(int age) {
    this.age = age;
  }

  private static Connection obterConexao() throws SQLException {
    String url = "jdbc:derby://localhost:1527/vendadb;create=true";
    String user = "app";
    String password = "app";
    return DriverManager.getConnection(url, user, password);
  }
  public void incluir() throws SQLException {
    Connection conn = obterConexao();
    
    String sql = "insert into \"user\" (name, email, age) values (?, ?, ?)";
    PreparedStatement pstmt = conn.prepareStatement(sql);
    pstmt.setString(1, name);
    pstmt.setString(2, email);
    pstmt.setInt(3, age);
    pstmt.execute();
  }

  public void salvar() throws SQLException {
    Connection conn = obterConexao();

    String sql = "update \"user\" set name = ?, age = ? where email = ?";
    PreparedStatement pstmt = conn.prepareStatement(sql);
    pstmt.setString(1, name);
    pstmt.setInt(2, age);
    pstmt.setString(3, email);
    pstmt.execute();
  }

  public void excluir() throws SQLException {
    Connection conn = obterConexao();
    
    String sql = "delete from \"user\" where email = ?";
    PreparedStatement pstmt = conn.prepareStatement(sql);
    pstmt.setString(1, email);
    pstmt.execute();
  }

  public static List<UserModel> listar() throws SQLException {
    Connection conn = obterConexao();
    
    Statement stmt = conn.createStatement();
    String sql = "select name, email, age from \"user\" order by name";
    ResultSet rs = stmt.executeQuery(sql);
  
    List<UserModel> users = new ArrayList<UserModel>();
    while (rs.next()) {
      UserModel user = new UserModel();
      user.setName(rs.getString("name"));
      user.setEmail(rs.getString("email"));
      user.setAge(rs.getInt("age"));
      users.add(user);
    }
    return users;
  }
}
