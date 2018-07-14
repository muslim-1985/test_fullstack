<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="add_task_model">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Author</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger" v-if="errors.length > 0">
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="title" id="name" placeholder="Author Name" class="form-control"
                               v-model="author.title">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" @click="createAuthor()" class="btn btn-primary">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
    import store from '../store/index'
    export default {
        name: "createAuthor",
        data(){
            return {
                author: {
                    title: ''
                },
                errors: [],
                tasks: []
            }
        },
        methods: {
            createAuthor() {
                return store.dispatch('createAuthor', this.author.title).then(()=>{
                    this.reset();
                    $("#add_task_model").modal("hide");
                })
            },
            reset()
            {
                this.author.title = '';
                //this.publishingHouse.title = ''
            },
        }
    }
</script>

<style scoped>

</style>