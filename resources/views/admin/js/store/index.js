import axios from "axios";

// axios.defaults.baseURL ='http://student.localhost:8000/' + "api/";
// axios.defaults.baseURL =process.env.MIX_APP_URL + "api/";
axios.defaults.baseURL = window.location.origin + "/api/v1";

import { createStore } from "vuex";

const store = createStore({
    modules: {
       
    },
});

export default store;
