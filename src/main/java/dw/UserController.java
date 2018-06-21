package dw;

import java.io.IOException;
import java.sql.SQLException;
import java.util.List;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet(value = "/mvc/user")
public class UserController extends HttpServlet {

  @Override
  protected void service(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
    String op = request.getParameter("op");
    op = (op == null ? "" : op);

    UserModel user = new UserModel();
    user.setName(request.getParameter("name"));
    user.setEmail(request.getParameter("email"));
    String ageStr = request.getParameter("age");
    ageStr = (ageStr == null ? "0" : ageStr);
    user.setAge(Integer.parseInt(ageStr));

    List<UserModel> users = null;
    try {
      if (op.equals("insert")) {
    	  user.incluir();
      } else if (op.equals("update")) {
    	  user.salvar();
      } else if (op.equals("delete")) {
    	  user.excluir();
      }

      users = UserModel.listar();

    } catch (SQLException e) {
      throw new RuntimeException(e);
    }
    
    request.setAttribute("users", users);

    request.
      getRequestDispatcher("/mvc/user-view.jsp").
      forward(request, response);
  }
}
