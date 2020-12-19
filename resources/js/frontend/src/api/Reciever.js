import Api from "./Api";

export default {
    profile(id) {
        return Api().get("/recievers/" + id);
    },
};