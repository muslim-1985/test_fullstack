import Vue from "vue";
export default {
    setAuthors(state, data) {
        state.authors.push(data);
    },
    clearAuthorsData(state) {
        return state.authors = [];
    },
    setPublishingHouses(state, data) {
        state.publishingHouses.push(data);
    },
    clearPublishingHouses(state) {
        return state.publishingHouses = [];
    },
    setBooks(state, data) {
        state.books.push(data);
    },
    clearBooks(state) {
        return state.books = [];
    },
};