
import Vue from "vue";
import axios from "axios";

export default {
    createAuthor({commit}, payload) {
        axios.post('/authorStore', {
            name: payload
        })
            .then(response => {
                alert(response.data.message);
            })
            .catch(error => {
                this.errors = [];
                if (error.response.data.errors.title) {
                    this.errors.push(error.response.data.errors.title[0]);
                }
            });
    },
    getAuthors({commit}) {
        axios.get('/getAuthors')
            .then(response => {
                commit('clearAuthorsData');
                for(let i = 0; i < response.data.authors.length; i++) {
                    commit('setAuthors', response.data.authors[i]);
                }
            });
    },
    createPublishing ({commit}, payload) {
        axios.post('/publishingHouseStore', {
            name: payload
        })
            .then(response => {
                alert(response.data.message);
            })
            .catch(error => {
                this.errors = [];
                if (error.response.data.errors.title) {
                    this.errors.push(error.response.data.errors.title[0]);
                }
            });
    },
    getPublishingHouses({commit}) {
        axios.get('/getPublishingHouses')
            .then(response => {
                commit('clearPublishingHouses');
                for(let i = 0; i < response.data.houses.length; i++) {
                    commit('setPublishingHouses', response.data.houses[i]);
                }
            });
    },
    createBook ({commit}, {selectedId, house, name, date, image}) {
        const objFormData = {selectedId, house, name, date, image};
        //создаем нативный js обЪект для отправки данных multipart form data
        let obj = new FormData();
        obj.append('authors', JSON.stringify(objFormData.selectedId));
        obj.append('publishing_houses_id', objFormData.house);
        obj.append('name', objFormData.name);
        obj.append('publishing', objFormData.date);
        obj.append('image', objFormData.image);
        //отправляем данные на сервер
        axios.post('/bookStore', obj)
            .then((res) => {
                console.log(res.data.message)
            })
            .catch((err) => {
                console.log(err)
            })
    },

    getBooks({commit}) {
        axios.get('/getBooks')
            .then(response => {
                commit('clearBooks');
                console.log(response.data);
                for(let i = 0; i < response.data.books.length; i++) {
                    commit('setBooks', response.data.books[i]);
                }
            })
            .catch((err) => {
                console.log(err)
            })
    },
    deleteBook ({commit}, {id}) {
        axios.delete('/destroyBook/' + id)
            .then((res) => {
                console.log(res.data.message)
            })
            .catch((err) => {
                //console.log(err);
            })
    }
};