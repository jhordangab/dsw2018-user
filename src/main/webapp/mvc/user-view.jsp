<!DOCTYPE html>
<%@page import="dw.UserModel"%>
<%@page import="java.util.List"%>
<html>
<head>
<title>User</title>
<meta charset="utf-8">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body style="margin-top: 15px">
  <div class="container">
    <div class="row">
      <div class="col-md-offset-2 col-md-8">
        <ol class="breadcrumb">
          <li><a href="/">Menu</a></li>
          <li class="active">User</li>
        </ol>
        <div class="panel panel-default">
          <div class="panel-body">
            <form>
              <div class="form-group">
                <input
                  name="name"
                  value="${param.name}"
                  type="text"
                  placeholder="Name"
                  class="form-control">
              </div>
              <div class="form-group">
                <input
                  name="email"
                  value="${param.email}"
                  type="email"
                  placeholder="email"
                  class="form-control">
              </div>
              <div class="form-group">
                <input
                  name="age"
                  value="${param.age}"
                  type="number"
                  placeholder="Age"
                  class="form-control">
              </div>
              <button name="op" value="insert" class="btn btn-default">Insert</button>
              <button name="op" value="update" class="btn btn-default">Update</button>
            </form>
          </div>
        </div>
        <table class="table table-bordered table-striped">
          <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Age</td>
            <td>#</td>
            <td>#</td>
          </tr>
          <%
          List<UserModel> users = (List<UserModel>) request.getAttribute("users");
          for (UserModel v:users) {
          %>
            <tr>
              <td><%=v.getName()%></td>
              <td><%=v.getEmail()%></td>
              <td><%=v.getAge()%></td>
              <td><a href="user?age=<%=v.getAge()%>&name=<%=v.getName()%>&email=<%=v.getEmail()%>">Edit</a></td>
              <td><a href="user?op=delete&email=<%=v.getEmail()%>">Delete</a></td>
            </tr>
          <%
          }
          %>
        </table>
      </div>
    </div>
  </div>
</body>
</html>