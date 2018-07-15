<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="create_book_model">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create Book</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" v-if="errors.length > 0">
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>Publishing Houses</label>
                        <select class="form-control" id="publishing" name="name" v-model="model.house">
                            <option v-for="data in getPublishingHouses" v-bind:value="data.id">{{ data.name }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Authors</label>
                        <multiselect
                                v-model="selected"
                                :multiple="true"
                                return="id"
                                track-by="id"
                                label = "name"
                                :options="getAuthorsData">
                        </multiselect>
                    </div>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" placeholder="Book Name" class="form-control" v-model="model.name">
                    </div>
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" placeholder="Book Date" class="form-control" v-model="model.date">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" @change="onFile">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" @click="createBook()" class="btn btn-primary">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
    import store from '../store/index'
    import Multiselect from 'vue-multiselect'
    export default {
        name: "createBook",
        components: { Multiselect},
        data(){
            return {
                selected: [],
                model: {
                    selectedId: [],
                    house: '',
                    name: '',
                    date: '',
                    image: ''
                },
                errors: [],
            }
        },
        mounted() {

        },
        methods: {
            createBook() {
                //записываем айдишники авторов в свойство так как в библиотеке нет инструментов для прямой записи
                for(let i = 0; i < this.selected.length; i++) {
                    this.model.selectedId.push(this.selected[i].id);
                }
                return store.dispatch('createBook', this.model).then(() => {
                    this.reset();
                    $("#create_book_model").modal("hide");
                    window.location.reload();
                })
            },
            onFile(event) {
                this.model.image = event.target.files[0];
            },
            reset() {
                this.selected = [];
                this.model.house = '';
                this.model.name = '';
                this.model.date = '';
            },
            getBook () {
                return  store.dispatch('getBooks');
            }
        },
        computed: {
            getAuthorsData() {
                return store.getters.authorData;
            },
            getPublishingHouses () {
                return store.getters.housesData;
            }
        },
    }
</script>

<style scoped>

</style>