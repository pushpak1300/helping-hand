import Api from "./Api";

export default {
  register(form) {
    return Api().post("/register", form);
  },

  login(form) {
    return Api().post("/login", form);
  },

  logout() {
    localStorage.removeItem('role');
    localStorage.removeItem('token');
    return Api().post("/logout");
  },

  auth() {
    return Api().get("/user");
  },

  getDashboard() {
    return Api().get("/dashboard");
  },

  transferMoney(id, form) {
    return Api().post("/recievers/" +id, form);
  },

  generateQR(form) {
    return Api().post("/recievers", form);
  }
};
