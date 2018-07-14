<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button @click="initAddAuthor()" class="btn btn-primary btn-xs pull-right">
                            + Add Author
                        </button>
                        <button @click="initAddPublishing()" class="btn btn-primary btn-xs pull-right">
                            + Add Publishing House
                        </button>
                        <button @click="initAddBook()" class="btn btn-primary btn-xs pull-right">
                            + Add Book
                        </button>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive">
                            <tbody>
                            <tr>
                               <th>id</th>
                                <th>name</th>
                                <th>authors</th>
                                <th>publishing house</th>
                                <th>publishing date</th>
                                <th>image</th>
                                <th>actions</th>
                            </tr>
                            <tr v-for="(data, index) in getBooksData">
                                <td>{{ data.id }}</td>
                                <td>{{ data.name }}</td>
                                <td>
                                    <p v-for="(key, value) in data.authors">{{ key.name }}</p>
                                </td>
                                <td>
                                    <span v-for="(key, value) in data">{{ key.name }}</span>
                                </td>
                                <td>{{ data.publishing }}</td>
                                <td><img :src="'http://localhost/'+data.image"/></td>
                                <td>
                                    <button  @click="deleteAuthor({id: data.id}, index)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <createAuthor></createAuthor>
        <publishingHouse></publishingHouse>
        <book></book>
    </div>
</template>

<script>
    import store from '../store/index'
    import createAuthor from './createAuthor'
    import publishingHouse from './createPublishingHouse'
    import book from './createBook'
    export default {
        components: { createAuthor, publishingHouse, book },
        data(){
            return {
                selected: null,
                selectedId: [],
                errors: [],
                tasks: []
            }
        },
        mounted() {
            this.getBooksAction ();
        },
        computed: {
            getAuthorsData() {
                return store.getters.authorData;
            },
            getBooksData() {
                return store.getters.booksData;
            }
        },
        methods: {
            initAddAuthor()
            {
                this.errors = [];
                $("#add_task_model").modal("show");
            },
            initAddPublishing()
            {
                this.errors = [];
                $("#create_publishing_house_model").modal("show");
            },
            initAddBook()
            {
                this.errors = [];
                $("#create_book_model").modal("show");
                //инициализируем запросы к серверу для вывода нужных данных в форме
                this.getAuthors();
                this.getPublishingHouses ();
            },
            getAuthors () {
                return store.dispatch('getAuthors');
            },
            getPublishingHouses () {
                return store.dispatch('getPublishingHouses');
            },
            getBooksAction () {
                return store.dispatch('getBooks');
            },

            deleteAuthor({id}, index)
            {
                let isDelete = confirm('do you really want to delete the book?');
                if(isDelete) {
                    store.dispatch('deleteBook', {id}).then(() => {
                        this.getBooksData.splice(index, 1);
                    })
                }
            },

        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css">

</style>