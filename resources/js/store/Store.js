import { createStore } from 'vuex';
import storage from "@/store/modules/storage.js";

const store = createStore({
    modules: {
        storage
    },
});

export default store;
