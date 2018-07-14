import Vue from 'vue'
export default {
    authorData(state) {
        return state.authors;
    },
    housesData (state) {
        return state.publishingHouses;
    },
    booksData (state) {
        return state.books;
    }
};